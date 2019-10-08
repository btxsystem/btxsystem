@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#member').select2({
            placeholder: "Choose sponsor...",
            ajax: {
			    placeholder: 'Choose Member',
                url: '{{ route("select.sponsor") }}',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    console.log(data);
                    return {
                        results: data
                    };
                },
                cache: true
                },
                minimumInputLength: 2,
            });
        });
    </script> 
@endsection