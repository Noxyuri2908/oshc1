@extends('fontend.layouts.master')
@section('title')
Special offer
@endsection
@section('content')
<section id="qa-page">
	<div class="container">
		<div class="header-page">
			<div class="title-section">
                Special offer
            </div>
			<div class="buge">...</div>
			<div class="cnt-contact cnt-special mb-5 d-flex">
				<div class="col-md-6">
					<div class="office">
						<ul class="info">
							<li class="address"><i class="fa fa-map-marker"></i> OSHCGLOBAL</li>
                            <li class="address"><i class="fa fa-map-marker"></i> ABN: 26 609 001 185</li>
                            <li class="address"><i class="fa fa-map-marker"></i> Email: info@oshcglobal.com</li>

                        </ul>
						<div class="logo-contact my-4">
							<img src="{{!empty($logo_company)?$logo_company->image:''}}">
						</div>
					</div>
				</div>
				<div class="col-md-6">

                    <form method="post" class="apart"  action="{{route('special-offer.send-mail')}}">
                        <h1 class="title" style="font-size:25px;">Register to have a special offer</h1>
                        @csrf
						<div class="name row">
							<label for="name" class="fa fa-user"></label>
							<input id="name" name="full_name" type="text" placeholder="Your name: *" required>
						</div>
						<div class="email row">
							<label for="email" class="fa fa-envelope"></label>
							<input id="email" name="email" type="text" placeholder="Email: *" required>
						</div>
						<div class="phone row">
							<label for="tel" class="fa fa-phone"></label>
							<input id="tel" name="tel" type="text" placeholder="Tel: " required>
						</div>
						<input type="submit" value="Send" class="btn btn-block btn-primary mt-2" name="submitted">
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection
@push('scripts')
@if(\Session::has('success'))
<script>
    Swal.fire({
        title:'Your request has been successfully submitted.',
        html:'We will process it soon and respond via email. Thank you!',
        width: 800,
    })
</script>
@endif
@endpush
