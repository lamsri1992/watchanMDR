@extends('layouts.app')
@section('content')
@if (Auth::check() == NULL)
    @php header( "location: /login" ); exit(0); @endphp
@endif
<div class="header bg-gradient-primary pb-8 pt-5"></div>
<div class="container-fluid mt--7">
    <div class="alert alert-danger alert-block text-center">
        <strong style="font-size: 20px;">โปรดอ่านก่อน <i class="fa fa-exclamation-triangle"></i></strong><br>
        <span>ก่อนสร้าง Tracking List ใหม่ กรุณาตรวจสอบ VN เวชระเบียนก่อนทุกครั้ง</span><br>
        <small class="badge badge-light text-white">ระวังข้อมูลเวชระเบียนซ้ำกันใน Tracking List</small>
    </div>
    @include('tracking.card')
    <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="mb-0">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-map-marked-alt"></i> ระบบติดตามเวชระเบียนผู้ป่วยใน</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row" style="margin-bottom: 1rem;">
                            <div class="col-6">
                                <h2>รายการเวชระเบียนผู้ป่วยในทั้งหมด</h2>
                            </div>
                            <div class="col-6 text-right">
                                <a href="/tracking/createOrderList" class="btn btn-danger"><i class="fa fa-plus-circle"></i> สร้างรายการใหม่</a>
                            </div>
                        </div>
                        <table id="trackList" class="table table-striped table-borderless table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">จำนวน</th>
                                    <th class="text-center"><i class="far fa-calendar-plus"></i> วันที่สร้าง</th>
                                    <th class="text-center">สถานะ</th>
                                    <th class="text-center">จุดที่ดำเนินการล่าสุด</th>
                                    <th class="text-center">ตัวเลือก</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $order)
                                <tr>
                                    <th class="text-center">WCC23736{{ str_pad($order->track_id, 4, '0', STR_PAD_LEFT) }}</th>
                                    <td class="text-center"><span class="badge badge-success btn-block" style="font-size: 14px;">{{ $order->track_case }} เคส</span></td>
                                    <td class="text-center">{{ $order->create_at }}</td>
                                    <td class="text-center {{ $order->t_stat_color }}">@php echo $order->t_stat_text @endphp</td>
                                    <td class="text-center">{{ $order->point_name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('tracking.show',base64_encode($order->track_id)) }}" class="btn btn-info btn-sm">
                                            <i class="fa fa-search"></i> ติดตามเวชระเบียน
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
        $('#trackList').dataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            order: [
                [0, 'desc']
            ],
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
</script>
@endsection

