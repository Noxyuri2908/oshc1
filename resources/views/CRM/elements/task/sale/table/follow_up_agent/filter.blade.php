<tr class="last-row">
    <th></th>
    @foreach($configFollowsUpByOrder as $key)
        @if(!empty($key['filter_blade']))
            @include($key['filter_blade'])
        @endif
    @endforeach
</tr>
