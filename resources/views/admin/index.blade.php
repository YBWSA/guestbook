@extends('layoutes.main')
@section('content')
    <div class="card card-default bg-transparent mb-0">
        <div class="card-header px-3">
            <h2>Statistik</h2>
        </div>

        <div class="card-body px-3">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="card card-default bg-secondary">
                        <div class="d-flex p-5">
                            <div class="icon-md bg-white rounded-circle mr-3">
                                <i class="mdi mdi-account-group-outline text-secondary"></i>
                            </div>
                            <div class="text-left">
                                <span class="h2 d-block text-white">{{ $mhsBulan }}</span>
                                <p class="text-white">Tamu Mahasiswa Bulan <span class="bulan-indo"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card card-default bg-success">
                        <div class="d-flex p-5">
                            <div class="icon-md bg-white rounded-circle mr-3">
                                <i class="mdi mdi-account-arrow-left text-success"></i>
                            </div>
                            <div class="text-left">
                                <span class="h2 d-block text-white">{{ $internalBulan }}</span>
                                <p class="text-white">Tamu Internal Bulan <span class="bulan-indo"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card card-default bg-primary">
                        <div class="d-flex p-5">
                            <div class="icon-md bg-white rounded-circle mr-3">
                                <i class="mdi mdi-account-arrow-right-outline text-primary"></i>
                            </div>
                            <div class="text-left">
                                <span class="h2 d-block text-white">{{ $eksternalBulan }}</span>
                                <p class="text-white">Tamu Eksternal Bulan <span class="bulan-indo"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card card-default bg-info">
                        <div class="d-flex p-5">
                            <div class="icon-md bg-white rounded-circle mr-3">
                                <i class="mdi mdi-calendar-today text-info"></i>
                            </div>
                            <div class="text-left">
                                <span class="h2 d-block text-white">{{ $totalHari }}</span>
                                <p class="text-white">Total Tamu Hari ini</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card card-default bg-info">
                        <div class="d-flex p-5">
                            <div class="icon-md bg-white rounded-circle mr-3">
                                <i class="mdi mdi-calendar-week text-info"></i>
                            </div>
                            <div class="text-left">
                                <span class="h2 d-block text-white">{{ $totalBulan }}</span>
                                <p class="text-white">Total Tamu Bulan ini</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Statistik Tamu <span id="tahunSekarang"></span></h2>
            <a href="{{ route('admin.exportExcel') }}" class="btn btn-success">Export Excel</a>

        </div>

        <div class="card-body">
            <div id="chart"></div>
        </div>
    </div>
@endsection
