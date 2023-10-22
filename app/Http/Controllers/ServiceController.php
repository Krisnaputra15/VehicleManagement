<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceHistory;
use App\Models\Vehicle;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $vehicle = Vehicle::find($id);
        $services = ServiceHistory::where('vehicle_id', $id)->paginate(20);
        Log::channel('activity')->info(request()->ip . " | User " . Auth::user()->email . " mengakses riwayat servis kendaraan dengan plat nomor {$vehicle->license_number}");
        return view('vehicle.service.index', ["vehicle" => $vehicle, "services" => $services, 'page' => 'vehicles']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return view('vehicle.service.form', ['page' => 'vehicles', 'vehicle' => Vehicle::find($id)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'service_date' => 'required|date',
            'service_desc' => 'required',
            'price' => 'required|numeric|min:500',
        ]);
        if ($validator->fails()){
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }
        $validated = $validator->validate();
        $validated['vehicle_id'] = $id;
        $validated['serviced_at_km'] = 0;
        $checkTransactions = Transaction::where('vehicle_id', $id)->get();
        foreach($checkTransactions as $c){
            $validated['serviced_at_km'] += $c->distance_traveled;
        }
        try{
            $create = ServiceHistory::create($validated);
            $vehicle = Vehicle::find($id);

            $update = $vehicle->update([
                'need_service' => false
            ]);
            Log::channel('activity')->alert($request->ip . " | User " . Auth::user()->email . " menambahkan history servis kendaraan dengan nomor plat {$vehicle->license_number}");
            return redirect()->route('services.index', ['id' => $id])->with('success', "Berhasil menambahkan data servis kendaraan {$vehicle->license_number}");
        } catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
        
    }

    public function show(string $id, string $serviceId)
    {
        $service = ServiceHistory::find($serviceId);
        $vehicle = Vehicle::find($id);
        Log::channel('activity')->alert(request()->ip . " | User " . Auth::user()->email . " mengakses detail servis dengan id {$service->id}");
        return view('vehicle.service.detail', ['page' => 'vehicles', 'service' => $service, 'vehicle' => $vehicle]);
    }

    public function update(Request $request, string $id, string $serviceId)
    {
        $validator = Validator::make($request->all(), [
            'service_date' => 'nullable|date',
            'service_desc' => 'required',
            'price' => 'required|numeric|min:500',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }
        $validated = $validator->validate();
        try {
            $service = ServiceHistory::find($serviceId);
            $validated['service_date'] = $request->service_date == null ? $service->service_date : $request->service_date;
            $update = $service->update([
                'service_date' => $validated['service_date'],
                'service_desc' => $validated['service_desc'],
                'price' => $validated['price'],
            ]);
            $vehicle = Vehicle::find($id);
            

            Log::channel('activity')->alert($request->ip . " | User " . Auth::user()->email . " memperbarui history servis dengan id {$service->id}");
            return redirect()->route('services.index', ['id' => $id])->with('success', "Berhasil memperbarui data servis kendaraan {$vehicle->license_number}");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
