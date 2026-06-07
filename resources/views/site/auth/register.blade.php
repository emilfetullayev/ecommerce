@extends('site.layouts.app')


@section('content')
    <div id="account-register" class="container">
        <ul class="breadcrumb">
            <li><a href="index9328.html?route=common/home">home</a></li>
            <li><a href="indexe223.html?route=account/account">Account</a></li>
            <li><a href="index5502.html?route=account/register">Register</a></li>
        </ul>

        <div id="content" class="col-sm-9">
            <h1>Register Account</h1>
            <p>If you already have an account with us, please login at the <a href="indexe223.html?route=account/login">login
                    page</a>.</p>
            <form action="{{ route('register') }}" method="POST" class="form-horizontal">
                @csrf {{-- Laravel təhlükəsizlik tokeni mütləqdir --}}

                {{-- Xətaları ekranda göstərmək üçün blok --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin-bottom: 0; list-style-type: none; padding-left: 0;">
                            @foreach ($errors->all() as $error)
                                <li><i class="fa fa-exclamation-triangle"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <fieldset id="account">
                    <legend>Şirkət və Şəxsi Məlumatlar</legend>

                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-company-name">Company Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="company_name" value="{{ old('company_name') }}"
                                   placeholder="Company Name" id="input-company-name" class="form-control" required/>
                        </div>
                    </div>


                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-name">Full Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="First & Last Name"
                                   id="input-name" class="form-control" required/>
                        </div>
                    </div>

                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-email">E-Mail</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="E-Mail"
                                   id="input-email" class="form-control" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-telephone">Telephone</label>
                        <div class="col-sm-10">
                            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Telephone"
                                   id="input-telephone" class="form-control"/>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Your Password</legend>
                    {{-- ŞİFRƏ --}}
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-password">Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" value="" placeholder="Password" id="input-password"
                                   class="form-control" required/>
                        </div>
                    </div>
                    {{-- ŞİFRƏ TƏKRARI --}}
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-confirm">Password Confirm</label>
                        <div class="col-sm-10">
                            <input type="password" name="password_confirmation" value="" placeholder="Password Confirm"
                                   id="input-confirm" class="form-control" required/>
                        </div>
                    </div>
                </fieldset>

                <div class="buttons">
                    <div class="text-right">
                        <input type="submit" value="Continue" class="btn btn-primary"
                               style="background: #ffbc00; color: #000; border: none; font-weight: bold; padding: 10px 30px;"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
