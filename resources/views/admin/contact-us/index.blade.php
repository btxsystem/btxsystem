@extends('layouts.admin')

@section('title')
List Of Contact US
@parent
@stop

@section('content')

<section class="content-header">
    <h1>Contact US </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Contact US</a>
        </li>
        <li class="active">Contact US </li>
    </ol>
</section>
<section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box primary" style="margin-top: 15px;">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    Contact US Table
                                </div>
                            </div>
                            
                            <div class="portlet-body flip-scroll">
                                <table class="table data-table table-bordered table-striped table-condensed flip-content" >
                                    <thead class="flip-content">
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Message</th>
                                            <th>Time</th>
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
        function deleteCont(id) {
            swal({
                title: "are you sure delete this data?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes!",
                showCancelButton: true,
                },
                function() {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                    $.ajax(
                    {
                        url: "/backoffice/contact-us/delete/"+id,
                        type: 'delete', // replaced from put
                        dataType: "JSON",
                        data: {
                            "id": id // method and token not needed in data
                        },
                        success: function (response)
                        {
                            table.draw();
                            swal("Data has been deleted!", {
                                icon: "success",
                            });
                        },
                        error: function(xhr) {
                            swal("Data cant delete!");
                        }
                    });
            });
        }
        $(document).ready(function () {
          var table = $('.data-table').DataTable({
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('contact-us.index') }}", 
              },
              
              columns: [
                  {
                      data: 'DT_RowIndex', name: 'DT_RowIndex', 
                      orderable: false, searchable: false
                  },
                  {data: 'name', name: 'name'},
                  {data: 'email', name: 'email'},                  
                  {data: 'message', name: 'message'},                   
                  {data: 'created_at', name: 'created_at'},              
                  {data: 'action', name: 'action'},                   
              ]
          });
          
        });
       
      </script>
@stop
