<?php

namespace App\Http\Controllers;

use App\Exports\TransactionExport;
use App\Models\Transaction;
use Carbon\Carbon;
use DateTime;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    public function home(){
        $date = new DateTime(date('Y-m-01'));
        $transaksiAll = Transaction::whereMonth('booking_start', date('m'))->get();
        $transaksiLimit = Transaction::whereMonth('booking_start', date('m'))->limit(5)->get();
        $dataIn = [];
        $dataOut = [];

        // Initialize the data arrays
        for ($week = 1; $week <= 5; $week++) {
            $dataIn[$week] = 0;
            $dataOut[$week] = 0;
        }

        foreach ($transaksiAll as $transaction) {
            $week = Carbon::parse($transaction->booking_start)->weekOfMonth;
            if ($transaction->is_returned == 1) {
                $dataIn[$week] += 1;
            } elseif ($transaction->is_returned == 0) {
                $dataOut[$week] += 1;
            }
        }
        return view('index', ['page' => "home", 'dataMasuk' => $dataIn, 'dataKeluar' => $dataOut, 'transaksi' => $transaksiLimit]);
    }

    public function download(){
        return Excel::download(new TransactionExport, 'report-' . date('m-Y') . '.xlsx');
    }
}
