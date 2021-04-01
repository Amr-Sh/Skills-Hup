
@extends('web.layout')
@section('title')
Contact Us
@endsection
@section('main')


		<!-- /Header -->

		<!-- Hero-area -->
		<div class="hero-area section">

			<!-- Backgound Image -->
            <div class="bg-image bg-parallax overlay"
            style="background-image:url({{asset('web/img/page-background.jpg')}})"></div>
			<!-- /Backgound Image -->

			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						<ul class="hero-area-tree">
							<li><a href="index.html">Home</a></li>
							<li>Contact</li>
						</ul>
						<h1 class="white-text">Get In Touch</h1>

					</div>
				</div>
			</div>

		</div>
		<!-- /Hero-area -->

		<!-- Contact -->
		<div id="contact" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<!-- contact form -->
					<div class="col-md-6">
						<div class="contact-form">
                            <h4>Send A Message</h4>
                            <div id="form-msg"></div>
							<form id="contact-form">
                                @csrf
								<input class="input" type="text" name="name" placeholder="Name">
								<input class="input" type="email" name="email" placeholder="Email">
								<input class="input" type="text" name="subject" placeholder="Subject">
								<textarea class="input" name="message" placeholder="Enter your Message"></textarea>
								<button type="submit" class="main-button icon-button pull-right">Send Message</button>
							</form>
						</div>
					</div>
					<!-- /contact form -->

					<!-- contact information -->
					<div class="col-md-5 col-md-offset-1">
						<h4>Contact Information</h4>
						<ul class="contact-details">
							<li><i class="fa fa-envelope"></i>{{$sett->email}}</li>
							<li><i class="fa fa-phone"></i>{{$sett->phone}}</li>
						</ul>

					</div>
					<!-- contact information -->

				</div>
				<!-- /row -->

			</div>
			<!-- /container -->

		</div>
		<!-- /Contact -->

@endsection
@section('custom-js')
    <script>
        $('#contact-form').submit(function(e){
            e.preventDefault()
            $('#success-msg').empty()
            $('#form-msg').empty()
            let data=new FormData($('#contact-form')[0])
            console.log(data.get('name'));

          $.ajax({
                type:'POST',
                url:"{{url('contact/send')}}",
                data:data,
                contentType:false,
                processData:false,
                success:function (data)
                {
                    $('#form-msg').append("<div class='alert alert-success'>"+ data.message
                      +"</div>"  )
                }, error: function(xhr, status, error)
                {
                    $.each(xhr.responseJSON.errors,function(key, item)
                    {
                        $('#form-msg').append("<div class='alert alert-danger'>" +item[0] + "</div>")
                    });
                }



            });
        })

    </script>
@endsection
