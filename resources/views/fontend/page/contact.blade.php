@extends('fontend.layouts.master')
@section('content')
<section id="qa-page">
	<div class="container">
		<div class="header-page">
			<div class="title-section">
				Contact us
			</div>
			<div class="buge">...</div>
			<div class="cnt-contact">
				<div class="col-md-6">
					<div class="office">
						<ul class="info">
							<li class="address"><i class="fa fa-map-marker"></i> OSHCGLOBAL</li>
                            <li class="address"><i class="fa fa-map-marker"></i> ABN: 26 609 001 185</li>
                            <li class="address"><i class="fa fa-map-marker"></i> Email: info@oshcglobal.com</li>
                        </ul>
						<div class="logo-contact my-4">
							<img src="{{$logo_company->image}}">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<form method="post" class="apart" action="">
						<div class="name row">
							<label for="name" class="fa fa-user"></label>
							<input id="name" name="yourname" type="text" placeholder="Your name: *">
						</div>
						<div class="email row">
							<label for="email" class="fa fa-envelope"></label>
							<input id="email" name="email" type="text" placeholder="Email: *">
						</div>
						<div class="phone row">
							<label for="tel" class="fa fa-phone"></label>
							<input id="tel" name="tel" type="text" placeholder="Tel: ">
						</div>
						<div class="subject row">
							<label for="subject" class="fa fa-check"></label>
							<input id="subject" name="subject" type="text" placeholder="Subject: *">
						</div>
						<div class="request row">
							<label for="comments" class="fa fa-newspaper-o"></label>
							<textarea id="comments" placeholder="Comments: *" name="comments"></textarea>
						</div>
						<input type="submit" value="Send" class="sub_inp" name="submitted">
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection
