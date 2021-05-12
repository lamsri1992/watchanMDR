@extends('layouts.app')
@section('content')

<div class="header bg-gradient-primary pb-8 pt-5"></div>
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
                                        <li class="breadcrumb-item active" aria-current="page">
                                            <i class="far fa-clipboard"></i> รายการอาหารผู้ป่วย ประจำวันที่
                                            {{ DateThai($rdate) }}
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <table id="foodList" class="table table-striped" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center"><i class="fa fa-bed"></i> เตียง/ห้อง</th>
                                    <th class=""><i class="far fa-id-card"></i> ผู้ป่วย</th>
                                    <th class="">รายการอาหาร</th>
                                    <th class="">ประเภทอาหาร</th>
                                    <th class="">หมายเหตุ</th>
                                    <th class=""><i class="far fa-calendar"></i> วันที่สั่งรายการ</th>
                                    <th class="text-center">สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order as $od)
                                    <tr>
                                        <td class="text-center">{{ $od->food_bed }}</td>
                                        <td class="">{{ $od->food_patient }}</td>
                                        <td class="">{{ $od->ft_name }}</td>
                                        <td class="">{{ $od->fl_name }}</td>
                                        <td class="">{{ $od->fo_note }}</td>
                                        <td class="">{{ DateThai($od->fo_date) }}</td>
                                        <td class="text-center">
                                            <span class="badge badge-{{ $od->fs_text }} btn-block">
                                                <i class="{{ $od->fs_icon }}"></i> {{ $od->fs_name }}
                                            </span>
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
<script type="text/javascript">
    $(document).ready(function () {
        $('#foodList').dataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
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
            },
            scrollX: true,
            autoWidth: true,
            dom: '<"top"Blf>rt<"bottom"ip><"clear">',
            buttons: [{
                    extend: 'print',
                    text: '<i class="fa fa-print"></i> พิมพ์',
                },
                {
                    extend: 'excel',
                    text: '<i class="fa fa-file-excel"></i> Excel',
                }
            ],
        });
    });
</script>
@endsection
