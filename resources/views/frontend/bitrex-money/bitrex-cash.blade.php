@extends('frontend.default')
@section('title')
    Bitrex cash
    @parent
@stop
@section('content')
<section class="content ecommerce-page">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Bitrex Cash History
                <small class="text-muted">Bitrexgo</small>
                </h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12" id="bill">
                
            </div>
        </div>
    </div>
    <div class="ajax-load text-center" style="display:none">
        <p>Loading...</p>
    </div>
</section>
@stop

@section('footer_scripts')  
<script type="text/javascript">
    $(document).ready(function () {
        $.ajax({
            url: '{{route("member.select.history-cash")}}',
            data: data,
            success:function(data){
                if (data.cash.data[0]==undefined) {
                    $('#bill').html('<div class="body" style="color:red;"><center><strong>You have not history!!!</strong></center></div>');    
                }else{
                    $.each(data.cash.data, function(i, item) {
                        date = moment(item.created_at).format('MMMM Do Y');
                        type = item.info ? 'Income' : 'Spending';
                        color = item.info ? 'green' : 'red';
                        $('#bill').append('<div class="card ke-'+i+'" style="border: 1px solid #ccc; box-shadow: 1px 1px 3px 0px  rgba(0,0,0,0.3);"><div class="body"><div class="row"><strong class="col-sm-4" id="date">Date Time: '+date+'</strong></div><hr><div class="row"><div class="col" id="type">Type: <b style="color:'+color+'">'+type+'</b></div><div class="col" id="nominal">Nominal: '+item.nominal+'</div><hr></div><div class="row"><div class="col" id="description">Description: '+item.description+'</div></div></div>'); 
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
            url: '/member/select/history-cash?page=' + page,
            beforeSend: function(){
                $('.ajax-load').show();
            }
        }).done(function(data){
            if(data.cash.data[0]==undefined){
                $('.ajax-load').html("No more records found");
                return;
            }
            $('.ajax-load').hide();
            $.each(data.cash.data, function(i, item) {
                date = moment(item.created_at).format('MMMM Do Y');
                type = item.info ? 'Income' : 'Spending';
                color = item.info ? 'green' : 'red';
                $('#bill').append('<div class="card ke-'+i+'" style="border: 1px solid #ccc; box-shadow: 1px 1px 3px 0px  rgba(0,0,0,0.3);"><div class="body"><div class="row"><strong class="col-sm-4" id="date">Date Time: '+date+'</strong></div><hr><div class="row"><div class="col" id="type">Type: <b style="color:'+color+'">'+type+'</b></div><div class="col" id="nominal">Nominal: '+item.nominal+'</div><hr></div><div class="row"><div class="col" id="description">Description: '+item.description+'</div><div class="col" id="points">Point: '+item.points+'</div></div></div></div>'); 
            });
        })
        .fail(function(jqXHR, ajaxOptions, thrownError){
            $('.ajax-load').html("Server not responding");
            return;
        });
    }
</script>
@stop