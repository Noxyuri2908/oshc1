@foreach($logs as $data)
    <tr id="log_data_{{$data->id}}">
        <td class="white-space-preline-report">{{$data->exception}}</td>
        <td class="white-space-preline-report">{{$data->created_at}}</td>
    </tr>
@endforeach
