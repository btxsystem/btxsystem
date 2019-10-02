@extends('frontend.default')
@section('title')
    Bitrex value
    @parent
@stop
@section('content')

<div class="modal fade" id="withdraw" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="wd">Withdrawal bitrex Value</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div>
                <br>
                <center><h5>Withdrawal feature will be coming soon</h5></center>
            </div>
            <!--<form action="" method="POST">
                @csrf
                <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-line">
                        <input class="form-control" value="Bitrex Value: {{number_format($profile->bitrex_cash,0,".",".")}}" type="text" readonly>
                    </div>
                </div>
                <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-line">
                        <input class="form-control" value="Bank Account Number: {{$profile->no_rec}}" type="text" readonly>
                    </div>
                </div>
                <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-line">
                        <input class="form-control" value="Bank Name: {{$profile->bank_name}}" type="text" readonly>
                    </div>
                </div>
                <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-line">
                        <input class="form-control" value="Bank Account Name: {{$profile->bank_account_name}}" type="text" readonly>
                    </div>
                </div>
                <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-line">
                        <input class="form-control" name="nominal" id="nominal" type="number" min="5">
                        <label class="form-label">Nominal withdrawal</label>
                    </div>
                </div>
                <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-line">
                        <input class="form-control" name="points" id="points" type="text" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <button type="submit" id="topup-points" disabled=true class="btn btn-primary">Topup</a>
                </div>
            </form>!-->
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>
    
<section class="content ecommerce-page">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h2>Bitrex Value History
                <small class="text-muted">Bitrexgo</small>
                </h2>
            </div>
        </div>
    </div>
    <div class="block-header">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="body">
                    <a href="#" class="btn btn-primary btn-md" data-toggle="modal" data-target="#withdraw" style="margin-bottom:-20px; width: 136px;">withdrawal</a>
                    <h4 class="d-flex flex-row-reverse">Bitrex Value: {{number_format($profile->bitrex_cash,0,".",".")}}</h4>
                </div>
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
                    $('#bill').html('<div class="body" style="color:red;"><center><strong>History is currently empty</strong></center></div>');    
                }else{
                    $.each(data.cash.data, function(i, item) {
                        date = moment(item.created_at).format('MMMM Do Y - HH:mm');
                        type = item.info ? 'Income' : 'Spending';
                        color = item.info ? 'green' : 'red';
                        nominal = addCommas(item.nominal);
                        $('#bill').append('<div class="card ke-'+i+'" style="border: 1px solid #ccc; box-shadow: 1px 1px 3px 0px  rgba(0,0,0,0.3);"><div class="body"><div class="row"><strong class="col-sm-4" id="date">Date Time: '+date+'</strong></div><hr><div class="row"><div class="col" id="type">Type: <b style="color:'+color+'">'+type+'</b></div><div class="col" id="nominal">Nominal: '+nominal+'</div><hr></div><div class="row"><div class="col" id="description">Description: '+item.description+'</div></div></div>'); 
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
            url: '/member/select/history-value?page=' + page,
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
                date = moment(item.created_at).format('MMMM Do Y - HH:mm');
                type = item.info ? 'Income' : 'Spending';
                color = item.info ? 'green' : 'red';
                nominal = addCommas(item.nominal);
                $('#bill').append('<div class="card ke-'+i+'" style="border: 1px solid #ccc; box-shadow: 1px 1px 3px 0px  rgba(0,0,0,0.3);"><div class="body"><div class="row"><strong class="col-sm-4" id="date">Date Time: '+date+'</strong></div><hr><div class="row"><div class="col" id="type">Type: <b style="color:'+color+'">'+type+'</b></div><div class="col" id="nominal">Nominal: '+nominal+'</div><hr></div><div class="row"><div class="col" id="description">Description: '+item.description+'</div></div></div></div>'); 
            });
        })
        .fail(function(jqXHR, ajaxOptions, thrownError){
            $('.ajax-load').html("Server not responding");
            return;
        });
    }
</script>
@stop