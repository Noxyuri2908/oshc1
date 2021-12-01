@php
    $cover = isset($obj) ? getCoverByServiceAndPolicy($obj->provider_id, $obj->policy) : [];
@endphp
<div class="card mb-3">
    <div class="card-header">
        <div class="chevron-down-up">
            <h5 class="mb-0">Service info</h5>
            <p class="click-down" data-id="service"><span class="fas fa-chevron-down"></span></p>
        </div>
    </div>
    <div class="card-body bg-light" data-id="service">
        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="agent_id">Service country</label>
                    <select class="form-control" id="service_country" name="service_country" required>
                        <option label=""></option>
                        @foreach(config('myconfig.service_country') as $key=>$value)
                            @if(!isset($obj))
                                <option
                                    value="{{$key}}" {{request()->get('service_country') == $key ? 'selected' : ''}}>{{$value}}</option>
                            @else
                                <option
                                    value="{{$key}}" {{$obj->service_country == $key ? 'selected' : ''}}>{{$value}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="type_service">Type of service</label>
                    <select class="form-control" id="type_service" name="type_service" required>
                        <option data-country="" label=""></option>
                        @foreach($dichvus as $dichvu)
                            @if(!isset($obj))
                                <option
                                    value="{{$dichvu->id}}" {{request()->get('type_service') == $dichvu->id ? 'selected' : ''}}>{{$dichvu->name}}</option>
                            @else
                                <option
                                    value="{{$dichvu->id}}" {{$obj->type_service == $dichvu->id ? 'selected' : ''}}>{{$dichvu->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="agent_id">Type of invoice</label>
                    <select class="form-control" id="type_invoice" name="type_invoice" required>
                        <option label=""></option>
                        @foreach(config('myconfig.type_invoice') as $key=>$value)
                            @if(!isset($obj))
                                <option
                                    value="{{$key}}" {{request()->get('type_invoice') == $key ? 'selected' : ''}}>{{$value}}</option>
                            @else
                                <option
                                    value="{{$key}}" {{$obj->type_invoice == $key ? 'selected' : ''}}>{{$value}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="provider_id">Provider</label>
                    <select class="form-control" id="provider_id" name="provider_id" required>
                        @if(!empty($obj))
                            <option data-country="" label=""></option>
                            @foreach($obj->getProvidersByService() as $provider)
                                <option value="{{$provider->id}}" data-value="{{$provider->slug}}" {{$obj->provider_id == $provider->id ? 'selected' : ''}}>{{$provider->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    <small id="provider_id_div_alert" class="text-danger text-validation"></small>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="policy">Policy</label>
                    <select class="form-control" id="policy" name="policy" required>
                        <option label=""></option>
                        @foreach(config('myconfig.policy') as $key=>$value)
                            @if(!isset($obj))
                                <option value="{{$key}}" {{request()->get('policy') == $key ? 'selected' : ''}}>{{$value}}</option>
                            @else
                                <option value="{{$key}}" {{$obj->policy == $key ? 'selected' : ''}}>{{$value}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="policy">Cover</label>
                    <select class="form-control" id="cover_id" name="cover_id">
                        @if(count($cover) > 0)
                            <option value=""></option>
                            @foreach($cover as $key => $item)
                                <option value="{{$item->id}}" {{$cus->cover_id == $item->id ? 'selected' : ''}}>{{$item->cover}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="name">No of adults</label>
                    <select class="form-control" id="no_of_adults" name="no_of_adults" required>
                        @if(!empty($obj))
                            <option value=1 {{!empty($obj) && $obj->no_of_adults == 1 ? 'selected' : ''}}>1</option>
                            <option value=2 {{!empty($obj) && $obj->no_of_adults == 2 ? 'selected' : ''}}>2</option>
                        @else
                            <option value=1 {{request()->no_of_adults == 1 ? 'selected' : ''}}>1</option>
                            <option value=2 {{request()->no_of_adults == 2 ? 'selected' : ''}}>2</option>
                        @endif
                    </select>
                    <small id="adults_div_alert" class="text-danger text-validation"></small>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="name">No of children</label>
                    <select class="form-control" id="no_of_children" name="no_of_children" required>
                        @if(!empty($obj))
                            <option value=0 {{!empty($obj) && $obj->no_of_children == 0 ? 'selected' : ''}}>0</option>
                            <option value=1 {{!empty($obj) &&$obj->no_of_children == 1 ? 'selected' : ''}}>1</option>
                            <option value=2 {{!empty($obj) && $obj->no_of_children == 2 ? 'selected' : ''}}>2</option>
                            <option value=3 {{!empty($obj) && $obj->no_of_children == 3 ? 'selected' : ''}}>3</option>
                            <option value=4 {{!empty($obj) && $obj->no_of_children == 4 ? 'selected' : ''}}>4</option>
                            <option value=5 {{!empty($obj) && $obj->no_of_children == 5 ? 'selected' : ''}}>5</option>
                        @else
                            <option value=0 {{request()->no_of_children == 0 ? 'selected' : ''}}>0</option>
                            <option value=1 {{request()->no_of_children == 1 ? 'selected' : ''}}>1</option>
                            <option value=2 {{request()->no_of_children == 2 ? 'selected' : ''}}>2</option>
                            <option value=3 {{request()->no_of_children == 3 ? 'selected' : ''}}>3</option>
                            <option value=4 {{request()->no_of_children == 4 ? 'selected' : ''}}>4</option>
                            <option value=5 {{request()->no_of_children == 5 ? 'selected' : ''}}>5</option>
                        @endif
                    </select>
                    <small id="childs_div_alert" class="text-danger text-validation"></small>

                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="type_visa">Type of visa</label>
                    <select class="form-control" id="type_visa" name="type_visa">
                        <option label=""></option>
                        @foreach(config('myconfig.type_visa') as $key=>$value)
                            @if(!isset($obj))
                                <option
                                    value="{{$key}}" {{request()->get('type_visa') == $key ? 'selected' : ''}}>{{$value}}</option>
                            @else
                                <option
                                    value="{{$key}}" {{$obj->type_visa == $key ? 'selected' : ''}}>{{$value}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="start_date">Start date</label>
                    <input class="form-control open-jquery-date" id="start_date" name="start_date"
                           value="{{isset($obj) ? convert_date_form_db($obj->start_date) : old('start_date')}}" type="text"
                           data-options='{"dateFormat":"d/m/Y"}' autocomplete="off">
                    <small id="start_date_div_alert" class="text-danger text-validation"></small>

                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="start_date">End date</label>
                    <input class="form-control open-jquery-date" id="end_date" name="end_date"
                           value="{{isset($obj) ? convert_date_form_db($obj->end_date) : old('end_date')}}" type="text"
                           data-options='{"dateFormat":"d/m/Y"}' autocomplete="off">
                    <small id="end_date_div_alert" class="text-danger text-validation"></small>
                </div>
            </div>
            <div class="col-lg-2">
                <label for="net_amount">Gross amount ($)</label>
                <div class="input-group mb-3">
                    <input class="form-control" id="net_amount" name="net_amount"
                           value="{{isset($obj) ? $obj->net_amount : 0}}" type="text" step="0.01">
                    <div class="input-group-append">
                        <span class="input-group-text">{{!empty($obj->provider) ? $obj->provider->currency() : ''}}</span></div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option label=""></option>
                        @foreach(config('myconfig.status_invoice') as $key=>$value)
                            @if(!isset($obj))
                                <option value="{{$key}}" {{old('status') == $key ? 'selected' : ''}}>{{$value}}</option>
                            @else
                                <option value="{{$key}}" {{$obj->status == $key ? 'selected' : ''}}>{{$value}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <label for="">Days</label>
                <input type="text" class="form-control" id="count_days" value="{{!empty($obj)?$obj->getCountDay():''}}" name="count_day" readonly>
            </div>
            <div class="col-lg-3">
                <label for="">Months</label>
                <input type="text" class="form-control" id="count_months" name="count_month" value="{{!empty($obj)?count(convertDateRangeToMonth($obj->start_date,$obj->end_date)):''}}" readonly>
            </div>
            <div class="col-lg-3">
                <label for="">Ref No</label>
                <input type="text" class="form-control" id="ref_no" name="ref_no" value="{{($flag == 'edit' && $obj->ref_no) ? $obj->ref_no : ''}}">
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="form-group">
                            <label for="ref_no">Note</label>
                            <textarea class="form-control" id="note" name="note"
                                      rows="3">{{isset($obj) ? decode_html($obj->note) : decode_html(old('note'))}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="">Staff</label>
                            <select class="form-control" name="staff_id" id="">
                                <option value="">Select</option>
                                @foreach($staffs as $staff)
                                    @if(!empty($obj))
                                        <option value="{{$staff->id}}" {{!empty($obj) && $obj->staff_id == $staff->id ? 'selected':''}}>{{$staff->admin_id}}</option>
                                    @else
                                        <option value="{{$staff->id}}" {{\Illuminate\Support\Facades\Auth::user()->id == $staff->id ? 'selected':''}}>{{$staff->admin_id}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <button id="quote-price" class="btn btn-primary">Quote price</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function (){
            @if(request()->get('type_invoice'))
                $('#type_invoice').val('2');
            @endif

            @if(request()->get('type_service'))
                callProvider({{request()->get('type_service')}});
            @endif
        })

        $(document).on('change', '#type_service', function (e) {
            e.preventDefault();
            let dataId = this.value
            callProvider(dataId);
        })
        $(document).on('change','#start_date, #end_date',function(e){
            let startDate = $('#start_date').val();
            let endDate = $('#end_date').val();
            if(startDate && endDate){
                startDate = new Date(convertDate(startDate));
                endDate = new Date(convertDate(endDate));
                let Difference_In_Time = endDate.getTime() - startDate.getTime();
                let Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24) +1;
                let Difference_In_Months;
                Difference_In_Months = (endDate.getFullYear() - startDate.getFullYear()) * 12;
                Difference_In_Months -= startDate.getMonth();
                Difference_In_Months += endDate.getMonth();
                $('#count_days').val(Difference_In_Days);
                $('#count_months').val(Difference_In_Months);
            }
        })
        function convertDate(date) {
            let arr = date.split('/');
            let day = arr[0];
            let month = arr[1];
            let year = arr[2];
            return year+'-'+month+'-'+day;
        }

        function callProvider(dataId){
            $.get('{{route('ajax.customer.getProvider')}}', { provider_id: dataId }, function (data) {
                let html = '<option value=""></option>'
                $.each(data, function (index, value) {
                    html += '<option value="' + value.id + '" data-value="' + value.slug + '" >' + value.name + '</option>'
                })
                $('#provider_id').html(html)
            })
        }

        $('#policy, #provider_id').on('change', function (){
            var service = $('#provider_id').val();
            var policy = $('#policy').val();

            $.ajax({
                url : '{{route('getCoverByServiceAndPolicy')}}',
                type : 'POST',
                data : {
                    _token: "{{ csrf_token() }}",
                    service,
                    policy
                },
                success : function (data){
                    if (data.error) {
                        removeElementChildCover();
                        alert(data.message);
                        return;
                    }

                    var html = '<option label=""></option>';
                    data.result.map(function (obj){
                        html += `<option label="" data-id="${obj.id}">${obj.cover}</option>`;
                    });
                    $('#cover_id').html(html);
                }
            });
        });

        function removeElementChildCover()
        {
            $('#cover_id').html('');
        }

    </script>
@endpush
