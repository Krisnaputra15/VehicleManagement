@extends('template.template')

@section('title')
Dashboard
@endsection

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="mb-4">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h3 class="card-title text-primary">Halo, {{ auth()->user()->fullname }}!</h3>
                                <p class="mb-4">
                                    Selamat datang di aplikasi admin <span class=""><b>Rideit</b></span>.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('admin/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 d-flex flex-column align-items-strech">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                @php
                                    $date = new DateTime(date('Y-m-d'));
                                    setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
                                    $formattedDate = strftime('%B %Y', $date->getTimestamp());
                                @endphp
                                <h5 class="card-title fw-semibold">Grafik Penggunaan Kendaraan per Minggu - {{ $formattedDate }}</h5>
                            </div>
                        </div>
                        <canvas id="transactionsChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-flex flex-column align-items-strech">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                @php
                                    $date = new DateTime(date('Y-m-d'));
                                    setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
                                    $formattedDate = strftime('%B %Y', $date->getTimestamp());
                                @endphp
                                <h5 class="card-title fw-semibold">Ringkasan Peminjaman Kendaraan Bulan {{ $formattedDate }}</h5>
                            </div>
                        </div>
                        <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">No</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Kendaraan</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Status</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach ($transaksi as $data)
                                    @php
                                        $date = new DateTime($data->booking_start);
                                        setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
                                        $formattedDate = strftime('%e %B %Y', $date->getTimestamp());
                                    @endphp
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{ $i }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">
                                                {{ $data->vehicle->serie }} | {{ $data->vehicle->license_number }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            @if($data->is_approved == 0)
                                                <span class="badge bg-label-primary me-1">Butuh Persetujuan</span>
                                            @elseif($data->pickup_date == null and $data->is_returned == 0)
                                                <span class="badge bg-label-danger me-1">Belum Diambil</span>
                                            @elseif($data->pickup_date != null and $data->is_returned == 0)
                                                <span class="badge bg-label-secondary me-1">Dipinjam</span>
                                            @elseif($data->is_returned == 1)
                                                <span class="badge bg-label-{{$data->return_status == "on time" ? "success" : "danger"}} me-1">Kembali {{$data->return_status == "on time" ? "Tepat Waktu" : "Terlambat"}}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @php if($i == 5) break; @endphp
                                    @php ++$i @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center py-3">
                            <a class="btn btn-primary text-white" href="{{route('download')}}">Download laporan bulanan</a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            
        </div>
            {{-- <div class="row">
                <div class="col-lg-6 col-md-12 col-6 mb-4 w-25">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('admin/img/icons/unicons/wallet-info.png') }}" alt="Credit Card"
                                        class="rounded" />
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                        <a class="dropdown-item" href="{{ url('admin/users') }}">Lihat Lebih</a>

                                    </div>
                                </div>
                            </div>
                            <span>Pengguna Terdaftar</span>
                            <h3 class="card-title text-nowrap my-2 ">{{ sizeof($dataser) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4 w-25">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('admin/img/icons/unicons/wallet-info.png') }}" alt="Credit Card"
                                        class="rounded" />
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                        <a class="dropdown-item" href="{{ url('admin/layanan') }}">Lihat Lebih</a>

                                    </div>
                                </div>
                            </div>
                            <span>Layanan Aktif</span>
                            <h3 class="card-title text-nowrap my-2">{{ sizeof($layanan) }}</h3>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4 w-25">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('admin/img/icons/unicons/wallet-info.png') }}" alt="Credit Card"
                                        class="rounded" />
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                        <a class="dropdown-item" href="{{ url('admin/forums') }}">Lihat Lebih</a>

                                    </div>
                                </div>
                            </div>
                            <span>Forum terdaftar</span>
                            <h3 class="card-title text-nowrap my-2">{{ sizeof($forum) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4 w-25">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('admin/img/icons/unicons/wallet-info.png') }}" alt="Credit Card"
                                        class="rounded" />
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                        <a class="dropdown-item" href="{{ url('admin/layanan') }}">Lihat Lebih</a>

                                    </div>
                                </div>
                            </div>
                            <span>Permohonan diproses</span>
                            <h3 class="card-title text-nowrap my-2">{{ sizeof($permohonan) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Order Statistics -->
                <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between pb-0">
                            <div class="card-title mb-0">
                                <h5 class="m-0 me-2">Statistik Permohonan</h5>
                                <small class="text-muted">{{ sizeof($permohonan) }} Total Permohonan</small>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                    <a class="dropdown-item" href="{{ url('admin/forums') }}">Lihat Lebih</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex flex-column align-items-center gap-1">
                                    <h2 class="mb-2">{{ sizeof($permohonan) }}</h2>
                                    <span>Total Permohonan</span>
                                </div>
                                <div id="orderStatisticsChart"></div>
                            </div>
                            <ul class="p-0 m-0">
                                @foreach ($permohonan as $data)
                                    <a href="{{ url('admin/permohonan/' . $data->id) }}" class="link-hover">
                                        <li class="d-flex mb-4 pb-1">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <span class="avatar-initial rounded bg-label-primary"><img
                                                        src="{{ $data->user->picture_url }}" alt="User"
                                                        class="rounded" /></i></span>
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">{{ $data->user->nama }}</h6>
                                                    <small class="text-muted">{{ $data->layanan->nama_layanman }}</small>
                                                </div>
                                                <div class="user-progress">
                                                    @php $date = new DateTime($data->created_at) @endphp
                                                    <small class="fw-semibold">{{ $date->format('d-m-Y') }}</small>
                                                </div>
                                            </div>
                                        </li>
                                    </a>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/ Order Statistics -->

                <!-- Transactions -->
                <div class="col-md-6 col-lg-4 order-2 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2">Forum</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                                    <a class="dropdown-item" href="{{ url('admin/forums') }}">Lihat Lebih</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="p-0 m-0">
                                @foreach ($forum as $data)
                                    <a href="{{ url('admin/forums/' . $data->id) }}" class="link-hover">
                                        <li class="d-flex mb-4 pb-1">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <img src="{{ $data->user->picture_url }}" alt="User"
                                                    class="rounded" />
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <small class="text-muted d-block mb-1">{{ $data->status }}</small>
                                                    <h6 class="mb-0">{{ $data->judul }}</h6>
                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    @php $date = new DateTime($data->created_at) @endphp
                                                    <small class="fw-semibold">{{ $date->format('d-m-Y') }}</small>
                                                </div>
                                            </div>
                                        </li>
                                    </a>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/ Transactions -->

                <!-- Transactions -->
                <div class="col-md-6 col-lg-4 order-2 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2">Pengguna</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                                    <a class="dropdown-item" href="{{ url('admin/users') }}">Lihat Lebih</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="p-0 m-0">
                                @foreach ($dataser as $data)
                                <a href="{{url('admin/users/'.$data->id)}}" class="link-hover">
                                    <li class="d-flex mb-4 pb-1">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <img src="{{ $data->picture_url }}" alt="User" class="rounded" />
                                        </div>
                                        <div
                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <h6 class="mb-2">{{ $data->nama }}</h6>
                                                @php $date = new DateTime($data->created_at) @endphp
                                                <small class="text-muted d-block mb-1">mendaftar pada
                                                    {{ $date->format('d-m-Y') }}</small>
                                            </div>
                                        </div>
                                    </li>
                                  </a>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/ Transactions -->
            </div> --}}
        </div>
        <!-- / Content -->
@endsection

@section('extra-scripts')
        <script>
        const dataIn = @json($dataMasuk);
        const dataOut = @json($dataKeluar);

        // Prepare the data for Chart.js
        const labels = Object.keys(dataIn);
        const valuesIn = Object.values(dataIn);
        const valuesOut = Object.values(dataOut);

        // Create the chart
        const ctx = document.getElementById('transactionsChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Kendaraan Masuk',
                        data: valuesIn,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Kendaraan Keluar',
                        data: valuesOut,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                        display: true,
                        text: 'Minggu'
                        }
                    },
                    y: {
                        title: {
                        display: true,
                        text: 'Jumlah Kendaraan'
                        },
                        min: 0,
                        max: 10,
                        ticks: {
                            stepSize: 2
                        }
                    }
                }
            }
        });
    </script>
@endsection