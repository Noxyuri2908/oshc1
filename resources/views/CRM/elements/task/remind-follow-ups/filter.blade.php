<tr class="last-row">
    <th></th>
    @foreach($configRemindFollowUpByOrder as $key)
        @if(!empty($key['filter_blade']))
            @include($key['filter_blade'])
        @endif
    @endforeach
</tr>
