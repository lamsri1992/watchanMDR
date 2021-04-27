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
                                        <li class="breadcrumb-item" aria-current="page"><a href="/foodOrder"> <i class="fas fa-utensils"></i> ระบบสั่งอาหารผู้ป่วย</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">สร้างรายการสั่งอาหาร</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <table id="visitList" class="display nowrap table" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th class=""><i class="fa fa-plus-circle"></i>&nbsp;</th>
                                    <th class="">หมายเลข VN</th>
                                    <th class="">หมายเลข HN</th>
                                    <th class=""><i class="far fa-address-card"></i> ผู้ป่วย</th>
                                    <th class=""><i class="fa fa-bed"></i> เตียง/ห้อง</th>
                                    <th class=""><i class="fas fa-user-md"></i> แพทย์ผู้ตรวจ</th>
                                    <th class=""><i class="far fa-calendar-check"></i> วันที่ Admit</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
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
        var table = $('#visitList').DataTable( {
        ajax: {
            url: "/api/drug_list",
            dataSrc: ""
        },
        columns: [
            { 'targets': -1, 'data': null, className: "text-center",
                'defaultContent': '<button class="btn btn-sm btn-success"><i class="fa fa-utensils"></i> Food</button>'
            },
            { 'data': 'visit_vn', className: "text-center" },
            { 'data': 'visit_hn', className: "text-center" },
            { 'data': 'patient_firstname',
                render: function (data, type, row, meta) {
                return row.patient_firstname + ' ' + row.patient_lastname
            },
            },
            { 'data': 'visit_bed'},
            { 'data': 'employee_firstname',
                render: function (data, type, row, meta) {
                return row.employee_firstname + ' ' + row.employee_lastname
            },
            },
            { 'data': 'visit_begin_admit_date_time'},
        ],
        order: [[1, 'desc']],
        lengthMenu: [
            [10, 50, 100, -1],
            [10, 50, 100, "All"]
        ],
        scrollX: true,
        oLanguage: {
            oPaginate: {
                sFirst: '<small>หน้าแรก</small>',
                sLast: '<small>หน้าสุดท้าย</small>',
                sNext: '<small>ถัดไป</small>',
                sPrevious: '<small>กลับ</small>'
            },
            sInfo: "<small>ทั้งหมด _TOTAL_ รายการ</small>",
            sLengthMenu: "<small>แสดง _MENU_ รายการ</small>",
            sSearch: "<i class='fa fa-search'></i> ค้นหา : ",
        }
    });

    $('#visitList tbody').on('click', 'button', function () {
        var formData = table.row( $(this).parents('tr') ).data();
        var token = "{{ csrf_token() }}";

        event.preventDefault();
        Swal.fire({
            title: 'ยืนยันการสร้างรายการอาหาร ?',
            text: 'โปรดตรวจสอบรายการ ก่อนสร้างรายการใหม่ทุกครั้ง',
            showCancelButton: true,
            confirmButtonText: `สร้างรายการ`,
            cancelButtonText: `ยกเลิก`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:"{{ route('food.createOrder')}}",
                    method:'POST',
                    data:{formData: formData,_token: token},
                    success:function(data){
                        Swal.fire({
                            icon: 'success',
                            title: 'สร้างรายการสำเร็จ',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        window.setTimeout(function () {
                                location.replace('/foodOrder/')
                        }, 1500);
                    }
                });
            }
        })
    });
});
</script>
@endsection
