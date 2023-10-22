@extends('template.template')

@section('title')
Daftar Pengajuan
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Pengajuan</h4>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Data Permintaan Persetujuan Penggunaan Kendaraan <span style="font-weight:bold;">Rideit</span></h5>
            <div class="table">
                @if (sizeof($approvation) == 0)
                    <p class="text-center">Belum ada data pengajuan terdaftar</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                @if(auth()->user()->level == 1)
                                <th>No</th>
                                <th>Nama Penyetuju</th>
                                <th>Jabatan</th>
                                <th>Status</th>
                                <th>Actions</th>
                                @else
                                <th>No</th>
                                <th>Nama Driver</th>
                                <th>Kendaraan</th>
                                <th>Status</th>
                                <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @php $i = 1; @endphp
                            @foreach ($approvation as $u)
                                <tr>
                                    @if(auth()->user()->level == 1)
                                    <td>
                                        <p>{{ $i }}</p>
                                    </td>
                                    <td>{{ $u->user->fullname }}</td>
                                    <td>{{ $u->user->position }}</td>
                                    <td>
                                        <span class="badge bg-label-{{$u->is_approved == 1 ? "success" : "danger"}} me-1">{{$u->is_approved == 1? "Diterima" : "Ditolak"}}</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown" data-bs-target="#detail">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" id="detail">
                                                <a class="dropdown-item" href="{{ route('approvations.destroy', ['id' => $transaction->id, 'approvationId' => $u->id]) }}"><i
                                                        class="bx bx-detail me-2"></i> Hapus data</a>
                                            </div>
                                        </div>
                                    </td>
                                    @else
                                    <td>
                                        <p>{{ $i }}</p>
                                    </td>
                                    <td>{{ $u->transaction->user->fullname }}</td>
                                    <td>{{ $u->transaction->vehicle->serie }} | {{ $u->transaction->vehicle->license_number }}</td>
                                    <td>
                                        <span class="badge bg-label-{{$u->is_approved == 1 ? "success" : "danger"}} me-1">{{$u->return_status == 1? "Diterima" : "Ditolak"}}</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown" data-bs-target="#detail">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" id="detail">
                                                @if($u->is_approved == 1)
                                                    <a class="dropdown-item" href="{{ route('nonadmin.approvations.setaction', ['id' => $u->id, 'action' => 'deny']) }}"><i
                                                        class="bx bx-detail me-2"></i> Tolak</a>
                                                @else
                                                    <a class="dropdown-item" href="{{ route('nonadmin.approvations.setaction', ['id' => $u->id, 'action' => 'approve']) }}"><i
                                                        class="bx bx-detail me-2"></i> Terima</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                                @php ++$i @endphp
                            @endforeach
                @endif
                </tbody>
                </table>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>
@endsection
