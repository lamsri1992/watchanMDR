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
                                        <li class="breadcrumb-item" aria-current="page"><a href="/tracking"><i class="fa fa-map-marked-alt"></i> ระบบติดตามเวชระเบียนผู้ป่วยใน</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">สร้าง Tracking List</li>
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
                                    <th></th>
                                    <th class="text-center">VN</th>
                                    <th class="text-center">HN</th>
                                    <th class="">ชื่อผู้ป่วย</th>
                                    <th class=""><i class="fas fa-user-md"></i> แพทย์ผู้ตรวจ</th>
                                    <th class="text-center">สถานะ</th>
                                    <th class="text-center"><i class="far fa-calendar-check"></i> วันที่ Discharge</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <button id="btnSubmit" class="btn btn-success btn-block"><i class="fa fa-plus-circle"></i> สร้างรายการ</button>
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
            url: "/api/discharge_list",
            dataSrc: ""
        },
        columns: [
            { 'data': 'visit_vn', className: "text-center" },
            { 'data': 'visit_vn', className: "text-center" },
            { 'data': 'visit_hn', className: "text-center" },
            { 'data': 'patient_firstname',
                render: function (data, type, row, meta) {
                return row.patient_firstname + ' ' + row.patient_lastname
            }
            },
            { 'data': 'employee_firstname',
                render: function (data, type, row, meta) {
                return row.employee_firstname + ' ' + row.employee_lastname
            }
            },
            { 'data': 'visit_bed', className: "text-center" },
            { 'data': 'visit_ipd_discharge_date_time', className: "text-center" },
        ],
        columnDefs: [
            {
                'targets': 0,
                'checkboxes': {
                'selectRow': true
                }
            }
        ],
        select: {
            'style': 'multiple'
        },
        language: {
            select: {
                rows: {
                    _: "<small class='text-danger'>เลือกแล้ว %d รายการ</small>",
                }
            }
        },
        order: [[1, 'asc']],
        lengthMenu: [
            [10, 50, 100, -1],
            [10, 50, 100, "All"]
        ],
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
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

    $('#btnSubmit').click( function () {
        var token = "{{ csrf_token() }}";
        var array = [];

        table.rows('.selected').every(function(rowIdx) {
            array.push(table.row(rowIdx).data())
        })

        var formData = array;
        Swal.fire({
            title: 'สร้าง Tracking Order List ?',
            text: 'โปรดตรวจสอบรายการ ก่อนสร้างรายการใหม่ทุกครั้ง',
            showCancelButton: true,
            confirmButtonText: `สร้างรายการ`,
            cancelButtonText: `ยกเลิก`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:"{{ route('tracking.createOrder')}}",
                    method:'POST',
                    data:{formData: formData,_token: token},
                    success:function(data){
                        let timerInterval
                            Swal.fire({
                            title: 'กำลังสร้าง Tracking Order List',
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                timerInterval = setInterval(() => {
                                const content = Swal.getContent()
                                if (content) {
                                    const b = content.querySelector('b')
                                    if (b) {
                                    b.textContent = Swal.getTimerLeft()
                                    }
                                }
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                            }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                    Swal.fire({
                                    icon: 'success',
                                    title: 'สร้างรายการสำเร็จ',
                                    showConfirmButton: false,
                                    timer: 3000
                                })
                                window.setTimeout(function () {
                                    location.replace('/tracking')
                                }, 3500);
                            }
                        })
                    }
                });
            }
        })
    });
});
</script>
@endsection

