@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')

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
                    <table id="ipdtype" class="table table-striped table-borderless" style="width:100%">
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
