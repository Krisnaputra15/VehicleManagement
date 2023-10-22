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
                       <form id="formAccountSettings" class="px-4 pb-4" method="POST" action="{{ route('transactions.update', ['id' => $transaction->id]) }}">
                            <div class="row">
                                @csrf
                                <div class="mb-3">
                                <label for="nik" class="form-label">Peminjam</label>
                                <select id="driver_id" name="driver_id" class="select2 form-select" disabled>
                                    @foreach($users as $u)
                                        <option value="{{$u->id}}" {{$u->id == $transaction->driver_id ? "selected" : ""}}>{{$u->email}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nik" class="form-label">Kendaraan</label>
                                <select id="vehicle_id" name="vehicle_id" class="select2 form-select" disabled>
                                    @foreach($vehicles as $u)
                                        <option value="{{$u->id}}" {{$u->id == $transaction->vehicle_id ? "selected" : ""}}>{{$u->serie}} {{strtoupper($u->license_number)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Mulai pinjam</label>
                                <p style="font-size: 0.7rem; color: gray; margin: 0 0;">* Kosongi jika tanggal tidak berubah</p>
                                <input class="form-control" type="date" name="booking_start" id="booking_start" placeholder="Seri" value="{{ $transaction->booking_start}}"
                                    />
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Durasi pinjam (hari)</label>
                                <input class="form-control" type="number" name="booking_duration" id="booking_duration"step="1" placeholder="Lama peminjaman kendaraan" value="{{ $transaction->booking_duration}}"
                                    />
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan data</button>
                            <button type="reset" class="btn btn-outline-secondary" onclick="window.location.reload()">Cancel</button>
                        </form>
                            </div>
                    <!-- /Account -->
                </div>
                <div class="card">
                    <h5 class="card-header">Hapus Data Pengajuan</h5>
                    <div class="card-body">
                        <div class="mb-3 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h6 class="alert-heading fw-bold mb-1">Apakah anda benar-benar ingin menghapus data pengajuan
                                    ini?
                                </h6>
                                <p class="mb-0">data tidak akan bisa dikembalikan saat sudah dihapus.</p>
                            </div>
                        </div>
                        <form id="formAccountDeactivation" method="GET"
                            action="{{ route('transactions.destroy', ['id' => $transaction->id]) }}">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="accountActivation"
                                    id="accountActivation" required />
                                <label class="form-check-label" for="accountActivation">Saya menyetujui penghapusan pengajuan
                                    ini</label>
                            </div>
                            <button type="submit" class="btn btn-danger deactivate-account">Hapus pengajuan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
