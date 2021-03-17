@extends('layouts.app')
@section('content')
@if (Auth::check() == NULL)
    @php header( "location: /login" ); exit(0); @endphp
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
                                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-notes-medical"></i> ระบบออเดอร์ผู้ป่วยใน</li>
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
                                <h2>รายการออเดอร์ผู้ป่วยในทั้งหมด</h2>
                            </div>
                            <div class="col-6 text-right">
                                <a href="/drugOrder/createDrugOrder" class="btn btn-danger"><i class="fa fa-plus-circle"></i> สร้างรายการใหม่</a>
                            </div>
                        </div>
                        @if ($message = Session::get('error'))
                        <div id="alert" class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        <table id="trackList" class="display nowrap table responsive" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">หมายเลข VN</th>
                                    <th class="text-center">หมายเลข HN</th>
                                    <th class="text-center">ผู้ป่วย</th>
                                    <th class="text-center">เตียง/ห้อง</th>
                                    <th class="text-center"><i class="far fa-calendar-plus"></i> วันที่สร้าง</th>
                                    <th class="text-center">ตัวเลือก</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $list)
                                <tr>
                                    <th class="text-center">ODL23736{{ str_pad($list->drug_id, 4, '0', STR_PAD_LEFT) }}</th>
                                    <td class="text-center">{{ $list->drug_vn }}</td>
                                    <td class="text-center">{{ $list->drug_hn }}</td>
                                    <td class="text-center">{{ $list->drug_patient }}</td>
                                    <td class="text-center">{{ $list->drug_bed }}</td>
                                    <td class="text-center">{{ $list->create_at }}</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                ตัวเลือก
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu" style="font-size:14px;">
                                                <a class="dropdown-item"  href="{{ route('drug.show',base64_encode($list->drug_id)) }}" class="btn btn-info btn-sm">
                                                    <i class="fa fa-search"></i> ดูรายการ
                                                </a>
                                                <a class="dropdown-item text-danger"  href="{{ route('drug.discharge',base64_encode($list->drug_id)) }}" class="btn btn-info btn-sm"
                                                    onclick="return confirm('ยืนยันการ Disharge VN: {{ $list->drug_vn }}')">
                                                    <i class="fa fa-times-circle"></i> Discharge
                                                </a>
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

    $(document).ready(function() {
        $("#alert").fadeTo(5000, 500).slideUp(500, function() {
        $("#alert").slideUp(500);
        });
    });
</script>
@endsection
