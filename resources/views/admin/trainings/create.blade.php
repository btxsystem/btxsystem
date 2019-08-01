@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Add Training
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
	<link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- end of page level css-->
    <style>
        body {
            background : #ddd;
        }
    </style>
@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
    <!--section starts-->
    <h1>Add Training</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Training</a>
        </li>
        <li>
            <a href="#">Training Management</a>
        </li>
        <li class="active">Add Training</li>
    </ol>
</section>
<section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box primary" style="margin-top: 15px;">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="livicon" data-name="form" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    Training Registration
                                </div>
                            </div>

                    <div class="portlet-body flip-scroll">
                    <form class="form-horizontal" action="{{ route('admin.trainings.store') }}" method="post">
                        @csrf
                              <div class="form-group">
                                 <label class="col-md-2 control-label">Location</label>
                                 <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                        <textarea class="from-control" name="location" id="location" rows="5" cols="90" required="true">{{ old('location') }}</textarea>
                                    </div>

                                    @if ($errors->has('location'))
                                        <strong class="text-danger">{{ $errors->first('location') }}</strong>
                                    @endif

                                 </div>
                              </div>
                              <div class="form-group">
                                    <label class="col-md-2 control-label">Start Training</label>
                                    <div class="col-md-8 inputGroupContainer">
                                       <div class="input-group">
                                           <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                           <input id="start_training" name="start_training" placeholder="Start Training" class="form-control" required="true" value="{{ old('start_training') }}" type="date">
                                       </div>

                                    @if ($errors->has('start_training'))
                                        <strong class="text-danger">{{ $errors->first('start_training') }}</strong>
                                    @endif

                                    </div>
                                 </div>

                              <div class="form-group">
                                    <label class="col-md-2 control-label">Price</label>
                                    <div class="col-md-8 inputGroupContainer">
                                       <div class="input-group">
                                           <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                           <input id="price" name="price" placeholder="Price" class="form-control" required="true" value="{{ old('price') }}" type="text">
                                       </div>

                                    @if ($errors->has('price'))
                                        <strong class="text-danger">{{ $errors->first('price') }}</strong>
                                    @endif

                                    </div>
                                 </div>

                              <div class="form-group">
                                 <label class="col-md-2 control-label">Capacity</label>
                                 <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                        <input id="capacity" name="capacity" placeholder="Capacity" class="form-control" required="true" value="{{ old('capacity') }}" type="text">
                                    </div>
                                    
                                    @if ($errors->has('capacity'))
                                        <strong class="text-danger">{{ $errors->first('capacity') }}</strong>
                                    @endif

                                 </div>
                              </div>

                              <div class="form-group">
                                 <label class="col-md-2 control-label">Note</label>
                                 <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
                                        <textarea class="from-control" name="note" id="note" rows="5" cols="90" required="true">{{ old('note') }}</textarea>
                                    </div>
                                    @if ($errors->has('note'))
                                        <strong class="text-danger">{{ $errors->first('note') }}</strong>
                                    @endif
                                 </div>
                              </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Open</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-eye"></i></span>
                                            <select id="js-example-basic-single" class="col-md-12" name="open">
                                                <option value="0" {{ old('open') == 0 ? 'selected' : '' }}>No</option>
                                                <option value="1" {{ old('open') == 1 ? 'selected' : '' }}>Yes</option>
                                            </select>
                                        </div>
                                        @if ($errors->has('open'))
                                            <strong class="text-danger">{{ $errors->first('open') }}</strong>
                                        @endif
                                    </div>
                                </div>

                        <div class="form-group">
                         <div class="col-md-3">                        .
                            <button type="submit" class="btn btn-primary pull-right">Submit</button>
                         </div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.responsive.js') }}" ></script>
    <script src="{{ asset('assets/js/pages/table-responsive.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
    <script>
    // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
                $('#js-example-basic-single').select2();
            });
    </script>
@stop
