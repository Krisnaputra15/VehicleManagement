<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    public function index(){
        $vehicles = Vehicle::paginate(20);
        Log::channel('activity')->info(request()->ip . " | User " . Auth::user()->email . " mengakses list semua kendaraan");
        return view('vehicle.index', ['page' => 'vehicles', 'vehicles' => $vehicles]);
    }

    public function create(){
        return view('vehicle.form', ['page' => 'vehicles']);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'serie' => 'required|string',
            'year' => 'required|numeric|min:1990|max:10000',
            'license_number' => 'required|string|unique:vehicles',
            'fuel_capacity' => 'required|numeric',
            'service_cycle' => 'nullable|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->route('vehicles.create')->with('error', $validator->errors()->first())->withInput();
        }
        $validated = $validator->validate();
        $validated['service_cycle'] = $validated['service_cycle'] == null ? 10000 : $validated['service_cycle'];
        $validated['license_number'] = strtoupper($validated['license_number']);
        try {
            $create = Vehicle::create($validated);
            Log::channel('activity')->alert(request()->ip . " | User " . Auth::user()->email . " membuat data kendaraan baru dengan nomor plat {$request->license_number}");
            return redirect()->route('vehicles.index')->with('success', "Berhasil membuat data kendaraan baru");
        } catch (\Exception $e) {
            return redirect()->route('vehicles.create')->with('error', $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $vehicle = Vehicle::find($id);
        Log::channel('activity')->alert(request()->ip . " | User " . Auth::user()->email . " mengakses detail data kendaraan dengan nomor plat {$vehicle->license_number}");
        return view('vehicle.detail', ['page' => 'vehicles', 'vehicle' => $vehicle]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'serie' => 'required|string',
            'year' => 'required|numeric|min:1990|max:10000',
            'license_number' => 'required|string',
            'fuel_capacity' => 'required|numeric',
            'service_cycle' => 'nullable|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->route('vehicles.detail')->with('error', $validator->errors()->first())->withInput();
        }
        $validated = $validator->validate();
        $validated['service_cycle'] = $validated['service_cycle'] == null ? 10000 : $validated['service_cycle'];
        $validated['license_number'] = strtoupper($validated['license_number']);
        try {
            $create = Vehicle::where('id', $id)->update($validated);
            Log::channel('activity')->alert(request()->ip . " | User " . Auth::user()->email . " memperbarui data kendaraan dengan nomor plat {$request->license_number}");
            return redirect()->route('vehicles.index')->with('success', "Berhasil memperbarui data kendaraan");
        } catch (\Exception $e) {
            return redirect()->route('vehicles.detail')->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy($id){
        $vehicle = Vehicle::find($id);
        $delete = $vehicle->delete();
        if ($delete) {
            Log::channel('activity')->alert(request()->ip . " | User " . Auth::user()->email . " menghapus data kendaraan dengan nomor plat {$vehicle->license_number}");
            return redirect()->route('vehicles.index')->with('success', "Berhasil menghapus data user");
        }
        return redirect()->route('vehicles.detail', ['id' => $id])->with('error', "Gagal menghapus data user");
    }
}
