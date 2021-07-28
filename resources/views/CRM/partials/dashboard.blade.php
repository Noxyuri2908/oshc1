<div class="card-deck">
  <div class="card mb-3" style="min-width: 12rem">
    <div class="bg-holder bg-card">
    </div>
    <!--/.bg-holder-->

    <div class="card-body position-relative">
      <h6>Học viên chính quy<span class="badge badge-soft-warning rounded-capsule ml-2"></span></h6>
      <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-warning" data-countupp='{"count":58386,"format":"alphanumeric"}'>{{$num_1}}</div><a class="font-weight-semi-bold fs--1 text-nowrap" href="{{route('chinh-quy.index')}}">CRM chính quy<span class="fas fa-angle-right ml-1" data-fa-transform="down-1"></span></a>
    </div>
  </div>
  <div class="card mb-3" style="min-width: 12rem">
    <div class="bg-holder bg-card">
    </div>
    <!--/.bg-holder-->

    <div class="card-body position-relative">
      <h6>Học viên liên thông<span class="badge badge-soft-success rounded-capsule ml-2"></span></h6>
      <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif" data-countup='{"count":{{$num_2}},"format":"comma","prefix":""}'>{{$num_2}}</div><a class="font-weight-semi-bold fs--1 text-nowrap" href="{{route('lien-thong.index')}}">CRM liên thông<span class="fas fa-angle-right ml-1" data-fa-transform="down-1"></span></a>
    </div>
  </div>
  <div class="card mb-3" style="min-width: 12rem">
    <div class="bg-holder bg-card">
    </div>
    <!--/.bg-holder-->

    <div class="card-body position-relative">
      <h6>Học viên cập nhật dược<span class="badge badge-soft-success rounded-capsule ml-2"></span></h6>
      <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif" data-countup='{"count":{{$num_3}},"format":"comma","prefix":""}'>{{$num_3}}</div><a class="font-weight-semi-bold fs--1 text-nowrap" href="{{route('cap-nhat-duoc.index')}}">CRM cập nhật dược<span class="fas fa-angle-right ml-1" data-fa-transform="down-1"></span></a>
    </div>
  </div>
</div>

<div class="card-deck">
  <div class="card mb-3" style="min-width: 12rem">
    <div class="bg-holder bg-card">
    </div>
    <!--/.bg-holder-->

    <div class="card-body position-relative">
      <h6>Đối tác<span class="badge badge-soft-warning rounded-capsule ml-2"></span></h6>
      <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-warning" data-countupp='{"count":{{$num_4}},"format":"alphanumeric"}'>{{$num_4}}</div><a class="font-weight-semi-bold fs--1 text-nowrap" href="{{route('doitac.index')}}">Chi tiết<span class="fas fa-angle-right ml-1" data-fa-transform="down-1"></span></a>
    </div>
  </div>
  <div class="card mb-3" style="min-width: 12rem">
    <div class="bg-holder bg-card">
    </div>
    <!--/.bg-holder-->

    <div class="card-body position-relative">
      <h6>Chăm sóc viên<span class="badge badge-soft-success rounded-capsule ml-2"></span></h6>
      <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif" data-countup='{"count":{{$num_5}},"format":"comma","prefix":""}'>{{$num_5}}</div><a class="font-weight-semi-bold fs--1 text-nowrap" href="{{route('user.index')}}">Chi tiết<span class="fas fa-angle-right ml-1" data-fa-transform="down-1"></span></a>
    </div>
  </div>
  <div class="card mb-3" style="min-width: 12rem">
    <div class="bg-holder bg-card">
    </div>
    <!--/.bg-holder-->

    <div class="card-body position-relative">
      <h6>Marketing<span class="badge badge-soft-success rounded-capsule ml-2"></span></h6>
      <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif" data-countup='{"count":{{$num_6}},"format":"comma","prefix":""}'>{{$num_6}}</div><a class="font-weight-semi-bold fs--1 text-nowrap" href="{{route('user.index')}}">Chi tiết<span class="fas fa-angle-right ml-1" data-fa-transform="down-1"></span></a>
    </div>
  </div>
</div>