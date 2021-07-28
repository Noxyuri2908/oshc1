<div>
    <h3 style="clear: both;
    display: block;
    float: left;
    width: 100%;
    padding: 15px;
    box-sizing: border-box;
    margin: 0px;
    margin-top: 20px;"> Personal Details</h3>
</div>
@foreach($arrayData['info'] as $key=>$one)
    <div>
        <label style="display: inline-block;
        width: 180px;
        margin-right: 10px;
        text-align: right;">{{(!empty(\Config::get('myconfig.lang_service_form')[$key]))?\Config::get('myconfig.lang_service_form')[$key]:''}}:</label>
        <span style="display: inline-block;
        border: 1px solid rgb(221,221,221);
        padding: 5px;
        border-radius: 5px;
        width: calc(100% - 220px);">{{$one}}</span>
    </div>
@endforeach
<div>
    <h3 style="clear: both;
    display: block;
    float: left;
    width: 100%;
    padding: 15px;
    box-sizing: border-box;
    margin: 0px;
    margin-top: 20px;">Request</h3>
</div>
@foreach($arrayData['request'] as $key=>$one)
    @if(is_array($one))
        @foreach($one as $subOne)
            <div>
                <label style="display: inline-block;
                width: 180px;
                margin-right: 10px;
                text-align: right;">{{(!empty(\Config::get('myconfig.lang_service_form')[$key]))?\Config::get('myconfig.lang_service_form')[$key]:''}}:</label>
                <span style="display: inline-block;
                border: 1px solid rgb(221,221,221);
                padding: 5px;
                border-radius: 5px;
                width: calc(100% - 220px);">{{$subOne}}</span>
            </div>
        @endforeach
    @else
        <div>
            <label style="display: inline-block;
            width: 180px;
            margin-right: 10px;
            text-align: right;">{{(!empty(\Config::get('myconfig.lang_service_form')[$key]))?\Config::get('myconfig.lang_service_form')[$key]:''}}:</label>
            <span style="display: inline-block;
            border: 1px solid rgb(221,221,221);
            padding: 5px;
            border-radius: 5px;
            width: calc(100% - 220px);">{{$one}}</span>
        </div>
    @endif
@endforeach
