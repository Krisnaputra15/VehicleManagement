@extends('template.template')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User /</span> Detail</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Detail User</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
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
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST"
                            action="{{ route('users.update', ['id' => $user->id]) }}">
                            <div class="row">
                                @csrf
                                <div class="mb-3">
                                    <label for="nik" class="form-label">Nama Lengkap</label>
                                    <input class="form-control" type="text" name="fullname" id="fullname" placeholder="Nama Lengkap" value="{{ $user->fullname }}">
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Email</label>
                                    <input class="form-control" type="text" name="email" id="email" placeholder="Email" value="{{ $user->email }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Password</label>
                                    <input class="form-control" type="password" name="password" id="password"
                                        placeholder="Kosongi jika tidak ingin melakukan update password" />
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Jabatan</label>
                                    <input class="form-control" type="text" name="position" id="position" placeholder="Jabatan" value="{{ $user->position }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="level" class="form-label">Level</label>
                                    <select id="level" name="level" class="select2 form-select">
                                        @if ($user->level == 1)
                                            <option value="1" selected>Administrator</option>
                                            <option value="2">Non-admin</option>
                                        @else
                                            <option value="1">Administrator</option>
                                            <option value="2" selected>Non-admin</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                                <button type="reset" class="btn btn-outline-secondary"
                                    onclick="window.location.reload()">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
                <div class="card">
                    <h5 class="card-header">Hapus Akun</h5>
                    <div class="card-body">
                        <div class="mb-3 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h6 class="alert-heading fw-bold mb-1">Apakah anda benar-benar ingin menghapus data user
                                    ini?
                                </h6>
                                <p class="mb-0">akun tidak akan bisa dikembalikan saat sudah dihapus.</p>
                            </div>
                        </div>
                        <form id="formAccountDeactivation" method="GET"
                            action="{{ route('users.destroy', ['id' => $user->id]) }}">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="accountActivation"
                                    id="accountActivation" required />
                                <label class="form-check-label" for="accountActivation">Saya menyetujui penghapusan akun
                                    ini</label>
                            </div>
                            <button type="submit" class="btn btn-danger deactivate-account">Hapus Akun</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
