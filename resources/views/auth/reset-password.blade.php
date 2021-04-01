@extends('web.layout')
@section('title')
	Reset-password
@endsection

@section('main')




		<!-- Contact -->
		<div id="contact" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<!-- login form -->
					<div class="col-md-6 col-md-offset-3">
						<div class="contact-form">

                            @include('web.inc.messages')
							<h4>reset password</h4>
                            <form method="POST" action="{{url('/reset-password')}}">
                                @csrf
                                <input class="input" type="email" name="email"  placeholder="Email">
                                <input class="input" type="password" name="password" placeholder="Password">
                                <input class="input" type="password" name="password_confirmation" placeholder="Confirm Password">
                                <input type="hidden" name="token"
                                value="{{request()->route('token')}}">


							<button type="submit" class="main-button icon-button pull-right">save</button>
							</form>
						</div>
					</div>
					<!-- /login form -->

				</div>
				<!-- /row -->

			</div>
			<!-- /container -->

		</div>
		<!-- /Contact -->

		@endsection
