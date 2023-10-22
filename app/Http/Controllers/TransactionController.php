<?php

namespace App\Http\Controllers;

use App\Models\Approvation;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{

    public function index()
    {
        $transactions = Transaction::paginate(20);
        Log::channel('activity')->info(request()->ip . " | User " . Auth::user()->email . " mengakses list semua pengajuan");
        return view('transaction.index', ['page' => 'transactions','transactions' => $transactions]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $vehicles = Vehicle::where('need_service', 0)->where('is_booked', 0)->select('id','serie','license_number')->get();
        $users = DB::select("SELECT id, email FROM users WHERE id NOT IN(SELECT DISTINCT driver_id FROM transactions WHERE is_returned = 0) AND level = 2");
        return view('transaction.form', ['page' => 'transactions', 'vehicles' => $vehicles, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'booking_duration' => 'required|numeric|max:10',
            'booking_start' => 'required',
            'driver_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'approver.*' => 'required|exists:users,id',
        ]);
        if($validator->fails()){
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }
        $checkDriver = Transaction::where('driver_id', $request->driver_id)->where('is_returned', 0)->count();
        $checkVehicle = Vehicle::where('id', $request->vehicle_id)->first();
        if($checkDriver > 0){
            return redirect()->back()->with('error', "Peminjam yang dipilih belum mengembalikan kendaraan, mohon kembalikan terlebih dahulu")->withInput();
        }
        if($checkVehicle->is_booked == 1){
            return redirect()->back()->with('error', "Kendaraan yang dipilih telah dipinjam, silakan pilih kendaraan lain")->withInput();
        }
        if ($checkVehicle->need_service == 1) {
            return redirect()->back()->with('error', "Kendaraan yang dipilih membutuhkan servis, silakan pilih kendaraan lain")->withInput();
        }
        try{
            $createTransaction = Transaction::create([
                'driver_id' => $request->driver_id,
                'vehicle_id' => $request->vehicle_id,
                'booking_duration' => $request->booking_duration,
                'booking_start' => $request->booking_start
            ]);
            for($i = 0; $i < count($request->approver); $i++){
                if($i > 0){
                    if($request->approver[$i] == $request->approver[$i-1]){
                        continue;
                    }
                }
                Approvation::create([
                    'approver_id' => $request->approver[$i],
                    'transaction_id' => $createTransaction->id
                ]);
            }
            $updateVehicle = Vehicle::where('id', $request->vehicle_id)->update([
                'is_booked' => 1
            ]);
            Log::channel('activity')->alert(request()->ip . " | User " . Auth::user()->email . " membuat pengajuan baru dengan id {$createTransaction->id}");
            return redirect()->route('transactions.index')->with('success', "Berhasil membuat pengajuan baru, silakan cek status persetujuan secara berkala");
        } catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = Transaction::find($id);
        $vehicles = Vehicle::where('need_service', 0)->select('id', 'serie', 'license_number')->get();
        $users = DB::select("SELECT id, email FROM users WHERE level = 2");
        Log::channel('activity')->alert(request()->ip . " | User " . Auth::user()->email . " mengakses detail data pengajuan dengan id {$transaction->id}");
        return view('transaction.detail', ['page' => 'transactions', 'transaction' => $transaction, 'vehicles' => $vehicles, 'users' => $users]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'booking_duration' => 'required|numeric|max:10',
            'booking_start' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }
        $validated = $validator->validate();
        try {
            $transaction = Transaction::find($id);
            $validated['booking_start'] = $request->booking_start == null ? $transaction->booking_start : $request->booking_start;
            $createTransaction = Transaction::where('id', $id)([
                'booking_duration' => $validated['booking_duration'],
                'booking_start' => $validated['booking_start']
            ]);
            Log::channel('activity')->alert(request()->ip . " | User " . Auth::user()->email . " memperbarui data pengajuan dengan id {$createTransaction->id}");
            return redirect()->route('transactions.index')->with('success', "Berhasil memperbarui data pengajuan, silakan cek status persetujuan secara berkala");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = Transaction::find($id);
        $vehicleUpdate = Vehicle::find($transaction->vehicle_id)->update([
            'is_booked' => 0
        ]);
        $delete = $transaction->delete();
        if ($delete) {
            Log::channel('activity')->alert(request()->ip . " | User " . Auth::user()->email . " menghapus data pengajuan dengan id {$transaction->id}");
            return redirect()->route('transactions.index')->with('success', "Berhasil menghapus data pengajuan");
        }
        return redirect()->route('transactions.detail', ['id' => $id])->with('error', "Gagal menghapus data pengajuan");
    }

    public function setAction(Request $request, string $id, string $action){
        $message = $action == 'pickup' ? "mengambil" : "mengembalikan";
        try {
            $transaction = Transaction::find($id);
            if($action == 'pickup'){
                $update = $transaction->update([
                    'pickup_date' => date('Y-m-d H:i:s')
                ]);
            }
            if($action == 'return'){
                $dateMustReturn = date('Y-m-d H:i:s', strtotime($transaction->booking_start . " +{$transaction->booking_duration} days"));
                return $dateMustReturn <= date('Y-m-d H:i:s');
                $update = $transaction->update([
                    'return_date' => date('Y-m-d H:i:s'),
                    'distance_traveled' => $request->distance_traveled,
                    'fuel_consumed' => $request->fuel_consumed,
                    'is_returned' => 1,
                    'return_status' => $dateMustReturn <= date('Y-m-d H:i:s') ? "on time" : "late"
                ]);
                $updateVehicle = Vehicle::where('id', $transaction->vehicle_id)->update([
                    'is_booked' => 0,
                ]);
            }
            Log::channel('activity')->alert(request()->ip . " | User " . Auth::user()->email . " mengubah status transaksi dengan id {$transaction->id}");
            return redirect()->back()->with('success', "Berhasil {$message} kendaraan");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Gagal {$message} kendaraan");
        }
    }
}
