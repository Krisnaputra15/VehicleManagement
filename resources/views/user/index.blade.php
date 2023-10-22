@extends('template.template')

@section('title')
Daftar Pengguna
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> {{ $page }}</h4>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Data User <span style="font-weight:bold;">Rideit</span></h5>
            <div class="table text-nowrap">
                @if (sizeof($user) == 0)
                    <p class="text-center">Belum ada data user</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Email</th>
                                <th>Nama Lengkap</th>
                                <th>Level</th>
                                <th>Jabatan</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @php $i = 1; @endphp
                            @foreach ($user as $u)
                                <tr>
                                    <td>
                                        <p>{{ $i }}</p>
                                    </td>
                                    <td>{{ strlen($u->email) == 0 ? 'Undefined' : $u->email }}</td>
                                    <td>{{ $u->fullname }}</td>
                                    <td>{{ $u->level == 1 ? 'Admin' : 'Non admin' }}</td>
                                    <td>{{ $u->position }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown" data-bs-target="#detail">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" id="detail">
                                                <a class="dropdown-item" href="{{ route('users.detail', ['id' => $u->id]) }}"><i
                                                        class="bx bx-detail me-2"></i> Lihat detail</a>
                                                {{-- <a class="dropdown-item" href="javascript:void(0);"
                            ><i class="bx bx-edit-alt me-2"></i> Edit</a
                          > --}}
                                                {{-- <a class="dropdown-item"
                                                    href="{{ url('/admin/users/' . $u->id . '/changeactivestatus') }}"><i
                                                        class="bx {{ $u->is_active == 0 ? 'bx-check' : 'bx-x' }} me-2"></i>{{ $u->is_active == 0 ? 'Aktivasi akun' : 'Deaktivasi akun' }}</a> --}}
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
            <a class="btn btn-primary text-white" href="{{route('users.create')}}">Tambah user baru</a>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>
@endsection
