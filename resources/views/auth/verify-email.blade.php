@extends('web.layout')
@section('title')
verify email
@endsection
@section('main')

<div id="contact" class="section">

    <!-- container -->
    <div class="container">

        <!-- row -->
        <div class="row">

            <!-- login form -->
            <div class="col-md-6 col-md-offset-3">
                <div class="contact-form">
                        <div class="alert alert-success">
                            a verifcation link sent successfully , pleas check your inbox
                        </div>
                <form method="POST" action="{{url('email/verification-notification')}}">
                    @csrf
                    <button type="submit" class="main-button icon-button pull-right">
                        Re Send
                    </button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
