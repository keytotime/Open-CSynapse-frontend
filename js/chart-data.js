$(function () {
  var chart;
  $(document).ready(function() {
    chart = new Highcharts.Chart({
        chart: {
            renderTo: 'scatterplot',
            type: 'scatter',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },    
        title: {
            text: ''
        },
        exporting: { 
            enabled: false 
        },
        credits: {
            enabled: false
        },
        xAxis: {
            title: {
                enabled: false,
                text: 'Height (cm)'
            },
            startOnTick: true,
            endOnTick: true,
            showLastLabel: true
        },
        yAxis: {
            title: {
                enabled: false,
                text: 'Weight (kg)'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            y: 60,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF',
            borderWidth: 0
        },
        plotOptions: {
            scatter: {
                marker: {
                    radius: 5,
                    states: {
                        hover: {
                            enabled: true,
                            lineColor: 'rgb(100,100,100)'
                        }
                    }
                },
                states: {
                    hover: {
                        marker: {
                            enabled: false
                        }
                    }
                },
                tooltip: {
                    headerFormat: '<b>{series.name}</b><br>',
                    pointFormat: '{point.x}, {point.y}'
                }
            }
        },
        series: scatterdata
    });
});

});

$(function () {
  var chart;
  $(document).ready(function() {
    chart = new Highcharts.Chart({
        chart: {
            renderTo: 'runspeed',
            type: 'column',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },    
        title: {
            text: ''
        },
        exporting: { 
            enabled: false 
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories: [
                'Training Time',
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                enabled: true,
                text: 'Seconds'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} Seconds</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: speeddata
    });
});

});

$(function () {
  var chart;
  $(document).ready(function() {
    chart = new Highcharts.Chart({
        chart: {
            renderTo: 'accuracy',
            type: 'column',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },    
        title: {
            text: ''
        },
        exporting: { 
            enabled: false 
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories: [
                'Accuracy',
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                    enabled: false,
                text: ''
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}%</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: accuracydata
    });
});

});