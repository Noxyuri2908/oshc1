@foreach($users as $user)
    <tr class="btn-reveal-trigger data-agent" id="data-agent_{{$user->id}}" data-id="{{$user->id}}">
        <td class="align-middle">
            <input class="ml-3 sub_chk" data-id="{{$user->id}}"
                   data-email="{{!empty($user) ? $user->email:''}}"
                   data-name="{{!empty($user) ? $user->name : ''}}" type="checkbox" aria-label="Checkbox for this row" />
        </td>
        <td class="align-middle  text-center">
            <div class="dropdown text-sans-serif">
                <button class="btn btn-link text-600 btn-sm dropdown-toggle" type="button" id="dropdownMenuButton{{$user->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-h fs--1"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{$user->id}}">
                    <a href="{{route('agent.show',['id'=>$user->id])}}" class="dropdown-item agent_data_show">Show</a>
                    @can('agent.edit')
                        <a class="dropdown-item agent_data_edit" data-url_edit="{{route('agent.showData',['id'=>$user->id])}}" href="{{route('agent.edit', ['id'=>$user->id])}}">Edit</a>
                    @endcan
                    @can('agent.process')
                        <a class="dropdown-item" href="{{route('agent.process', ['id'=>$user->id])}}" data-id="{{$user->id}}">Process</a>
                    @endcan
                    @can('agent.delete')
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger agent_data_delete" data-id="{{$user->id}}" data-url="{{route("agent.destroy",["id"=>$user->id])}}" href="#!">Delete</a>
                    @endcan
                </div>
            </div>
        </td>
        <td class="align-middle">{{(!empty($user) && !empty($departments[$user->department]))?$departments[$user->department]:''}}</td>
        <td class="align-middle text-overflow">
            <a style="cursor: pointer; color: blue" class="agent_info" data-id="{{$user->id}}" href="{{request()->user()->can('agent.store')?route('agent.process', ['id'=>$user->id]):'#'}}">{{$user->name}}</a>
        </td>
        <td class="align-middle text-overflow">{{(!empty($user) && !empty($countries[$user->country]))?$countries[$user->country]:''}}</td>
        <td class="align-middle text-overflow text-center">{{$user->text_status}}</td>
        <td class="align-middle text-overflow">{{(!empty($user))?$user->text_market:''}}</td>
        <td class="align-middle text-overflow">{{$user->getPotentialService($dichvus)}}</td>
        <td class="align-middle text-center">{{(!empty($user))?$user->rating:''}}</td>
        <td class="align-middle text-center">
            <a href="#" class="get_agent_contact" data-url="{{route('agent.getContactAgent',['id'=>$user->id])}}"><span class="far fa-eye"></span></a>
        </td>
        <td class="align-middle text-center">
            <a href="#" class="agent_comm" data-id="{{$user->id}}"><span class="far fa-eye"></span></a>
        </td>
        <td class="align-middle text-overflow">
            <a style="cursor: pointer; color: blue" class="agent_info" data-id="{{$user->id}}">{{(!empty($user))?$user->agent_code:''}}</a>
        </td>
        <td class="text-center td_staff_id">{{!empty($admins[$user->staff_id])?$admins[$user->staff_id]:''}}</td>
        <td class="align-middle text-center">{{(!empty($user))?convert_date_form_db($user->date_of_contract):''}}</td>
        <td class="align-middle text-center">{{convert_date_form_db($user->created_at)}}</td>
        <td class="align-middle text-overflow">
            <a href="#" data-toggle="modal" data-target="#note1_data{{$user->id}}">{{$user->note1}}</a>
            <div class="modal fade" id="note1_data{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Note1</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <p style="white-space: pre-wrap;">{{$user->note1}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </td>
        <td class="align-middle text-overflow">
            <a href="#" data-toggle="modal" data-target="#note2_data{{$user->id}}">{{$user->note2}}</a>
            <div class="modal fade" id="note2_data{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Note2</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <p style="white-space: pre-wrap;">{{$user->note2}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </td>
        <td class="align-middle text-overflow">{{(!empty($user) && !empty($typeAgent[$user->type_id]) )?$typeAgent[$user->type_id]:''}}</td>
        <td class="align-middle text-overflow">{{$user->email}}</td>
        <td class="align-middle text-overflow">{{(!empty($user))?$user->tel_1:''}}</td>
        <td class="align-middle text-overflow">{{(!empty($user))?$user->tel_2:''}}</td>
        <td class="align-middle text-overflow">{{(!empty($user))?$user->website:''}}</td>
        <td class="align-middle text-overflow">{{(!empty($user))?$user->city:''}}</td>
        <td class="align-middle text-overflow">{{(!empty($user))?$user->office:''}}</td>
    </tr>
@endforeach
