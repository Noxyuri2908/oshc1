@if(session('error-task'))
  <div class="alert alert-danger">
    <strong>{{session('error-task')}}</strong>
  </div>
@endif
@if(session('success-task'))
  <div class="alert alert-success">
    <strong>{{session('success-task')}}</strong>
  </div>
@endif
<div class="card mb-3">
  <div class="card-header">
    <div class="row align-items-center">
      <div class="col">
        <h5 class="fs-0 mb-0">Follow ups agent</h5>
      </div>
      <div class="col-auto">
        <a class="btn btn-falcon-primary btn-sm sxme" id="btn_add_new_task"><span class="fas fa-plus mr-1" data-fa-transform="shrink-3"></span> <span>New</span></a>
      </div>
    </div>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-sm mb-0 table-dashboard fs--1">
        <thead class="bg-200 text-900">
          <tr>
            <th>Task</th>
            <th>Service</th>
            <th>Type</th>
            <th>Agent</th>
            <th>Customer</th>
            <th>Description</th>
            <th>Type of task</th>
            <th>Level</th>
            <th>Status</th>
            <th>Leader</th>
            <th>Process by</th>
            <th>Person in charge</th>
            <th>From</th>
            <th>To</th>
            <th>Processing</th>
          </tr>
        </thead>
        <tbody>
          @if($tasks->count() <= 0)
          <tr>
            <td class="text-center" colspan="14">No data</td>
          </tr>
          @else
          @foreach($tasks as $task)
          <tr data-id="{{$task->id}}" style="cursor: pointer;" class="data_task">
            <td class="align-middle">{{$task->task}}</td>
            <td class="align-middle">{{$task->service}}</td>
            <td class="align-middle">{{$task->type_service}}</td>
            <td class="align-middle">{{$task->agent != null ? $task->agent->name : ''}}</td>
            <td class="align-middle">{{$task->apply != null && $task->apply->registerCus() != null ? $task->apply->registerCus()->first_name.' '.$task->apply->registerCus()->last_name : ''}}</td>
            <td class="align-middle">{{$task->content}}</td>
            <td class="align-middle">{{isset(config('myconfig.type_task')[$task->task_type]) ? config('myconfig.type_task')[$task->task_type] : ''}}</td>
            <td class="align-middle">{{isset(config('myconfig.lv')[$task->level]) ? config('myconfig.lv')[$task->level] : ''}}</td>
            <td class="align-middle">{{isset(config('myconfig.status_task')[$task->status]) ? config('myconfig.status_task')[$task->status] : ''}}</td>
            <td class="align-middle">{{$task->u_leader != null ? $task->u_leader->username : ''}}</td>
            <td class="align-middle">{{$task->u_process_by != null ? $task->u_process_by->username : ''}}</td>
            <td class="align-middle">
            @php
              $str = [];
              foreach($task->pIC() as $tmp){
                $str[] = $tmp->username;
              }
              echo implode(";", $str);
            @endphp
            </td>
            <td class="align-middle">{{$task->from_date}}</td>
            <td class="align-middle">{{$task->to_date}}</td>
            <td class="align-middle">{{$task->processing}}</td>
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer border-top">
    <div class="row">
      <div class="col-auto">
      {{$tasks->links()}}
      </div>
    </div>
  </div>
</div>
@include('CRM.elements.task.modal-form')




