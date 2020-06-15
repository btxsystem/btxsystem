@extends('layouts.admin')

@section('title')
Activity Logs
@parent
@stop

@section('content')

<section class="content-header">
    <h1>Activity Logs </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Activity</a>
        </li>
        <li class="active">Logs </li>
    </ol>
</section>
<section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <div class="portlet box primary" style="margin-top: 15px;">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="livicon" data-name="notebook" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    Activity Logs
                                </div>
                            </div>
                            
                            <div class="portlet-body flip-scroll">
                                <table class="table data-table table-bordered table-striped table-condensed flip-content" >
                                    <thead class="flip-content">
                                        <tr>
                                            <th>No</th>
                                            <th class="text-center">Log Name</th>
                                            <th class="text-center">Log From</th>
                                            <th class="text-center">IP Address</th>
                                            <th class="text-center">User Agent</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Log Time</th>
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
    var table = $('.data-table').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('activity.index') }}", 
        },
        
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'action_name', name: 'action_name'},
            {data: 'action_from', name: 'action_from'},
            {data: 'ip_address', name: 'ip_address'},
            {data: 'user_agent', name: 'user_agent'},
            {data: 'status', name: 'status'},
            {data: 'created_at', name: 'created_at'},
        ]
    });
  });

  let deleteRole = (id) => {
      $("#deleteRoleForm").attr('action','roles/'+id);
      $('#myModal').modal('show')
  }
</script>
      
@endsection
