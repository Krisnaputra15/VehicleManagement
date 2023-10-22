@extends('template.template')

@section('title')
    Buat User Baru
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
       <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Kendaraan /</span> {{$vehicle->license_number}} / Servis</h4>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Data Kendaraan <span style="font-weight:bold;">Rideit</span></h5>
            <form id="formAccountSettings" class="px-4 pb-4" method="POST" action="{{ route('services.store', ['id' => $vehicle->id]) }}">
                <div class="row">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Tanggal servis</label>
                        <input class="form-control" type="date" name="service_date" id="service_date" placeholder="Tanggal servis" value="{{ old('service_date')}}" required
                            />
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Deskripsi servis</label>
                        <textarea class="form-control my-editor" name="service_desc" id="service_desc">{{ old('service_desc') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Biaya total</label>
                        <input class="form-control" type="number" name="price" id="price" placeholder="Total biaya servis" value="{{ old('price')}}" required
                            />
                    </div>
                </div>
                <a href="{{route('services.index', ['id' => $vehicle->id])}}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan data</button>
            </form>
        </div>
        <!--/ Basic Bootstrap Table -->
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
