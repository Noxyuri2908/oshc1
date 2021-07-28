
<thead>
    <tr>
        <th class="no-sort" width="50px"><input type="checkbox" id="master"></th>
        <!-- các cột mặc định -->
        @foreach($info_table as $key=>$value)
        <th>{{$value['name']}}</th>
        @endforeach
    </tr>
</thead>
<tbody>
    @foreach($agents as $agent)
    @php
    $route = "#";
    $info = $agent->info;
    $support = App\Admin\Support::where('agent_id',$agent->id)->orderby('langoi','desc')->first();
    @endphp
    @if($info != null)
    <tr>
        <td><input type="checkbox" class="sub_chk" data-id="{{$agent->id}}"></td>
        <!-- các cột mặc định -->
        @foreach($info_table as $key=>$value)
            @if($value['table'] == 'users')
                @switch($key)
                    @case("status")
                        @if($agent->status == 1) <td onclick="window.location='{{$route}}'">Active</td>
                        @else <td onclick="window.location='{{$route}}'">De-active</td>
                        @endif
                        @break
                    @case("staff_id")
                        <td onclick="window.location='{{$route}}'">{{$agent->staff != null ? $agent->staff->username : ''}}</td>
                        @break
                    @default
                        <td onclick="window.location='{{$route}}'">{{$agent->toArray()[$key]}}</td>
                        @break
                @endswitch
            @endif
            @if($value['table'] == 'infos')
                <td onclick="window.location='{{$route}}'">{{$info->toArray()[$key]}}</td>
            @endif
            @if($value['table'] == 'supports')
                <td onclick="window.location='{{$route}}'">{{$support != null ? $support->toArray()[$key] : ''}}</td>
            @endif
        @endforeach
    </tr>
    @endif
    @endforeach
</tbody>
