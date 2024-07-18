@extends('dashboard/layouts/main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-xxl-4 col-lg-6 col-md-12 col-12 mb-2">
            <a href="/dashboard/member" class="text-decoration-none">
                <div class="card shadow" style="border-left: 5px solid #0d6efd">
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="col-8">
                                    <div class="h6">Total Member</div>
                                    <div class="h1 fs-3">{{ $user }}</div>
                                </div>
                                <div class="col-2">
                                    <h1 class="bi bi-file-person text-primary" style="font-size: 4rem"></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxl-4 col-lg-6 col-md-12 col-12 mb-2">
            <a href="/dashboard/member" class="text-decoration-none">
                <div class="card shadow" style="border-left: 5px solid #0d6efd">
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="col-8">
                                    <div class="h6">Member Aktif</div>
                                    <div class="h1 fs-3">{{ $memberaktif }}</div>
                                </div>
                                <div class="col-2">
                                    <h1 class="bi bi-file-person text-primary" style="font-size: 4rem"></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxl-4 col-lg-6 col-md-12 col-12 mb-2">
            <a href="/dashboard/notif-member" class="text-decoration-none">
                <div class="card shadow" style="border-left: 5px solid #0d6efd">
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="col-8">
                                    <div class="h6">Member Belum Dikonfirmasi</div>
                                    <div class="h1 fs-3">{{ $unconfirm_member }}</div>
                                </div>
                                <div class="col-2">
                                    <h1 class="bi bi-file-person text-primary" style="font-size: 4rem"></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxl-4 col-lg-6 col-md-12 col-12 mb-2">
            <a href="/dashboard/transaksi" class="text-decoration-none">
                <div class="card shadow" style="border-left: 5px solid #198754">
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="col-8">
                                    <div class="h6">Total Transaksi Perbulan</div>
                                    <div class="h1 fs-3">Rp. {{ $formatted_total_harga }}</div>
                                </div>
                                <div class="col-2">
                                    <h1 class="bi bi-wallet2 text-success" style="font-size: 4rem"></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxl-4 col-lg-6 col-md-12 col-12 mb-2">
            <a href="/dashboard/personal_trainer" class="text-decoration-none">
                <div class="card shadow" style="border-left: 5px solid #6f42c1">
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="col-8">
                                    <div class="h6">Total Personal Trainer</div>
                                    <div class="h1 fs-3">{{ $personal_trainer }}</div>
                                </div>
                                <div class="col-2">
                                    <h1 class="bi bi-people" style="font-size: 4rem; color:#6f42c1;"></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxl-4 col-lg-6 col-md-12 col-12 mb-2">
            <a href="/dashboard/admin" class="text-decoration-none">
                <div class="card shadow" style="border-left: 5px solid  #dc3545">
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="col-8">
                                    <div class="h6">Total Admin</div>
                                    <div class="h1 fs-3">{{ $admin }}</div>
                                </div>
                                <div class="col-2">
                                    <h1 class="bi bi-person-gear" style="font-size: 4rem; color:#dc3545;"></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- chart --}}
    <div class="chart mt-3 mb-5">
        <div class="row">
            <div class="col-xxl-6 col-lg-6 col-md-12 col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <canvas id="MemberChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xxl-6 col-lg-6 col-md-12 col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <canvas id="TransaksiChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Member perminggu --}}
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var weeklyAttendanceData = @json($memberPerminggu);

                var labels = weeklyAttendanceData.map(entry => 'Minggu ' + entry.week);
                var values = weeklyAttendanceData.map(entry => entry.member);

                var ctx = document.getElementById('MemberChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Pendaftaran member perminggu bulan ini',
                            backgroundColor: '#0d6efd',
                            borderColor: '#0d6efd',
                            borderWidth: 1,
                            data: values,
                        }],
                    },
                    options: {
                        scales: {
                            x: {
                                type: 'category',
                            },
                            y: {
                                beginAtZero: true,
                                precision: 0,
                            },
                        },
                    },
                });
            });
        </script>

        {{-- transaksi perminggu --}}
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var weeklyAttendanceData = @json($transaksiPerminggu);

                var labels = weeklyAttendanceData.map(entry => 'Minggu ' + entry.week);
                var values = weeklyAttendanceData.map(entry => entry.transaksi);

                var ctx = document.getElementById('TransaksiChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Transaksi perminggu bulan ini',
                            backgroundColor: '#198754',
                            borderColor: '#198754',
                            borderWidth: 1,
                            data: values,
                        }],
                    },
                    options: {
                        scales: {
                            x: {
                                type: 'category',
                            },
                            y: {
                                beginAtZero: true,
                                precision: 0,
                                ticks: {
                                    callback: function(value, index, values) {

                                        return new Intl.NumberFormat('id-ID', {
                                            style: 'currency',
                                            currency: 'IDR'
                                        }).format(value);
                                    }
                                }
                            },
                        },
                    },
                });
            });
        </script>
    </div>
@endsection
