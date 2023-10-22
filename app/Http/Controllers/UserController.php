<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $users = User::paginate(20);
        Log::channel('activity')->info(request()->ip." | User ".Auth::user()->email." mengakses list semua user");
        return view('user.index', ['page' => 'users', 'user' => $users]);
    }

    public function create(){
        return view('user.form', ['page' => 'users']);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'nullable|string',
            'fullname' => 'required|string',
            'position' => 'required|string',
        ]);
        if($validator->fails()){
            return redirect()->route('users.create')->with('error', $validator->errors()->first())->withInput();
        }
        try{
            $password = Hash::make($request->password == null ? 'vehiclemanagement' : $request->password);
            $create = User::create([
                'email' => $request->email,
                'password' => $password,
                'fullname' => $request->fullname,
                'position' => $request->position
            ]);
            Log::channel('activity')->alert(request()->ip . " | User " . Auth::user()->email . " membuat user baru dengan email {$request->email}");
            return redirect()->route('users.index')->with('success', "Berhasil membuat data user baru");
        } catch(\Exception $e){
            return redirect()->route('users.create')->with('error', $e->getMessage())->withInput();
        }
    }

    public function show($id){
        $user = User::find($id);
        Log::channel('activity')->alert(request()->ip . " | User " . Auth::user()->email . " mengakses detail data user dengan email {$user->email}");
        return view('user.detail', ['page' => 'users', 'user' => $user]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'nullable|string',
            'fullname' => 'required|string',
            'position' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->route('users.detail', ['id' => $id])->with('error', $validator->errors()->first())->withInput();
        }
        try {
            $update = User::where('id', $id)->update([
                'email' => $request->email,
                'fullname' => $request->fullname,
                'position' => $request->position
            ]);
            if($request->password != null){
                User::where('id', $id)->update([
                    'password' => Hash::make($request->password),
                ]);
            }
            Log::channel('activity')->alert(request()->ip . " | User " . Auth::user()->email . " memperbarui data user dengan email {$request->email}");
            return redirect()->route('users.index')->with('success', "Berhasil memperbarui data user");
        } catch (\Exception $e) {
            return redirect()->route('users.detail', ['id' => $id])->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy($id){
        $user = User::find($id);
        $delete = $user->delete();
        if($delete){
            Log::channel('activity')->alert(request()->ip." | User " . Auth::user()->email . " menghapus data user dengan email {$user->email}");
            return redirect()->route('users.index')->with('success', "Berhasil menghapus data user");
        }
        return redirect()->route('users.detail', ['id' => $id])->with('error', "Gagal menghapus data user");
    }

    // api

    public function getUser(){
        $user = User::select('id','email')->get();
        return $user;
    }
}
