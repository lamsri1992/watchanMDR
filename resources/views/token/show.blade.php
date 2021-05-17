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
                                            <a href="/token">
                                                <i class="fab fa-line"></i> กำหนด Line Token
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            {{ $list->token_name }}
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
                        <form id="editToken">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>ชื่อ/กลุ่ม</label>
                                    <input type="text" name="name" class="form-control" value="{{ $list->token_name }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Token</label>
                                    <input type="text" name="line" class="form-control" value="{{ $list->token_line }}" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-success">
                                       <i class="fa fa-save"></i> บันทึก
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>

$('#editToken').on('submit', function () {
        var token = "{{ csrf_token() }}";
        event.preventDefault();
        Swal.fire({
            title: 'ยืนยันการแก้ไขข้อมูล ?',
            showCancelButton: true,
            confirmButtonText: `ตกลง`,
            cancelButtonText: `ยกเลิก`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('tracking.updateTrack') }}",
                    method: 'POST',
                    data: {
                        formData: formData,
                        _token: token
                    },
                    success: function (data) { }
                });
            }
        })
    });    

    $(document).ready(function () {
        $("#alert").fadeTo(5000, 500).slideUp(500, function () {
            $("#alert").slideUp(500);
        });
    });
</script>
@endsection
