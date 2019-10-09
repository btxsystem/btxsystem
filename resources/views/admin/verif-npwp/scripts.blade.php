@section('footer_scripts')
    <script type="text/javascript">

        let verif = (data) => {
            $('#info-verif').html('Are you want verification npwp '+ data +' ?')
        }

        $('#verification').click(function(){
            $.ajax({
                type: 'POST',
                url: '/member/select/bitrex-points',
                success: function (data) {
                    if (data.bitrex_points >= 280) {
                        $('#register').modal('show');
                    }else{
                        $('#register').modal('hide');
                        $('#warning').modal('show');
                    }
                },
                error: function() {
                    console.log("Error");
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