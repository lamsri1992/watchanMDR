@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    <div class="header bg-gradient-primary py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mt-7 mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-6">
                        <h1 class="text-white">{{ __('ยินดีต้อนรับเข้าสู่ระบบบริหารจัดการเวชระเบียนผู้ป่วยใน') }}</h1>
                        <a href="/login" class="btn btn-primary">{{ __('คลิ๊กที่นี่ เพื่อลงชื่อเข้าใช้งานระบบ') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt--10 pb-5"></div>
@endsection
