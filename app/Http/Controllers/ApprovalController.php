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

class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id = null)
    {
        if($id == null){
            $approved = Approvation::where('approver_id', Auth::user()->id)->where('is_approved', 1)->get();
            $unapproved = Approvation::where('approver_id', Auth::user()->id)->where('is_approved', 0)->get();
            return view('transaction.approvation.index', ['page' => 'transactions', 'approved' => $approved, 'approvation' => $unapproved]);
        } else {
            $approvation = Approvation::where('transaction_id', $id)->get();
            $transaction = Transaction::find($id);
            return view('transaction.approvation.index', ['page' => 'transactions', 'approvation' => $approvation, 'transaction' => $transaction]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function setApprovation(string $id, string $action){
        $message = $action == 'approve' ? "menerima" : "menolak";
        try{
            $approvation = Approvation::find($id);
            $update = $approvation->update([
                'is_approved' => $action == 'approve' ? 1 : 0,
            ]);
            $this->checkAndChangeApproveStatus($approvation->transaction_id);
            Log::channel('activity')->alert(request()->ip . " | User " . Auth::user()->email . " mengubah status persetujuan dengan id {$approvation->id}");
            return redirect()->back()->with('success', "Berhasil {$message} permohonan peminjaman kendaraan");
        } catch (\Exception $e){
            return redirect()->back()->with('error', "Gagal {$message} permohonan peminjaman kendaraan");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, string $approvationId)
    {   
        $approvation = Approvation::find($approvationId);
        $delete = $approvation->delete();
        if ($delete) {
            $this->checkAndChangeApproveStatus($approvation->transaction_id);
            Log::channel('activity')->alert(request()->ip . " | User " . Auth::user()->email . " menghapus data penyetuju dengan id {$approvation->id}");
            return redirect()->route('approvations.index', ['id' => $id, 'approvationId'])->with('success', "Berhasil menghapus data user");
        }
        return redirect()->route('approvations.index', ['id' => $id, 'approvationId'])->with('error', "Gagal menghapus data user");

    }

    public function checkAndChangeApproveStatus(string $transactionId){
        $countAllApprovation = Approvation::where('transaction_id', $transactionId)->count();
        $countApproved = Approvation::where('transaction_id', $transactionId)->where('is_approved', 1)->count();
        if ($countApproved == $countAllApprovation) {
            $updateTransaction = Transaction::where('id', $transactionId)->update([
                'is_approved' => 1
            ]);
        }
    }
}
