@section('footer_scripts')
    <script>
        $(document).ready(function () {
            $.ajax({
                url: '{{route("member.select.bonus-event")}}',
                data: data,
                success:function(data){
                    data = data.data;
                    if (data[0]==undefined) {
                        $('#bill').html('<div class="body" style="color:red;"><center><strong>History is currently empty</strong></center></div>');    
                    }else{
                        $.each(data, function(i, item) {
                            date = moment(item.created_at).format('MMMM Do Y - HH:mm');
                            nominal = addCommas(item.nominal);
                            $('#bill').append('<div class="card ke-'+i+'" style="border: 1px solid #ccc; box-shadow: 1px 1px 3px 0px  rgba(0,0,0,0.3);"><div class="body"><div class="row"><strong class="col-sm-4" id="date">Date Time: '+date+'</strong></div><hr><div class="row"><div class="col" id="nominal">Nominal: '+nominal+'</div><hr></div><div class="row"><div class="col" id="description">Description: '+item.description+'</div></div></div>'); 
                        });
                    }
                }
            });
        });
        var page = 1;
        $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() >= $(document).height()) {
                page++;
                loadMoreData(page);
            }
        });
        function loadMoreData(page){
            $.ajax({
                url: '/member/select/bonus-event?page=' + page,
                beforeSend: function(){
                    $('.ajax-load').show();
                }
            }).done(function(data){
                data = data.data;
                if(data[0]==undefined){
                    $('.ajax-load').html("No more records found");
                    return;
                }
                $('.ajax-load').hide();
                $.each(data, function(i, item) {
                    date = moment(item.created_at).format('MMMM Do Y - HH:mm');
                    nominal = addCommas(item.nominal);
                    $('#bill').append('<div class="card ke-'+i+'" style="border: 1px solid #ccc; box-shadow: 1px 1px 3px 0px  rgba(0,0,0,0.3);"><div class="body"><div class="row"><strong class="col-sm-4" id="date">Date Time: '+date+'</strong></div><hr><div class="row"><div class="col" id="nominal">Nominal: '+nominal+'</div><hr></div><div class="row"><div class="col" id="description">Description: '+item.description+'</div></div></div>'); 
                });
            })
            .fail(function(jqXHR, ajaxOptions, thrownError){
                $('.ajax-load').html("Server not responding");
                return;
            });
        }
    </script>
@stop