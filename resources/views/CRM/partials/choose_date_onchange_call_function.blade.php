@foreach($idElementInputFlatpick as $element)
    <script>
        $('#{{$element}}').flatpickr({
            dateFormat:'d/m/Y',
            allowInput:'true',
            onChange:function(selectedDates, dateStr, instance){
                {{$functionNameCall}}();
            }
        })
    </script>
    @endforeach
