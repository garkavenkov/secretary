@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center min-vh-100 " style="padding-top: 10rem;">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Авторізація в системі</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col text-center">
                            <img src="/img/community.png" alt="" class="login-logo">
                        </div>
                        <div class="col">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col">
                                        <label  for="userName"
                                                class="col-form-label">
                                            @lang('auth.user_name')
                                        </label>
                                        <input  id="userName"
                                                type="text"
                                                class="form-control @error('user_name') is-invalid @enderror"
                                                name="user_name"
                                                value="{{ old('user_name') }}"
                                                required
                                                autocomplete="user_name"
                                                autofocus>
                                        @error('user_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label  for="password"
                                                class="col-form-label">
                                            @lang('auth.password')
                                        </label>
                                        <input  id="password"
                                                type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password"
                                                required
                                                autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="form-check">
                                            <input  class="form-check-input"
                                                    type="checkbox"
                                                    name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label  class="form-check-label"
                                                    for="remember">
                                                @lang('auth.remember_me')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-0">
                                    <div class="col">
                                        <button type="submit"
                                                class="btn btn-primary">
                                            @lang('auth.login')
                                        </button>
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                @lang('auth.forgot_your_password')
                                            </a>
                                        @endif
                                    </div>
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
