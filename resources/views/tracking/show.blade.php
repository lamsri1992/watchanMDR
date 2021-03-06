@extends('layouts.app')
@section('content')
@if (Auth::check() == NULL)
    @php header( "location: /login" ); exit(0); @endphp
@endif
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
                                            <a href="/tracking">
                                                <i class="fa fa-map-marked-alt"></i> ระบบติดตามเวชระเบียนผู้ป่วยใน
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            WCC23736{{ str_pad($order->track_id, 4, '0', STR_PAD_LEFT) }}
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <article class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="text-center">
                                        <strong><i class="far fa-folder-open"></i> TRACK_ID : </strong>
                                        <span class="btn btn-light btn-sm">
                                            WCC23736{{ str_pad($order->track_id, 4, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="text-center">
                                        <strong><i class="fas fa-list-ol"></i> CASE : </strong>
                                        <span class="btn btn-danger btn-sm">
                                            จำนวน : {{ $order->track_case }} เคส
                                        </span>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="text-left">
                                        <strong class="badge badge-success"><i class="far fa-calendar-plus"></i> CREATE :</strong>
                                        <span>{{ DateTimeThai($order->create_at) }}</span>
                                    </div>
                                    <div class="text-left">
                                        <strong class="badge badge-warning"><i class="far fa-calendar-check"></i> UPDATE :</strong>
                                        <span>{{ DateTimeThai($order->update_at) }}</span>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="text-center">
                                        <span class="{{ $order->t_stat_color }}">
                                            @php echo $order->t_stat_text @endphp
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                    <div class="track">
                        <div
                            class="step {{ ($order->track_point >= "1" ? "active" : "") }}">
                            <span class="icon" data-toggle="tooltip" data-placement="top"
                                title="งานผู้ป่วยในดำเนินการ Discharge และนำส่งงานเวชระเบียน"><i class="fa fa-clipboard-check"></i></span>
                            <span class="text">IPD Discharge</span>
                        </div>
                        <div
                            class="step {{ ($order->track_point >= "2" ? "active" : "") }}">
                            <span class="icon" data-toggle="tooltip" data-placement="top"
                                title="งานเวชระเบียนตรวจสอบเวชระเบียนผู้ป่วยใน ก่อนจำหน่ายตามแพทย์เจ้าของเคส"><i
                                    class="fa fa-notes-medical"></i></span>
                            <span class="text">งานเวชระเบียน</span>
                        </div>
                        <div
                            class="step {{ ($order->track_point >= "3" ? "active" : "") }}">
                            <span class="icon" data-toggle="tooltip" data-placement="top"
                                title="กลุ่มการแพทย์ตรวจสอบเวชระเบียนผู้ป่วยใน"><i class="fa fa-user-md"></i></span>
                            <span class="text">กลุ่มการแพทย์</span>
                        </div>
                        <div
                            class="step {{ ($order->track_point >= "4" ? "active" : "") }}">
                            <span class="icon" data-toggle="tooltip" data-placement="top"
                                title="ตรวจสอบ + สแกนเวชระเบียนเก็บในระบบ"><i class="fa fa-clipboard-check"></i></span>
                            <span class="text">งานเวชระเบียน</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        @if ($message = Session::get('keep'))
                        <div id="alert" class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        <h6><i class="fa fa-clipboard-list"></i> รายการเวชระเบียนผู้ป่วยใน</h6>
                        <table id="chartList" class="display nowrap table" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">เลข VN</th>
                                    <th class="text-center"><i class="fas fa-id-card"></i> เลข HN</th>
                                    <th><i class="fas fa-user-md"></i> ผู้ป่วย</th>
                                    <th><i class="fas fa-user-md"></i> แพทย์</th>
                                    <th class="text-center"><i class="far fa-clock"></i> วันที่ส่งชาร์ท</th>
                                    <th class="text-center"><i class="far fa-clock"></i> วันที่เก็บชาร์ท</th>
                                    <th class="text-center">สถานะ</th>
                                    @if ($order->track_point == 2  && $count >= 1 && Auth::user()->permission_id == 1)
                                        <th class="text-center"><i class="fa fa-clipboard-check"></i></th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list as $lists)
                                @php $exp = DateDiff(SUBSTR($lists->list_end,0,10),SUBSTR($lists->list_start,0,10)) @endphp
                                    <tr>
                                        <th class="text-center">{{ $lists->list_vn }}</th>
                                        <td class="text-center">{{ $lists->list_hn }}</td>
                                        <td>{{ $lists->list_patient }}</td>
                                        <td>{{ $lists->list_doctor }}</td>
                                        <td class="text-center">{{ DateThai(SUBSTR($lists->list_start,0,10)) }}</td>
                                        <td class="text-center text-primary">{{ DateThai(SUBSTR($lists->list_end,0,10)) }}</td>
                                        <td class="text-center {{ $lists->t_stat_color }}">
                                            @php echo $lists->t_stat_text @endphp
                                        </td>
                                        @if ($order->track_point == 2  && $count >= 1 && $lists->list_status == 1 && Auth::user()->permission_id == 1)
                                        <td class="text-center">
                                            <a  href="{{ route('tracking.keepChart',base64_encode($lists->list_id)) }}" 
                                                class="btn btn-info btn-sm" onclick="return confirm('ยืนยันการเก็บชาร์ท VN: {{ $lists->list_vn }}')">
                                                <i class="fa fa-clipboard-check"></i> เก็บชาร์ท
                                            </a>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid text-center">
                            @if($order->track_point == 1 && Auth::user()->permission_id == 1)
                            @if ($order->track_point == 2)
                                @php $btn = 'disabled'; @endphp
                            @else
                                @php $btn = ''; @endphp
                            @endif
                            <button id="mdcheck_complete" class="btn btn-success" data-id="{{ $order->track_id }}"
                                data-point="{{ $order->track_point }}" {{ $btn }}>
                                <i class="fas fa-check-circle"></i> ตรวจสอบเวชระเบียนเสร็จสิ้น
                            </button>
                            @endif
                            @if($order->track_point == 2 && $count == 0 && Auth::user()->permission_id == 1)
                            <button id="doctor_complete" class="btn btn-success" data-id="{{ $order->track_id }}"
                                data-point="{{ $order->track_point }}">
                                <i class="fas fa-sign-out-alt"></i> เก็บคืนเวชระเบียนเสร็จสิ้น
                            </button>
                            @endif
                            @if(Auth::user()->permission_id == 1 && $order->track_point == 3)
                            @if ($order->track_status == 2)
                                @php $show = 'disabled'; @endphp
                            @else 
                                @php $show = ''; @endphp
                            @endif
                            <button id="final_complete" class="btn btn-success" data-id="{{ $order->track_id }}"
                                data-point="{{ $order->track_point }}" {{ $show }}>
                                <i class="fas fa-check-circle"></i> จบกระบวนการ
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>

    $(document).ready(function () {
        $('#chartList').dataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            order: [
                [0, 'desc']
            ],
            scrollX: true,
            oLanguage: {
                oPaginate: {
                    sFirst: '<small>หน้าแรก</small>',
                    sLast: '<small>หน้าสุดท้าย</small>',
                    sNext: '<small>ถัดไป</small>',
                    sPrevious: '<small>กลับ</small>'
                },
                sSearch: '<small>ค้นหา</small>',
                sInfo: '<small>ทั้งหมด _TOTAL_ รายการ</small>',
                sLengthMenu: '<small>แสดง _MENU_ รายการ</small>',
                sInfoEmpty: '<small>ไม่มีข้อมูล</small>'
            }
        });
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $('#mdcheck_complete').on('click', function () {
        var formID = $(this).attr('data-id');
        var formData = $(this).attr('data-point');
        var token = "{{ csrf_token() }}";
        event.preventDefault();
        Swal.fire({
            title: 'ยืนยันการดำเนินการ ?',
            text: 'ตรวจสอบเวชระเบียนเสร็จสิ้น',
            showCancelButton: true,
            confirmButtonText: `ดำเนินการ`,
            cancelButtonText: `ยกเลิก`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('tracking.updateTrack') }}",
                    method: 'POST',
                    data: {
                        formID: formID,
                        formData: formData,
                        _token: token
                    },
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกการดำเนินการเสร็จสิ้น',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        window.setTimeout(function () {
                            location.replace('/tracking')
                        }, 1500);
                    }
                });
            }
        })
    });

    $('#doctor_complete').on('click', function () {
        var formID = $(this).attr('data-id');
        var formData = $(this).attr('data-point');
        var token = "{{ csrf_token() }}";
        event.preventDefault();
        Swal.fire({
            title: 'ยืนยันการดำเนินการ ?',
            text: 'เก็บคืนเวชระเบียนเสร็จสิ้น',
            showCancelButton: true,
            confirmButtonText: `ตกลง`,
            cancelButtonText: `ยกเลิก`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('tracking.updateTrack') }}",
                    method: 'POST',
                    data: {
                        formID: formID,
                        formData: formData,
                        _token: token
                    },
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกการดำเนินการเสร็จสิ้น',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        window.setTimeout(function () {
                            location.replace('/tracking')
                        }, 1500);
                    }
                });
            }
        })
    });

    $('#final_complete').on('click', function () {
        var formID = $(this).attr('data-id');
        var formData = $(this).attr('data-point');
        var token = "{{ csrf_token() }}";
        event.preventDefault();
        Swal.fire({
            title: 'ยืนยันจบกระบวนการ ?',
            text: 'ดำเนินการขั้นตอนสุดท้ายเสร็จสิ้น',
            showCancelButton: true,
            confirmButtonText: `ตกลง`,
            cancelButtonText: `ยกเลิก`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('tracking.finalTrack') }}",
                    method: 'POST',
                    data: {
                        formID: formID,
                        formData: formData,
                        _token: token
                    },
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกการดำเนินการเสร็จสิ้น',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        window.setTimeout(function () {
                            location.replace('/tracking')
                        }, 1500);
                    }
                });
            }
        })
    });

    $(document).ready(function() {
        $("#alert").fadeTo(5000, 500).slideUp(500, function() {
        $("#alert").slideUp(500);
        });
    });

</script>
@endsection
