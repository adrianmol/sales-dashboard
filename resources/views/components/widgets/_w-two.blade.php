{{--

/**
*
* Created a new component <x-rtl.widgets._w-two/>.
*
*/

--}}


<div class="widget-two">
    <div class="widget-content">
        <div class="w-chart">
            <div id="daily-sales"></div>
        </div>
    </div>
</div>

<script>
    window.addEventListener("load", function(){
        try {
            var options = {
                series: [{
                    name: 'Subtotal',
                    data: [{{$thisYearSubTotalToString}}],
                }, {
                    name: 'Tax',
                    data: [{{$thisYearTaxToString}}]
                }, {
                    name: 'BlackMoney',
                    data: [{{$thisYearTaxToString}}]
                }],
                colors: ['#622bd7', '#ffbb44', '#de1111'],
                chart: {
                    type: 'bar',
                    height: 450,
                    stacked: true,

                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        legend: {
                            position: 'bottom',
                            offsetX: -10,
                            offsetY: 0
                        }
                    }
                }],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        borderRadius: 10,
                        dataLabels: {
                            total: {
                                enabled: true,
                                style: {
                                    fontSize: '13px',
                                    fontWeight: 900
                                }
                            }
                        }
                    },
                },
                xaxis: {
                    tickPlacement: 'on',
                    type: 'category',
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                },
                legend: {
                    position: 'right',
                    offsetY: 40
                },
                fill: {
                    opacity: 1
                }
            };

            var chart = new ApexCharts(document.querySelector("#daily-sales"), options);
            chart.render();

        } catch(e) {
            console.log(e);
        }
    })

</script>
