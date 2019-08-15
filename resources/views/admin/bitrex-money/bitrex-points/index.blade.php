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
        <li class="active">Bitrex Points</li>
    </ol>
</section>
    <section class="content">                
    <div class="row">
        <div class="col-md-12">
        <a href="#myDemoModal" role="button" class="btn btn-large btn-success" data-toggle="modal"><i class="fa fa-money" style="margin-right: 10px;"></i>Topup</a>    
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

    <div id="myDemoModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Topup</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('bitrex-money.topup') }}" class="well form-horizontal">
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Username</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <select name="name" id="username" class="form-control" required="true" value=""></select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Nominal</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-piggy-bank"></i></span><input id="nominal" name="nominal" placeholder="Nominal" class="form-control" required="true" value="" type="text"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Description</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span><textarea name="description" id="description" cols="30" rows="10" placeholder="Description" class="form-control" required="true" value=""></textarea></div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-success">
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="detail" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title name_trx"></h4>
                    </div>
                    <div class="modal-body">
                            <fieldset>
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="livicon" data-name="permissions" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                                </div>
                                            </div>
                                            
                                            <div class="portlet-body flip-scroll">
                                                <table class="table data-table table-bordered table-striped table-condensed flip-content detail" >
                                                    <thead class="flip-content">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nominal</th>
                                                            <th>Points</th>
                                                            <th>Description</th>
                                                            <th>Transaction Date</th>
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
                url: "{{ route('bitrex-money.points') }}", 
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
        $.ajax({
               type:'GET',
               url: id+'/detail/username',
               data: {
                   _token : '<?php echo csrf_token() ?>',
                   id: id,
               },
               success:function(data) {
                  $('.name_trx').html("<b>"+data.text+"</b> - <b>"+data.id+"</b>");
               }
        });

        var table = $('.detail').DataTable({
              destroy: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: id+"/detail"
              },
              
              columns: [
                  {
                      data: 'DT_RowIndex', name: 'DT_RowIndex', 
                      orderable: false, searchable: false
                  },
                  {data: 'nominal', name: 'nominal'},
                  {data: 'points', name: 'points'},
                  {data: 'description', name: 'description', searchable: false},
                  {data: 'transaction_date', name: 'transaction_date', orderable: false, searchable: false},
              ]    
        });
        
    };
      </script>
@stop
