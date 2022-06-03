<div class="card mb-3">
    <div class="contenr-header">
        <div class="card-header tab-form-bt">
            <input type="hidden" id="_id" value="{{!empty($obj) ? $obj->id : ''}}">
            <div class="row">
                <div class="col-12">
                    {{--<div class="group-checkbox">--}}
                    {{--  <div class="row">--}}
                    {{--    @foreach(config('admin.status') as $key=>$value)--}}
                    {{--    <div class="col-sm-6 col-md-3 checkboxs">--}}
                    {{--      <div class="form-group">--}}
                    {{--        <input type="radio" class="c_status" id="agent_status" name="agent_status" value="{{$key}}" >--}}
                    {{--        <label for="">{{$value}}</label>--}}
                    {{--      </div>--}}
                    {{--    </div>--}}
                    {{--    @endforeach--}}
                    {{--  </div>--}}
                    {{--</div>--}}
                    @if(session('error-agent-process'))
                        <div class="alert alert-danger">
                            <strong>{{session('error-agent-process')}}</strong>
                        </div>
                    @endif
                    @if(session('success-agent-process'))
                        <div class="alert alert-success">
                            <strong>{{session('success-agent-process')}}</strong>
                        </div>
                    @endif
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="follow-ups-tab" data-toggle="tab" href="#follow-ups"
                               role="tab"
                               aria-controls="follow-ups" aria-selected="true">
                                Follow ups
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="appointment-tab" data-toggle="tab" href="#appointment" role="tab"
                               aria-controls="appointment" aria-selected="false">
                                Appointment & Visit Agent
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="market-feedback-tab" data-toggle="tab" href="#market-feedback"
                               role="tab"
                               aria-controls="market-feedback" aria-selected="false">
                                Agent feedback
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="competition-feedback-tab" data-toggle="tab"
                               href="#competition-feedback"
                               role="tab" aria-controls="competition-feedback" aria-selected="false">
                                Competitor update
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="marketing-support-tab" data-toggle="tab" href="#marketing-support"
                               role="tab"
                               aria-controls="marketing-support" aria-selected="false">
                                Marketing support
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="proposal-tab" data-toggle="tab" href="#proposal" role="tab"
                               aria-controls="proposal" aria-selected="false">
                                Proposal
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                               aria-controls="contact" aria-selected="false">
                                Contact
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="follow-ups" role="tabpanel"
                             aria-labelledby="follow-ups-tab">
                            <div class="d-flex justify-content-between mt-2" style="justify-content: flex-end !important;">

                                <div class="d-flex" style="justify-content: center;align-items: center;">
                                    <a href="#" class="btn btn-link" is-click='false'
                                       id='delete_all_follow_ups_fillter' style="margin-right: 10px">
                                        Clear filter</a>
                                    <a href="#" class="btn btn btn-link" is-click='false' id='btn_add_new_follow'>
                                <span>
                                    <i class="fal fa-plus"></i>
                                </span>
                                        Add
                                    </a>
                                </div>

                            </div>
                            <div id="follow-ups-table" class="mt-3">
                                @include('CRM.elements.task.sale.table.follow-up-agent',['agent_id'=>$agent_id])
                            </div>
                        </div>
                        <div class="tab-pane fade" id="appointment" role="tabpanel" aria-labelledby="appointment-tab">

                            <div class="d-flex justify-content-between mt-2" style="justify-content: flex-end !important;">

                                <div class="d-flex" style="justify-content: center;align-items: center;">
                                    <a href="#" class="btn btn-link" is-click='false'
                                       id='delete_all_appointment_fillter' style="color: black">Clear
                                        filter</a>
                                    <a href="{{route('event.create',['submit_form'=>'task_sale'])}}" class="btn btn btn-link" is-click='false' id='btn_add_new_appointment'
                                       style="color: black; padding-bottom: 0">
                                <span>
                                    <i class="fal fa-plus"></i>
                                </span>
                                        Add
                                    </a>
                                </div>

                            </div>
                            <div id="appointment-table" class="mt-3">
                                @include('CRM.elements.task.sale.table.appointment',['agent_id'=>$agent_id])
                            </div>
                        </div>
                        <div class="tab-pane fade" id="market-feedback" role="tabpanel"
                             aria-labelledby="market-feedback-tab">

                            <div class="d-flex justify-content-between mt-2" style="justify-content: flex-end !important;">

                                <div class="d-flex" style="justify-content: center;align-items: center;">
                                    <a href="#" class="btn btn-link" is-click='false'
                                       id='delete_all_market_feedback_fillter' style="color: black">Clear
                                        filter</a>
                                    <a href="#" class="btn btn btn-link" is-click='false' id='btn_add_new_market_feedback'
                                       style="color: black; padding-bottom: 0">
                                <span>
                                    <i class="fal fa-plus"></i>
                                </span>
                                        Add
                                    </a>
                                </div>

                            </div>

                            <div id="market-feedback-table" class="mt-3">
                                @include('CRM.elements.task.sale.table.market-feedback-agent',['agent_id'=>$agent_id])
                            </div>
                        </div>
                        <div class="tab-pane fade" id="competition-feedback" role="tabpanel"
                             aria-labelledby="competition-feedback-tab">

                            <div class="d-flex justify-content-between mt-2" style="justify-content: flex-end !important;">

                                <div class="d-flex" style="justify-content: center;align-items: center;">
                                    <a href="#" class="btn btn-link" is-click='false'
                                       id='delete_all_competitor_feedback_fillter' style="color: black">Clear
                                        filter</a>
                                    <a href="#" class="btn btn btn-link" is-click='false' id='btn_add_new_competition_feedback'
                                       style="color: black; padding-bottom: 0">
                                <span>
                                    <i class="fal fa-plus"></i>
                                </span>
                                        Add
                                    </a>
                                </div>

                            </div>

                            <div id="competition-feedback-table" class="mt-3">
                                @include('CRM.elements.task.sale.table.competitor-feedback-agent',['agent_id'=>$agent_id])
                            </div>
                        </div>
                        @foreach($typeSaleTask as $key=>$type)
                            <div class="tab-pane fade" id="marketing-support" role="tabpanel"
                                 aria-labelledby="marketing-support-tab">

                                <div class="d-flex justify-content-between mt-2" style="justify-content: flex-end !important;">

                                    <div class="d-flex" style="justify-content: center;align-items: center;">
                                        <a href="#" class="btn btn-link" is-click='false'
                                           id='delete_all_{{$type}}_fillter' style="color: black">Clear
                                            filter</a>
                                        <a href="#" class="btn btn btn-link" is-click='false' id='create_{{$type}}_sale'
                                           style="color: black; padding-bottom: 0">
                                <span>
                                    <i class="fal fa-plus"></i>
                                </span>
                                            Add
                                        </a>
                                    </div>

                                </div>

                                <div id="marketing-support-table" class="mt-3">
                                    @include('CRM.elements.task.sale.table.sale_task_assign',['typeTask'=>$type,'typeTask_id'=>$key,'agent_id'=>$agent_id])
                                </div>
                            </div>
                        @endforeach
                        <div class="tab-pane fade" id="proposal" role="tabpanel" aria-labelledby="proposal-tab">

                            <div class="d-flex justify-content-between mt-2" style="justify-content: flex-end !important;">

                                <div class="d-flex" style="justify-content: center;align-items: center;">
                                    <a href="#" class="btn btn-link" is-click='false'
                                       id='delete_all_proposal_fillter' style="color: black">Clear
                                        filter</a>
                                    <a href="#" class="btn btn btn-link" is-click='false' id='btn_add_new_proposal'
                                       style="color: black; padding-bottom: 0">
                                <span>
                                    <i class="fal fa-plus"></i>
                                </span>
                                        Add
                                    </a>
                                </div>

                            </div>

                            <div id="proposal-table" class="mt-3">
                                @include('CRM.elements.task.sale.table.proposal-agent',['agent_id'=>$agent_id])
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                            <div class="d-flex justify-content-between mt-2" style="justify-content: flex-end !important;">

                                <div class="d-flex" style="justify-content: center;align-items: center;">
                                    <a href="#" class="btn btn-link" is-click='false'
                                       id='delete_all_proposal_fillter' style="color: black">Clear
                                        filter</a>
                                    <a href="#" class="btn btn btn-link" is-click='false' id='btn_add_agent_contact'
                                       style="color: black; padding-bottom: 0">
                                <span>
                                    <i class="fal fa-plus"></i>
                                </span>
                                        Add
                                    </a>
                                </div>

                            </div>
                            <div id="contact-table" class="mt-3">
                                @include('CRM.elements.agents.process-table.agent-contact.index',['agent_id'=>$agent_id])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
