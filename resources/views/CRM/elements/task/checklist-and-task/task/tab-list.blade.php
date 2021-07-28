
@foreach($groups as $group)
    <li class="nav-item">
        <a class="nav-link {{($loop->index==0)?'active':''}} group-content{{$type}}" data-id="{{$group->id}}" id="group-tab-{{$group->id}}" data-toggle="tab" href="#group-content-{{$group->id}}" role="tab" aria-controls="home" aria-selected="true">{{$group->group_name}} </a>
        {{--        ({{$group->countProcessingg}})--}}
    </li>
@endforeach
