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
                                        <li class="breadcrumb-item active" aria-current="page">รายงานข้อมูล REFER</li>
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
                                <h2>รายงานข้อมูล REFER</h2>
                            </div>
                            <div class="col-6 text-right">
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#refer">
                                    <i class="fa fa-plus-circle"></i> บันทึกข้อมูล REFER
                                </a>
                            </div>
                        </div>
                        <table id="referList" class="display nowrap table responsive" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center"><i class="far fa-clipboard"></i> REFER_NO</th>
                                    <th class="text-center"><i class="far fa-calendar-alt"></i> วันที่ REFER</th>
                                    <th class="text-center"><i class="far fa-address-card"></i> HN</th>
                                    <th class=""><i class="fas fa-user-injured"></i> ผู้ป่วย</th>
                                    <th class="text-center"><i class="fa fa-hospital"></i> รพ.ปลายทาง</th>
                                    <th class="text-center">สถานะ</th>
                                    <th class="text-center"><i class="fa fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $ref)
                                <tr>
                                    <th class="text-center">
                                        REF23736{{ str_pad($ref->refer_id, 4, '0', STR_PAD_LEFT) }}
                                    </th>
                                    <td class="text-center">{{ $ref->refer_no }}</td>
                                    <td class="text-center">{{ DateThai($ref->refer_date) }}</td>
                                    <td class="text-center">{{ $ref->refer_hn }}</td>
                                    <td>{{ $ref->refer_patient }}</td>
                                    <td class="text-center">{{ $ref->refer_hname }}</td>
                                    <td class="text-center">
                                        @if (!isset($ref->refer_diag_back))
                                            <a href="#" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="รายการไม่สมบูรณ์">
                                                <i class="fa fa-times-circle"></i> Incomplete
                                            </a>
                                        @else
                                            <span class="badge badge-success">
                                                <i class="fa fa-check-circle"></i> Complete
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('er.refer_show',base64_encode($ref->refer_id)) }}" class="btn btn-info btn-sm">
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

<!-- Modal -->
<div class="modal fade" id="refer" tabindex="-1" aria-labelledby="referLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('er.refer_list') }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="referLabel"><i class="far fa-calendar-check"></i> เลือกปีของข้อมูล</h5>
                </div>
                <div class="modal-body">
                    <select name="year" class="custom-select" required>
                        <option value="">เลือกปี</option>
                        <option value="2564">ปี 2564</option>
                        <option value="2563">ปี 2563</option>
                        <option value="2562">ปี 2562</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-search"></i>
                        ค้นหาข้อมูล
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#referList').dataTable({
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
    
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection
