@extends('layouts.admin')

@section('title')
Detail Video
@parent
@stop

@section('content')

<section class="content-header">
    <h1> Video</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Video Management</a>
        </li>
        <li class="active">Detail Data Video</li>
    </ol>

    <div class="container">
            <table class="table table-striped">
               <tbody>
                  <tr>
                  <td colspan="1">
                    <div class="well form-horizontal">
                     <fieldset>
                        <div class="pull-right">
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


@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript">

       
      </script>
@stop
