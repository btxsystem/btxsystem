@extends('frontend.default')
@section('title')
    My Sponsor
    @parent
@stop
@section('content')
<section class="content ecommerce-page">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h2>My Sponsor
                <small class="text-muted">Bitrexgo</small>
                </h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12" id="bill">
                <table id="my-sponsor" class="display nowrap" style="width:100%; font-size:15px">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Phone Number</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@extends('frontend.team-report.my-sponsor.scripts')
@stop
