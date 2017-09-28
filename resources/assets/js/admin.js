require('chart.js');
(function ($) {
    function initCharts() {
        $("canvas[data-target='chartjs']").each(function () {
            let title = $(this).attr('chartjs-title') ? $(this).attr('chartjs-title') : '';
            let type = $(this).attr('chartjs-type') ? $(this).attr('chartjs-type') : 'bar';
            let labels = JSON.parse($(this).attr('chartjs-labels'));
            let data = JSON.parse($(this).attr('chartjs-data'));
            let options = JSON.parse($(this).attr('chartjs-options') ? $(this).attr('chartjs-options') : '{}');
            let defaultOptions = {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        }
                    }]
                }
            };
            let config = {
                type: type,
                data: {
                    labels: labels,
                    datasets: [{
                        label: title,
                        data: data,
                        backgroundColor: 'rgba(82,118,142,0.2)',
                        borderColor: 'rgba(82,118,142,1)',
                        borderWidth: 1
                    }]
                },
                options: $.extend(true, {}, defaultOptions, options)
            };
            let ctx = this.getContext("2d");
            new Chart(ctx, config);
        });
    }

    initCharts();
})(jQuery);