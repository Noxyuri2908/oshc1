@extends('CRM.layouts.default')

@section('title')
    Config Luckydraw
    @parent
@stop

@section('css')
    @include('CRM.partials.css-list')
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{!empty($lucky)?route('lucky_draw.update',['id'=>$lucky->id]):route('lucky_draw.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Bias</label>
                    <textarea name="arr_bias_number" id="" cols="30" rows="10" class="form-control">{{!empty($lucky)?str_replace("<br />",'',nl2br($textValue))  :''}}</textarea>

                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

    </div>
@endsection
