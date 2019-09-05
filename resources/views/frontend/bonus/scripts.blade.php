@section('footer_scripts')
    <script>
        $(document).ready(function () {
            $.ajax({
                url: '{{route("member.bonus.index")}}',
                data: data,
                success:function(data){
                    $('.bonus-sponsor').text(addCommas(data.sponsor.nominal == null ? 0 : data.sponsor.nominal));
                    $('.bonus-sales-profit').text(addCommas(data.profit.nominal == null ? 0 : data.profit.nominal));
                    $('.bonus-pairing').text(addCommas(data.pairing.nominal == null ? 0 : data.pairing.nominal));
                }
            });
        });
    </script>
@stop