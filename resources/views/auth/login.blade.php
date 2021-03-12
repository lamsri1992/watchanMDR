@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
@include('layouts.headers.guest')

<div class="container mt--8 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card bg-secondary shadow border-0">
                <div class="card-body px-lg-5 py-lg-5">
                    @if($message = Session::get('valid'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <span>{{ $message }}</span>
                        </div>
                    @endif
                    <form role="form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="text-center">
                            <h3>กรุณาลงชื่อเข้าใช้งาน</h3>
                        </div>
                        <div class="form-group{{ $errors->has('username') ? ' has-danger' : '' }} mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                </div>
                                <input
                                    class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Username') }}" type="text" name="username"
                                    value="{{ old('username') }}" required autofocus>
                            </div>
                            @if($errors->has('username'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div
                            class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" placeholder="{{ __('Password') }}" type="password"
                                    required>
                            </div>
                            @if($errors->has('password'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="text-center">
                            <button type="submit"
                                class="btn btn-success my-4"><i class="fa fa-sign-in-alt"></i> {{ __('ลงชื่อเข้าใช้งาน') }} </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
