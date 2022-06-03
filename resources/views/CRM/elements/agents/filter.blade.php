<tr class="last-row">
    <th></th>
    <th></th>
    @foreach($configAgentByOrder as $key)
        @if(!empty($key['filter_blade']))
            @include($key['filter_blade'])
        @endif
    @endforeach
</tr>
@push('scripts')
    <script>
        $('#market_id_filter').select2({
            closeOnSelect: false,
        })
        $('#potential_service_filter').select2({
            closeOnSelect: false,
        })
    </script>
@endpush
