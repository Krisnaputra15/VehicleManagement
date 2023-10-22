@extends('template.template')

@section('title')
    Buat Pengajuan Baru
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Peminjaman</h4>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Data Kendaraan <span style="font-weight:bold;">Rideit</span></h5>
            <form id="formPengajuanSettings" class="px-4 pb-4" method="POST" action="{{ route('transactions.store') }}">
                <div class="row">
                    @csrf
                    <div class="mb-3">
                        <label for="nik" class="form-label">Peminjam</label>
                        <select id="driver_id" name="driver_id" class="select2 form-select" required>
                            @foreach($users as $u)
                                <option value="{{$u->id}}">{{$u->email}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">Kendaraan</label>
                        <select id="vehicle_id" name="vehicle_id" class="select2 form-select" required>
                            @foreach($vehicles as $u)
                                <option value="{{$u->id}}">{{$u->serie}} {{strtoupper($u->license_number)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Mulai pinjam</label>
                        <input class="form-control" type="date" name="booking_start" id="booking_start" placeholder="Seri" value="{{ old('booking_start')}}" required
                            />
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Durasi pinjam (hari)</label>
                        <input class="form-control" type="number" name="booking_duration" id="booking_duration"step="1" placeholder="Tahun Kendaraan" value="{{ old('booking_duration')}}" required
                            />
                    </div>
                    <div class="mb-3" id="approverBox">
                        <label for="syarat" class="form-label">Penyetuju</label>
                        <div class="d-flex" style="gap: 15px">
                            <select id="approver" name="approver[]" class="select2 form-select" required>
                                @foreach($users as $u)
                                    <option value="{{$u->id}}">{{$u->email}}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-success" onclick="add()"><i
                                    class="fa-sharp fa-solid fa-plus" style="color: #ffffff;"></i></button>
                            <button type="button" class="btn btn-danger" onclick="remove()"><i
                                    class="fa-sharp fa-solid fa-minus" style="color: #ffffff;"></i></button>
                        </div>

                    </div>
                </div>
                <a href="{{route('transactions.index')}}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan data</button>
            </form>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>
@endsection

@section('extra-scripts')
<script>
        var formfield = document.getElementById('formPengajuanSettings');
        var elementBox = document.getElementById('approverBox');
        var elementForm = document.getElementById('approver');

        function add() {
            var container = document.getElementById("approverBox");
            var newDiv = document.createElement("div");
            newDiv.setAttribute("class", "d-flex");
            newDiv.style.gap = "15px";
            newDiv.style.marginTop = "10px";
            newDiv.innerHTML = `
             <select id="approver" name="approver[]" class="select2 form-select" required>
                                @foreach($users as $u)
                                    <option value="{{$u->id}}">{{$u->email}}</option>
                                @endforeach
            </select>
            <button type="button" class="btn btn-success" onclick="add()" required><i class="fa-sharp fa-solid fa-plus" style="color: #ffffff;"></i></button>
            <button type="button" class="btn btn-danger" onclick="remove()"><i class="fa-sharp fa-solid fa-minus" style="color: #ffffff;"></i></button>
        `;
            container.appendChild(newDiv);
        }

        function remove() {
            var syaratBox = document.getElementById("approverBox");
            var dFlexDivs = syaratBox.getElementsByClassName("d-flex");

            // Check if there are more than one d-flex divs
            if (dFlexDivs.length > 1) {
                syaratBox.removeChild(dFlexDivs[dFlexDivs.length - 1]);
            }
        }
    </script>
@endsection
