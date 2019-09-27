@section('footer_scripts')
    <script>
        var table = $('#my-sponsor').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            "retrieve": true,
            ajax: {
                url: "{{ route('member.team-report.my-sponsor') }}", 
            },
                
            columns: [
                {data: 'name', name: 'name'},
                {data: 'username', name: 'username'},
                {data: 'number_phone', name: 'number_phone', searchable: false},
                ],
            
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
        });
        $(document).ready(function () {
            $('.dropdown-toggle').hide();
        })
    </script>
@stop