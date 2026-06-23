@extends('site.layouts.app')

@section('content')
    <div id="information-contact" class="container">

        @include('site.partials.breadcrumb', [
            'title' => t('contact_title'),
            'section_title' => t('contact_section_title'),
            'home_title' => t('home_title'),
        ])

        <div class="row">
            <div id="content" class="col-sm-12">

                {{-- SUCCESS MESSAGE --}}
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- ERROR MESSAGE --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin:0;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="shop-content row">

                    {{-- LEFT SIDE --}}
                    <div class="col-sm-12">
                        <h3 class="contact-title">{{ t('location_title') }}</h3>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 contact-left">
                        <div class="content-details">

                            <div class="phone-info">
                                <div class="phone-title title">
                                    <i class="fa fa-mobile"></i> {{ t('phone_title') }}
                                </div>
                                <div class="content-number">
                                    123-456-7890
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- RIGHT SIDE FORM --}}
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 contact-right">

                        <form action="{{ route('contact.store') }}" method="POST" class="form-horizontal">
                            @csrf

                            <fieldset>
                                <legend>{{ t('contact_form_title') }}</legend>

                                {{-- NAME --}}
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-name">
                                        {{ t('contact_full_name') }}
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                               name="name"
                                               id="input-name"
                                               value="{{ old('name') }}"
                                               class="form-control"
                                               required>
                                    </div>
                                </div>

                                {{-- EMAIL --}}
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-email">
                                        {{ t('contact_email_address') }}
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="email"
                                               name="email"
                                               id="input-email"
                                               value="{{ old('email') }}"
                                               class="form-control"
                                               required>
                                    </div>
                                </div>

                                {{-- MESSAGE --}}
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-enquiry">
                                        {{ t('contact_desc') }}
                                    </label>
                                    <div class="col-sm-10">
                                    <textarea name="enquiry"
                                              id="input-enquiry"
                                              rows="8"
                                              class="form-control"
                                              required>{{ old('enquiry') }}</textarea>
                                    </div>
                                </div>

                            </fieldset>

                            <div class="buttons clearfix">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary">
                                        Göndər
                                    </button>
                                </div>
                            </div>


                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
