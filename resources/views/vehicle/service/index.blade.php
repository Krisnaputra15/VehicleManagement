@extends('template.template')

@section('title')
Daftar Pengguna
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Kendaraan /</span> {{$vehicle->license_number}} / Servis</h4>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Data Servis Kendaraan <span style="font-weight:bold;">{{$vehicle->license_number}}</span></h5>
            <div class="table text-nowrap">
                @if (sizeof($services) == 0)
                    <p class="text-center">Belum ada data servis tercatat</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Servis</th>
                                <th>Biaya servis</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @php $i = 1; @endphp
                            @foreach ($services as $u)
                                @php $date = new DateTime($u->service_date) @endphp
                                <tr>
                                    <td>
                                        <p>{{ $i }}</p>
                                    </td>
                                    <td>{{ $date->format('d-m-Y') }}</td>
                                    <td>{{ $u->price }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown" data-bs-target="#detail">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" id="detail">
                                                <a class="dropdown-item" href="{{ route('services.detail', ['id' => $vehicle->id, 'serviceId' => $u->id]) }}"><i
                                                        class="bx bx-detail me-2"></i> Lihat detail</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @php ++$i @endphp
                            @endforeach
                @endif
                </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center py-3">
            @if ($vehicle->need_service == 0)
                <a class="btn btn-success text-white">Kendaraan dalam kondisi sehat</a>
            @else
                <a class="btn btn-primary text-white" href="{{route('services.create', ['id' => $vehicle->id])}}">Tambah data servis</a>
            @endif
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>
@endsection
