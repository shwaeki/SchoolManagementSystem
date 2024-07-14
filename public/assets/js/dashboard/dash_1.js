window.addEventListener("load", function () {
    "use strict"

    var Theme = 'dark';

    Apex.tooltip = {
        theme: 'dark'
    }

    var PaymentsAndPruchasesOptions = {
        chart: {
            height: 300,
            type: 'line',
            toolbar: {
                show: false,
            }
        },
        colors: ['#622bd7', '#ffbb44'],
        dataLabels: {
            enabled: false
        },
        legend: {
            position: 'bottom',
            horizontalAlign: 'center',
            fontSize: '14px',
            markers: {
                width: 10,
                height: 10,
                offsetX: -5,
                offsetY: 0
            },
            itemMargin: {
                horizontal: 10,
                vertical: 8
            }
        },
        grid: {
            borderColor: '#e0e6ed',
        },
        stroke: {
            show: true,
            width: 3, // Adjust stroke width for better visibility
            curve: 'smooth' // Smooth lines for a line chart
        },
        series: [{
            name: 'مبيعات',
            data: totalPayments
        }, {
            name: 'مدفوعات',
            data: totalPurchases
        }],
        xaxis: {
            categories: months,
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: Theme,
                type: 'vertical',
                shadeIntensity: 0.3,
                inverseColors: false,
                opacityFrom: 1,
                opacityTo: 0.8,
                stops: [0, 100]
            }
        },
        tooltip: {
            marker: {
                show: false,
            },
            theme: Theme,
            y: {
                formatter: function (val) {
                    return val;
                }
            }
        },
        responsive: [
            {
                breakpoint: 767,
                options: {
                    stroke: {
                        width: 2 // Adjust stroke width for smaller screens
                    }
                }
            },
        ]
    };

    new ApexCharts(
        document.querySelector("#PaymentsAndPruchases"),
        PaymentsAndPruchasesOptions
    ).render();

    const ps = new PerfectScrollbar(document.querySelector('.mt-container'));

});
