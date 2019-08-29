@extends('frontend.default')
@section('title')
    Ebook
    @parent
@stop
@section('content')

<div class="modal fade" id="buy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buy Ebook</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('member.ebook.store')}}" method="POST">
                    @csrf
                    <input type="text" name="id" id="id" hidden>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Buy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<section class="content ecommerce-page">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Ebook
                <small class="text-muted">Bitrexgo</small>
                </h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">        
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card" style="background-color:#b92240">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="ebook">
                                    <div class="my-5">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-6 mb-3">
                                                    <div class="bg-white shadow rounded p-3 border-hover">
                                                        <div class="row">
                                                            <div id="flag" class="renewal-basic" aria-hidden="true">
                                                                Renewal
                                                            </div>
                                                            <div class="col-lg-3 d-flex align-items-center">
                                                                <img src="http://ebook.bitrexgo.id/assetsebook/v2/img/1.png" class="mx-auto d-block">
                                                            </div>
                                                            <input type="text" id="basic-value" hidden>
                                                            <div class="col-lg-9">
                                                                <h2 class="mb-0" style="color: #8543da;" id="basic"></h2>
                                                                <br>
                                                                <h5 style="color:black" id="description-basic"></h5><br>
                                                                <a href="#" data-toggle="modal" data-target="#buy" class="btn btn-danger btn-sm mt-3 px-5" id="cart1">BUY</a>
                                                                <a href="{{route('member.ebook.referral', ['type' => 'advance', 'username' => isset($profile->username) ? $profile->username : $profile['username']])}}" class="btn btn-danger btn-sm mt-3 px-5" id="view1">VIEW</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <div class="bg-white shadow rounded p-3 border-hover">
                                                        <div class="row">
                                                            <div id="flag" class="renewal-advance" aria-hidden="true">
                                                                Renewal
                                                            </div>
                                                            <div class="col-lg-3 d-flex align-items-center">
                                                                <img src="http://ebook.bitrexgo.id/assetsebook/v2/img/1.png" class="mx-auto d-block">
                                                            </div>
                                                            <input type="text" id="advance-value" hidden>
                                                            <div class="col-lg-9">
                                                                <h2 class="mb-0" style="color: #8543da;" id="advance"></h2>
                                                                <br>
                                                                <h5 style="color:black" id="advance-description"></h5><br>
                                                                <a href="#" data-toggle="modal" data-target="#buy" class="btn btn-danger btn-sm mt-3 px-5" id="cart2">BUY</a>
                                                                <a href="{{route('member.ebook.referral', ['type' => 'advance', 'username' => isset($profile->username) ? $profile->username : $profile['username']])}}" class="btn btn-danger btn-sm mt-3 px-5" id="view2">VIEW</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('footer_scripts')
<style>
    div#flag { 
        background-color: #333;
        padding: 10px;
        font-size: 11px !important;
        border-radius: 2px;
        -ms-transform: rotate(40deg); /* IE 9 */
        -webkit-transform: rotate(40deg); /* Safari 3-8 */
        transform: rotate(40deg);
        width: 60px;
        position: absolute;
        right:0;
        top:4;
    }
</style>  
<script type="text/javascript">
    $(document).ready(function () {
        $('#cart1').click(function(){
            $('#id').val($('#basic-value').val());
        });

        $('#cart2').click(function(){
            $('#id').val($('#advance-value').val());
        });

        $.ajax({
			type: 'GET',
			url: '{{route("member.select.ebook")}}',
			success: function (data) {
				for (let index = 0; index < data.length; index++) {
                    if(index == 0){
                        data[index].id = 3 ? $('#basic').text(data[index].title.replace('_', ' ')) : $('#basic').text(data[index].title) ;
                        data[index].id = 3 ? $('.renewal-basic').show() : $('.renewal-basic').hide() ;
                        $('#description-basic').text(data[index].description);
                        $('#basic-value').val(data[index].id);
                    }else{
                        data[index].id = 4 ? $('#advance').text(data[index].title.replace('_', ' ')) : $('#advance').text(data[index].title);
                        $('#advance-description').text(data[index].description);
                        $('#advance-value').val(data[index].id);
                    }
                }
			},
			error: function() { 
				console.log("Error");
			}
        });
    });
</script>
@stop