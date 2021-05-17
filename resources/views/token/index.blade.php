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
                                        <li class="breadcrumb-item active" aria-current="page">
                                            <i class="fab fa-line"></i> กำหนด Line Token
                                        </li>
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
                                <h2>รายการ Line Token ทั้งหมด</h2>
                            </div>
                            <div class="col-6 text-right">
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#addToken">
                                    <i class="fa fa-plus-circle"></i> เพิ่ม Line Token
                                </a>
                            </div>
                        </div>
                        <table id="userList" class="table table-striped table-borderless table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="">ชื่อ/กลุ่ม</th>
                                    <th class="">Token</th>
                                    <th class="text-center"><i class="fa fa-bars"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $res)
                                    <tr>
                                        <th class="text-center">{{ $res->token_id  }}</th>
                                        <td class="">{{ $res->token_name }}</td>
                                        <td class="">{{ $res->token_line }}</td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <a href="{{ route('token.show',base64_encode($res->token_id)) }}" class="btn btn-info btn-sm" type="button">
                                                    <i class="far fa-edit"></i> แก้ไข
                                                </a>
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
<div class="modal fade" id="addToken" tabindex="-1" role="dialog" aria-labelledby="addTokenLabel" aria-hidden="true">
    <form action="{{ url('/token/addToken') }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('POST') }}
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTokenLabel"><i class="fa fa-plus-circle"></i> เพิ่ม Line Token</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="name">ชื่อ/กลุ่ม</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="กำหนดชื่อ/กลุ่ม" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="token">Token</label>
                            <input type="text" name="line" class="form-control" id="line" placeholder="ระบุ Token" required>
                        </div>
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
