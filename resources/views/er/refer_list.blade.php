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
                        <table id="referList" class="display nowrap table table-condensed" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th class=""><i class="fa fa-table"></i></th>
                                    <th class="">REFER_NO</th>
                                    <th class="">HN</th>
                                    <th class=""><i class="fas fa-user-injured"></i> ผู้ป่วย</th>
                                    <th class=""><i class="far fa-calendar-check"></i> วันที่</th>
                                    <th class=""><i class="far fa-hospital"></i> รพ.ปลายทาง</th>
                                    <th class="">DIAG</th>
                                    <th class="">หมายเหตุ</th>
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

<div class="modal fade" id="referModal" tabindex="-1" role="dialog" aria-labelledby="referModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="referRecord">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">
                        บันทึกข้อมูลการ REFER
                        <small id="vid" class="text-muted"></small>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for=""><i class="fa fa-notes-medical"></i> REFER_NO</label>
                                    <input id="no" name="no" type="text" class="form-control text-danger" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for=""><i class="fa fa-address-card"></i> HN</label>
                                    <input id="hn" name="hn" type="text" class="form-control text-danger" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for=""><i class="fa fa-user-injured"></i> ผู้ป่วย</label>
                                    <input id="pname" name="pname" type="text" class="form-control text-primary" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for=""><i class="fa fa-stethoscope"></i> DIAG</label>
                                    <textarea id="diag" name="diag" class="form-control text-default" rows="4" readonly></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for=""><i class="fa fa-hospital-symbol"></i> HCODE</label>
                                    <input id="hcode" name="hcode" type="text" class="form-control text-primary" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for=""><i class="fa fa-hospital"></i> โรงพยาบาลปลายทาง</label>
                                    <input id="hname" name="hname" type="text" class="form-control text-primary" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for=""><i class="far fa-calendar-alt"></i> วันที่ REFER</label>
                                    <input id="" name="date" type="text" class="form-control jsDate" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for=""><i class="fa fa-users"></i> เจ้าหน้าที่</label>
                                    <select id="emp" name="emp[]" class="form-control" multiple="multiple" style="width:100%;" required>
                                        @foreach ($emplist as $emps)
                                        <option value="{{ $emps->id }}">{{ $emps->emp_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for=""><i class="fa fa-user-md"></i> แพทย์ผู้สั่ง REFER</label>
                                    <select class="form-control" name="doctor" required>
                                        <option value="">เลือกแพทย์</option>
                                        <option value="ประจินต์ เหล่าเที่ยง">ประจินต์ เหล่าเที่ยง</option>
                                        <option value="นัฐยา กิติกูล">นัฐยา กิติกูล</option>
                                        <option value="ชาติชาย เชวงชุติรัตน์">ชาติชาย เชวงชุติรัตน์</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
            columns: [
                { 'targets': -1, 'data': null, className: "text-center",
                    'defaultContent': '<button class="btn btn-sm btn-success"><i class="fa fa-clipboard-check"></i> เลือก</button>'
                },
                { 'data': 'visit_refer_in_out_number', className: "text-center" },
                { 'data': 'visit_hn', className: "text-center" },
                { 'data': 'patient_firstname',
                    render: function (data, type, row, meta) {
                    return row.patient_firstname + ' ' + row.patient_lastname
                },
                },
                { 'data': 'visit_begin_visit_time'},
                { 'data': 'visit_office_name1',
                    render: function (data, type, row, meta) {
                    return  '<span class="badge badge-warning">' + row.visit_refer_in_out_refer_hospital + '</span> ' + row.visit_office_name1
                },
                },
                { 'data': 'visit_refer_in_out_summary_diagnosis'},
                { 'data': 'refer_cause_description'},
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
                sSearch: "<i class='fa fa-search'></i> ค้นหา Keywords : ",
            },
        });

        $('#referList tbody').on('click', 'button', function () {
            var formData = table.row( $(this).parents('tr') ).data();
            $("#referModal").modal("show");
            $("#vid").text("ref : " + formData['t_visit_id']);
            document.getElementById("no").value = formData['visit_refer_in_out_number'];
            document.getElementById("hn").value = formData['visit_hn'];
            document.getElementById("pname").value = formData['patient_firstname'] + " " + formData['patient_lastname'];
            document.getElementById("diag").value = formData['visit_refer_in_out_summary_diagnosis'];
            document.getElementById("hcode").value = formData['visit_refer_in_out_refer_hospital'];
            document.getElementById("hname").value = formData['visit_office_name1'];
        });
    });

    $('#emp').select2({
    createTag: function(params) {
        if (params.term.indexOf('@') === -1) {
            return null;
        }
        return {
            id: params.term,
            text: params.term
        }
    },
        placeholder: "ระบุเจ้าหน้าที่ REFER",
    });

    $(function() {
        $.datetimepicker.setLocale('th');
        $(".jsDate").datetimepicker({
            format: 'Y-m-d',
            timepicker: false,
            lang: 'th',
            widgetPositioning: {
            horizontal: "bottom",
            vertical: "auto"
          },
        });
    });

    $('#referRecord').on('submit', function () {
        event.preventDefault();
        Swal.fire({
            title: 'บันทึกข้อมูล REFER ?',
            showCancelButton: true,
            confirmButtonText: `บันทึก`,
            cancelButtonText: `ยกเลิก`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('er.record_refer') }}",
                    data: $('#referRecord').serialize(),
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกรายการ REFER สำเร็จ',
                            showConfirmButton: false,
                            timer: 2800
                        })
                        window.setTimeout(function () {
                            location.replace('/er/refer/')
                        }, 3000);
                    }
                });
            }
        })
    });

</script>
@endsection
