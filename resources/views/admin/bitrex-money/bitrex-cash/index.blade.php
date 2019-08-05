@extends('layouts/admin')
@section('title')
List Of Bitrex Points
@parent
@stop

@section('content')

<section class="content-header">
    <h1>Bitrex Points</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Bitrex Money</a>
        </li>
        <li class="active">Bitrex Cash</li>
    </ol>
</section>
    <section class="content">                
    <div class="row">
        <div class="col-md-12">
           
        <div class="portlet box primary" style="margin-top: 15px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="permissions" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Bitrex Points Table
                    </div>
                </div>
                
                <div class="portlet-body flip-scroll">
                    <table class="table data-table table-bordered table-striped table-condensed flip-content employee" >
                        <thead class="flip-content">
                            <tr>
                                <th>No</th>
                                <th>Id Member</th>
                                <th>Name</th>
                                <th>Points</th>
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

  
    <div id="detail" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Detail transactions</h4>
                    </div>
                    <div class="modal-body">
                            <fieldset>
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="livicon" data-name="permissions" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                                    Bitrex Cash Table
                                                </div>
                                            </div>
                                            
                                            <div class="portlet-body flip-scroll">
                                                <table class="table data-table table-bordered table-striped table-condensed flip-content" >
                                                    <thead class="flip-content">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Id Member</th>
                                                            <th>Name</th>
                                                            <th>Points</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                            </fieldset>
                            <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    

@stop

@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
          var table = $('.employee').DataTable({
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('admin.bitrex-money.points') }}", 
              },
              
              columns: [
                  {
                      data: 'DT_RowIndex', name: 'DT_RowIndex', 
                      orderable: false, searchable: false
                  },
                  {data: 'id_member', name: 'id_member'},
                  {data: 'username', name: 'username'},
                  {data: 'points', name: 'points', searchable: false},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });

            $('#username').select2({
            placeholder: "Choose username...",
            width:'100%',
            ajax: {
                url: '{{ route("select.username") }}',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    });

    var detail = (id) => {
        console.log(id);      
    };
      </script>
@stop
