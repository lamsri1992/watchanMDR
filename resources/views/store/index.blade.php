@extends('layouts.app')
@section('title',"WATCHAN CHART MANAGEMENT :: ระบบบริหารจัดการเวชระเบียนผู้ป่วยใน รพช.วัดจันทร์เฉลิมพระเกียรติ ๘๐ พรรษา")
@section('content')

<div class="container-fluid">
    <article class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><i class="far fa-folder-open"></i> คลังเวชระเบียนผู้ป่วยใน</li>
            </ol>
        </nav>
        <div class="card-body">
            <div class="container-fluid">
                <table id="trackList" class="table table-striped table-borderless table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">VN</th>
                            <th class="text-center">HN</th>
                            <th class="text-center">สถานะ</th>
                            <th class="text-center"><i class="far fa-calendar-plus"></i> วันที่สร้าง</th>
                            <th class="text-center"><i class="fa fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="text-center">1</th>
                            <td class="text-center">1640000002</td>
                            <td class="text-center">000000002</td>
                            <td class="text-center text-success"><i class="fa fa-check"></i> ว่าง</td>
                            <td class="text-center">2021-01-01</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-info btn-sm dropdown-toggle" type="button" 
                                    id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        ตัวเลือก
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                                        <a class="dropdown-item" href="#">ดูเวชระเบียน</a>
                                        <a class="dropdown-item" href="#">ยืมเวชระเบียน</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">2</th>
                            <td class="text-center">1640000003</td>
                            <td class="text-center">000000003</td>
                            <td class="text-center text-success"><i class="fa fa-check"></i> ว่าง</td>
                            <td class="text-center">2021-01-01</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-info btn-sm dropdown-toggle" type="button" 
                                    id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        ตัวเลือก
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                                        <a class="dropdown-item" href="#">ดูเวชระเบียน</a>
                                        <a class="dropdown-item" href="#">ยืมเวชระเบียน</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">3</th>
                            <td class="text-center">1640000004</td>
                            <td class="text-center">000000004</td>
                            <td class="text-center text-danger"><i class="fa fa-spinner fa-spin"></i> ถูกยืม</td>
                            <td class="text-center">2021-01-01</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-info btn-sm dropdown-toggle" type="button" 
                                    id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        ตัวเลือก
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                                        <a class="dropdown-item" href="#">ดูเวชระเบียน</a>
                                        <a class="dropdown-item" href="#">ยืมเวชระเบียน</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">4</th>
                            <td class="text-center">1640000005</td>
                            <td class="text-center">000000005</td>
                            <td class="text-center text-danger"><i class="fa fa-spinner fa-spin"></i> ถูกยืม</td>
                            <td class="text-center">2021-01-01</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-info btn-sm dropdown-toggle" type="button" 
                                    id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        ตัวเลือก
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                                        <a class="dropdown-item" href="#">ดูเวชระเบียน</a>
                                        <a class="dropdown-item" href="#">ยืมเวชระเบียน</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">5</th>
                            <td class="text-center">1640000006</td>
                            <td class="text-center">000000006</td>
                            <td class="text-center text-success"><i class="fa fa-check"></i> ว่าง</td>
                            <td class="text-center">2021-01-01</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-info btn-sm dropdown-toggle" type="button" 
                                    id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        ตัวเลือก
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                                        <a class="dropdown-item" href="#">ดูเวชระเบียน</a>
                                        <a class="dropdown-item" href="#">ยืมเวชระเบียน</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">6</th>
                            <td class="text-center">1640000007</td>
                            <td class="text-center">000000007</td>
                            <td class="text-center text-success"><i class="fa fa-check"></i> ว่าง</td>
                            <td class="text-center">2021-01-01</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-info btn-sm dropdown-toggle" type="button" 
                                    id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        ตัวเลือก
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                                        <a class="dropdown-item" href="#">ดูเวชระเบียน</a>
                                        <a class="dropdown-item" href="#">ยืมเวชระเบียน</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">7</th>
                            <td class="text-center">1640000008</td>
                            <td class="text-center">000000008</td>
                            <td class="text-center text-success"><i class="fa fa-check"></i> ว่าง</td>
                            <td class="text-center">2021-01-01</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-info btn-sm dropdown-toggle" type="button" 
                                    id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        ตัวเลือก
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                                        <a class="dropdown-item" href="#">ดูเวชระเบียน</a>
                                        <a class="dropdown-item" href="#">ยืมเวชระเบียน</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">8</th>
                            <td class="text-center">1640000009</td>
                            <td class="text-center">000000009</td>
                            <td class="text-center text-danger"><i class="fa fa-spinner fa-spin"></i> ถูกยืม</td>
                            <td class="text-center">2021-01-01</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-info btn-sm dropdown-toggle" type="button" 
                                    id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        ตัวเลือก
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                                        <a class="dropdown-item" href="#">ดูเวชระเบียน</a>
                                        <a class="dropdown-item" href="#">ยืมเวชระเบียน</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">9</th>
                            <td class="text-center">1640000009</td>
                            <td class="text-center">000000009</td>
                            <td class="text-center text-success"><i class="fa fa-check"></i> ว่าง</td>
                            <td class="text-center">2021-01-01</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-info btn-sm dropdown-toggle" type="button" 
                                    id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        ตัวเลือก
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                                        <a class="dropdown-item" href="#">ดูเวชระเบียน</a>
                                        <a class="dropdown-item" href="#">ยืมเวชระเบียน</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">10</th>
                            <td class="text-center">1640000010</td>
                            <td class="text-center">000000010</td>
                            <td class="text-center text-danger"><i class="fa fa-spinner fa-spin"></i> ถูกยืม</td>
                            <td class="text-center">2021-01-01</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-info btn-sm dropdown-toggle" type="button" 
                                    id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        ตัวเลือก
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                                        <a class="dropdown-item" href="#">ดูเวชระเบียน</a>
                                        <a class="dropdown-item" href="#">ยืมเวชระเบียน</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </article>
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
            }
        });
    });
</script>
@endsection
