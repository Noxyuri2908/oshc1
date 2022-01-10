<div class="modal fade user-information" id="modal_competition_feedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{!empty($competitionFeedback)?'Update':'Add new'}} Competitor feedback {{ !empty($obj) ? $obj->name : '' }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span class="font-weight-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content-information">
                    <div class="row">
                        @if(empty($obj))
                            <div class="col-md-4 content-table fill_content">
                                <div class="form-group agent_competition_feedback_select2">
                                    <label class="control-label">Agent:</label>
                                    <select class="form-control" name="status" id="agent_competition_feedback" onmouseover="hoverToLoadSelectCompetitionFeedback()">

                                    </select>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Processing date:</label>
                                <input class="form-control" autocomplete="off" value="{{!empty($competitionFeedback)?convert_date_form_db($competitionFeedback->processing_date):''}}" name="processing_date" id="processing_date_competition_feedback" type="text" required>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Issue:</label>
                                <select class="form-control" name="issue" id="issue_competition_feedback">
                                    <option label=""></option>
                                    @foreach(config('myconfig.issue_competition_feedback_agent') as $key=>$value)
                                        <option value="{{$key}}" {{!empty($competitionFeedback) && $competitionFeedback->issue == $key ?'selected':''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-md-4 content-table fill_content">
                          <div class="form-group">
                            <label class="control-label">Person in charge:</label>
                            <select class="form-control" name="person_in_charge" id="person_in_charge_competition_feedback">
                              <option label=""></option>
                              @foreach($admins as $admin)
                                <option value="{{$admin->id}}" {{!empty($competitionFeedback) && $competitionFeedback->person_in_charge == $admin->id ?'selected':''}}>{{$admin->username}}</option>
                              @endforeach
                            </select>
                          </div>
                      </div> --}}
                        <div class="col-md-12 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Competition feedback:</label>
                                <textarea name="des" id="des_competition_feedback" class="form-control my-editor" rows="5"> {{!empty($competitionFeedback)?$competitionFeedback->competition_feedback:''}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @if(!empty($competitionFeedback))
                    @can('competitorUpdate.update')
                        <button class="btn btn-success mr-1 mb-1 btn-submit-competition-feedback-form" type="submit" data-url="{{route('agent.process.competition.feedback.update', ['agent_id'=> !empty($obj) ? $obj->id : 0, 'competition_feedback_id' =>$competitionFeedback->id])}}">Update</button>
                    @endcan
                @else
                    @can('competitorUpdate.store')
                        <button class="btn btn-success mr-1 mb-1 btn-submit-competition-feedback-form" type="submit" data-url="{{route('agent.process.competition.feedback.store', ['id'=>(!empty($obj))?$obj->id:0])}}">Save</button>
                    @endcan
                @endif
                <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    function hoverToLoadSelectCompetitionFeedback() {
        $('#agent_competition_feedback').select2({
            dropdownParent: $('.agent_competition_feedback_select2'),
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
        $('#agent_competition_feedback').append(option).trigger('change')
        @endif
    }
</script>
