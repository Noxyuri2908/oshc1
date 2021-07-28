@foreach($dataSaleTaskAssign as $one)
    <tr id="{{$typeTask}}_{{$one->id}}">
        <th>
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownApplyReceipt{{$one->id}}"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-h fs--1"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownApplyReceipt{{$one->id}}">
                    <div class="bg-white py-2">
                        @can('tasksAsigned.edit')
                            <a class="dropdown-item edit-{{$typeTask}}-agent" data-id="{{$one->id}}" href="#">Edit</a>
                        @endcan
                        @can('tasksAsigned.delete')
                            <a class="dropdown-item text-danger delete-{{$typeTask}}-agent" data-id="{{$one->id}}" data-url="{{route('tasks.destroySaleTaskAssign',['id'=>$one->id])}}" href="#!">Delete</a>
                        @endcan
                    </div>
                </div>
            </div>
        </th>
        <th class="white-space-break-spaces text-overflow">{{\Carbon::parse($one->processing_date)->format('d/m/Y')}}</th>
        <td class="white-space-break-spaces text-overflow">{{$one->item}}</td>
        <td class="white-space-break-spaces text-overflow">{{$saleTaskAssignType->where('id',$one->type)->pluck('name')->first()}}</td>
        <td class="white-space-break-spaces text-overflow">{{!empty($agents[$one->user_id])?$agents[$one->user_id]:''}}</td>
        <td class="white-space-break-spaces text-overflow">{{!empty($admins[$one->assigned_by])?$admins[$one->assigned_by]:''}}</td>
        <th class="white-space-break-spaces text-overflow">{{\Carbon::parse($one->deadline)->format('d/m/Y')}}</th>
        <td class="white-space-break-spaces text-overflow text-left">{{$one->note}}</td>
    </tr>
@endforeach
