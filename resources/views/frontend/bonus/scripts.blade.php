@section('footer_scripts')
    <script>
        $(document).ready(function () {
            $.ajax({
                url: '{{route("member.select.bonus")}}',
                data: data,
                success:function(data){
                    $('.total-commission').text(addCommas(data.total.nominal == null ? 0 : data.total.nominal));
                    $('.bonus-sponsor').text(addCommas(data.sponsor.nominal == null ? 0 : data.sponsor.nominal));
                    $('.bonus-sales-profit').text(addCommas(data.profit.nominal == null ? 0 : data.profit.nominal));
                    $('.bonus-pairing').text(addCommas(data.pairing.nominal == null ? 0 : data.pairing.nominal));
                    $('.bonus-rewards').text(addCommas(data.rewards.nominal == null ? 0 : data.rewards.nominal));
                    $('.bonus-event').text(addCommas(data.event.nominal == null ? 0 : data.event.nominal));
                }
            });
        });
    </script>
@stop