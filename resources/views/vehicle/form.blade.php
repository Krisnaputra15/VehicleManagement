@extends('template.template')

@section('title')
    Buat User Baru
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> {{ $page }}</h4>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Data Kendaraan <span style="font-weight:bold;">Rideit</span></h5>
            <form id="formAccountSettings" class="px-4 pb-4" method="POST" action="{{ route('vehicles.store') }}">
                <div class="row">
                    @csrf
                    <div class="mb-3">
                        <label for="nik" class="form-label">Tipe</label>
                        <select id="type" name="type" class="select2 form-select" required>
                                <option value="suv">SUV</option>
                                <option value="sedan">Sedan</option>
                                <option value="pickup">Pickup</option>
                                <option value="bus">Bus</option>
                                <option value="motor">Motor</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Seri</label>
                        <input class="form-control" type="text" name="serie" id="serie" placeholder="Seri" value="{{ old('serie')}}" required
                            />
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Tahun</label>
                        <input class="form-control" type="number" name="year" id="year" min="1900" max="9999" step="1" placeholder="Tahun Kendaraan" value="{{ old('year')}}" required
                            />
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nomor Plat</label>
                        <input class="form-control" type="text" name="license_number" id="license_number" placeholder="Nomor Plat Kendaraan" value="{{ old('license_number')}}" required
                            />
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Kapasitas BBM (Liter)</label>
                        <input class="form-control" type="number" name="fuel_capacity" id="fuel_capacity" placeholder="Kapasitas BBM dalam Liter" value="{{ old('fuel_capacity')}}" required
                            />
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Siklus Servis (per KM)</label>
                        <input class="form-control" type="number" name="service_cycle" id="service_cycle" placeholder="Kosongi untuk default (10000 KM)" value="{{ old('service_cycle')}}"
                            />
                    </div>
                </div>
                <a href="{{route('vehicles.index')}}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan data</button>
            </form>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>
@endsection
