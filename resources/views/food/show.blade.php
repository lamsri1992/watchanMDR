@extends('layouts.app')
@section('content')
@if (Auth::check() == NULL)
    @php header( "location: /login" ); exit(0); @endphp
@endif
<div class="header bg-gradient-primary pb-8 pt-5"></div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
            @if ($message = Session::get('add'))
            <div id="alert" class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                <span><i class="fa fa-check-circle"></i> {{ $message }}</span>
            </div>
            @endif
            @if ($message = Session::get('change'))
            <div id="alert" class="alert alert-warning alert-block">
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
                                            <a href="/foodOrder"> <i class="fas fa-utensils"></i> ระบบสั่งอาหารผู้ป่วย</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            FOD23736{{ str_pad($list->food_id, 4, '0', STR_PAD_LEFT) }}
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <table class="table table-striped table-borderless table-sm">
                                    <tr>
                                        <th class="text-center"><i class="far fa-id-card"></i> ผู้ป่วย</th>
                                        <td>{{ $list->food_patient }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">หมายเลข VN</th>
                                        <td>{{ $list->food_vn }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">หมายเลข HN</th>
                                        <td>{{ $list->food_hn }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-center"><i class="fa fa-bed"></i> เตียง/ห้อง</th>
                                        <td>{{ $list->food_bed }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-center"><i class="fa fa-calendar-plus"></i> วันที่สร้าง</th>
                                        <td>{{ DateTimeThai($list->create_at) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <a href="#" class="badge badge-danger"><i class="fa fa-times-circle"></i> Discharge</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-8">
                                <table class="table table-striped table-borderless table-sm">
                                    <tr>
                                        <th class="text-center">REF</th>
                                        <th>ประเภทอาหาร</th>
                                        <th>รายการอาหาร</th>
                                        <th>วันที่สั่งรายการ</th>
                                        <th class="text-center">สถานะ</th>
                                    </tr>
                                    @foreach ($order as $od)
                                        <tr>
                                            <td class="text-center">{{ base64_encode($od->fo_id) }}</td>
                                            <td>{{ $od->ft_name }}</td>
                                            <td>{{ $od->fl_name." ".$od->fo_note }}</td>
                                            <td>{{ DateTimeThai($od->fo_date) }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('food.change',base64_encode($od->fo_id)) }}" class="badge badge-{{ $od->fs_text }} btn-block">
                                                    <i class="{{ $od->fs_icon }}"></i> {{ $od->fs_name }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div style="margin-bottom: 2rem;">
                            <i class="fa fa-clipboard-check"></i> แบบบันทึกรายการอาหารผู้ป่วย
                        </div>
                        <form action="{{ url('/foodOrder/addOrder') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <input type="hidden" name="food_id" value="{{ $list->food_id }}">
                            <div class="form-row">
                                <div class="form-group col-md-1 text-right">
                                    <div class="form-group">
                                        <label class="custom-toggle">
                                            <input type="checkbox" name="gridCheck" onchange="handleChange(this);" value="1">
                                            <span class="custom-toggle-slider rounded-circle"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-2 text-left">
                                    <div class="form-group">
                                        <span class="text-danger"><i class="fa fa-ban"></i> NPO งดน้ำและอาหาร</span>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <select id="food_type" name="food_type" class="js-single">
                                                <option value="">เลือกประเภทอาหาร</option>
                                                <option value="1">อาหารธรรมดา</option>
                                                <option value="2">อาหารอ่อน</option>
                                                <option value="3">โจ๊ก</option>
                                                <option value="4">เหลว</option>
                                                <option value="5">จิบน้ำ</option>
                                                <option value="6">อื่นๆ</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <select id="food_list" name="food_list" class="js-single">
                                                <option value="">เลือกรายการอาหาร</option>
                                                <option value="1">ลดไขมัน</option>
                                                <option value="2">ลดเค็ม</option>
                                                <option value="3">เบาหวาน</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <input id="note" name="note" class="form-control" placeholder="ระบุหมายเหตุการสั่งอาหาร (ถ้ามี)">
                                    </div>
                                </div>
                            </div>
                            <div class="text-right" style="margin-top: -2rem;">
                                <button type="button" class="btn btn-success" 
                                onclick=
                                "Swal.fire({
                                    title: 'บันทึกรายการอาหารผู้ป่วย ?',
                                    text: '{{ 'VN:'.$list->food_vn.' '.$list->food_patient }}',
                                    showCancelButton: true,
                                    confirmButtonText: `บันทึกรายการ`,
                                    cancelButtonText: `ยกเลิก`,
                                  }).then((result) => {
                                    if (result.isConfirmed) {
                                        form.submit();
                                    } else if (result.isDenied) {
                                        form.reset();
                                    }
                                })">บันทึกการสั่งอาหาร
                                </button>
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

    $(document).ready(function() {
        $('.js-single').select2({
            width: '100%',
            allowClear: true,
        });
    });

    $(document).ready(function () {
        $("#alert").fadeTo(5000, 500).slideUp(500, function () {
            $("#alert").slideUp(500);
        });
    });

    function handleChange(checkbox) {
        if(checkbox.checked == true){
            document.getElementById("food_type").disabled = true;
            document.getElementById("food_list").disabled = true;
            document.getElementById("note").disabled = true;
        }else{
            document.getElementById("food_type").disabled = false;
            document.getElementById("food_list").disabled = false;
            document.getElementById("note").disabled = false;
        }
    }
   
</script>
@endsection
