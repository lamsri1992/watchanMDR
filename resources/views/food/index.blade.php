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
                                <a href="/foodOrder/createFoodOrder" class="btn btn-danger"><i class="fa fa-plus-circle"></i> สร้างรายการใหม่</a>
                            </div>
                        </div>
                        <table id="foodList" class="display nowrap table responsive" width="100%">
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
                                {{-- <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr> --}}
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
                [1, 'desc']
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
</script>
@endsection
