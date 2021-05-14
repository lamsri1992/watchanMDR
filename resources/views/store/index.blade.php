@extends('layouts.app')
@section('content')
@if(Auth::check() == NULL)
    @phpheader( "location: /login" ); exit(0); @endphp
    @endif

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
                                            <li class="breadcrumb-item" aria-current="page">
                                                <a href="#">
                                                    <i class="fa fa-folder-open"></i> ระบบงานเวชระเบียน
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                คลังเวชระเบียนผู้ป่วยใน
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <table id="mdrList" class="table table-striped table-borderless table-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">VN</th>
                                        <th class="text-center">HN</th>
                                        <th class=""><i class="far fa-id-card"></i> ผู้ป่วย</th>
                                        <th class=""><i class="fas fa-user-md"></i> แพทย์</th>
                                        <th class=""><i class="far fa-calendar-times"></i> วันที่ D/C</th>
                                        <th class=""><i class="far fa-calendar-check"></i> วันที่สรุป</th>
                                        <th class="text-center">สถานะ</th>
                                        <th class="text-center"><i class="fas fa-bars"></i> ตัวเลือก</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $md)
                                        <tr>
                                            <th class="text-center">{{ $md->list_vn }}</th>
                                            <td class="text-center">{{ $md->list_hn }}</td>
                                            <td class="">{{ $md->list_patient }}</td>
                                            <td class="">{{ $md->list_doctor }}</td>
                                            <td class="">{{ $md->list_discharge }}</td>
                                            <td class="">{{ DateThai($md->list_end) }}</td>
                                            <td class="text-center {{ $md->t_stat_color }}">
                                                @php echo $md->t_stat_text @endphp
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group dropleft">
                                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa fa-bars"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <h6 class="dropdown-header text-muted">{{ "VN ".$md->list_vn }}</h6>
                                                        <a class="dropdown-item" href="#">รายละเอียด</a>
                                                        <a class="dropdown-item" href="#">ยืมเวชระเบียน</a>
                                                    </div>
                                                </div>
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
            $('#mdrList').dataTable({
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                // order: [
                //     [0, 'desc']
                // ],
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
