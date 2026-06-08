@extends('site.layouts.app')

@section('content')
    <div id="account-login" class="container" style="margin-top: 50px; margin-bottom: 50px;">

        <ul class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-home">Home</i></a></li>
            <li><a href="{{ route('company.login') }}">Giriş</a></li>
        </ul>

        {{-- Uğurlu qeydiyyat mesajı --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="fa fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="fa fa-exclamation-circle"></i>
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="row">
            <div id="content" class="col-sm-12">
                <div class="row">

                    <div class="col-sm-6">
                        <div class="well"
                             style="min-height: 330px; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <h2>{{ t('register_section_title') }}</h2>
                                <p><strong> {{ t('register_title') }}</strong></p>
                                <p>
                                    {{ t('register_desc') }}
                                </p>
                            </div>

                            <div>
                                <a href="{{ route('register') }}"
                                   class="btn btn-primary"
                                   style="background: #333; color: #fff; border: none; padding: 10px 20px;">
                                     {{ t('register_button_title') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="well" style="min-height: 330px;">
                            <h2>{{ t('login_title') }}</h2>
                            <p><strong> {{ t('login_desc') }}</strong></p>

                            <form action="{{ route('company.login') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="input-email">{{ t('login_email') }}</label>
                                    <input type="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           id="input-email"
                                           class="form-control"
                                           placeholder="E-Mail ünvanı"
                                           required
                                           autocomplete="email"
                                           autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="input-password">{{ t('login_password') }}</label>
                                    <input type="password"
                                           name="password"
                                           id="input-password"
                                           class="form-control"
                                           placeholder="Şifrə"
                                           required
                                           autocomplete="current-password">

                                    <a href="#"
                                       style="margin-top: 5px; display: inline-block; color: #666;">
                                        {{ t('forgot_password') }}
                                    </a>
                                </div>

                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"
                                                   name="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            {{ t('remember_me') }}
                                        </label>
                                    </div>
                                </div>

                                <button type="submit"
                                        class="btn btn-primary"
                                        style="background: #ffbc00; color: #000; border: none; font-weight: bold; padding: 10px 30px; width: 100%;">
                                     {{ t('sign_in') }}
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
