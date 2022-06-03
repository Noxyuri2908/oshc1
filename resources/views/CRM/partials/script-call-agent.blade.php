<script>
    @if(!empty($nameFunction))
    var isReadyLoad{{$nameFunction}} = true;
    function {{$nameFunction}}(){
        if(isReadyLoad{{$nameFunction}}){
            $('#{{$elementIdSelect2}}').select2({
                dropdownParent: $('.{{$elementParentIdSelect2}}'),
                ajax: {
                    url: '{{route('agent.getAgentSelect')}}',
                    type: 'GET',
                    quietMillis: 10000,
                    dataType: 'json',
                    data: function (term) {
                        var query = {
                            name: term.term,
                        }
                        return query
                    },
                    processResults: function (data) {
                        // Transforms the top-level key of the response object from 'items' to 'results'

                        var results = []
                        data.forEach(e => {
                            results.push({
                                id: e.id,
                                text: e.name,
                            })
                        })
                        return {
                            results: results,
                        }
                    },
                },
            })
                @if(!empty($data))
            var option = new Option('{{$dataName}}', '{{$dataId}}', true, true)
            $('#{{$elementIdSelect2}}').append(option).trigger('change')
            @endif
                isReadyLoad{{$nameFunction}} = false;
        }
    }
    @else
    $('#{{$elementIdSelect2}}').select2({
        dropdownParent: $('.{{$elementParentIdSelect2}}'),
        ajax: {
            url: '{{route('agent.getAgentSelect')}}',
            type: 'GET',
            quietMillis: 10000,
            dataType: 'json',
            data: function (term) {
                var query = {
                    name: term.term,
                }
                return query
            },
            processResults: function (data) {
                // Transforms the top-level key of the response object from 'items' to 'results'

                var results = []
                data.forEach(e => {
                    results.push({
                        id: e.id,
                        text: e.name,
                    })
                })
                return {
                    results: results,
                }
            },
        },
    })
        @if(!empty($data))
    var option = new Option('{{$dataName}}', '{{$dataId}}', true, true)
    $('#{{$elementIdSelect2}}').append(option).trigger('change')
    @endif
        @endif
</script>
