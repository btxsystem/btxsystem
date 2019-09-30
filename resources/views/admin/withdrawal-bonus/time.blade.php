@extends('layouts.admin')

@section('title')
List Of Paid Withdrawal
@parent
@stop

@section('content')

<section class="content-header">
    <h1>Paid Withdrawal</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Withdrawal</a>
        </li>
        <li class="active">Paid Withdrawal</li>
    </ol>
</section>
<section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Start Time</th>
                  <th>End Time</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                @foreach ($product as $key)
                  <tr>
                    <td>{{$key->start_time}}</td>
                    <td>{{$key->end_time}}</td>
                    <td>
                      <a data-toggle="modal" data-target="#edit-time-{{ $key->id }}" title="Edit"><i class="fa fa-edit"></i></a>
                    </td>
                  </tr>

                  <div class="modal fade" id="edit-time-{{ $key->id }}">
                    <div class="modal-dialog">
                      <form method="post" enctype="multipart/form-data" action="{{ route('countdown.update', $key->id) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title"> Countdown Update</h4>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <center>
                              <label>Start &nbsp;&nbsp;
                                <input id="start_time" name="start_time" type="text" style="width:100px" value="{{$key->start_time}}" class="time ui-timepicker-input" autocomplete="off"></input>
                              </label>
          
                              &nbsp;&nbsp;&nbsp;&nbsp;
          
                              <label>End &nbsp;&nbsp;
                                <input id="end_time" name="end_time" type="text" style="width:100px" value="{{$key->end_time}}" class="time ui-timepicker-input"a utocomplete="off"></input>
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

<script>
    $('#start_time').timepicker({ 
        showMeridian: false 
      });
    $('#end_time').timepicker({ 
        showMeridian: false  
        });
    </script>

@stop
