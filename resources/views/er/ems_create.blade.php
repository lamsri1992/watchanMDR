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
                            <div class="form-group col-md-4">
                                <label for="">HN <span class="text-danger">*</span></label>
                                <input id="hn" name="hn" type="text" class="form-control" placeholder="ระบุหมายเลข HN">
                            </div>
                            <button id="hn_find" type="button" class="btn btn-dark" hidden><i class="fa fa-search"></i></button>
                            <div class="form-group col-md-4">
                                <label for=""><i class="far fa-address-card"></i> CID</label>
                                <input id="cid" name="cid" type="text" class="form-control" placeholder="ค่าอัตโนมัติ" readonly required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for=""><i class="fas fa-user-injured"></i> ชื่อ - สกุล</label>
                                <input id="pname" name="pname" type="text" class="form-control" placeholder="ค่าอัตโนมัติ" readonly required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for=""><i class="far fa-calendar"></i> วันที่เกิดเหตุ</label>
                                <input type="text" name="date" class="form-control jsDate" placeholder="เลือกวันที่" required>
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
                                <input type="text" name="symptom" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">ระดับความรุนแรง</label>
                                <select name="level" class="custom-select" required>
                                    <option value="">เลือก</option>
                                    @foreach ($lv as $lvs)
                                    <option value="{{ $lvs->level_id }}">{{ $lvs->level_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">ประเภทผู้ป่วย</label>
                                <select name="type" class="custom-select" required>
                                    <option value="">เลือก</option>
                                    @foreach ($tp as $tps)
                                    <option value="{{ $tps->type_id }}">{{ $tps->type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">การนำส่ง</label>
                                <select name="transpot" class="custom-select" required>
                                    <option value="">เลือก</option>
                                    @foreach ($tl as $tls)
                                    <option value="{{ $tls->tran_id }}">{{ $tls->tran_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">สิทธิการรักษา</label>
                                <select name="perm" class="custom-select" required>
                                    <option value="">เลือก</option>
                                    @foreach ($pl as $pls)
                                    <option value="{{ $pls->perm_id }}">{{ $pls->perm_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">การดูแลเบื้องต้น</label>
                                <input type="text" name="primcare" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">การวินิจฉัย</label>
                                <input type="text" name="diag" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Disposition</label>
                                <select name="disposition" class="custom-select" required>
                                    <option value="">เลือก</option>
                                    @foreach ($ds as $dss)
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

@endsection
@section('script')
<script type="text/javascript">
    document.onkeydown = fkey;
    document.onkeypress = fkey
    document.onkeyup = fkey;

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
                    Swal.fire({
                        icon: 'success',
                        title: 'พบข้อมูล HN: '+ id,
                        text: result.patient_firstname + " " + result.patient_lastname,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }else{
                    $("#hn").val("");
                    $("#cid").val("");
                    $("#pname").val("");
                    Swal.fire({
                        icon: 'error',
                        title: 'ไม่พบ HN: '+id,
                        text: 'กรุณาตรวจสอบใหม่อีกครั้ง',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        });
    });

    $(function () {
        $.datetimepicker.setLocale('th');
        $(".jsDate").datetimepicker({
            format: 'Y-m-d',
            timepicker: false,
            lang: 'th',
        });
    });

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
                    url:"{{ route('er.record_ems') }}",
                    data: $('#emsRecord').serialize(),
                    success:function(data){
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
