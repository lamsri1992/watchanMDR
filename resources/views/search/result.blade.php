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
                                        <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-search"></i> ค้นหาเวชระเบียน</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div id="alert" class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <span>พบข้อมูลที่ตรงกัน </span>
                            <strong>{{ count($result) }} รายการ</strong>
                        </div>
                        <table id="searchList" class="table text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>TRACK:ID</th>
                                    <th>VN</th>
                                    <th>HN</th>
                                    <th><i class="fa fa-map-marker-alt"></i> จุดบริการ</th>
                                    <th>สถานะ</th>
                                    <th><i class="fa fa-bars"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $results)
                                <tr>
                                    <th>
                                        <a href="{{ route('tracking.show',base64_encode($results->track_id)) }}">
                                            WCC23736{{ str_pad($results->track_id, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                    </th>
                                    <td>{{ $results->list_vn }}</td>
                                    <td>{{ $results->list_hn }}</td>
                                    <td>{{ $results->point_name }}</td>
                                    <td class="{{ $results->t_stat_color }}">@php echo $results->t_stat_text @endphp</td>
                                    <td>
                                        <button class="btn btn-info btn-sm"><i class="fa fa-search"></i> รายละเอียด</button>
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

@endsection
@section('script')
<script type="text/javascript">
 $(document).ready(function () {
        $('#searchList').dataTable({
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
