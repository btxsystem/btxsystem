@section('footer_scripts')
    <script>
        var table = $('#my-analizer').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "{{ route('member.team-report.my-analizer') }}", 
            },
                
            columns: [
                {data: 'id', name: 'id'},
                {data: 'username', name: 'username'},
                {data: 'parent_id', name: 'parent_id'},
                ],
        });
        $(document).ready(function () {
            $('.dropdown-toggle').hide();
        })
    </script>
@stop