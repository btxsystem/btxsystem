@extends('frontend.default')
@section('title')
    PV Pairing History
    @parent
@stop
@section('content')
<section class="content ecommerce-page">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>PV Pairing History
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
            url: '{{route("member.select.history-pv-pairing")}}',
            data: data,
            success:function(data){
                if (data.data[0]==undefined) {
                    $('#bill').html('<div class="body" style="color:red;"><center><strong>History is currently empty</strong></center></div>');    
                }else{
                    $.each(data.data, function(i, item) {
                        date = moment(item.created_at).format('MMMM Do Y - HH:mm');
                        total_pairing = addCommas(item.total_pairing);
                        failed_pairing = addCommas(item.fail_pairing);
                        left = addCommas(item.left);
                        midle = addCommas(item.midle);
                        right = addCommas(item.right);
                        current_left = addCommas(item.current_left);
                        current_midle = addCommas(item.current_midle);
                        current_right = addCommas(item.current_right);
                        if (item.total_pairing == 0) {
                            $('#bill').append('<div class="card ke-'+i+'" style="border: 1px solid #ccc; box-shadow: 1px 1px 3px 0px  rgba(0,0,0,0.3);"><div class="body"><div class="row"><strong class="col-sm-4" id="date">Date Time: '+date+'</strong></div><hr><div class="row"><div class="col">Before</div><div class="col">Pairing</div><div class="col">Current</div></div><hr><div class="row"><div class="col" id="pv_l">Total PV L: '+left+'</div><div class="col" id="total">Total Pairing: '+total_pairing+'</div><div class="col" id="current_left">Total PV L: '+current_left+'</div><hr></div><div class="row"><div class="col" id="pv_m">Total PV M: '+midle+'</div><div class="col" id="fail" style="color:red;">Unqualified: '+failed_pairing+'</div><div class="col" id="current_midle">Total PV M: '+current_midle+'</div><hr></div><div class="row"><div class="col" id="pv_r">Total PV R: '+right+'</div><div class="col"></div><div class="col" id="current_right">Total PV R: '+current_right+'</div></div>');                             
                        }else{
                            $('#bill').append('<div class="card ke-'+i+'" style="border: 1px solid #ccc; box-shadow: 1px 1px 3px 0px  rgba(0,0,0,0.3);"><div class="body"><div class="row"><strong class="col-sm-4" id="date">Date Time: '+date+'</strong></div><hr><div class="row"><div class="col">Before</div><div class="col">Pairing</div><div class="col">Current</div></div><hr><div class="row"><div class="col" id="pv_l">Total PV L: '+left+'</div><div class="col" id="total">Total Pairing: '+total_pairing+'</div><div class="col" id="current_left">Total PV L: '+current_left+'</div><hr></div><div class="row"><div class="col" id="pv_m">Total PV M: '+midle+'</div><div class="col" id="fail">Flush Out: '+failed_pairing+'</div><div class="col" id="current_midle">Total PV M: '+current_midle+'</div><hr></div><div class="row"><div class="col" id="pv_r">Total PV R: '+right+'</div><div class="col"></div><div class="col" id="current_right">Total PV R: '+current_right+'</div></div>'); 
                        }
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
            url: '/member/select/history-pv-pairing?page=' + page,
            beforeSend: function(){
                $('.ajax-load').show();
            }
        }).done(function(data){
            if(data.data[0]==undefined){
                $('.ajax-load').html("No more records found");
                return;
            }
            $('.ajax-load').hide();
            $.each(data.data, function(i, item) {
                date = moment(item.created_at).format('MMMM Do Y - HH:mm');
                total_pairing = addCommas(item.total_pairing);
                failed_pairing = addCommas(item.fail_pairing);
                left = addCommas(item.left);
                midle = addCommas(item.midle);
                right = addCommas(item.right);
                current_left = addCommas(item.current_left);
                current_midle = addCommas(item.current_midle);
                current_right = addCommas(item.current_right);
                $('#bill').append('<div class="card ke-'+i+'" style="border: 1px solid #ccc; box-shadow: 1px 1px 3px 0px  rgba(0,0,0,0.3);"><div class="body"><div class="row"><strong class="col-sm-4" id="date">Date Time: '+date+'</strong></div><hr><div class="row"><div class="col">Before</div><div class="col">Pairing</div><div class="col">Current</div></div><hr><div class="row"><div class="col" id="pv_l">Total PV L: '+left+'</div><div class="col" id="total">Total Pairing: '+total_pairing+'</div><div class="col" id="current_left">Total PV L: '+current_left+'</div><hr></div><div class="row"><div class="col" id="pv_m">Total PV M: '+midle+'</div><div class="col" id="fail">Flash Out: '+failed_pairing+'</div><div class="col" id="current_midle">Total PV M: '+current_midle+'</div><hr></div><div class="row"><div class="col" id="pv_r">Total PV R: '+right+'</div><div class="col"></div><div class="col" id="current_right">Total PV R: '+current_right+'</div></div>'); 
            });
        })
        .fail(function(jqXHR, ajaxOptions, thrownError){
            $('.ajax-load').html("Server not responding");
            return;
        });
    }
</script>
@stop