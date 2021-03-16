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
                                        <li class="breadcrumb-item active" aria-current="page"><i
                                                class="fa fa-users"></i> ระบบจัดการผู้ใช้งาน</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        @if($message = Session::get('success'))
                        <div id="alert" class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <span>{{ $message }}</span>
                        </div>
                        @endif
                        <div class="row" style="margin-bottom: 1rem;">
                            <div class="col-6">
                                <h2>บัญชีผู้ใช้งานทั้งหมด</h2>
                            </div>
                            <div class="col-6 text-right">
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#addUser">
                                    <i class="fa fa-plus-circle"></i> เพิ่มผู้ใช้งาน
                                </a>
                            </div>
                        </div>
                        <table id="userList" class="table table-striped table-borderless table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="">ชื่อ-สกุล</th>
                                    <th class="">ชื่อผู้ใช้งาน</th>
                                    <th class="">อีเมล์</th>
                                    <th class="">สิทธิ์การใช้งาน</th>
                                    <th class="text-center"><i class="fa fa-bars"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $users)
                                    <tr>
                                        <th class="text-center">{{ $users->id }}</th>
                                        <td class="">{{ $users->name }}</td>
                                        <td class="">{{ $users->username }}</td>
                                        <td class="">{{ $users->email }}</td>
                                        <td class="">{{ $users->permission }}</td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-info btn-sm dropdown-toggle" type="button"
                                                    id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    ตัวเลือก
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenu"
                                                    style="font-size:14px;">
                                                    <a class="dropdown-item"
                                                        href="{{ route('drug.show',base64_encode($users->id)) }}"
                                                        class="btn btn-info btn-sm">
                                                        <i class="fa fa-search"></i> แก้ไข
                                                    </a>
                                                    <a class="dropdown-item text-danger"
                                                        href="{{ route('drug.discharge',base64_encode($users->id)) }}"
                                                        class="btn btn-info btn-sm"
                                                        onclick="return confirm('ยืนยันการ Reset Password : {{ $users->username }} ?\nรหัสผ่านเริ่มต้น `123456`')">
                                                        <i class="fa fa-times-circle"></i> Reset Password
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

<!-- Modal Add User -->
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
    <form action="{{ url('/users/addUser') }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('POST') }}
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserLabel"><i class="fa fa-plus-circle"></i> เพิ่มผู้ใช้งาน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">ชื่อ-สกุล</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="ระบุชื่อ-สกุล" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="กำหนดชื่อผู้ใช้งาน" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="ระบุอีเมล์">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">Password</label>
                            <input type="text" name="password" class="form-control" id="password" value="123456" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="permission">สิทธิ์การใช้งาน</label>
                        <select name="permission" class="custom-select" required>
                            <option value="">เลือกสิทธิ์การใช้งาน</option>
                            <option value="1">ผู้ดูแลระบบ</option>
                            <option value="2">งานเภสัชกรรม</option>
                            <option value="3">กลุ่มการแพทย์</option>
                            <option value="4">งานเวชระเบียน</option>
                            <option value="5">ผู้ใช้งานทั่วไป</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('#userList').dataTable({
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

    $(document).ready(function () {
        $("#alert").fadeTo(5000, 500).slideUp(500, function () {
            $("#alert").slideUp(500);
        });
    });

</script>
@endsection
