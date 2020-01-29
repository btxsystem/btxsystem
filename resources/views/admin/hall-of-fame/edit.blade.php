@extends('layouts.admin')

@section('title')
Edit Hall Of Fame
@parent
@stop

@section('content')

<section class="content-header">
    <h1> Hall Of Fame</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Hall Of Fame</a>
        </li>
        <li class="active">Edit Data Hall Of Fame</li>
    </ol>

    <div class="container">
            <table class="table table-striped">
               <tbody>
                  <tr>
                     <td colspan="1">
                        <form class="well form-horizontal" method="post" action="{{route('hall-of-fame.update', [$hallOfFame->id])}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                           <fieldset>


                            <div class="form-group">
                                <label class="col-md-2 control-label">Member</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <select name="parent_id" id="parent_id" class="form-control">
                                        <option value="{{$hallOfFame->member_id}}" selected="selected">{{$employeer->username}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Title</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <textarea id="desc" name="desc" placeholder="Description" cols="10" rows="5" class="form-control" required="true">{{$hallOfFame->desc}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-8 inputGroupContainer">
                                       <button type="submit" class="btn btn-primary btn-block">Submit</button>
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
<!--section ends-->
<section class="content">

@stop

@section('footer_scripts')
    <script>
        $(document).ready(function () {
            $('#parent_id').select2({
                width: '510%',
                placeholder: "Choose member...",
                ajax: {
                    url: '{{route('select.sponsor')}}',
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
            $('#parent_id').trigger('change');

        });
    </script>
@stop
