@extends('layouts.admin')

@section('title')
{{$data->title}}
@parent
@stop

@section('content')

<section class="content-header">
    <h1>{{$data->title}} Overview </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Ebook </a>
        </li>
        <li class="active">{{$data->title}} </li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            
            <div class="portlet box primary" style="margin-top: 15px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-area-chart"></i> &nbsp;
                        Overview
                    </div>

                    <div class="pull-right">
                        <a style=" color: white; text-decoration: none; margin-right: 20px; !important" href="{{ route('cms.our-products.edit', $data->id) }}"><i style="font-size:15px;" class="fa fa-pencil"></i>&nbsp; &nbsp;<strong>Edit Data</strong></a>
                        <!-- <a data-id="" style=" color: white; text-decoration: none !important"><i style="font-size:15px;" class="fa fa-power-off"></i>&nbsp; &nbsp;<strong>Delete</strong></a> -->
                     
                     </div>
                </div>
                  
                    <div class="col-md-12">
                        <br>
                        <div class="col-md-1">
                            <label class="control-label">Title </label>
                        </div>  
                        <div class="col-md-1">
                            :
                        </div>  
                        <div class="col-md-8">
                          {{($data->title)}}
                        </div>  
                        <br>
                    </div>
                    <div class="col-md-12">
                        <br>
                        <div class="col-md-1">
                            <label class="control-label">Image </label>
                        </div>  
                        <div class="col-md-1">
                            :
                        </div>  
                        <div class="col-md-8">
                            <img src="{{URL::asset($data->img)}}" alt="profile Pic" height="200" width=
                        </div>  
                        <br>
                    </div>
                    <div class="col-md-12">
                        <br>
                        <div class="col-md-1">
                            <label class="control-label">Article </label>
                        </div>  
                        <div class="col-md-1">
                            :
                        </div>  
                        <div class="col-md-8">
                            {!!$data->article !!}
                        </div>  
                        <br>
                    </div>
            </div>
        </div>
    </div>
 </section>

@stop

@section('footer_scripts')
      
@endsection
