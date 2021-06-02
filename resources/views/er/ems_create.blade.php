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
                                            <a href="/er/ems">รายงานข้อมูล EMS</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">บันทึกข้อมูล EMS</li>
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
                                <h2><i class="far fa-edit"></i> แบบฟอร์มบันทึกข้อมูล EMS</h2>
                            </div>
                        </div>
                    </div>
                    <form id="emsRecord">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="">HN <span class="text-danger">*</span></label>
                                <input id="hn" name="hn" type="text" class="form-control" placeholder="ระบุหมายเลข HN">
                            </div>
                            <div class="form-group col-md-1">
                                <label for="">&nbsp;</label>
                                <button id="hn_find" type="button" class="btn btn-success btn-block">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="">&nbsp;</label>
                                <button id="patient_find" type="button" class="btn btn-primary btn-block"
                                    data-toggle="modal" data-target="#modalHistory" disabled>
                                    <i class="fa fa-notes-medical"></i>
                                </button>
                            </div>
                            <div class="form-group col-md-4">
                                <label for=""><i class="far fa-address-card"></i> CID</label>
                                <input id="cid" name="cid" type="text" class="form-control" placeholder="ค่าอัตโนมัติ"
                                    readonly required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for=""><i class="fas fa-user-injured"></i> ชื่อ - สกุล</label>
                                <input id="pname" name="pname" type="text" class="form-control"
                                    placeholder="ค่าอัตโนมัติ" readonly required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for=""><i class="far fa-calendar"></i> วันที่เกิดเหตุ</label>
                                <input type="text" name="date" class="form-control jsDate" placeholder="เลือกวันที่"
                                    required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for=""><i class="far fa-clock"></i> เวลารับแจ้งเหตุ</label>
                                <input type="time" name="time_in" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for=""><i class="far fa-clock"></i> เวลาถึงที่เกิดเหตุ</label>
                                <input type="time" name="time_find" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">เลขปฏิบัติการ</label>
                                <input type="text" name="no" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for=""><i class="fas fa-info-circle"></i> อาการที่สำคัญ</label>
                                <input type="text" id="symptom" name="symptom" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">ระดับความรุนแรง</label>
                                <select name="level" class="custom-select" required>
                                    <option value="">เลือก</option>
                                    @foreach($lv as $lvs)
                                        <option value="{{ $lvs->level_id }}">{{ $lvs->level_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">ประเภทผู้ป่วย</label>
                                <select name="type" class="custom-select" required>
                                    <option value="">เลือก</option>
                                    @foreach($tp as $tps)
                                        <option value="{{ $tps->type_id }}">{{ $tps->type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">การนำส่ง</label>
                                <select name="transpot" class="custom-select" required>
                                    <option value="">เลือก</option>
                                    @foreach($tl as $tls)
                                        <option value="{{ $tls->tran_id }}">{{ $tls->tran_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">สิทธิการรักษา</label>
                                <select name="perm" class="custom-select" required>
                                    <option value="">เลือก</option>
                                    @foreach($pl as $pls)
                                        <option value="{{ $pls->perm_id }}">{{ $pls->perm_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">สถานที่เกิดเหตุ</label>
                                <input type="text" name="place" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">RC CODE</label>
                                <input type="text" name="rccode" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">การดูแลเบื้องต้น</label>
                                <input type="text" name="primcare" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">การวินิจฉัย</label>
                                <input type="text" id="diag" name="diag" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Disposition</label>
                                <select name="disposition" class="custom-select" required>
                                    <option value="">เลือก</option>
                                    @foreach($ds as $dss)
                                        <option value="{{ $dss->dis_id }}">{{ $dss->dis_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-9">
                                <label for="">ประเด็นคุณภาพที่สำคัญ</label>
                                <input type="text" name="kpi" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check-circle"></i> บันทึกข้อมูล
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalHistory" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHistory"><i class="fa fa-history"></i> ประวัติการ EMS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="emsHistory" class="table table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>DATE_TIME</th>
                            <th>TRANSPOT</th>
                            <th>LEVEL</th>
                            <th>STATUS</th>
                            <th class="text-center"><i class="fa fa-bars"></i></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
    $(function () {
        $.datetimepicker.setLocale('th');
        $(".jsDate").datetimepicker({
            format: 'Y-m-d',
            timepicker: false,
            lang: 'th',
        });
    });

    document.onkeydown = fkey;

    function fkey(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            $('#hn_find').click();
        }
    }

    $('#hn_find').click(function () {
        var id = document.getElementById("hn").value;
        $.ajax({
            url: "/api/patient/" + id,
            success: function (result) {
                if (typeof result.patient_firstname !== "undefined") {
                    $("#cid").val(result.patient_pid);
                    $("#pname").val(result.patient_firstname + " " + result.patient_lastname);
                    document.getElementById("patient_find").disabled = false;
                    Swal.fire({
                        icon: 'success',
                        title: 'พบข้อมูล HN: ' + id,
                        text: result.patient_firstname + " " + result.patient_lastname,
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    $("#hn").val("");
                    $("#cid").val("");
                    $("#pname").val("");
                    Swal.fire({
                        icon: 'error',
                        title: 'ไม่พบ HN: ' + id,
                        text: 'กรุณาตรวจสอบใหม่อีกครั้ง',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        });
    });

    $('#patient_find').click(function () {
        var id = document.getElementById("hn").value;
        $.ajax({
            url: "/api/history/" + id,
            dataType: 'json',
            success: function (data) {
                for (var i = 0; i < data.length; i++) {
                    var row =
                        $(
                            '<tbody><tr><td>' + data[i].visit_begin_visit_time + '</td>' +
                            '<td>' + data[i].visit_service_type_description + '</td>' +
                            '<td>' + data[i].emergency_status_description + '</td>' +
                            '<td>' + data[i].description + '</td>' +
                            '<td class="text-center"><button class="btn btn-success btn-sm" onclick="fillData(this)"' +
                            'data-id="' + data[i].t_visit_id + '">เลือก</button></td></tr></tbody>'
                        );
                    $('#emsHistory').append(row);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error: ' + textStatus + ' - ' + errorThrown);
            }
        });
    });

    function fillData(elem) {
        var id = $(elem).data("id");
        $.ajax({
            url: "/api/visit/" + id,
            success: function (result) {
                $("#symptom").val(result.visit_primary_symptom_main_symptom);
                $("#diag").val(result.visit_dx);
                $('#modalHistory').modal('hide');
            }
        });
    }


    $('#emsRecord').on('submit', function () {
        event.preventDefault();
        Swal.fire({
            title: 'บันทึกข้อมูล EMS ?',
            showCancelButton: true,
            confirmButtonText: `บันทึก`,
            cancelButtonText: `ยกเลิก`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('er.record_ems') }}",
                    data: $('#emsRecord').serialize(),
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกรายการ EMS สำเร็จ',
                            showConfirmButton: false,
                            timer: 2800
                        })
                        window.setTimeout(function () {
                            location.replace('/er/ems/')
                        }, 3000);
                    }
                });
            }
        })
    });

</script>
@endsection
