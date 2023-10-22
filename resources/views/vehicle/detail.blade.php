@extends('template.template')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Kendaraan /</span> Detail</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Detail Kendaraan</h5>
                    <!-- Account -->
                    <div class="card-body">
                        {{-- <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ $user->picture_url == null ? asset('admin/img/avatars/1.png') : $user->picture_url }}"
                                alt="user-avatar" class="d-block rounded" height="100" width="100"
                                id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Ganti foto baru</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" class="account-file-input" hidden
                                        accept="image/png, image/jpeg" />
                                </label>
                                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>

                                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                            </div>
                        </div> --}}
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                       <form id="formAccountSettings" class="px-4 pb-4" method="POST" action="{{ route('vehicles.update', ['id' => $vehicle->id]) }}">
                            <div class="row">
                                @csrf
                                <div class="mb-3">
                                    <label for="nik" class="form-label">Tipe</label>
                                    <select id="type" name="type" class="select2 form-select" required>
                                            <option value="suv" {{$vehicle->type == "suv" ? "selected" : ""}}>SUV</option>
                                            <option value="sedan" {{$vehicle->type == "sedan" ? "selected" : ""}}>Sedan</option>
                                            <option value="pickup" {{$vehicle->type == "pickup" ? "selected" : ""}}>Pickup</option>
                                            <option value="bus" {{$vehicle->type == "bus" ? "selected" : ""}}>Bus</option>
                                            <option value="motor" {{$vehicle->type == "motor" ? "selected" : ""}}>Motor</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Seri</label>
                                    <input class="form-control" type="text" name="serie" id="serie" placeholder="Seri" value="{{ $vehicle->serie }}" required
                                        />
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Tahun</label>
                                    <input class="form-control" type="number" name="year" id="year" min="1900" max="9999" step="1" placeholder="Tahun Kendaraan" value="{{ $vehicle->year }}" required
                                        />
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nomor Plat</label>
                                    <input class="form-control" type="text" name="license_number" id="license_number" placeholder="Nomor Plat Kendaraan" value="{{ $vehicle->license_number }}" required
                                        />
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Kapasitas BBM (Liter)</label>
                                    <input class="form-control" type="number" name="fuel_capacity" id="fuel_capacity" placeholder="Kapasitas BBM dalam Liter" value="{{ $vehicle->fuel_capacity }}" required
                                        />
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Siklus Servis (per KM)</label>
                                    <input class="form-control" type="number" name="service_cycle" id="service_cycle" placeholder="Kosongi untuk default (10000 KM)" value="{{ $vehicle->service_cycle }}"
                                        />
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan data</button>
                            <button type="reset" class="btn btn-outline-secondary" onclick="window.location.reload()">Cancel</button>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
                <div class="card">
                    <h5 class="card-header">Hapus Data Kendaraan</h5>
                    <div class="card-body">
                        <div class="mb-3 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h6 class="alert-heading fw-bold mb-1">Apakah anda benar-benar ingin menghapus data kendaraan
                                    ini?
                                </h6>
                                <p class="mb-0">data tidak akan bisa dikembalikan saat sudah dihapus.</p>
                            </div>
                        </div>
                        <form id="formAccountDeactivation" method="GET"
                            action="{{ route('vehicles.destroy', ['id' => $vehicle->id]) }}">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="accountActivation"
                                    id="accountActivation" required />
                                <label class="form-check-label" for="accountActivation">Saya menyetujui penghapusan kendaraan
                                    ini</label>
                            </div>
                            <button type="submit" class="btn btn-danger deactivate-account">Hapus Kendaraan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
