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
            <div class="shop-content row">
                <div class="col-sm-12">
                    <h3 class="contact-title">{{ t('location_title') }}</h3>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 contact-left">
                    <div class="content-details">
                        <div class="phone-info">
                            <div class="phone-title title"><i class="fa fa-mobile"></i>{{ t('phone_title') }}</div>
                            <div class="content-number"> 123-456-7890</div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 contact-right">
                    <form action="https://opencart.mahardhi.com/MT03/tooltrex/01/index.php?route=information/contact" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <fieldset>
                            <legend>{{ t('contact_form_title') }}</legend>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-name">{{ t('contact_full_name') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" value="" id="input-name" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-email">{{ t('contact_email_address') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" name="email" value="" id="input-email" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-enquiry">{{ t('contact_desc') }}</label>
                                <div class="col-sm-10">
                                    <textarea name="enquiry" rows="10" id="input-enquiry" class="form-control"></textarea>
                                </div>
                            </div>

                        </fieldset>
                        <div class="buttons clearfix">
                            <div class="pull-right">
                                <input class="btn btn-primary" type="submit" value="Submit" />
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
