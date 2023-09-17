{{--

/**
*
* Created a new component <x-rtl.widgets._w-chart-one/>.
*
*/

--}}


<div class="widget widget-chart-one">
    <div class="widget-heading">
        <h5 class="">{{$title}}</h5>
{{--        <div class="task-action">--}}
{{--            <div class="dropdown">--}}
{{--                <a class="dropdown-toggle" href="#" role="button" id="revenue" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>--}}
{{--                </a>--}}
{{--                <div class="dropdown-menu left" aria-labelledby="revenue" style="will-change: transform;">--}}
{{--                    <a class="dropdown-item" href="javascript:void(0);">Weekly</a>--}}
{{--                    <a class="dropdown-item" href="javascript:void(0);">Monthly</a>--}}
{{--                    <a class="dropdown-item" href="javascript:void(0);">Yearly</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <div class="widget-content">
        <div id="revenueYearly"></div>
    </div>
</div>

<script>
    window.addEventListener("load", function(){
        try {

            var Theme = 'light';

            Apex.tooltip = {
                theme: Theme
            }

            var options1 = {
                chart: {
                    fontFamily: 'Nunito, sans-serif',
                    height: 365,
                    type: 'area',
                    zoom: {
                        enabled: false
                    },
                    dropShadow: {
                        enabled: true,
                        opacity: 0.2,
                        blur: 10,
                        left: -7,
                        top: 22
                    },
                    toolbar: {
                        show: false
                    },
                },
                colors: ['#1b55e2', '#e7515a'],
                dataLabels: {
                    enabled: false
                },
                markers: {
                    discrete: [{
                        seriesIndex: 0,
                        dataPointIndex: 7,
                        fillColor: '#000',
                        strokeColor: '#000',
                        size: 5
                    }, {
                        seriesIndex: 2,
                        dataPointIndex: 11,
                        fillColor: '#000',
                        strokeColor: '#000',
                        size: 4
                    }]
                },
                subtitle: {
                    text: {{$total}} +'€',
                    align: 'left',
                    margin: 0,
                    offsetX: 120,
                    offsetY: 20,
                    floating: false,
                    style: {
                        fontSize: '18px',
                        color:  '#4361ee'
                    }
                },
                title: {
                    text: 'Total Revenue',
                    align: 'left',
                    margin: 0,
                    offsetX: -10,
                    offsetY: 20,
                    floating: false,
                    style: {
                        fontSize: '18px',
                        color:  '#0e1726'
                    },
                },
                stroke: {
                    show: true,
                    curve: 'smooth',
                    width: 2,
                    lineCap: 'square'
                },
                series: [{
                    name: '2022',
                    data: [{{$previousYearTotalToString}}]
                }, {
                    name: '2023',
                    data: [{{$thisYearTotalToString}}]
                }],
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                xaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    crosshairs: {
                        show: true
                    },
                    labels: {
                        offsetX: 0,
                        offsetY: 5,
                        style: {
                            fontSize: '12px',
                            fontFamily: 'Nunito, sans-serif',
                            cssClass: 'apexcharts-xaxis-title',
                        },
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function(value, index) {
                            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")  + 'K'
                        },
                        offsetX: -15,
                        offsetY: 0,
                        style: {
                            fontSize: '12px',
                            fontFamily: 'Nunito, sans-serif',
                            cssClass: 'apexcharts-yaxis-title',
                        },
                    }
                },
                grid: {
                    borderColor: '#e0e6ed',
                    strokeDashArray: 5,
                    xaxis: {
                        lines: {
                            show: true
                        }
                    },
                    yaxis: {
                        lines: {
                            show: false,
                        }
                    },
                    padding: {
                        top: -50,
                        right: 0,
                        bottom: 0,
                        left: 5
                    },
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    offsetY: -50,
                    fontSize: '16px',
                    fontFamily: 'Quicksand, sans-serif',
                    markers: {
                        width: 10,
                        height: 10,
                        strokeWidth: 0,
                        strokeColor: '#fff',
                        fillColors: undefined,
                        radius: 12,
                        onClick: undefined,
                        offsetX: -5,
                        offsetY: 0
                    },
                    itemMargin: {
                        horizontal: 10,
                        vertical: 20
                    }

                },
                tooltip: {
                    theme: Theme,
                    marker: {
                        show: true,
                    },
                    x: {
                        show: false,
                    }
                },
                fill: {
                    type:"gradient",
                    gradient: {
                        type: "vertical",
                        shadeIntensity: 1,
                        inverseColors: !1,
                        opacityFrom: .19,
                        opacityTo: .05,
                        stops: [100, 100]
                    }
                },
                responsive: [{
                    breakpoint: 575,
                    options: {
                        legend: {
                            offsetY: -50,
                        },
                    },
                }]
            }

            var chart1 = new ApexCharts(
                document.querySelector("#revenueYearly"),
                options1
            );

            chart1.render();

            document.querySelector('.theme-toggle').addEventListener('click', function() {
                chart1.updateOptions({
                    colors: ['#1b55e2', '#e7515a'],
                    subtitle: {
                        style: {
                            color:  '#4361ee'
                        }
                    },
                    title: {
                        style: {
                            color:  '#0e1726'
                        }
                    },
                    grid: {
                        borderColor: '#e0e6ed',
                    }
                })
            })
        } catch(e) {
            console.log(e);
        }
    })
</script>
