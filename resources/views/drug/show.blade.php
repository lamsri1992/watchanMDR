@extends('layouts.app')
@section('content')

<div class="header bg-gradient-primary pb-8 pt-5"></div>
<div class="container-fluid mt--7">
    @if($message = Session::get('success'))
    <div id="alert" class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <span>{{ $message }}</span>
    </div>
    @endif
    @if($message = Session::get('send'))
    <div id="alert" class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <span>{{ $message }}</span>
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
                                        <li class="breadcrumb-item">
                                            <a href="/drugOrder"><i class="fas fa-notes-medical"></i>
                                                รายการสั่งยาผู้ป่วยใน
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            ODL23736{{ str_pad($list->drug_id, 4, '0', STR_PAD_LEFT) }}
                                        </li>
                                        <div style="margin-left: 60%">
                                            <a href="#" class="badge badge-danger" style="font-size: 14px;" data-toggle="modal"
                                                data-target="#messageModal">
                                                <i class="fa fa-comment-dots"></i> Message Note
                                            </a>
                                        </div>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-7">
                                <table class="table table-striped table-borderless">
                                    <tr>
                                        <th class="text-center">หมายเลข VN</th>
                                        <td>{{ $list->drug_vn }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">หมายเลข HN</th>
                                        <td>{{ $list->drug_hn }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">ผู้ป่วย</th>
                                        <td>{{ $list->drug_patient }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">เตียง/ห้อง</th>
                                        <td>{{ $list->drug_bed }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">แพทย์ผู้ดูแล</th>
                                        <td>{{ $list->drug_doctor }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">วันที่สร้าง</th>
                                        <td>{{ $list->create_at }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-center"><i class="far fa-folder-open"></i> ไฟล์ Order</th>
                                        <td>
                                            @php
                                                $path = "/MDR/".$list->drug_vn."/Order/";
                                                $handle = opendir('MDR/'.$list->drug_vn.'/Order');
                                                $names = array();
                                                while($name = readdir($handle)) {
                                                    $names[] = $name;
                                                }
                                                closedir($handle);
                                                rsort($names);
                                                
                                                foreach ($names as $files) {
                                                if ($files == '.' || $files == '..')continue;
                                                echo "<a href='".$path.$files."' target='_blank'><i class='far fa-file-image'></i> ".$files."</a>
                                                        <a href='#' class='delFiles' data-vn='".$list->drug_vn."' data-name='".$files."'>
                                                            <i class='fas fa-times-circle text-danger' style='font-size:20px;'></i>
                                                        </a>
                                                    <hr>";
                                                }
                                            @endphp
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-5">
                                <h4>อัพโหลด Order</h4>
                                <form action="{{ url('/drugOrder/uploadFile') }}" method="POST"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('POST') }}
                                    <div class="form-group">
                                        <input type="file" class="form-control-file" name="vn_file" required>
                                        <input type="text" class="form-control" name="vn_id" value="{{ $list->drug_vn }}"
                                            hidden>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-upload"></i>
                                            Upload
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="container-fluid">
                                @php
                                    $path = "/MDR/".$list->drug_vn."/Order/";
                                    $handle = opendir('MDR/'.$list->drug_vn.'/Order');
                                    $names = array();
                                    while($name = readdir($handle)) {
                                        $names[] = $name;
                                    }
                                    closedir($handle);
                                    rsort($names);
                                    
                                    foreach ($names as $files) {
                                    if ($files == '.' || $files == '..')continue;
                                    echo "<a data-fancybox='gallery' href='".$path.$files."'>
                                            <img src='".$path.$files."' class='img-fluid img-thumbnail' width='30%'>&nbsp;&nbsp;
                                        </a>";
                                    }
                                @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel"><i class="far fa-comment-dots"></i> Message Note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="messaging">
                    <div class="inbox_msg">
                        <div class="mesgs">
                            <div class="msg_history">
                                @foreach ($note as $chat)
                                <div class="incoming_msg" style="margin-bottom: 1rem;">
                                    <div class="incoming_msg_img"> 
                                        {{ $chat->dm_comment }}
                                    </div>
                                    <div class="received_msg">
                                        <div class="received_withd_msg">
                                            <p>{{ $chat->dm_note }}</p>
                                            <span class="time_date"> {{ $chat->dm_date }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <form action="{{ url('/drugOrder/messageNote') }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('POST') }}
                                <div class="type_msg">
                                    <div class="form-group">
                                        <textarea type="text" name="note" class="form-control" rows="3" placeholder="ฝากข้อความ" required></textarea>
                                        <input type="hidden" name="drug_id" value="{{ $list->drug_id }}">
                                    </div>
                                    <div class="form-group">
                                        <small>ผู้ฝากข้อความ</small>
                                        <input type="text" name="comment" class="form-control" value="{{ auth()->user()->name }}" readonly>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-success btn-sm" type="submit"><i class="far fa-paper-plane" aria-hidden="true"></i> ส่งข้อความ</button>
                                    </div><br>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $('.delFiles').click(function () {
        var files_name = $(this).attr('data-name');
        var files_vn = $(this).attr('data-vn');
        var token = "{{ csrf_token() }}";
        // alert(files_name);
        event.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: 'ลบไฟล์ ' + files_name + '\n VN: ' + files_vn + ' ?',
            text: 'หากลบไฟล์แล้ว ไม่สามารถย้อนกลับคืนได้อีก',
            showCancelButton: true,
            confirmButtonText: `ยืนยัน`,
            cancelButtonText: `ยกเลิก`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('drug.fileDelete') }}",
                    method: 'POST',
                    data: {
                        files_name: files_name,
                        files_vn: files_vn,
                        _token: token
                    },
                    success: function (data) {
                        Swal.fire({
                            icon: 'error',
                            title: 'ลบไฟล์',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        window.setTimeout(function () {
                            location.reload()
                        }, 1500);
                    }
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
