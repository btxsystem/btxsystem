@extends('layouts.admin')

@section('title')
Throttle
@parent
@stop

@section('content')

<section class="content-header">
    <h1>Throttle </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Login</a>
        </li>
        <li class="active">Throttle </li>
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
                                    Throttle
                                </div>
                            </div>
                            
                            <div class="portlet-body flip-scroll">
                                <table class="table data-table table-bordered table-striped table-condensed flip-content" >
                                    <thead class="flip-content">
                                        <tr>
                                            <th>No</th>
                                            <th class="text-center">IP Address</th>
                                            <th>Total Fail</th>
                                            <th>Locked To</th>
                                            <th>Log Time</th>
                                            <th>Action</th>
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
          url: "{{ route('login-throttle.index') }}", 
        },
        
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'ip_address', name: 'ip_address'},
            {data: 'total_fail', name: 'total_fail'},
            {data: 'locked_at', name: 'locked_at'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });

  $(document).on('click', '.btn-remove', function (e) {
      e.preventDefault();
      let url = $(this).attr('href');
      
      swal({
          title: "Are you sure delete this data permanently?",
          type: "error",
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes!",
          showCancelButton: true,
      }, function() {
        window.location.href = url
      });
  });

  $(document).on('click', '.block-access', function (e) {
      e.preventDefault();
      let url = $(this).attr('href');

      swal({
          title: "Are you sure block this IP ?",
          type: "error",
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes!",
          showCancelButton: true,
      }, function() {
        window.location.href = url
      });
  });

  $(document).on('click', '.unblock-access', function (e) {
      e.preventDefault();
      let url = $(this).attr('href');

      swal({
          title: "Are you sure unblock this IP ?",
          type: "error",
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes!",
          showCancelButton: true,
      }, function() {
        window.location.href = url
      });
  });

  let deleteRole = (id) => {
      $("#deleteRoleForm").attr('action','roles/'+id);
      $('#myModal').modal('show')
  }
</script>
      
@endsection
