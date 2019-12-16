@extends('frontend.default')
@section('title')
    Bitrex value
    @parent
@stop
@section('content')

<div class="modal fade" id="otp" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="wd">Verification OTP code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <input type="text" id="nominal_" value="" hidden>
                <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-line">
                        <input class="form-control" id="nominal_fake" value="" type="text" readonly>
                    </div>
                </div>
                <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-line">
                        <input class="form-control" name="form_otp" id="form_otp" type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                        <label class="form-label">OTP</label>
                    </div>
                    <p class="notif" style="color:green">Check your email for get OTP code</p>
                    <div>
                        <div id="countdown" style="font-size:16px"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <a href="#" id="load-otp" style="cursor:pointer; display:none;" class="btn btn-primary"></a>
                    <button type="submit" id="otp-button" disabled=true class="btn btn-primary" style="cursor:pointer">Send OTP</a>
                </div>
        </div>
    </div>
</div>


<div class="modal fade" id="withdraw" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="wd">Withdrawal bitrex Value</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
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
                        <input class="form-control" name="nominal" id="nominal" type="text" min="5" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                        <label class="form-label">Nominal withdrawal</label>
                    </div>
                    <p class="notif" style="color:green">Minimum withdrawal bitrex value IDR 10000</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <a href="#" id="load-withdraw" style="cursor:pointer; display:none;" class="btn btn-primary"></a>
                    <button type="submit" id="withdraw-button" disabled=true class="btn btn-primary" style="cursor:pointer">Withdraw</a>
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
                    {{--<a href="#" class="btn btn-primary btn-md" data-toggle="modal" data-target="#withdraw" style="margin-bottom:-20px; width: 136px;">withdrawal</a>--}}
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
                        $('#bill').append('<div class="card ke-'+i+'" style="border: 1px solid #ccc; box-shadow: 1px 1px 3px 0px  rgba(0,0,0,0.3);"><div class="body"><div class="row"><strong class="col-sm-4" id="date">Date Time: '+date+'</strong></div><hr><div class="row"><div class="col" id="type">Type: <b style="color:'+color+'">'+type+'</b></div><div class="col" id="nominal">Nominal Withdraw: '+nominal+'</div><hr></div><div class="row"><div class="col" id="description">Description: '+item.description+'</div></div></div>');
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

    $('#form_otp').on('change keyup', function(){
        if($(this).val().length > 0){
            $('#otp-button').prop('disabled',false);
        }else{
            $('#otp-button').prop('disabled',true);
        }
    });

    $('#otp-button').click(function(){
        var $this = $(this);
        var loadingText = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
        if ($(this).html() !== loadingText) {
            $this.data('original-text', $(this).html());
            $this.hide();
            $('#load-otp').html(loadingText);
            $('#load-otp').show();
        }
        setTimeout(function() {
            $this.html($this.data('original-text'));
            $('#load-otp').hide();
            $this.show();
        }, 100000);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '{{route("member.send-otp")}}',
            data: {nominal: $('#nominal_').val(), otp: $('#form_otp').val()},
            success: function (data) {
                $('#otp').modal('hide');
                if (data.status=='"Success"') {
                    swal({
                        title: "Success",
                        text: "Your withrawal success",
                        type: "success",
                        confirmButtonClass: "btn-primary",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    },
                    function(){
                        location.reload();
                    });
                }else if(data.status!='"success"'){
                    swal({
                        title: "Error",
                        text: "Cant withdrawal, something wrong",
                        type: "error",
                        confirmButtonClass: "btn-primary",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    },
                    function(){
                        location.reload();
                    });
                }else{
                    if(data.ErrorMessage){
                        swal({
                            title: "Error",
                            text: data.ErrorMessage.English,
                            type: "error",
                            confirmButtonClass: "btn-primary",
                            confirmButtonText: "OK",
                            closeOnConfirm: false
                        },
                        function(){
                            location.reload();
                        });
                    }
                }
            },
            error: function() {
                console.log("Error");
            }
        });
    });

    $('#nominal').on('change keyup', function(){
        let bitrex_value = {{$profile->bitrex_cash}};
        $(this).val() >= 10000 && parseInt($(this).val())+5000 <= bitrex_value ? $('#withdraw-button').prop('disabled',false) : $('#withdraw-button').prop('disabled',true);
    })

    $('#withdraw-button').click(function(){
        var $this = $(this);
        var loadingText = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
        if ($(this).html() !== loadingText) {
            $this.data('original-text', $(this).html());
            $this.hide();
            $('#load-withdraw').html(loadingText);
            $('#load-withdraw').show();
        }
        setTimeout(function() {
            $this.html($this.data('original-text'));
            $('#load-withdraw').hide();
            $this.show();
        }, 100000);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '{{route("member.withdrawal")}}',
            data: {nominal: $('#nominal').val()},
            success: function (data) {
                $('#nominal_fake').val('Nominal: '+addCommas(data.nominal));
                $('#nominal_').val(data.nominal);
                $('#otp').modal('show');
                $('#withdraw').modal('hide');
                var timeleft = data.minute;
                var downloadTimer = setInterval(function(){
                    document.getElementById("countdown").innerHTML = timeleft;
                    timeleft -= 1;
                    if(timeleft <= 0){
                        clearInterval(downloadTimer);
                        document.getElementById("countdown").innerHTML = "<button class='btn btn-primary' onclick='resendOTP()' style='font-size:12px; cursor:pointer'>Resend OTP</button>"
                    }
                }, 1000);
            },
            error: function() {
                console.log("Error");
            }
        });
    })

    let resendOTP = () => {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '{{route("member.resend-otp")}}',
            success: function (data) {
                var timeleft = data.minute;
                var downloadTimer = setInterval(function(){
                    document.getElementById("countdown").innerHTML = timeleft;
                    timeleft -= 1;
                    if(timeleft <= 0){
                        clearInterval(downloadTimer);
                        document.getElementById("countdown").innerHTML = "<button class='btn btn-primary' onclick='resendOTP()' style='font-size:12px; cursor:pointer'>Resend OTP</button>"
                    }
                }, 1000);
            },
            error: function() {
                console.log("Error");
            }
        });

    }

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
