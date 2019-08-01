@extends('layouts.admin')
@section('content')


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
        <form class="form-horizontal" action="{{ route("admin.users.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label class="col-md-2 control-label" for="name">{{ trans('global.user.fields.name') }}</label>
                <div class="col-md-8">
                   <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($user) ? $user->name : '') }}">
                   </div>
                    @if($errors->has('name'))
                    <em class="invalid-feedback">
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
                            <em class="invalid-feedback">
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
                       <span class="input-group-addon"><i class="glyphicon glyphicon-password"></i></span>
                        <input type="password" id="password" name="password" class="form-control">
                   </div>
                        @if($errors->has('password'))
                            <em class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </em>
                        @endif
                </div>
                <p class="helper-block">
                    {{ trans('global.user.fields.password_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                <label class="col-md-2 control-label" for="roles">{{ trans('global.user.fields.roles') }}*
                    <span class="btn btn-info btn-xs select-all">Select all</span>
                    <span class="btn btn-info btn-xs deselect-all">Deselect all</span></label>
                <div class="col-md-8">
                   <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <select name="roles[]" id="roles" class="form-control select2" multiple="multiple">
                            @foreach($roles as $id => $roles)
                                <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>
                                    {{ $roles }}
                                </option>
                            @endforeach
                        </select>
                   </div>
                        @if($errors->has('roles'))
                            <em class="invalid-feedback">
                                {{ $errors->first('roles') }}
                            </em>
                        @endif
                </div>
                <p class="helper-block">
                    {{ trans('global.user.fields.roles_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
</div>
</div>
</section>

@endsection