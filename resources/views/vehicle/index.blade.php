@extends('template.template')

@section('title')
Daftar Pengguna
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> {{ $page }}</h4>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Data Kendaraan <span style="font-weight:bold;">Rideit</span></h5>
            <div class="table text-nowrap">
                @if (sizeof($vehicles) == 0)
                    <p class="text-center">Belum ada data kendaraan terdaftar</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tipe</th>
                                <th>Seri</th>
                                <th>Tahun</th>
                                <th>Plat Nomor</th>
                                <th>Kapasitas BBM</th>
                                <th>Siklus Servis (km)</th>
                                <th>Status Servis</th>
                                <th>Status Kendaraan</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @php $i = 1; @endphp
                            @foreach ($vehicles as $u)
                                <tr>
                                    <td>
                                        <p>{{ $i }}</p>
                                    </td>
                                    <td>{{ strtoupper($u->type) }}</td>
                                    <td>{{ $u->serie }}</td>
                                    <td>{{ $u->year }}</td>
                                    <td>{{ $u->license_number }}</td>
                                    <td>{{ $u->fuel_capacity }} L</td>
                                    <td>{{ $u->service_cycle }} KM</td>
                                    <td>
                                        <span class="badge bg-label-{{ $u->need_service == 0 ? 'success' : 'danger  ' }} me-1">{{ $u->need_service == 0 ? 'Kendaraan Sehat':'Butuh Servis'}}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-label-{{ $u->is_booked == 0 ? 'success' : 'danger  ' }} me-1">{{ $u->is_booked == 0 ? 'Kosong' : 'Dalam pemakaian' }}</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown" data-bs-target="#detail">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" id="detail">
                                                <a class="dropdown-item" href="{{ route('vehicles.detail', ['id' => $u->id]) }}"><i
                                                        class="bx bx-detail me-2"></i> Lihat detail</a>
                                                <a class="dropdown-item" href="{{ route('services.index', ['id' => $u->id]) }}"><i
                                                        class="bx bx-cog me-2"></i> Lihat Histori Servis</a> 
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
            <a class="btn btn-primary text-white" href="{{route('vehicles.create')}}">Tambah kendaraan baru</a>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>
@endsection
