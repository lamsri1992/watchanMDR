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
                                        <li class="breadcrumb-item active" aria-current="page">
                                            <i class="fa fa-print"></i> REFER REPORT :: {{ DateThai($d_start)." - ".DateThai($d_end) }}
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <table id="referListReport" class="table table-sm" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">วันที่</th>
                                    <th>เจ้าหน้าที่</th>
                                    <th class="text-center">ระดับแอลกอฮอล์</th>
                                    <th>ผู้ป่วย</th>
                                    <th>Diag ต้นทาง</th>
                                    <th>Diag ปลายทาง</th>
                                    <th>รพ.ปลายทาง</th>
                                    <th class="text-center">เวลาออก</th>
                                    <th class="text-center">เวลากลับ</th>
                                    <th>แพทย์เวร</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($report as $re)
                                    <tr>
                                       <td class="text-center">{{ $re->refer_id }}</td>
                                       <td class="text-center">{{ DateThai($re->refer_date) }}</td>
                                       <td>
                                        @php $arr = explode(",", $re->refer_employee); @endphp
                                            @foreach ($arr as $emps)
                                                <li>{{ $emps }}</li>
                                            @endforeach
                                        </td>
                                       <td class="text-center">{{ $re->refer_alcohol }}</td>
                                       <td>{{ $re->refer_hn." : ".$re->refer_patient }}</td>
                                       <td>{{ $re->refer_diag_go }}</td>
                                       <td>{{ $re->refer_diag_back }}</td>
                                       <td>{{ $re->refer_hname }}</td>
                                       <td class="text-center">{{ $re->refer_time_go }}</td>
                                       <td class="text-center">{{ $re->refer_time_back }}</td>
                                       <td>{{ $re->refer_doctor }}</td>
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
        $('#referListReport').dataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            order: [
                [0, 'asc']
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
