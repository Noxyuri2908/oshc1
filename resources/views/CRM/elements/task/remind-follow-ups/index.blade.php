<div class="table-follow-ups table-div">
    <table class="">
        <thead class="">
        <tr class="first-row">
            <th class="width-50 text-center">Action</th>
            @foreach($configRemindFollowUpByOrder as $key)
                <th class="{{$key['class']}}">{{$key['value']}}</th>
            @endforeach {{--View Composer agent--}}
        </tr>

        @include('CRM.elements.task.remind-follow-ups.filter')

        </thead>
        <tbody id="remind-follow-ups-data">

        </tbody>
    </table>
</div>
