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
            $('#clock-basic').countdown(data.basic.expired_at, function(event) {
                $(this).html(event.strftime('%D days %H:%M:%S'));
            });
            $('#clock-advance').countdown(data.advance.expired_at, function(event) {
                $(this).html(event.strftime('%D days %H:%M:%S'));
            });
        }
    })

    $.ajax({
        type: 'GET',
        url: '{{route("member.select.ebook")}}',
        success: function (data) {
            for (let index = 0; index < data.length; index++) {
                if(index == 0){
                    var str = data[index].id == 3 ? data[index].title.replace('renewal_', ' ') : data[index].title ;
                    str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                        return letter.toUpperCase();
                    });
                    $('#basic').text(str);
                    data[index].id == 3 ? $('.renewal-basic').show() : $('.renewal-basic').hide() ;
                    $('#description-basic').text(data[index].description);
                    $('#basic-value').val(data[index].id);
                    price_basic = data[index].price;
                }else{
                    var str = data[index].id == 4 ? data[index].title.replace('renewal_', ' ') : data[index].title ;
                    str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                        return letter.toUpperCase();
                    });
                    $('#advance').text(str);
                    data[index].id == 4 ? $('.renewal-advance').show() : $('.renewal-advance').hide() ;
                    $('#advance-description').text(data[index].description);
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