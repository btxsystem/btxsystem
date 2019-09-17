@extends('frontend.default')
@section('title')
    My Rewards
    @parent
@stop
@section('content')
<section class="content ecommerce-page">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>My Rewards
                <small class="text-muted">Bitrexgo</small>
                </h2>
            </div>
        </div>
    </div>
    <div class="body table-responsive">
        <table class="table table-condensed">
            <thead>
                <tr class="l-red">
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Class name</th>
                </tr>
            </thead>
            <tbody>
                <tr class="l-red">
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>.l-pink</td>
                </tr>
                <tr class="l-turquoise">
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>.l-turquoise</td>
                </tr>
                <tr class="l-parpl">
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>.l-parpl</td>
                </tr>
                <tr class="l-blue">
                    <th scope="row">4</th>
                    <td>Larry</td>
                    <td>Jellybean</td>
                    <td>.l-blue</td>
                </tr>
                <tr class="l-blush">
                    <th scope="row">5</th>
                    <td>Larry</td>
                    <td>Kikat</td>
                    <td>.l-blush</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
@stop

@section('footer_scripts')  
<script type="text/javascript">
    $(document).ready(function () {
        $.ajax({
            url: '{{route("member.select.reward")}}',
            data: data,
            success:function(data){
                console.log(data);         
            }
        });
    });
</script>
@stop