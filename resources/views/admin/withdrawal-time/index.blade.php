@extends('layouts.admin')

@section('title')
Withdrawal Time
@parent
@stop

@section('content')

<section class="content-header">
    <h1>Time Withdrawal</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Withdrawal</a>
        </li>
        <li class="active">Time Withdrawal</li>
    </ol>
</section>
<section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <div class="box-body">
            <table id="time-wd" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th class="text-center">Last Withdrawal</th>
                  <th class="text-center">Next Withdrawal</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>

              <tbody>
                @foreach ($times as $key)
                  <tr>
                    <td class="text-center">{{$key->last_withdrawal}}</td>
                    <td class="text-center">{{$key->next_withdrawal}}</td>
                    <td class="text-center">
                      <a data-toggle="modal" data-target="#edit-time-{{ $key->id }}" title="Edit"><i class="fa fa-edit"></i></a>
                    </td>
                  </tr>

                  <div class="modal fade" id="edit-time-{{ $key->id }}">
                    <div class="modal-dialog">
                      <form method="post" action="{{ route('withdrawal-time.update', $key->id) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title"> Withdrawal Time Update</h4>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <center>
                              <label>Last Withdrawal &nbsp;&nbsp;
                                <input id="last_withdrawal" name="last_withdrawal" type="text" style="width:150px" value="{{$key->last_withdrawal}}" class="time ui-timepicker-input" autocomplete="off"></input>
                              </label>
          
                              &nbsp;&nbsp;&nbsp;&nbsp;
          
                              <label>Next Withdrawal &nbsp;&nbsp;
                                <input id="next_withdrawal" name="next_withdrawal" type="text" style="width:150px" value="{{$key->next_withdrawal}}" class="time ui-timepicker-input" autocomplete="off"></input>
                              </label>
                              </center>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                @endforeach
              </tbody>
            </table>
          </div>
                    </div>
                </div>
            </section>

@stop

@section('footer_scripts')
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.js"></script>

<script>
    $("#last_withdrawal").datetimepicker({  
        dateFormat: 'yy-mm-dd',
        timeFormat: 'hh:mm:ss',
    });
    $('#next_withdrawal').datetimepicker({ 
        dateFormat: 'yy-mm-dd',
        timeFormat: 'hh:mm:ss',
    });
</script>

<script type="text/javascript">
        $(document).ready(function () {
          var table = $('#time-wd').DataTable({
              destroy: true,
              processing: true,
              serverSide: false,
              searching: false,
              paging: false,
              info: false,
          });
          
        });
       
      </script>

@stop
