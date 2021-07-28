<div class="modal fade user-information" id="modal_market_feedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{!empty($marketFeedback)?'Update':'Add new'}} market feedback</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span class="font-weight-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content-information">
                    <div class="row">
                        @if(empty($obj))
                            <div class="col-md-4 content-table fill_content">
                                <div class="form-group agent_market_feedback_select2">
                                    <label class="control-label">Agent:</label>
                                    <select class="form-control" name="status" id="agent_market_feedback" onmouseover="hoverToLoadSelectMarketFeedback()">
                                        {{--<option label=""></option>--}}
                                        {{--@foreach($agents as $key=>$value)--}}
                                        {{--    <option value="{{$key}}" {{!empty($follow) && $follow->user_id == $key ?'selected':''}}>{{$value}}</option>--}}
                                        {{--@endforeach--}}
                                    </select>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Processing date:</label>
                                <input class="form-control" autocomplete="off" value="{{!empty($marketFeedback)?convert_date_form_db($marketFeedback->processing_date):''}}" name="processing_date" id="processing_date_market_feedback" type="text" required>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Issue:</label>
                                <select class="form-control" name="issue" id="issue_market_feedback">
                                    <option label=""></option>
                                    @foreach(config('myconfig.issue_market_feedback_agent') as $key=>$value)
                                        <option value="{{$key}}" {{!empty($marketFeedback) && $marketFeedback->issue == $key ?'selected':''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Person in charge:</label>
                                <select class="form-control" name="person_in_charge" id="person_in_charge_market_feedback">
                                    <option label=""></option>
                                    @foreach($admins as $keyAdmin=>$valueAdmin)
                                        <option value="{{$keyAdmin}}"

                                                @if(!empty($marketFeedback) && $marketFeedback->person_in_charge == $keyAdmin)
                                                selected
                                                @elseif(empty($marketFeedback) && \Illuminate\Support\Facades\Auth::user()->id == $keyAdmin)
                                                selected
                                            @endif
                                        >{{$valueAdmin}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Market feedback:</label>
                                <textarea name="des" id="des_market_feedback" class="form-control my-editor" rows="5"> {{!empty($marketFeedback)?$marketFeedback->market_feedback:''}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success mr-1 mb-1 btn-submit-market-feedback-form" type="submit" data-url="{{!empty($marketFeedback)?route('agent.process.market.feedback.update', ['agent_id'=>$obj->id, 'market_feedback_id' =>$marketFeedback->id]):route('agent.process.market.feedback.store', ['id'=>(!empty($obj))?$obj->id:0])}}">{{!empty($marketFeedback)?'Update':'Save'}}</button>
                <button class="btn btn-info mr-1 mb-1" type="reset">Reset</button>
                <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    <script>
        function hoverToLoadSelectMarketFeedback(){
            $('#agent_market_feedback').select2({
                dropdownParent: $('.agent_market_feedback_select2'),
                ajax: {
                    url: '{{route('agent.getAgentSelect')}}',
                    type: 'GET',
                    quietMillis: 10000,
                    dataType: 'json',
                    data: function (term) {
                        var query = {
                            name: term.term,
                        }
                        return query
                    },
                    processResults: function (data) {
                        // Transforms the top-level key of the response object from 'items' to 'results'

                        var results = []
                        data.forEach(e => {
                            results.push({
                                id: e.id,
                                text: e.name,
                            })
                        })
                        return {
                            results: results,
                        }
                    },
                },
            })
                @if(!empty($obj))
            var option = new Option('{{$obj->name}}', '{{$obj->id}}', true, true)
            $('#agent_market_feedback').append(option).trigger('change')
            @endif
        }
    </script>
