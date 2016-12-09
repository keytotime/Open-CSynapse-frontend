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