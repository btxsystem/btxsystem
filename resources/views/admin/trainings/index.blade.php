@extends('layouts.admin')

{{-- Page title --}}
@section('title')
    Training
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
	<link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />

    <!-- end of page level css-->
@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
    <!--section starts-->
    <h1>Users</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Training</a>
        </li>
        <li class="active">Training Management</li>
    </ol>
</section>
<!--section ends-->
<section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <a href="{{ route('trainings.create') }}" class="btn btn-primary"><i class="fa fa-plus" style="margin-right: 10px;"></i>Add</a>
                        <div class="portlet box primary" style="margin-top: 15px;">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="livicon" data-name="permissions" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    Training Management Table
                                </div>
                            </div>

                            <div class="portlet-body flip-scroll">
                                <table class="table data-table table-bordered table-striped table-hover table-condensed flip-content" >
                                    <thead class="flip-content">
                                        <tr>
                                            <th>No</th>
                                            <th>Location</th>
                                            <th>Start Training</th>
                                            <th>Price</th>
                                            <th>Capacity</th>
                                            <th>Note</th>
                                            <th>Open</th>
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

            <form id="delete-form" action="" method="POST" style="display:none;">
                @csrf
                {{ method_field('DELETE') }}
                <button type="submit"></button>
            </form>

@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.responsive.js') }}" ></script>
    <script src="{{ asset('assets/js/pages/table-responsive.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
          var table = $('.data-table').DataTable({
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('trainings.index') }}",
              },

              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'location', name: 'location'},
                  {data: 'start_training', name: 'start_training'},
                  {data: 'price', name: 'price'},
                  {data: 'capacity', name: 'capacity'},
                  {data: 'note', name: 'note'},
                  {data: 'open', name: 'open'},

                {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });

        });
      </script>
      <script>
        function deleteTraining(id) {
            var result = confirm("are you sure delete this data ?")
            if (result) {
                event.preventDefault();
                $('#delete-form').attr("action", window.location.href + '/' + id);
                $('#delete-form').submit();
            }
        }
      </script>
@stop
