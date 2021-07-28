<div class="modal fade user-information" id="modal_exchange_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{(!empty($obj))?'Edit exchange rate':'Add new exchange rate'}}</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="{{(!empty($obj))?route('exchange-rate.update',['id'=>$obj->id]):route('exchange-rate.store')}}" method="POST">
        @csrf
        @if(!empty($obj))
        <input type="hidden" name="_method" value="PUT">
        @endif
        <div class="modal-body">
          <div class="content-information">
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="row">
                <div class="col-md-3 content-table fill_content">
                    <div class="form-group">
                        <label class="control-label">Type:</label>
                        <select class="form-control" id="type" name="type">
                            {{-- <option label=""></option> --}}
                            @foreach(config('myconfig.type_exchange') as $key=>$value)
                            <option value="{{$key}}" {{(!empty($obj) && $obj->type == $key)?'selected':''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3 content-table fill_content month_form">
                    <div class="form-group">
                    <label class="control-label">Month:</label>
                    <select class="form-control" name="month">
                        <option label=""></option>
                        @foreach(config('date-time.month') as $key=>$value)
                        <option value="{{$key}}" {{(!empty($obj) && $obj->month == $key)?'selected':''}}>{{$value}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="col-md-3 content-table fill_content">
                    <div class="form-group">
                    <div class="form-group">
                    <label class="control-label">Year:</label>
                    <select class="form-control" name="year">
                        <option label=""></option>
                        @foreach(config('date-time.year') as $key=>$value)
                        <option value="{{$key}}" {{(!empty($obj) && $obj->year == $key)?'selected':''}}>{{$value}}</option>
                        @endforeach
                    </select>
                    </div>
                    </div>
                </div>
                <div class="col-md-3 content-table fill_content unit_form">
                    <div class="form-group">
                    <label class="control-label">Unit:</label>
                    <select class="form-control" name="unit">
                        <option label=""></option>
                        @foreach(config('myconfig.currency') as $key=>$value)
                        <option value="{{$key}}" {{(!empty($obj) && $obj->unit == $key)?'selected':''}}>{{$value}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>

                <div class="col-md-6 content-table fill_content exchange_rate_form">
                    <div class="form-group">
                    <label class="control-label">Exchange Rate:</label>
                    <input type="number" id="rate" name="rate" class="form-control" placeholder="" value="{{(!empty($obj))?$obj->rate:''}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 quarter_form" style="display: none">
                    <label for="">Quarter</label>
                    <select name="quarter_id" class="form-control" id="">
                        @foreach(\Config::get('myconfig.quarter') as $key=>$value)
                            <option value="{{$key}}" {{(!empty($obj) && $obj->quarter_id == $key)?'selected':''}}>{{$value['name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 unit_to_aud_form" style="display: none">
                    <label for="">Unit to AUD</label>
                    <input class="form-control" type="text" id="unit_to_aud" name="unit_to_aud" value="{{(!empty($obj))?$obj->unit_to_aud:''}}">
                </div>
                <div class="col-md-4 aud_to_vnd_form" style="display: none">
                    <label for="">AUD to VND</label>
                    <input class="form-control" type="text" id="aud_to_vnd" name="aud_to_vnd" value="{{(!empty($obj))?$obj->aud_to_vnd:''}}">
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-success mr-1 mb-1" type="submit">{{!empty($obj)?'Update':'Add'}}</button>
          <button class="btn btn-info mr-1 mb-1" type="reset">Reset</button>
          <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>

    @if(!empty($obj) && $obj->type == 8)
        $('.unit_form').show();
        $('.month_form').hide();
        $('.exchange_rate_form').hide();
        $('.quarter_form').show();
        $('.unit_to_aud_form').show();
        $('.aud_to_vnd_form').hide();
    @elseif(!empty($obj) && $obj->type == 9)
        $('.unit_form').hide();
        $('.month_form').hide();
        $('.exchange_rate_form').hide();
        $('.quarter_form').show();
        $('.unit_to_aud_form').hide();
        $('.aud_to_vnd_form').show();
    @else
        $('.unit_form').show();
        $('.quarter_form').hide();
        $('.unit_to_aud_form').hide();
        $('.aud_to_vnd_form').hide();
        $('.month_form').show();
        $('.exchange_rate_form').show();
    @endif
</script>
