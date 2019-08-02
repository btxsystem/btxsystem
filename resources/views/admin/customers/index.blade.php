@extends('layouts.admin')

@section('title')
List Of Users Active
@parent
@stop

@section('content')

<section class="content-header">
    <h1>Customer </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Customer</a>
        </li>
        <li class="active">Customer </li>
    </ol>
</section>
<section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <a class="btn btn-large btn-primary" href="{{ route('admin.customer.create') }}" data-toggle="modal"><i class="fa fa-plus" style="margin-right: 10px;"></i>Add</a>
                        <div class="portlet box primary" style="margin-top: 15px;">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    Customer  Table
                                </div>
                            </div>
                            
                            <div class="portlet-body flip-scroll">
                                <table class="table data-table table-bordered table-striped table-condensed flip-content" >
                                    <thead class="flip-content">
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Password</th>
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
                url: "{{ route('admin.customer.index') }}", 
              },
              
              columns: [
                  {
                      data: 'DT_RowIndex', name: 'DT_RowIndex', 
                      orderable: false, searchable: false
                  },
                  {data: 'name', name: 'name'},
                  {data: 'username', name: 'username'},                  
                  {data: 'email', name: 'email'},                  
                  {data: 'password', name: 'password'},             
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });
          
        });
        function hapusData(row) {
             row        = JSON.parse(row);
             var result = confirm("hapus ... ?"); 
             var data   = $("#del"+row.id).serializeArray();
            if (result) {
                $.ajax({
                    type    : "POST", 
                    url     : window.location.href + '/' + row.id, 
                    data    : data,
                    dataType: "json",      
                    success : function(response)  
                    {

                        alert('Data Has Deleted');
                        window.location.reload();

                    }   
                });
            }  
        }
      </script>
@stop
