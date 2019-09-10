@section('footer_scripts')
    <script>
        $('#username').keyup(function () {
            let user = this.value;
            if (user != '') {        
                $.ajax({
                    url: 'select/username/'+user,
                    data: data,
                    success:function(data){
                        data.username==true ? $('#username_notif').html('<span style=color:red>Username cannot be used</span>') : $('#username_notif').html('<span style=color:green>Username can be used </span>');
                        data.username==true ? $('#goto-join').attr('disabled',true) : $('#goto-join').attr('disabled',false);
                    }
                });
            }
        });
    </script>
@stop