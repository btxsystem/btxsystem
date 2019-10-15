@extends('layouts.admin')
{{-- Page title --}}
@section('title')
List Of Verification npwp
@parent
@stop
{{-- Page content --}}
@section('content')

<section class="content-header">
    <!--section starts-->
    <h1>Verification NPWP</h1>
    <ol class="breadcrumb">
        <li class="active">Verification NPWP</li>
    </ol>
</section>
<!--section ends-->
<div id="detail" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Verification NPWP Confirmation</h4>
            </div>
            <div class="modal-body">
                <fieldset>
                    <center><b id="info-verif"></b></center>
                </fieldset>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="verification">Verification</button>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary" style="margin-top: 15px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="card" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Verification NPWP Table
                    </div>
                </div>
                
                <div class="portlet-body flip-scroll">
                    <table class="table npwp-table table-bordered table-striped table-condensed flip-content" >
                        <thead class="flip-content">
                            <tr>
                                <th>Username</th>
                                <th>Name</th>
                                <th>NPWP</th>
                                <th style="width:5px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
            <!-- BEGIN SAMPLE TABLE PORTLET-->
        </div>
    </div>
</section>
@extends('admin.verif-npwp.scripts')
@stop

