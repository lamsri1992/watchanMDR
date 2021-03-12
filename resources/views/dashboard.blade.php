@extends('layouts.app')
@section('content')

<div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
    style="background-image: url(https://new.watchanhospital.com/assets/img/hospital_front.jpg); 
    background-size: cover; background-position: bottom;">

    <span class="mask bg-gradient-default opacity-8"></span>
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-muted mb-0">จำนวนเตียง</h5>
                                    <span class="h2 font-weight-bold mb-0">10</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                        <i class="fas fa-hospital"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-nowrap">โรงพยาบาลชุมชน ขนาด F3</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-muted mb-0">จำนวนผู้ป่วยใน</h5>
                                    <span class="h2 font-weight-bold mb-0">
                                        @foreach ($num as $admit)
                                            {{ $admit->admit_num }}
                                        @endforeach
                                    </span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-bed"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-danger mr-2"><i class="fas fa-arrow-up"></i> admit 3 ราย</span>
                                <span class="text-success mr-2"><i class="fas fa-arrow-down"></i> discharge 2 ราย</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-muted mb-0">จำนวนวันนอน</h5>
                                    <span class="h2 font-weight-bold mb-0">12</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-nowrap">อัพเดตล่าสุด</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-muted mb-0">จำนวนการส่งต่อ/ครั้ง</h5>
                                    <span class="h2 font-weight-bold mb-0">0</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-ambulance"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-nowrap">อัพเดตล่าสุด</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">
    <div class="row mt-5">
        <div class="col-xl-6 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0"><i class="fas fa-clipboard-list"></i> จำนวนผู้ป่วยในแยกตามแผนก :: <span style="font-weight: lighter;">ปีงบประมาณ 2564</span></h3>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <!-- Top IPD Type -->
                    <table id="ipdtype" class="table table-striped table-borderless" style="width:100%;">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">คลินิก</th>
                                <th scope="col">จำนวน/คน</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-6 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0"><i class="far fa-star"></i> 10 อันดับโรคผู้ป่วยใน :: <span style="font-weight: lighter;">ปีงบประมาณ 2564</span></h3>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <!-- Top 10 ICD10 IPD -->
                    <table id="topicd10" class="table table-striped table-borderless" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ICD10</th>
                                <th scope="col">จำนวน/คน</th>
                                <th scope="col">จำนวน/ครั้ง</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.nav')
</div>

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush

@section('script')
<script type="text/javascript">
$(document).ready(function () {
        var table = $('#ipdtype').DataTable( {
            paging: false,
            ordering: false,
            info: false,
            searching: false,
            scrollY: "380px",
        ajax: {
            url: "/api/ipdadmit",
            dataSrc: ""
        },
        columns: [
            { 'data': 'clinic_name', className: "text-center" },
            { 'data': 'p_num', className: "text-center" },
        ],
        order: [[1, 'desc']],
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
    });
});

$(document).ready(function () {
        var table = $('#topicd10').DataTable( {
            paging: false,
            ordering: false,
            info: false,
            searching: false,
            scrollY: "380px",
        ajax: {
            url: "/api/top10icd",
            dataSrc: ""
        },
        columns: [
            { 'data': 'diag_icd10_number', className: "text-center" },
            { 'data': 'p_num', className: "text-center" },
            { 'data': 'v_num', className: "text-center" },
        ],
        order: [[1, 'desc']],
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
    });
});

</script>
@endsection
