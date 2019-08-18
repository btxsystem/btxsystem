@extends('layouts.admin')
{{-- Page title --}}
@section('title')
Event
@parent
@stop
{{-- Page content --}}
@section('content')
	<section class="content-header">
    <!--section starts-->
    <h1>Event</h1>
    <ol class="breadcrumb">
        <li>
            <a href="/">Admin</a>
        </li>
        <li class="active">Event</li>
    </ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="chart" id="example">
					
				</div>

				<!-- <div class="chart" id="basic-example"></div> -->
			</div>
		</div>
	</section>

<section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <a href="" class="btn btn-primary"><i class="fa fa-plus" style="margin-right: 10px;"></i>Add</a>
                        <div class="portlet box primary" style="margin-top: 15px;">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="livicon" data-name="permissions" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    Event Table
                                </div>
                            </div>
                            
                            <div class="portlet-body flip-scroll">
                                <table class="table data-table table-bordered table-striped table-condensed flip-content" >
                                    <thead class="flip-content">
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
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
@stop