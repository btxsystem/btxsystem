@section('footer_scripts')
    <script type="text/javascript">
        let username = undefined;

        let verif = (data) => {
            username = data;
            $('#info-verif').html('Are you want verification npwp '+ data +' ?')
        }

        $('#verification').click(function(){
            var $btn = $(this);
            $.ajax({
                url: '{{route("verification-npwp.store")}}',
                data: { "_token": "{{ csrf_token() }}", "username": username},
                success:function(data){
                    $btn.disabled = true;
                    $btn.button('loading');
                    // simulating a timeout
                    location.reload();
                    setTimeout(function () {
                        $btn.button('reset');
                    }, 2000);
                }
            });
        })

        $(document).ready(function () {
            var table = $('.npwp-table').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('verification-npwp.index') }}", 
                },
                columns: [
                    { data: 'username', name: 'username' },
                    { data: 'name', name: 'name' }, 
                    { data: 'npwp_number', name: 'npwp_number' },
                    { data: 'action', name: 'action' },                 
                ]
            });
        });
    </script> 
@endsection