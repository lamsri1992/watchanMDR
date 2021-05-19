@extends('layouts.app')
@section('content')

<div class="header bg-gradient-default pb-8 pt-5"></div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="mb-0">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item" aria-current="page">
                                            <a href="#"> <i class="fas fa-ambulance"></i> งานอุบัติเหตุและฉุกเฉิน</a>
                                        </li>
                                        <li class="breadcrumb-item" aria-current="page">
                                            <a href="/er/refer">รายงานข้อมูล REFER</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">ปี {{ $year }}</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <div class="row" style="margin-bottom: 1rem;">
                            <div class="col-12">
                                <h2>รายงานข้อมูล REFER : ปี {{ $year }}</h2>
                            </div>
                        </div>
                        <table id="referList" class="display nowrap table" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th class=""><i class="fa fa-table"></i></th>
                                    <th class="">REFER_NO</th>
                                    <th class="">HN</th>
                                    <th class=""><i class="fas fa-user-injured"></i> ผู้ป่วย</th>
                                    <th class=""><i class="far fa-calendar-check"></i> วันที่บันทึก</th>
                                    <th class="">DIAG</th>
                                    <th class="">TREATMENT</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        var year = "<?php echo $year ?>";
        var table = $('#referList').DataTable( {
            ajax: {
                url: "/api/refer/"+year,
                dataSrc: ""
            },
            scrollX: true,
            scrollCollapse: true,
            fixedColumns:   {
                leftColumns: 1,
            },
            columns: [
                { 'targets': -1, 'data': null, className: "text-center",
                    'defaultContent': '<button class="btn btn-sm btn-success"><i class="fa fa-clipboard-check"></i> เลือก</button>'
                },
                { 'data': 'visit_refer_in_out_number', className: "text-center" },
                { 'data': 'visit_refer_in_out_hn', className: "text-center" },
                { 'data': 'patient_firstname',
                    render: function (data, type, row, meta) {
                    return row.patient_firstname + ' ' + row.patient_lastname
                },
                },
                { 'data': 'record_date_time'},
                { 'data': 'visit_refer_in_out_summary_diagnosis'},
                { 'data': 'visit_refer_in_out_summary_treatment'},
            ],
            order: [[1, 'desc']],
            lengthMenu: [
                [10, 50, 100, -1],
                [10, 50, 100, "All"]
            ],
            oLanguage: {
                oPaginate: {
                    sFirst: '<small>หน้าแรก</small>',
                    sLast: '<small>หน้าสุดท้าย</small>',
                    sNext: '<small>ถัดไป</small>',
                    sPrevious: '<small>กลับ</small>'
                },
                sInfo: "<small>ทั้งหมด _TOTAL_ รายการ</small>",
                sLengthMenu: "<small>แสดง _MENU_ รายการ</small>",
                sSearch: "<i class='fa fa-search'></i> ค้นหา : ",
            }
        });

        $('#referList tbody').on('click', 'button', function () {
            var formData = table.row( $(this).parents('tr') ).data();
            // console.log(formData);
            Swal.fire({
                icon: 'success',
                title: 'SELECT DATA',
                text: formData['visit_refer_in_out_number']+" :: "+formData['patient_firstname']+" "+formData['patient_lastname'],
            })
        });
    });

</script>
@endsection
