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
                                        <li class="breadcrumb-item active" aria-current="page">รายงานข้อมูล EMS</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <div class="row" style="margin-bottom: 1rem;">
                            <div class="col-6">
                                <h2>รายงานข้อมูล EMS</h2>
                            </div>
                            <div class="col-6 text-right">
                                <a href="/er/create_ems" class="btn btn-danger"><i class="fa fa-plus-circle"></i> บันทึกข้อมูล EMS</a>  
                            </div>
                        </div>
                        <table id="emsList" class="display nowrap table responsive" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class=""> สถานะ</th>
                                    <th class="text-center"><i class="far fa-calendar"></i> วันที่เกิดเหตุ</th>
                                    <th class="text-center"><i class="fa fa-clipboard-list"></i> เลขปฏิบัติการณ์</th>
                                    <th class="text-center"><i class="fa fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $ls)
                                <tr>
                                    <th class="text-center">
                                        EMS23736{{ str_pad($ls->ems_id, 4, '0', STR_PAD_LEFT) }}
                                    </th>
                                    <td class="">{{ $ls->ems_status_name }}</td>
                                    <td class="text-center">{{ DateThai($ls->ems_date) }}</td>
                                    <td class="text-center">{{ $ls->ems_no }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('er.ems_show',base64_encode($ls->ems_id)) }}" class="btn btn-info btn-sm">
                                            <i class="fa fa-search"></i> รายละเอียด
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
<script type="text/javascript">
    $(document).ready(function () {
            $('#emsList').dataTable({
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
                    sSearch: '<small>ค้นหา : </small>',
                    sInfo: '<small>ทั้งหมด _TOTAL_ รายการ</small>',
                    sLengthMenu: '<small>แสดง _MENU_ รายการ</small>',
                    sInfoEmpty: '<small>ไม่มีข้อมูล</small>'
                }
            });
        });
</script>
@endsection
