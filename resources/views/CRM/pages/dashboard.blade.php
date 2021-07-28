@extends('CRM.layouts.default')

@section('title')
DASHBOARD
@parent
@stop

@section('css')
@include('CRM.partials.css')
@stop

@section('content')
<div class="card-deck">
  <div class="card mb-3" style="min-width: 12rem">
    <div class="bg-holder bg-card">
    </div>
    <!--/.bg-holder-->

    <div class="card-body position-relative">
      <h6>AGENT ACTIVE<span class="badge badge-soft-warning rounded-capsule ml-2"></span></h6>
      <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-warning" data-countupp='{"count":{{$active_agent}},"format":"alphanumeric"}'>{{$active_agent}}</div><a class="font-weight-semi-bold fs--1 text-nowrap" href="#">List agent active<span class="fas fa-angle-right ml-1" data-fa-transform="down-1"></span></a>
    </div>
  </div>
  <div class="card mb-3" style="min-width: 12rem">
    <div class="bg-holder bg-card">
    </div>
    <!--/.bg-holder-->

    <div class="card-body position-relative">
      <h6>AGENT DE-ACTIVE<span class="badge badge-soft-warning rounded-capsule ml-2"></span></h6>
      <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-warning" data-countupp='{"count":{{$deactive_agent}},"format":"alphanumeric"}'>{{$deactive_agent}}</div><a class="font-weight-semi-bold fs--1 text-nowrap" href="#">List agent de-active<span class="fas fa-angle-right ml-1" data-fa-transform="down-1"></span></a>
    </div>
  </div>
  <div class="card mb-3" style="min-width: 12rem">
    <div class="bg-holder bg-card">
    </div>
    <!--/.bg-holder-->

    <div class="card-body position-relative">
      <h6>APPLIES PENDING<span class="badge badge-soft-success rounded-capsule ml-2"></span></h6>
      <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif" data-countup='{"count":{{$pending_applies}},"format":"comma","prefix":""}'>{{$pending_applies}}</div><a class="font-weight-semi-bold fs--1 text-nowrap" href="#">List applies pending<span class="fas fa-angle-right ml-1" data-fa-transform="down-1"></span></a>
    </div>
  </div>
</div>
<div class="card-deck">
  <div class="card mb-3" style="min-width: 12rem">
    <div class="bg-holder bg-card">
    </div>
    <!--/.bg-holder-->

    <div class="card-body position-relative">
      <h6>APPLIES RUNNING<span class="badge badge-soft-warning rounded-capsule ml-2"></span></h6>
      <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-warning" data-countupp='{"count":{{$running_applies}},"format":"alphanumeric"}'>{{$running_applies}}</div><a class="font-weight-semi-bold fs--1 text-nowrap" href="#">List applies running<span class="fas fa-angle-right ml-1" data-fa-transform="down-1"></span></a>
    </div>
  </div>
  <div class="card mb-3" style="min-width: 12rem">
    <div class="bg-holder bg-card">
    </div>
    <!--/.bg-holder-->

    <div class="card-body position-relative">
      <h6>APPLIES REJECT<span class="badge badge-soft-warning rounded-capsule ml-2"></span></h6>
      <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-warning" data-countupp='{"count":{{$reject_applies}},"format":"alphanumeric"}'>{{$reject_applies}}</div><a class="font-weight-semi-bold fs--1 text-nowrap" href="#">List applies reject<span class="fas fa-angle-right ml-1" data-fa-transform="down-1"></span></a>
    </div>
  </div>
  <div class="card mb-3" style="min-width: 12rem">
    <div class="bg-holder bg-card">
    </div>
    <!--/.bg-holder-->

    <div class="card-body position-relative">
      <h6>APPLIES INCOMPLETE<span class="badge badge-soft-success rounded-capsule ml-2"></span></h6>
      <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif" data-countup='{"count":{{$incom_applies}},"format":"comma","prefix":""}'>{{$incom_applies}}</div><a class="font-weight-semi-bold fs--1 text-nowrap" href="#">List applies incomplete<span class="fas fa-angle-right ml-1" data-fa-transform="down-1"></span></a>
    </div>
  </div>
</div>
{{--@include('CRM.elements.dashboard.modal-department')--}}
@stop


@section('js')
<script type="text/javascript">
$('#modal_department').modal('toggle');
</script>
@stop
