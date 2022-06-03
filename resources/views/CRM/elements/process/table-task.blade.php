<div class="table-responsive">
  <table class="table table-md mb-0 table-dashboard fs--1">
    <thead class="bg-200 text-900">
      <tr>
        <th class="processing-date">Task</th>
        <th class="md15">Description</th>
        <th class="processing-date">From</th>
        <th class="processing-date">To</th>
        <th class="status">Type of task</th>
        <th class="status">Level</th>
        <th class="status">Status</th>
        <th class="status">Leader</th>
        <th class="status">Process by</th>
        <th class="status">Processing</th>
      </tr>
    </thead>
    <tbody>
      @foreach($tasks as $tmp)
      @php
      $date = DateTime::createFromFormat('Y-m-d H:i:s', $tmp->created_at);
      @endphp
      <tr data-id="{{$tmp->id}}" style="cursor: pointer;" class="data_task">
        <td>{{$tmp->task}}</td>
        <td>{!! $tmp->content !!}</td>
        <td>{{$tmp->from_date}}</td>
        <td>{{$tmp->to_date}}</td>
        <td>{{isset(config('myconfig.task_type')[$tmp->task_type]) ? config('myconfig.status')[$tmp->task_type] : ''}}</td>
        <td>{{isset(config('myconfig.lv')[$tmp->level]) ? config('myconfig.lv')[$tmp->level] : ''}}</td>
        <td>{{isset(config('myconfig.status')[$tmp->status]) ? config('myconfig.status')[$tmp->status] : ''}}</td>
        <td>{{$tmp->u_leader != null ? $tmp->u_leader->username : ''}}</td>
        <td>{{$tmp->u_process_by != null ? $tmp->u_process_by->username : ''}}</td>
        <td>{{$tmp->processing}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>