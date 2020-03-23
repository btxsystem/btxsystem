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

                    <div class="col-md-12">
                        <div class="portlet box primary" style="margin-top: 15px;">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="livicon" data-name="permissions" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    Members
                                </div>
                            </div>

                            <div class="portlet-body flip-scroll">
                                <table class="table data-member table-bordered table-striped table-condensed flip-content" >
                                    <thead class="flip-content">
                                        <tr>
                                            <th>No</th>
                                            <th>ID Member</th>
                                            <th>Username</th>
                                            <!-- <th>Name</th> -->
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Rank</th>
                                            <th>Show Member</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
@stop

@section('footer_scripts')
<script type="text/javascript">
    $(document).ready(function () {
        load_member()
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

    function load_member(from_date = '', to_date = ''){
        $('.data-member').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('members.active.hof') }}",
                data:{from_date:from_date, to_date:to_date}
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'id_member', name: 'id_member'},
                { data: 'username', name: 'username'},
                // { data: 'first_name', name: 'first_name', "render": function(data, type, row){
                //     if ( type === "sort" || type === 'type' ) {
                //         return data
                //     } else {
                //         return row.full_name
                //     }
                // }},
                { data: 'first_name', name: 'first_name'},
                { data: 'last_name', name: 'last_name'},
                { data: 'ranking', name: 'rank.name', orderable: false },
                { data: 'show_hall_of_fame', name: 'show_hall_of_fame', searchable: false, className: 'text-center', "render": function(data, type, row) {
                    if ( type === "sort" || type === 'type' ) {
                        return data
                    } else {
                        let checkbox;
                    
                        if(row.show_hall_of_fame) {
                            checkbox = `<div class="checkbox">
                                <label><input type="checkbox" onclick="toggle_member(`+row.id+`, 'hide')" checked></label>
                            </div>`;
                        } else {
                            checkbox = `<div class="checkbox">
                                <label><input type="checkbox" onclick="toggle_member(`+row.id+`, 'show')"></label>
                            </div>`;
                        }
                        return checkbox;
                    }
                }},
            ]
        });
    }

    function refresh_table() {
        $('.data-member').DataTable().ajax.reload()
    }

    function toggle_member(id, type) {
        var url =   "{{url('backoffice/members/active/hof/update')}}"
        swal({
            title: type == 'hide' ? "Apakah anda yakin akan menghapus member ini dari Hall of Fame ?" : 'Apakah anda yakin akan menampilkan member ini dari Hall of Fame ?',
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes!",
            showCancelButton: true,
        },
        function() {
            $.ajax({
                type: "POST",
                url: url,
                data: {id:id, type: type},
                success: function (data) {
                    refresh_table()
                }
            });
        });
    }
</script>
@endsection
