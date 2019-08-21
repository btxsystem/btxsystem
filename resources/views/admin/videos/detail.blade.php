@extends('layouts.admin')

@section('title')
Detail Book
@parent
@stop

@section('content')

<section class="content-header">
    <h1> Book</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Book Management</a>
        </li>
        <li class="active">Detail Data Book</li>
    </ol>

    <div class="container">
            <table class="table table-striped">
               <tbody>
                  <tr>
                  <td colspan="1">
                    <div class="well form-horizontal">
                     <fieldset>
                        <div class="pull-right">
                        <!-- <a href="#addChapterModal" role="button" class="btn btn-large btn-success" data-toggle="modal"><i class="fa fa-plus" style="margin-right: 10px;"></i>Add Chapter</a>  -->
                        </div>
                         <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label class="control-label">Title &nbsp; :</label>
                                <div class="">
                                    <p class="form-control-static">
                                        {{$data->title}}
                                    </p>
                                </div>
                            </div>   

                            <div class="form-group">
                                <label class="control-label">Video &nbsp; :</label>
                                <div class="">
                                    <p class="form-control-static">
                                    <center>
                                    <video width="500" height="350" controls>
                                        <source src="{{URL::asset("$data->path")}}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    </cneter>
                                    </p>
                                </div>
                            </div>                       
                          </div>
                     </fieldset>
                    </div>
                    </td>
                  </tr>
               </tbody>
            </table>
     </div>
</section>
<!--section ends-->
<div id="addChapterModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Book Chapter</h4>
                </div>
                <div class="modal-body">
                    <form class="well form-horizontal" action="{{ route('book-chapter.store') }}" method="post">                    <form class="well form-horizontal" method="post" action="{{route('book-chapter.store')}}">
                        {{ csrf_field() }}
                        <fieldset>
                        <input id="book_id" name="book_id" value="{{$data->id}}" type="hidden">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Title</label>
                                <div class="col-md-9 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-piggy-bank"></i></span>
                                    <input id="title" name="title" placeholder="Title" class="form-control" required="true" value="" type="text">
                                </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript">

       
      </script>
@stop
