@extends('frontend.default')
@section('title')
    Bitrex points
    @parent
@stop
@section('content')
<div class="modal fade" id="topup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="topup">Top Up Bitrex Points</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('member.transaction.topup')}}" method="POST">
                @csrf
                <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-line">
                        <input class="form-control" name="nominal" id="nominal" type="number" min="5">
                        <label class="form-label">Nominal</label>
                    </div>
                    <p class="notif" style="color:green">Minimum input bitrex points 10000, and Multiples 1000</p>
                </div>
                <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-line">
                        <input class="form-control" name="points" id="points" type="text" readonly>
                    </div>
                    <p class="notif" style="color:green">Convert from IDR 1000</p>
                </div>
                <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="demo-radio-button">
                    <input name="method" type="radio" value="1" id="male" class="with-gap radio-col-red" checked />
                    <label for="male">Transfer</label>
                    <input name="method" type="radio" value="0" id="female" class="with-gap radio-col-red" />
                    <label for="female">Ipay</label>
                  </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <button type="submit" disabled=true class="btn btn-primary">Topup</a>
                </div>
            </form>
        </div>
    </div>
</div>

<section class="content ecommerce-page">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h2>Bitrex Points History
                    <small class="text-muted">Bitrexgo</small>
                </h2>
            </div>
        </div>
    </div>
    <div class="block-header">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="body">
                    <a href="#" class="btn btn-primary btn-md" data-toggle="modal" data-target="#topup">Topup</a>
                    <h5 class="d-flex flex-row-reverse">Bitrex Points: {{number_format($profile->bitrex_points)}}</h5>
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
            url: '{{route("member.select.history-points")}}',
            data: data,
            success:function(data){
                if (data.points.data[0]==undefined) {
                    $('#bill').html('<div class="body" style="color:red;"><center><strong>History is currently empty</strong></center></div>');
                }else{
                    $.each(data.points.data, function(i, item) {
                        date = moment(item.created_at).format('MMMM Do Y');
                        type = item.info ? 'Income' : 'Spending';
                        color = item.info ? 'green' : 'red';
                        nominal = addCommas(item.nominal);
                        points = addCommas(item.points);
                        $('#bill').append('<div class="card ke-'+i+'" style="border: 1px solid #ccc; box-shadow: 1px 1px 3px 0px  rgba(0,0,0,0.3);"><div class="body"><div class="row"><strong class="col-sm-4" id="date">Date Time: '+date+'</strong></div><hr><div class="row"><div class="col" id="type">Type: <b style="color:'+color+'">'+type+'</b></div><div class="col" id="nominal">Nominal: '+nominal+'</div><hr></div><div class="row"><div class="col" id="description">Description: '+item.description+'</div><div class="col" id="points">Points: '+points+'</div></div></div></div>');
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
            url: '/member/select/history-points?page=' + page,
            beforeSend: function(){
                $('.ajax-load').show();
            }
        }).done(function(data){
            if(data.points.data[0]==undefined){
                $('.ajax-load').html("No more records found");
                return;
            }
            $('.ajax-load').hide();
            $.each(data.points.data, function(i, item) {
                date = moment(item.created_at).format('MMMM Do Y');
                type = item.info ? 'Income' : 'Spending';
                color = item.info ? 'green' : 'red';
                nominal = addCommas(item.nominal);
                points = addCommas(item.points);
                $('#bill').append('<div class="card ke-'+i+'" style="border: 1px solid #ccc; box-shadow: 1px 1px 3px 0px  rgba(0,0,0,0.3);"><div class="body"><div class="row"><strong class="col-sm-4" id="date">Date Time: '+date+'</strong></div><hr><div class="row"><div class="col" id="type">Type: <b style="color:'+color+'">'+type+'</b></div><div class="col" id="nominal">Nominal: '+nominal+'</div><hr></div><div class="row"><div class="col" id="description">Description: '+item.description+'</div><div class="col" id="points">Points: '+points+'</div></div></div></div>');
            });
        })
        .fail(function(jqXHR, ajaxOptions, thrownError){
            $('.ajax-load').html("Server not responding");
            return;
        });
    }

    $('#nominal').keyup(function(){
        var points = $('#nominal').val() / 1000;
        $('#points').val(points);
        if ($('#nominal').val() % 1000 == 0 && $('#nominal').val() >= 10000) {
            $("button").prop('disabled',false);
        }else{
            $("button").prop('disabled',true);
        }
    })
</script>
@stop
