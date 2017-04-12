@extends('layouts.master')
@section('content')
<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
        @if(Session::has('info'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible show"  role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span>{{Session::get('info')}}</span>
                </div>
            </div>
        </div>
        @endif
            <p>Want to get in touch with me? Fill out the form below to send me a message and I will try to get back to you within 24 hours!</p>
            <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
            <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
            <!-- NOTE: To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
            <form name="sentMessage" id="contactForm" novalidate method="post" action="{{route('others.contact')}}">
            {{csrf_field()}}
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Name" id="name" name="name" required data-validation-required-message="Please enter your name.">
                        @if ($errors->has('name'))
                            <p class="help-block text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </p>
                        @endif
                    </div>
                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label>Email Address</label>
                        <input type="email" class="form-control" placeholder="Email Address" id="email" name="email" required data-validation-required-message="Please enter your email address.">
                        @if ($errors->has('email'))
                            <p class="help-block text-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </p>
                        @endif
                    </div>
                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls{{ $errors->has('number') ? ' has-error' : '' }}">
                        <label>Phone Number</label>
                        <input type="tel" class="form-control" placeholder="Phone Number" name="number" id="phone" required data-validation-required-message="Please enter your phone number.">
                        @if ($errors->has('number'))
                            <p class="help-block text-danger">
                                <strong>{{ $errors->first('number') }}</strong>
                            </p>
                        @endif
                    </div>
                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls{{ $errors->has('content') ? ' has-error' : '' }}">
                        <label>Message</label>
                        <textarea rows="5" class="form-control" placeholder="Message" id="message" name="content" required data-validation-required-message="Please enter a message."></textarea>
                        @if ($errors->has('content'))
                            <p class="help-block text-danger">
                                <strong>{{ $errors->first('content') }}</strong>
                            </p>
                        @endif
                    </div>
                </div>
                <br>
                <div id="success"></div>
                <div class="row">
                    <div class="form-group col-xs-12">
                        <button type="submit" class="btn btn-default">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<hr>
@endsection
