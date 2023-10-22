@extends('template.template')

@section('title')
Daftar Pengajuan
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Pengajuan</h4>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Data Pengajuan Penggunaan Kendaraan <span style="font-weight:bold;">Rideit</span></h5>
            <div class="table">
                @if (sizeof($transactions) == 0)
                    <p class="text-center">Belum ada data pengajuan terdaftar</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Peminjam</th>
                                <th>Kendaraan</th>
                                <th>Mulai Booking</th>
                                <th>Lama Booking (Hari)</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @php $i = 1; @endphp
                            @foreach ($transactions as $u)
                                <tr>
                                    <td>
                                        <p>{{ $i }}</p>
                                    </td>
                                    <td>{{ $u->user->fullname }}</td>
                                    <td>{{ $u->vehicle->serie." | ".$u->vehicle->license_number }}</td>
                                    <td>{{ $u->booking_start }}</td>
                                    <td>{{ $u->booking_duration }}</td>
                                    <td>{{ $u->return_date }}</td>
                                    <td>
                                        @if($u->is_approved == 0)
                                            <span class="badge bg-label-primary me-1">Butuh Persetujuan</span>
                                        @elseif($u->pickup_date == null and $u->is_returned == 0)
                                            <span class="badge bg-label-danger me-1">Belum Diambil</span>
                                        @elseif($u->pickup_date != null and $u->is_returned == 0)
                                            <span class="badge bg-label-secondary me-1">Dipinjam</span>
                                        @elseif($u->is_returned == 1)
                                            <span class="badge bg-label-{{$u->return_status == "on time" ? "success" : "danger"}} me-1">Kembali {{$u->return_status == "on time" ? "Tepat Waktu" : "Terlambat"}}</span>
                                        @endif
                                        
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown" data-bs-target="#detail">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" id="detail">
                                                <a class="dropdown-item" href="{{ route('transactions.detail', ['id' => $u->id]) }}"><i
                                                        class="bx bx-detail me-2"></i> Lihat detail</a>
                                                <a class="dropdown-item" href="{{ route('approvations.index', ['id' => $u->id]) }}"><i
                                                        class="bx bx-cog me-2"></i> Lihat Persetujuan</a> 
                                                @if($u->is_approved == 1 and $u->pickup_date == null and $u->is_returned == 0)
                                                    <a class="dropdown-item" href="{{ route('transactions.setaction', ['id' => $u->id, 'action' => 'pickup']) }}"><i
                                                        class="bx bx-detail me-2"></i> Set diambil</a>
                                                @endif

                                                @if($u->is_approved == 1 and $u->pickup_date != null and $u->is_returned == 0)
                                                    <a class="dropdown-item" href="{{ route('transactions.setaction', ['id' => $u->id, 'action' => 'return']) }}"><i
                                                        class="bx bx-detail me-2"></i> Set dikembalikan</a>
                                                @endif
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
            <a class="btn btn-primary text-white" href="{{route('transactions.create')}}">Tambah pengajuan baru</a>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>
@endsection
