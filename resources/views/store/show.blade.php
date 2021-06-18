@extends('layouts.app')
@section('content')
@if(Auth::check() == NULL)
    @phpheader( "location: /login" ); exit(0); @endphp
    @endif

    <div class="header bg-gradient-default pb-8 pt-5"></div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                @if ($message = Session::get('success'))
                <div id="alert" class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>	
                    <span><i class="fa fa-check-circle"></i> {{ $message }}</span>
                </div>
                @endif
                <div class="card">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="mb-0">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item" aria-current="page">
                                                <a href="#">
                                                    <i class="fa fa-folder-open"></i> ระบบงานเวชระเบียน
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item" aria-current="page">
                                                <a href="/store">
                                                    คลังเวชระเบียนผู้ป่วยใน
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                VN : {{ $data->list_vn }}
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <table class="table table-striped table-borderless">
                                <tr>
                                    <th width="50%">หมายเลข VN</th>
                                    <td>{{ $data->list_vn }}</td>
                                </tr>
                                <tr>
                                    <th>หมายเลข HN</th>
                                    <td>{{ $data->list_hn }}</td>
                                </tr>
                                <tr>
                                    <th><i class="far fa-id-card"></i> ผู้ป่วย</th>
                                    <td>{{ $data->list_patient }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-user-md"></i> แพทย์ผู้ดูแล</th>
                                    <td>{{ $data->list_doctor }}</td>
                                </tr>
                                <tr>
                                    <th><i class="far fa-calendar"></i> วันที่ Discharge</th>
                                    <td>{{ $data->list_discharge }}</td>
                                </tr>
                                @if(empty($data->list_path))
                                <form action="{{ url('/store/upload') }}" method="POST"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('POST') }}
                                    <tr>
                                        <td>
                                           <input type="file" name="fileUpload" class="form-control">
                                           <input type="hidden" class="form-control" name="vn" value="{{ $data->list_vn }}">
                                        </td>
                                        <td class="text-left">
                                            <button class="btn btn-success">
                                                <i class="fa fa-file-upload"></i> อัพโหลดไฟล์
                                            </button>
                                        </td>
                                    </tr>
                                </form>
                                @else
                                    <tr>
                                        <th>
                                            <i class="far fa-file-pdf text-danger"></i> ไฟล์เวชระเบียน
                                        </th>
                                        <td>{{ $data->list_path }}</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                    @if(isset($data->list_path))
                    <div class="card-body">
                        @php
                            $path = "/MDR/".$data->list_vn."/Charts/".$data->list_path;
                        @endphp
                        <div class="container">
                            <iframe style="pointer-events:none;" src="{{ $path }}#toolbar=0&navpanes=0" width="100%" height="800px"></iframe>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @endsection
    @section('script')
    <script type="text/javascript">
    $(document).ready(function () {
        $("#alert").fadeTo(5000, 500).slideUp(500, function () {
            $("#alert").slideUp(500);
        });
    });
    </script>
    @endsection
