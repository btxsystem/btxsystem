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
                         <form action="{{ route('admin-management.roles.store') }}" class="well form-horizontal" method="POST" enctype="multipart/form-data">
                            @csrf
                            <fieldset>
                                    <div class="form-group">
                                    <label class="col-md-2 control-label">Role Name</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                                            <input id="role" name="title" placeholder="Role Name" class="form-control" required="true" value="" type="text">
                                        </div>
                                    </div>
                                    </div>

                                    <label class="col-md-2 control-label">Permissions</label>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-md-8 inputGroupContainer">
                                            <ul id="tree">
                                                <li>
                                                    <label>
                                                        <input type="checkbox" name="permissions[]" value="1" />Dashboard
                                                    </label>
                                                </li>
                                                <li>
                                                    <label>
                                                        <input type="checkbox" name="permissions[]" value="2" />Category Ebook
                                                    </label>
                                                    <ul>
                                                        <li>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="3" />List
                                                            </label>
                                                            <ul>
                                                                <li>
                                                                    <label>
                                                                        <input type="checkbox" name="permissions[]" value="4" />Detail
                                                                    </label>
                                                                </li>
                                                                <li>
                                                                    <label>
                                                                        <input type="checkbox" name="permissions[]" value="5" />Edit
                                                                    </label>
                                                                </li>
                                                                <li>
                                                                    <label>
                                                                        <input type="checkbox"/>Ebook
                                                                    </label>
                                                                    <ul>
                                                                        <li>
                                                                            <label>
                                                                                <input type="checkbox" name="permissions[]" value="6" />Add
                                                                            </label>
                                                                        </li>
                                                                        <li>
                                                                            <label>
                                                                                <input type="checkbox" name="permissions[]" value="7" />Edit
                                                                            </label>
                                                                        </li>
                                                                        <li>
                                                                            <label>
                                                                                <input type="checkbox" name="permissions[]" value="8" />View
                                                                            </label>
                                                                        </li>
                                                                        <li>
                                                                            <label>
                                                                                <input type="checkbox" name="permissions[]" value="9" />Delete
                                                                            </label>
                                                                        </li>
                                                                        <li>
                                                                            <label>
                                                                                <input type="checkbox" />Lesson
                                                                            </label>
                                                                            <ul>
                                                                                <li>
                                                                                    <label>
                                                                                        <input type="checkbox" name="permissions[]" value="10"/>Add
                                                                                    </label>
                                                                                </li>
                                                                                <li>
                                                                                    <label>
                                                                                        <input type="checkbox" name="permissions[]" value="11"/>Edit
                                                                                    </label>
                                                                                </li>
                                                                                <li>
                                                                                    <label>
                                                                                        <input type="checkbox" name="permissions[]" value="12"/>View
                                                                                    </label>
                                                                                </li>
                                                                                <li>
                                                                                    <label>
                                                                                        <input type="checkbox" name="permissions[]" value="13"/>Delete
                                                                                    </label>
                                                                                </li>
                                                                            </ul>
                                                                        </li>

                                                                        <li>
                                                                            <label>
                                                                                <input type="checkbox" />Image
                                                                            </label>
                                                                            <ul>
                                                                                <li>
                                                                                    <label>
                                                                                        <input type="checkbox" name="permissions[]" value="14"/>Add
                                                                                    </label>
                                                                                </li>
                                                                                <li>
                                                                                    <label>
                                                                                        <input type="checkbox" name="permissions[]" value="15"/>Edit
                                                                                    </label>
                                                                                </li>
                                                                                <li>
                                                                                    <label>
                                                                                        <input type="checkbox" name="permissions[]" value="16"/>Delete
                                                                                    </label>
                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                <li>
                                                                    <label>
                                                                        <input type="checkbox"/>Video
                                                                    </label>
                                                                    <ul>
                                                                        <li>
                                                                            <label>
                                                                                <input type="checkbox" name="permissions[]" value="17" />Add
                                                                            </label>
                                                                        </li>
                                                                        <li>
                                                                            <label>
                                                                                <input type="checkbox" name="permissions[]" value="18" />Edit
                                                                            </label>
                                                                        </li>
                                                                        <li>
                                                                            <label>
                                                                                <input type="checkbox" name="permissions[]" value="19" />View
                                                                            </label>
                                                                        </li>
                                                                        <li>
                                                                            <label>
                                                                                <input type="checkbox" name="permissions[]" value="20" />Delete
                                                                            </label>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="21"/>Members
                                                        </label>
                                                        <ul>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="22"/>Members Active
                                                                </label>
                                                                <ul>
                                                                    <li>
                                                                        <label>
                                                                            <input type="checkbox" name="permissions[]" value="24"/>Add
                                                                        </label>
                                                                    </li>
                                                                    <li>
                                                                        <label>
                                                                            <input type="checkbox" name="permissions[]" value="25"/>Topup
                                                                        </label>
                                                                    </li>
                                                                    <li>
                                                                        <label>
                                                                            <input type="checkbox" name="permissions[]" value="26"/>Edit
                                                                        </label>
                                                                    </li>
                                                                </ul>
                                                                <li>
                                                                    <label>
                                                                        <input type="checkbox" name="permissions[]" value="23"/>Members Inactive
                                                                    </label>
                                                                </li>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="31" />Customer
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="38" />Tree
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="43" />Claim Rewards
                                                        </label>
                                                    </li>
                                                </li>
                                            </ul>
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
    <style>
        ul{
            list-style-type: none;
        }
    </style>
    <script src="{{asset('assets/js/treeView.js')}}"></script>

    <script type="text/javascript">
        $('#tree').checktree();
        $(document).ready(function() {
            $('#permissions').select2({
            placeholder: "Choose permissions...",
            ajax: {
                url: '{{ route("select.permissions") }}',
                dataType: 'json',
                data: function (params) {
                    console.log('masuk');

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
    </script>
@endsection
