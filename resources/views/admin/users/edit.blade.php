@extends('layouts.admin')
@section('content')

{{-- Page title --}}
@section('title')
Add Training
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <style>
        body {
            background : #ddd;
        }
    </style>
@stop

<section class="content-header">
    <!--section starts-->
    <h1>Edit User</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">User</a>
        </li>
        <li>
            <a href="#">User Management</a>
        </li>
        <li class="active">Edit User</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary" style="margin-top: 15px;">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="livicon" data-name="form" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                Edit User
                            </div>
                        </div>

        <div class="portlet-body flip-scroll">
        <form class="form-horizontal" action="/admin/admin-management/users/{{ $user->id }}" method="POST">
            @csrf
            @method('PUT')
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
                   <div class="input-group"></div>
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
                <label class="col-md-2 control-label" for="password">New Password</label>
                <div class="col-md-8">
                   <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                   <input type="password" id="password" name="password" class="form-control" value="{{ old('password') }}">
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
                                <option value="{{ $id }}" {{ $id ? 'selected' : '' }}>
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
    <script>
    // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
                $('#js-example-basic-single').select2();
            });
    </script>
@stop