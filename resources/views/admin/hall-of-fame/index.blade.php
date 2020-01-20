@extends('layouts.admin')
{{-- Page title --}}
@section('title')
Hall Of Fame
@parent
@stop
{{-- Page content --}}
@section('content')
	<section class="content-header">
    <!--section starts-->
    <h1>Hall Of Fame</h1>
    <ol class="breadcrumb">
        <li>
            <a href="/">Admin</a>
        </li>
        <li class="active">Hall Of Fame</li>
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
                    <a href="{{route('hall-of-fame.create')}}" class="btn btn-primary"><i class="fa fa-plus" style="margin-right: 10px;"></i>Add</a>
                        <div class="portlet box primary" style="margin-top: 15px;">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="livicon" data-name="permissions" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    Hall Of Fame Table
                                </div>
                            </div>

                            <div class="portlet-body flip-scroll">
                                <table class="table data-table table-bordered table-striped table-condensed flip-content" >
                                    <thead class="flip-content">
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Rank</th>
                                            <th>Description</th>
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

@section('footer_scripts')
<script type="text/javascript">
    $(document).ready(function () {
        var table = $('.data-table').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
            url: "{{ route('hall-of-fame.index') }}",
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', className: "text-center", orderable: false, searchable: false },
                { data: 'username', name: 'username', className: "text-center" },
                { data: 'rank', name: 'rank', className: "text-center" },
                { data: 'desc', name: 'desc', className: "text-center" },
                { data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center" },
            ]
        });

    });
</script>
@endsection
