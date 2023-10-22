@extends('template.template')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Kendaraan / </span> {{$vehicle->license_number}} / Servis / Detail</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Detail Servis</h5>
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
                       <form id="formAccountSettings" class="px-4 pb-4" method="POST" action="{{ route('services.update', ['id' => $vehicle->id, 'serviceId' => $service->id]) }}">
                            <div class="row">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Tanggal servis</label>
                                    <p style="font-size: 0.7rem; color: gray; margin: 0 0;">* Kosongi jika tanggal tidak berubah</p>
                                    <input class="form-control" type="date" name="service_date" id="service_date" placeholder="Tanggal servis" value="{{ $service->service_date}}" 
                                        />
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Deskripsi servis</label>
                                    <textarea class="form-control my-editor" name="service_desc" id="service_desc">{!! $service->service_desc !!}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Biaya total</label>
                                    <input class="form-control" type="number" name="price" id="price" placeholder="Total biaya servis" value="{{ $service->price}}" required
                                        />
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan data</button>
                            <button type="reset" class="btn btn-outline-secondary" onclick="window.location.reload()">Cancel</button>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script src="https://cdn.tiny.cloud/1/a652irwn1qsuf084nirrph7cx1likixztsr4gp83e2nrq7ja/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        var editor_config = {
            path_absolute: "/",
            selector: 'textarea.my-editor',
            relative_urls: false,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",

        };

        tinymce.init(editor_config);
    </script>
@endsection
