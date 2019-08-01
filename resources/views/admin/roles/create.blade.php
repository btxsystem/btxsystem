@extends('layouts.admin')

@section('title')
    Add Role
    @parent
@stop

@section('content')
<section class="content-header">
        <h1>Add Roles</h1>
        <ol class="breadcrumb">
            <li>
                <a href="">Admin Management</a>
            </li>
            <li class="active">Add Roles</li>
        </ol>
    
        <div class="container">
                <table class="table table-striped">
                   <tbody>
                      <tr>
                         <td colspan="1">
                         <form action="{{ route('admin.admin-management.roles.store') }}" class="well form-horizontal" method="POST" enctype="multipart/form-data"> 
                            <fieldset>
                                    <div class="form-group">
                                    <label class="col-md-2 control-label">Title</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                                            <input id="title" name="title" placeholder="Title" class="form-control" required="true" value="" type="text">
                                        </div>
                                    </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label"></label>
                                        <div class="col-md-8 inputGroupContainer">
                                            <span class="btn btn-info btn-sm select-all">Select all</span>
                                            <span class="btn btn-danger btn-sm deselect-all">Deselect all</span>
                                        </div>        
                                    </div>

                                    <div class="form-group">                
                                    <label class="col-md-2 control-label">Permissions</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            <select name="permissions[]" id="permissions" class="form-control select2" multiple="multiple" required="true">
    
                                            </select>
                                        </div>
                                    </div>
                                    </div>
                                                                            
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"></label>
                                        <div class="col-md-8 inputGroupContainer">
                                            <button type="submit" class="btn btn-primary btn-block">Add</button>
                                        </div>
                                    </div>
                                                                
                
                               </fieldset>
                            </form>
                         </td>
                      </tr>
                   </tbody>
                </table>
             </div>
    </section>
    
    <script type="text/javascript">
        $(document).ready(function() {    
            $('#permissions').select2({
            placeholder: "Choose permissions...",
            ajax: {
                url: '{{ route("select.permissions") }}',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    console.log(data);
                    
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
        });
    </script>
@endsection