@extends('layouts.admin')
{{-- Page title --}}
@section('title')
List Of Credit Card
@parent
@stop
{{-- Page content --}}
@section('content')

<section class="content-header">
    <!--section starts-->
    <h1>Users</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#" class="active">List Credit Card</a>
        </li>
    </ol>
</section>
<!--section ends-->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary" style="margin-top: 15px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="permissions" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        List Credit Card Table
                    </div>
                </div>

                <div class="portlet-body flip-scroll">
                    <table class="table data-table table-bordered table-striped table-condensed flip-content" >
                        <thead class="flip-content">
                            <tr>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Description</th>
                                <th>Nominal</th>
                                <th>No Ref</th>
                                <th>Status</th>
                                <th>Date</th>
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

{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript">
    $(document).ready(function () {
      var table = $('.data-table').DataTable({
          destroy: true,
          processing: true,
          serverSide: true,
          ajax: {
            url: "{{ route('list-cc') }}",
          },

          columns: [
              {data: 'fullname', name: 'fullname'},
              {data: 'username', name: 'username'},
              {data: 'description', name: 'description'},
              {data: 'nominal', name: 'nominal'},
              {data: 'transaction_ref', name: 'transaction_ref'},
              {data: 'status', name: 'status'},
              {data: 'date', name: 'date'},
          ]
      });

    });
</script>
@stop
