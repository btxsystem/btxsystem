@extends('frontend.default')
@section('title')
    Prospected Member Transactions
    @parent
@stop
@section('content')
<section class="content ecommerce-page">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Prospected Member Transactions History
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
            url: '{{route("member.select.prospected-member-transaction")}}',
            data: data,
            success:function(data){
                console.log(data);

                if (data.transaction.data[0]==undefined) {
                    $('#bill').html('<div class="body" style="color:red;"><center><strong>You have no history!!!</strong></center></div>');    
                }else{
                    $.each(data.transaction.data, function(i, item) {
                        date = moment(item.created_at).format('MMMM Do Y');
                        price = parseInt(item.price) + parseInt(item.price_markup);
                        $('#bill').append('<div class="card ke-'+i+'" style="border: 1px solid #ccc; box-shadow: 1px 1px 3px 0px  rgba(0,0,0,0.3);"><div class="body"><div class="row"><strong class="col-sm-4" id="date">Date Time: '+date+'</strong></div><hr><div class="row"><div class="col" id="type">Ebook: '+ item.title +'</div><div class="col" id="price">Nominal: '+ price +'</div><hr></div><div class="row"><div class="col" id="description">Description: Commission bonus from '+item.username+'</div><div class="col" id="bonus">Bonus: '+item.price_markup+'</div></div></div></div>');
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
            url: '/member/select/prospected-member-transaction?page=' + page,
            beforeSend: function(){
                $('.ajax-load').show();
            }
        }).done(function(data){
            if(data.transaction.data[0]==undefined){
                $('.ajax-load').html("No more records found");
                return;
            }else{
                $('.ajax-load').hide();
                $.each(data.transaction.data, function(i, item) {
                    date = moment(item.created_at).format('MMMM Do Y');
                    price = parseInt(item.price) + parseInt(item.price_markup);
                    $('#bill').append('<div class="card ke-'+i+'" style="border: 1px solid #ccc; box-shadow: 1px 1px 3px 0px  rgba(0,0,0,0.3);"><div class="body"><div class="row"><strong class="col-sm-4" id="date">Date Time: '+date+'</strong></div><hr><div class="row"><div class="col" id="type">Ebook: '+ item.title +'</div><div class="col" id="price">Nominal: '+ price +'</div><hr></div><div class="row"><div class="col" id="description">Description: Commission bonus from '+item.username+'</div><div class="col" id="bonus">Bonus: '+item.price_markup+'</div></div></div></div>');
                });
            }
        })
        .fail(function(jqXHR, ajaxOptions, thrownError){
            $('.ajax-load').html("Server not responding");
            return;
        });
    }
</script>
@stop
