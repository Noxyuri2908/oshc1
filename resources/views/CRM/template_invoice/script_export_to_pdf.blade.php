@push('scripts')
    <script>
        var opt = {
            filename: "{{$ref_no}}.pdf",
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale : 2},
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
        };
        $('.btn').on('click', function (){
            var element = document.getElementById('page');
            html2pdf().set(opt).from(element).save();
        })
    </script>
@endpush
