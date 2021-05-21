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
                                        <li class="breadcrumb-item active" aria-current="page">REF23736{{ str_pad($data->refer_id, 4, '0', STR_PAD_LEFT) }}</li>
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
                                <h2><i class="far fa-edit"></i> ข้อมูล REFER23736{{ str_pad($data->refer_id, 4, '0', STR_PAD_LEFT) }}</h2>
                            </div>
                        </div>
                    </div>
                    <table class="table table-condensed table-sm">
                        <tr>
                            <th><i class="far fa-calendar"></i> วันที่ REFER</th>
                            <td>{{ DateThai($data->refer_date) }}</td>
                            <th><i class="fas fa-clipboard"></i> REFER_NO</th>
                            <td>{{ $data->refer_no }}</td>
                        </tr>
                        <tr>
                            <th><i class="far fa-address-card"></i> HN</th>
                            <td>{{ $data->refer_hn }}</td>
                            <th><i class="fas fa-user-injured"></i> ผู้ป่วย</th>
                            <td>{{ $data->refer_patient }}</td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-stethoscope"></i> DIAG</th>
                            <td colspan="3">{{ $data->refer_diag_go }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-hospital-symbol"></i> HCODE</th>
                            <td>{{ $data->refer_hcode }}</td>
                            <th><i class="far fa-hospital"></i> รพ. ปลายทาง</th>
                            <td>{{ $data->refer_hname }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-user-md"></i> แพทย์สั่ง REFER</th>
                            <td colspan="3">{{ $data->refer_doctor }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-users"></i> เจ้าหน้าที่ REFER</th>
                            <td colspan="3">
                                @php $arr = explode(",", $data->refer_employee); @endphp
                                @foreach ($arr as $emps)
                                    <li>{{ $emps }}</li>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-body">
                    <div class="">
                        <h2><i class="far fa-edit"></i> บันทึกข้อมูลเพิ่มเติม</h2>
                    </div>
                    <form id="referUpdate">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for=""><i class="fa fa-wine-bottle"></i> ระดับแอลกอฮอล์ (mg%)</label>
                                <input name="alcohol" type="text" class="form-control" value="{{ $data->refer_alcohol }}" required>
                                <input name="id" type="hidden" class="form-control" value="{{ $data->refer_id }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for=""><i class="fa fa-comment-medical"></i> DIAG รพ.ปลายทาง</label>
                                <input name="diag_back" type="text" class="form-control" value="{{ $data->refer_diag_back }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for=""><i class="fa fa-clock"></i> เวลาที่ออก</label>
                                <input name="time_go" type="time" class="form-control" value="{{ $data->refer_time_go }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for=""><i class="fa fa-clock"></i> เวลากลับถึง</label>
                                <input name="time_back" type="time" class="form-control" value="{{ $data->refer_time_back }}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-success">
                                    <i class="fa fa-save"></i> บันทึกข้อมูล
                                </button>
                            </div>
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
    $(function () {
        $.datetimepicker.setLocale('th');
        $(".jsDate").datetimepicker({
            format: 'Y-m-d',
            timepicker: false,
            lang: 'th',
        });
    });

    $('#referUpdate').on('submit', function () {
        event.preventDefault();
        Swal.fire({
            title: 'บันทึกข้อมูล REFER23736{{ str_pad($data->refer_id, 4, "0", STR_PAD_LEFT) }}?',
            showCancelButton: true,
            confirmButtonText: `บันทึก`,
            cancelButtonText: `ยกเลิก`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('er.update_refer') }}",
                    data: $('#referUpdate').serialize(),
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกข้อมูล REFER สำเร็จ',
                            showConfirmButton: false,
                            timer: 2500
                        }),
                        window.setTimeout(function () {
                            location.reload()
                        }, 3000);
                    }
                });
            }
        })
    });

</script>
@endsection
