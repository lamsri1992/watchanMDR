@extends('layouts.app')
@section('content')

<div class="header bg-gradient-primary pb-8 pt-5"></div>
<div class="container-fluid mt--7">
    @if ($message = Session::get('discharge'))
    <div id="alert" class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        <span><i class="fa fa-check-circle"></i> {{ $message }}</span>
    </div>
    @endif
    <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="mb-0">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-utensils"></i> ระบบสั่งอาหารผู้ป่วย</li>
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
                                <h2>รายการสั่งอาหารผู้ป่วยทั้งหมด</h2>
                            </div>
                            <div class="col-6 text-right">
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#report"><i class="fa fa-print"></i> พิมพ์รายการอาหาร</a>
                                <a href="/foodOrder/createFoodOrder" class="btn btn-danger"><i class="fa fa-plus-circle"></i> สร้างรายการใหม่</a>  
                            </div>
                        </div>
                        <table id="foodList" class="table table-striped responsive nowrap" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="">ID</th>
                                    <th class="">หมายเลข VN</th>
                                    <th class="">หมายเลข HN</th>
                                    <th><i class="far fa-id-card"></i> ผู้ป่วย</th>
                                    <th><i class="fa fa-bed"></i> เตียง/ห้อง</th>
                                    <th><i class="far fa-calendar-plus"></i> วันที่สร้าง</th>
                                    <th class="text-center">ตัวเลือก</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $list)
                                <tr>
                                    <th class="">
                                        FOD23736{{ str_pad($list->food_id, 4, '0', STR_PAD_LEFT) }}
                                        @if (empty($list->fo_id))
                                        <span class="badge badge-danger">
                                            No Order
                                        </span>
                                        @endif
                                    </th>
                                    <td class="">{{ $list->food_vn }}</td>
                                    <td class="">{{ $list->food_hn }}</td>
                                    <td>{{ $list->food_patient }}</td>
                                    <td>{{ $list->food_bed }}</td>
                                    <td>{{ DateTimeThai($list->create_at) }}</td>
                                    <td class="text-center">
                                        <div class="dropdown dropleft">
                                            <button class="btn btn-warning btn-sm dropdown-toggle" type="button" id="foodMenu"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <i class="fa fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="foodMenu">
                                                <form action="{{ route('food.discharge',base64_encode($list->food_id)) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('POST') }}
                                                    <button href="#" type="button" class="dropdown-item" 
                                                        onclick=
                                                        "Swal.fire({
                                                            title: 'Discharge : FOD23736{{ str_pad($list->food_id, 4, '0', STR_PAD_LEFT) }} ?',
                                                            text: '{{ 'VN:'.$list->food_vn.' '.$list->food_patient }}',
                                                            showCancelButton: true,
                                                            confirmButtonText: `Discharge`,
                                                            cancelButtonText: `ยกเลิก`,
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                form.submit();
                                                            } else if (result.isDenied) {
                                                                form.reset();
                                                            }
                                                        })"><i class="fa fa-times-circle text-danger"></i> Discharge
                                                    </button>
                                                </form>
                                                <a href="{{ route('food.show',base64_encode($list->food_id)) }}" class="dropdown-item">
                                                    <i class="fa fa-search text-success"></i> รายละเอียด
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

<!-- Modal -->
<div class="modal fade" id="report" tabindex="-1" aria-labelledby="reportLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ url('/foodOrder/report') }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('POST') }}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportLabel"><i class="fa fa-print"></i> พิมพ์รายการอาหาร</h5>
                </div>
                <div class="modal-body">
                    <input type="text" name="date_ref" class="form-control jsDate" placeholder="เลือกวันที่" style="width: 100%;" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> พิมพ์รายการ</button>
                </div>
            </div>
        </form>
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
            // scrollX: true,
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

    $(function() {
        $.datetimepicker.setLocale('th');
        $(".jsDate").datetimepicker({
            format: 'Y-m-d',
            timepicker: false,
            lang: 'th',
        });
    });

    $(document).ready(function () {
        $("#alert").fadeTo(5000, 500).slideUp(500, function () {
            $("#alert").slideUp(500);
        });
    });
</script>
@endsection
