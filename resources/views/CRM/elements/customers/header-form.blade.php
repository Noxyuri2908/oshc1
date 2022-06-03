@if (!isset($obj))
<div class="row">
    <div class="col-12">
      <div class="card mb-3 btn-reveal-trigger">
        <div class="card-header position-relative minh-25vh mb-8">
          <div class="cover-image">
            <div class="bg-holder rounded-soft rounded-bottom-0" style="background-image:url({{asset('backend_CRM/pages/assets/img/slider1.jpg')}});">
            </div>
          </div>
          <div class="avatar avatar-5xl avatar-profile shadow-sm img-thumbnail rounded-circle">
            <div class="h-100 w-100 rounded-circle overflow-hidden position-relative"> <img src="{{asset('backend_CRM/pages/assets/img/new.png')}}" width="200" alt="">
            </div>
          </div>
          <div class="thong-tin-user">
            <div class="offset-md-2 col-md-10 offset-lg-2 col-lg-10 offset-sm-3 col-sm-9 offset-xs-4 col-xs-8">
                <h2>New invoice</h2>
                <p><i>Create new invoice</i></p>
            </div>
            <div class="offset-md-10 col-md-10 offset-lg-2 col-lg-10 offset-sm-3 col-sm-9 offset-xs-4 col-xs-8 dang-ky-new">
              <button type="submit" class="dang-ky-submit">Submit</button>
            <a href="{{route('customer.index',['page'=>(!empty(request()->get('page'))?request()->get('page'):1)])}}" class="text-decoration-none dang-ky-restart" >Close</a>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@else

<div class="row">
    <div class="col-12">
      <div class="card mb-3 btn-reveal-trigger">
        <div class="card-header position-relative minh-25vh mb-8">
          <div class="cover-image">
            <div class="bg-holder rounded-soft rounded-bottom-0" style="background-image:url({{asset('backend_CRM/pages/assets/img/slider1.jpg')}});">
            </div>
          </div>
          <div class="avatar avatar-5xl avatar-profile shadow-sm img-thumbnail rounded-circle">
            <div class="h-100 w-100 rounded-circle overflow-hidden position-relative"> <img src="{{asset('backend_CRM/pages/assets/img/new.png')}}" width="200" alt="">
            </div>
          </div>
          <div class="thong-tin-user">
            <div class="offset-md-2 col-md-10 offset-lg-2 col-lg-10 offset-sm-3 col-sm-9 offset-xs-4 col-xs-8">
                <h2>Edit invoice</h2>
            </div>
            <div class="offset-md-10 col-md-10 offset-lg-2 col-lg-10 offset-sm-3 col-sm-9 offset-xs-4 col-xs-8 dang-ky-new">
              <button type="submit" class="dang-ky-submit">Update</button>
              <a href="{{route('customer.index',['page'=>(!empty(request()->get('page'))?request()->get('page'):1)])}}" class="text-decoration-none dang-ky-restart" >Close</a>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endif
