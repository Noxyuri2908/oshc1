@if(!empty($EmailTemplates))
    @foreach($EmailTemplates as $key => $item)
        <tr class="tr-content {{$loop->iteration / 2 != 0 ? 'odd' : ''}}">
            <td class="text-center">{{$item->id}}</td>
            <td class="text-center">{{$item->subject}}</td>
            <td>{{$item->template}}</td>
            <td class="text-center">{{getEmailCategoryById($item->cat_id)}}</td>
            <td class="text-center"><span
                    class="badge badge-pill {{$item->mail_status == 1 ? 'badge-success' : 'badge-danger'}} ">{{$item->mail_status == 1 ? 'Active' : 'Deactive'}}</span>
            </td>
            <td>
                <div class="d-flex justify-content-around">
                    <a href="{{route('email.email-template.edit', ['id' => $item->id])}}"
                       class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="destroy" data-id="{{$item->id}}">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td>no data</td>
    </tr>
@endif
