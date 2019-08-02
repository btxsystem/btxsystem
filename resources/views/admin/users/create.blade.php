@extends('layouts.admin')
@section('content')

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

<section class="content-header">
    <!--section starts-->
    <h1>Add User</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">User</a>
        </li>
        <li>
            <a href="#">User Management</a>
        </li>
        <li class="active">Add User</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary" style="margin-top: 15px;">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="livicon" data-name="form" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                User Registration
                            </div>
                        </div>

        <div class="portlet-body flip-scroll">
        <form class="form-horizontal" action="{{ route("admin.admin-management.users.store") }}" method="POST">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label class="col-md-2 control-label" for="name">{{ trans('global.user.fields.name') }}</label>
                <div class="col-md-8">
                   <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($user) ? $user->name : '') }}">
                   </div>
                    @if($errors->has('name'))
                    <em class="text-danger">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                </div>
                <p class="helper-block">
                    {{ trans('global.user.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label class="col-md-2 control-label" for="email">{{ trans('global.user.fields.email') }}</label>
                <div class="col-md-8">
                   <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}">
                   </div>
                        @if($errors->has('email'))
                            <em class="text-danger">
                                {{ $errors->first('email') }}
                            </em>
                        @endif
                </div>
                        <p class="helper-block">
                            {{ trans('global.user.fields.email_helper') }}
                        </p>
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label class="col-md-2 control-label" for="password">{{ trans('global.user.fields.password') }}</label>
                <div class="col-md-8">
                   <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                   <input type="password" id="password" name="password" class="form-control">
                   </div>
                        @if($errors->has('password'))
                            <em class="text-danger">
                                {{ $errors->first('password') }}
                            </em>
                        @endif
                </div>
                <p class="helper-block">
                    {{ trans('global.user.fields.password_helper') }}
                </p>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Roles</label>
                <div class="col-md-8 inputGroupContainer">
                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-eye"></i></span>
                        <select id="js-example-basic-single" class="col-md-12" name="roles">
                            @foreach($roles as $id => $roles)
                                <option value="{{ $id }}" {{ old('roles') == $id ? 'selected' : '' }}>
                                    {{ $roles }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('roles'))
                        <strong class="text-danger">{{ $errors->first('roles') }}</strong>
                    @endif
                </div>
                <p class="helper-block">
                    {{ trans('global.user.fields.roles_helper') }}
                </p>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</section>

@endsection


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