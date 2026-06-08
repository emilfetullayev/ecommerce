@extends('site.layouts.app')


@section('content')
    <div id="account-register" class="container">
        <ul class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-home">Home</i></a></li>
            <li><a href="{{ route('company.login') }}">Giriş</a></li>
        </ul>

        <div id="content" class="col-sm-9">
            <h1> {{ t('register_account_title') }}</h1>

            <form action="{{ route('register') }}" method="POST" class="form-horizontal">
                @csrf

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
                    <legend> {{ t('company_and_personal_information') }}</legend>

                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-company-name"> {{ t('company_name') }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="company_name" value="{{ old('company_name') }}"
                                   placeholder="Company Name" id="input-company-name" class="form-control" required/>
                        </div>
                    </div>


                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-name"> {{ t('full_name') }} </label>
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
                        <label class="col-sm-2 control-label" for="input-telephone"> {{ t('telephone') }}</label>
                        <div class="col-sm-10">
                            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Telephone"
                                   id="input-telephone" class="form-control"/>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend> {{ t('your_password') }}</legend>
                    {{-- ŞİFRƏ --}}
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-password"> {{ t('password') }}</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" value="" placeholder="Password" id="input-password"
                                   class="form-control" required/>
                        </div>
                    </div>

                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-confirm"> {{ t('password_confirm') }}</label>
                        <div class="col-sm-10">
                            <input type="password" name="password_confirmation" value="" placeholder="Password Confirm"
                                   id="input-confirm" class="form-control" required/>
                        </div>
                    </div>
                </fieldset>

                <div class="buttons">
                    <div class="text-right">
                        <input type="submit" value="{{ t('continue') }}" class="btn btn-primary"
                               style="background: #ffbc00; color: #000; border: none; font-weight: bold; padding: 10px 30px;"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
