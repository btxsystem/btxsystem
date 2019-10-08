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
    
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card product-report">
                <div class="body table-responsive">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="l-turquoise">
                                <th>RANK</th>
                                <th>LEFT</th>
                                <th>MIDLE</th>
                                <th>RIGHT</th>
                                <th>REWARDS</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ranks as $key => $rank)
                                @if ($key%2==0)
                                    <tr class="xl-blue">
                                        <td><img src="{{url('img/1'.$key.'.png')}}" style="width: 60px; border-radius: 50%;"></td>
                                        <td>{{$rank->pv_needed_left}}</td>
                                        <td>{{$rank->pv_needed_midle}}</td>
                                        <td>{{$rank->pv_needed_right}}</td>
                                        <td>{{$rewards[$key]->description}}</td>
                                        <td class="reward reward-status-{{$key}}">
                                        </td>
                                    </tr>
                                @else
                                    <tr class="xl-turquoise">
                                        <td><img src="{{url('img/1'.$key.'.png')}}" style="width: 60px; border-radius: 50%;"></td>
                                        <td>{{$rank->pv_needed_left}}</td>
                                        <td>{{$rank->pv_needed_midle}}</td>
                                        <td>{{$rank->pv_needed_right}}</td>
                                        <td>{{$rewards[$key]->description}}</td>
                                        <td class="reward reward-status-{{$key}}">
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('footer_scripts')  
<script type="text/javascript">
    let claim = (e) => {
        $('.reward').hide();
        $.ajax({
            url: '{{route("member.claim-reward")}}',
            data: { "_token": "{{ csrf_token() }}", "id": e},
            success:function(data){
                location.reload();
                $('.reward').show();
            }
        });
    }

    $(document).ready(function () {
        let over = 0;
        this.disabled=false;
        $.ajax({
            url: '{{route("member.select.reward-claim")}}',
            data: data,
            success:function(data){
                let leng = Object.keys(data).length;
                if (leng <= 8 && leng > 0) {
                    over ++;
                    $.each(data, function(i, item){
                        if (item.status == 2) {
                            $('.reward-status-'+i).html('<button type="button" style="cursor:no-drop" class="btn btn-success fa fa-check">Claimed</button>');
                        }else if(item.status == 1){
                            $('.reward-status-'+i).html('<button type="button" style="cursor:no-drop" class="btn btn-secondary">Waiting approval</button>');
                        }else if(item.status == 0){
                            $('.reward-status-'+i).html('<button type="button" style="cursor:pointer" class="btn btn-primary" onclick="claim('+item.reward_id+')">Claim</button>');
                        }
                    });
                }else if(leng > 8){
                    $.each(data, function(i, item){
                        if (item.status == 2) {
                            $('.reward-status-'+i).html('<button type="button" style="cursor:no-drop" class="btn btn-success fa fa-check">Claimed</button>');
                        }else if(item.status == 1){
                            $('.reward-status-'+i).html('<button type="button" style="cursor:no-drop" class="btn btn-secondary">Waiting approval</button>');
                        }else if(item.status == 0){
                            $('.reward-status-'+i).html('<button type="button" style="cursor:pointer" class="btn btn-primary" onclick="claim('+item.reward_id+')">Claim</button>');
                        }
                    });
                }else{
                    for (let index = 0; index < 8; index++) {
                        $('.reward-status-'+index).html('<button type="button" style="cursor:no-drop" class="btn btn-secondary">Unlock</button>');
                    }
                }        
            }
        });
    });
</script>
@stop