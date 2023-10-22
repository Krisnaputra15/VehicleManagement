@extends('template.template')

@section('title')
    Buat User Baru
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> {{ $page }}</h4>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Data User <span style="font-weight:bold;">Rideit</span></h5>
            <form id="formAccountSettings" class="px-4 pb-4" method="POST" action="{{ route('users.store') }}">
                <div class="row">
                    @csrf
                    <div class="mb-3">
                        <label for="nik" class="form-label">Nama Lengkap</label>
                        <input class="form-control" type="text" name="fullname" id="fullname" placeholder="Nama Lengkap" value="{{ old('fullname')}}"
                            >
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Email</label>
                        <input class="form-control" type="text" name="email" id="email" placeholder="Email" value="{{ old('email')}}"
                            />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Password</label>
                        <input class="form-control" type="password" name="password" id="password" value="{{ old('password')}}"
                            placeholder="Kosongi untuk set password default (vehiclemanagement)" />
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Jabatan</label>
                        <input class="form-control" type="text" name="position" id="position" placeholder="Jabatan" value="{{ old('position')}}"/>
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <select id="level" name="level" class="select2 form-select">
                                <option value="1">Administrator</option>
                                <option value="2">Non-admin</option>
                        </select>
                    </div>
                </div>
                <a href="{{route('users.index')}}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan data</button>
            </form>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>
@endsection
