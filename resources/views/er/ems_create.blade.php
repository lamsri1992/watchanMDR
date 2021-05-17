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
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="">HN <span class="text-danger">*</span></label>
                                <input id="hn" type="text" class="form-control" placeholder="ระบุหมายเลข HN">
                            </div>
                            <button id="hn_find" type="button" class="btn btn-dark" hidden><i
                                    class="fa fa-search"></i></button>
                            <div class="form-group col-md-4">
                                <label for=""><i class="far fa-address-card"></i> CID</label>
                                <input id="cid" type="text" class="form-control" placeholder="ค่าอัตโนมัติ" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for=""><i class="fas fa-user-injured"></i> ชื่อ - สกุล</label>
                                <input id="pname" type="text" class="form-control" placeholder="ค่าอัตโนมัติ" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for=""><i class="far fa-calendar"></i> วันที่เกิดเหตุ</label>
                                <input type="text" class="form-control jsDate" placeholder="เลือกวันที่">
                            </div>
                            <div class="form-group col-md-3">
                                <label for=""><i class="far fa-clock"></i> เวลารับแจ้งเหตุ</label>
                                <input type="time" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-3">
                                <label for=""><i class="far fa-clock"></i> เวลาถึงที่เกิดเหตุ</label>
                                <input type="time" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">เลขปฏิบัติการ</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-12">
                                <label for=""><i class="fas fa-info-circle"></i> อาการที่สำคัญ</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">ระดับความรุนแรง</label>
                                <select name="" class="custom-select" required>
                                    <option value="">เลือก</option>
                                    <option value="">Resuscition</option>
                                    <option value="">Emergency</option>
                                    <option value="">Urgent</option>
                                    <option value="">Semi Urgent</option>
                                    <option value="">Non Urgent</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">ประเภทผู้ป่วย</label>
                                <select name="" class="custom-select" required>
                                    <option value="">เลือก</option>
                                    <option value="">Trauma</option>
                                    <option value="">Non Trauma</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">การนำส่ง</label>
                                <select name="" class="custom-select" required>
                                    <option value="">เลือก</option>
                                    <option value="">ผู้ป่วยมาเอง/ญาตินำส่ง</option>
                                    <option value="">BLS</option>
                                    <option value="">ALS</option>
                                    <option value="">FR</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">สิทธิการรักษา</label>
                                <select name="" class="custom-select" required>
                                    <option value="">เลือก</option>
                                    <option value="">บัตรทอง</option>
                                    <option value="">อุบัติเหตุจราจร</option>
                                    <option value="">ประกันสังคม</option>
                                    <option value="">ต่างด้าว</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">การดูแลเบื้องต้น</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">การวินิจฉัย</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Disposition</label>
                                <select name="" class="custom-select" required>
                                    <option value="">เลือก</option>
                                    <option value="">D/C</option>
                                    <option value="">Admit</option>
                                    <option value="">Refer</option>
                                    <option value="">Death</option>
                                </select>
                            </div>
                            <div class="form-group col-md-9">
                                <label for="">ประเด็นคุณภาพที่สำคัญ</label>
                                <input type="text" class="form-control" placeholder="">
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
                        timer: 3000
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'ไม่พบ HN: '+id,
                        text: 'กรุณาตรวจสอบใหม่อีกครั้ง',
                        showConfirmButton: false,
                        timer: 3000
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

</script>
@endsection
