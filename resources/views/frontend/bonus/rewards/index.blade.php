@extends('frontend.default')
@section('title')
    History bonus rewards
    @parent
@stop
@section('content')
<section class="content ecommerce-page">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h2>History Bonus Rewards
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
@extends('frontend.bonus.rewards.scripts')
@stop
