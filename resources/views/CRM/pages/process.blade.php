@extends('CRM.layouts.process')

@section('title')
AGENT PROCESS
@parent
@stop

@section('css')
@include('CRM.elements.customer-process.css')
@include('CRM.partials.css-list')
<style>
  .table-div .form-control {
    height: 28px;
  }
  .table-div {
    max-width: 100%;
    position: relative;
    overflow: scroll;
    height: 32em;
    max-height: 32em;
  }

  .table-main-agent table,.table-div table {
    position: relative;
    border-collapse: collapse;
    white-space: nowrap;
    table-layout: fixed;
    width: 100%;
  }
  .table-main-agent td,
  .table-main-agent th,
  .table-div td,
  .table-div th{
    padding: 0.25em;
  }

  .top-80 {
    top: 25px;
  }

  .last-row th {
    top: 25px;
  }


  .table-main-agent thead.customer-thead .first-row th:first-child,
  .table-main-agent thead.customer-thead .last-row th:first-child {
    left: 0;
    z-index: 2;
  }
  .table-main-agent thead.customer-thead .first-row th:nth-child(2),
  .table-main-agent thead.customer-thead .last-row th:nth-child(2) {
    left: 40px;
    z-index: 3;
  }
  .table-main-agent thead.customer-thead .first-row th:nth-child(3),
  .table-main-agent thead.customer-thead .last-row th:nth-child(3) {
    left: 90px;
    z-index: 2;
  }
  .table-main-agent thead.customer-thead .first-row th:nth-child(4),
  .table-main-agent thead.customer-thead .last-row th:nth-child(4) {
    left: 190px;
    z-index: 2;
  }
  .table-main-agent thead.customer-thead .first-row th:nth-child(5),
  .table-main-agent thead.customer-thead .last-row th:nth-child(5) {
    left: 290px;
    z-index: 2;
  }
  .table-main-agent thead.customer-thead .first-row th:nth-child(6),
  .table-main-agent thead.customer-thead .last-row th:nth-child(6) {
    left: 390px;
    z-index: 2;
  }
  .table-main-agent thead.customer-thead .first-row th:nth-child(7),
  .table-main-agent thead.customer-thead .last-row th:nth-child(7) {
    left: 490px;
    z-index: 2;
  }
  .table-main-agent tbody .first-col {
    left: 0;
    z-index: 1;
    background-color: #fff;
  }
  .table-main-agent tbody .second-col {
    left: 40px;
    z-index: 1;
    background-color: #fff;
  }
  .table-main-agent tbody .third-col {
    left: 90px;
    z-index: 1;
    background-color: #fff;
  }
  .table-main-agent tbody .fourth-col {
    left: 190px;
    z-index: 1;
    background-color: #fff;
  }
  .table-main-agent tbody tr td:nth-child(5){
    left: 290px;
    z-index: 1;
    background-color: #fff;
  }
  .table-main-agent tbody tr td:nth-child(6){
    left: 390px;
    z-index: 1;
    background-color: #fff;
  }
  .table-main-agent tbody tr td:nth-child(7){
    left: 490px;
    z-index: 1;
    background-color: #fff;
  }
  .table-main-agent tbody .sticky-col{
    position: sticky;
  }

  tbody th, tbody td {
    border-bottom: 1px solid #ccc;
  }


  .text-overflow {
    text-overflow: ellipsis;
    overflow: hidden;
  }
  .white-space-pre-text{
    white-space: pre;
  }

  .bg-pale-gray {
    background-color: #eae7e7
  }

  .process-hover-dropdown:hover .dropdown-menu{
    display: block;
  }

  .title-page{
      padding-top: 20px;
  }

  .back-page{
      font-size: 1.728rem;
  }
</style>
@stop
@section('content')
    <h3 class="title-page"><a href="{{route('agent.index')}}" class="back-page">AGENT</a> / PROCESS</h3>
<div id="div_alert"></div>
<div class="row no-gutters">
  <div class="col-xl-2 pl-xl-2">
    @include('CRM.elements.info-agent')
  </div>
  <div class="col-xl-10 pl-xl-2">
    @include('CRM.elements.process.form')
  </div>
</div>
@stop
@push('scripts')
    <script>
        $(document).on('change','#is_receive_comm',function(e){
            e.preventDefault();
            if(this.checked == true){
                $('.info_bank').css('display','block');
            }else if(this.checked == false){
                $('.info_bank').css('display','none');
            }
        })
    </script>
@endpush



