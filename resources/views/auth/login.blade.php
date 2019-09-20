@extends('layouts.app')
@section('content')
<div class="login-box">
    <div class="login-logo">
        <div class="login-logo">
            <a href="#">
                {{ trans('panel.site_title') }}
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">{{ trans('auth.login_title') }}</p>
            @if(\Session::has('message'))
                <p class="alert alert-info">
                    {{ \Session::get('message') }}
                </p>
            @endif
            <form action="{{ route('login') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="{{ trans('global.login_staff_no') }}" name="staff_no">
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="{{ trans('global.login_password') }}" name="password">
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <input type="checkbox" name="remember"> {{ trans('global.remember_me') }}
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('global.login') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p class="mb-0">

            </p>
            <p class="mb-1">

            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
@endsection
