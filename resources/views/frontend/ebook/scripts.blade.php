@section('footer_scripts')
<script type="text/javascript">
var price_basic = 0;
var price_advance = 0;
var cek = 0;
var disable = false;
$(document).ready(function () {
    $.ajax({
        type: 'GET',
        url: '{{route("member.select.bitrex-points")}}',
        success: function (data) {
            cek = price_basic != 0 ? price_basic : price_advance;
            cek = cek / 1000;
            btrx_points = data.bitrex_points;
            if (cek < btrx_points) {
                $('#bp').attr('disabled',true);
                disable = true;
            }else{
                $('#pay').attr('type','submit');
            }
        },
        error: function() {
            console.log("Error");
        }
    });

    $('#cart1').click(function(){
        $('#id').val($('#basic-value').val());
        $('#my-bp').attr('value', 'Bitrex Points: '+addCommas(btrx_points));
        $('#price').attr('value', 'Price: IDR '+addCommas(price_basic));
    });

    $('#cart2').click(function(){
        $('#id').val($('#advance-value').val());
        $('#price').attr('value', 'Price: IDR '+addCommas(price_advance));
    });

    $('input[type=radio][name=payment]').change(function() {
        if (this.value == 0) {
            $('#pay').attr('type','submit');
        }else{
            $('#pay').attr('type','submit');
        };
    });

    $.ajax({
        url: '{{route("member.select.expired-ebook")}}',
        data: data,
        success:function(data){
            if (data.basic) {
                $('#clock-basic').countdown(data.basic.expired_at, function(event) {
                    //$(this).html(event.strftime('%D days %H:%M:%S'));
                    $(this).html(`
                      <div id="clockdiv" class="clockdiv mt-2">
        								<div>
        									<span class="days">${event.strftime('%D')}</span>
        									<div class="smalltext">Days</div>
        								</div>
        								<div>
        									<span class="hours">${event.strftime('%H')}</span>
        									<div class="smalltext">Hours</div>
        								</div>
        								<div>
        									<span class="minutes">${event.strftime('%M')}</span>
        									<div class="smalltext">Minutes</div>
        								</div>
        								<div>
        									<span class="seconds">${event.strftime('%S')}</span>
        									<div class="smalltext">Seconds</div>
        								</div>
        							</div>
                    `)
                });
            }
            if (data.advance) {
                    $('#clock-advance').countdown(data.advance.expired_at, function(event) {
                    //$(this).html(event.strftime('%D days %H:%M:%S'));
                    $(this).html(`
                      <div id="clockdiv" class="clockdiv mt-2">
        								<div>
        									<span class="days">${event.strftime('%D')}</span>
        									<div class="smalltext">Days</div>
        								</div>
        								<div>
        									<span class="hours">${event.strftime('%H')}</span>
        									<div class="smalltext">Hours</div>
        								</div>
        								<div>
        									<span class="minutes">${event.strftime('%M')}</span>
        									<div class="smalltext">Minutes</div>
        								</div>
        								<div>
        									<span class="seconds">${event.strftime('%S')}</span>
        									<div class="smalltext">Seconds</div>
        								</div>
        							</div>
                    `)
                });
            }

        }
    })

    $.ajax({
        type: 'GET',
        url: '{{route("member.select.ebook")}}',
        success: function (data) {
            for (let index = 0; index < data.length; index++) {
                if(index == 0){
                    var str = data[index].id == 3 ? data[index].title.replace('renewal_', ' ') + ' + Intermediate' : data[index].title + ' + Intermediate' ;
                    str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                        return letter.toUpperCase();
                    });
                    $('#basic').text(str);
                    data[index].id == 3 ? $('#cart1').text('REFEAT ORDER') : $('#cart1').text('BUY') ;

                    if(parseInt($( window ).width()) < 992) {
                      $('#view1').addClass('btn-block')
                      $('#cart1').addClass('btn-block')
                    }

                    $(window).on('resize', function(){
                      if(parseInt($(this).width()) < 992) {
                        $('#view1').addClass('btn-block')
                        $('#cart1').addClass('btn-block')
                      } else {
                        $('#view1').removeClass('btn-block')
                        $('#cart1').removeClass('btn-block')
                      }
                    })

                    $('#description-basic').html(data[index].description);
                    $('#basic-value').val(data[index].id);
                    price_basic = data[index].price;
                }else{
                    var str = data[index].id == 4 ? data[index].title.replace('renewal_', ' ') : data[index].title ;
                    str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                        return letter.toUpperCase();
                    });
                    $('#advance').text(str);
                    data[index].id == 4 ? $('#cart2').text('REFEAT ORDER') : $('#cart2').text('BUY') ;

                    if(parseInt($( window ).width()) < 992) {
                      $('#view2').addClass('btn-block')
                      $('#cart2').addClass('btn-block')
                    }

                    $(window).on('resize', function(){
                      if(parseInt($(this).width()) < 992) {
                        $('#view2').addClass('btn-block')
                        $('#cart2').addClass('btn-block')
                      } else {
                        $('#view2').removeClass('btn-block')
                        $('#cart2').removeClass('btn-block')
                      }
                    })

                    $('#advance-description').html(data[index].description);
                    $('#advance-value').val(data[index].id);
                    price_advance = data[index].price;
                }
            }
        },
        error: function() {
            console.log("Error");
        }
    });
});
</script>
@stop
