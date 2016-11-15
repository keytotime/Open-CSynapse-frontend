$(function() {
    var chart;
    $(document).ready(function() {

        function getPointsFromArrays(xData, yData, labelList) {
            var pointsData = {};
            for (var i = 0; i < xData.length; i++) {
                var label = labelList[i];
                if (pointsData.hasOwnProperty(label)) {
                    pointsData[label].push([xData[i], yData[i]]);
                } else {
                    pointsData[label] = [
                        [xData[i], yData[i]]
                    ];
                }

            }

            var final = [];
            for (var x in pointsData) {
                if (pointsData.hasOwnProperty(x)) {
                    final.push({ name: x, data: pointsData[x] })
                }
            }
            // group by label
            return final;
        }

        function updateSeries(newData) {

            // remove old series
            while (chart.series.length > 0) {
                chart.series[0].remove(false);
            }

            // add new series
            newData.forEach(function(d) {
                chart.addSeries(d, false);
            })
            chart.redraw();
        }

        // Check to see if there is header data
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'scatterplot2d',
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
                    enabled: true,
                    text: ''
                },
                startOnTick: true,
                endOnTick: true,
                showLastLabel: true
            },
            yAxis: {
                title: {
                    enabled: true,
                    text: ''
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

        // Build selector menus if header points exist
        if (headerPoints !== '' && labels != '' && regressionData != '') {

            console.log(regressionData);

            function addToLookup(d, keyOne, keyTwo, data) {
                if (d.hasOwnProperty(keyOne)) {
                    d[keyOne][keyTwo] = data;
                } else {
                    var toAdd = {};
                    toAdd[keyTwo] = data;
                    d[keyOne] = toAdd;
                }
                if (d.hasOwnProperty(keyTwo)) {
                    d[keyTwo][keyOne] = data;
                } else {
                    var toAdd = {};
                    toAdd[keyOne] = data;
                    d[keyTwo] = toAdd;
                }
            }

            function roundToThree(val){
                return Math.round(val * 1000) / 1000;
            }

            var regressionLookup = {};
            // Double sided lookup for regression data
            regressionData.forEach(function(d) {
                addToLookup(regressionLookup, d.h1, d.h2, { p: roundToThree(d.p), r: roundToThree(d.r), rSquared: roundToThree(d.rSquared) });
            });

            var featureMenusOpen = false;

            var topMenu = ['<div class="pull-right">',
                '<div class="btn-group">',
                '<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">',
                '<span id="graphType">All Features</span>',
                '<span class="caret"></span>',
                '</button>',
                '<ul class="dropdown-menu pull-right" role="menu">',
                '<li><a class="graph-select" href="javascript:void(0)">All Features</a></li>',
                '<li><a class="graph-select" href="javascript:void(0)">Two Features</a></li>',
                '</ul>',
                '</div>'
            ].join('\n');


            var firstHeader = headerPoints[0].header;
            var secondHeader = headerPoints[1].header;

            // get list of all the headers
            var headerList = headerPoints.map(function(d) {
                return '<li><a class="x-select" href="javascript:void(0)">' + d.header + '</a></li>';
            });

            var menu = ['<div class="pull-left graph-menu">',
                    'X-Axis:',
                    '<div class="btn-group">',
                    '<button  type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">',
                    '<span id="xAxis">' + firstHeader + '</span>',
                    '<span class="caret"></span>',
                    '</button>',
                    '<ul class="dropdown-menu pull-right" role="menu">'
                ].concat(headerList)
                .concat(['</ul>', '</div>']);

            // get list of all the headers
            var headerListTwo = headerPoints.map(function(d) {
                return '<li><a class="y-select" href="javascript:void(0)">' + d.header + '</a></li>';
            });

            // get initial regression data
            var first = regressionLookup[firstHeader][secondHeader];

            var initReg = ' r: ' + first.r + ' rSquared:' + first.rSquared + ' p:' + first.p;
            var menuTwo = ['<div class="pull-left graph-menu left-space">',
                    'Y-Axis:',
                    '<div class="btn-group">',
                    '<button  type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">',
                    '<span id="yAxis">' + secondHeader + '</span>',
                    '<span class="caret"></span>',
                    '</button>',
                    '<ul class="dropdown-menu pull-right" role="menu">'
                ].concat(headerListTwo)
                .concat(['</ul>', '<span class="left-space" id="regInfo">' + initReg + '</span></div>']);

            // Build easier look up
            var headers = {};

            headerPoints.forEach(function(d) {
                headers[d.header] = d.values;
            });

            $('#scatterHeader').append(topMenu);

            $('.graph-select').click(function(value) {
                if ($(value.target).text() === 'All Features') {
                    if (featureMenusOpen) {
                        $('#multi-dimension').show();
                        $('.graph-menu').remove();
                        featureMenusOpen = false;
                        // Put graph back to normal
                        chart.xAxis[0].update({
                            title: {
                                text: ''
                            }
                        });

                        chart.yAxis[0].update({
                            title: {
                                text: ''
                            }
                        });
                        updateSeries(scatterdata);
                    }
                } else {
                    if (!featureMenusOpen) {
                        $('#multi-dimension').hide();
                        featureMenusOpen = true;
                        $('#scatter-body').append(menu.join('\n'));
                        $('#scatter-body').append(menuTwo.join('\n'));

                        // Change graph data to default choices
                        var xData = headers[firstHeader];
                        var yData = headers[secondHeader];

                        var pointsData = getPointsFromArrays(xData, yData, labels);
                        // Set data
                        updateSeries(pointsData);

                        chart.xAxis[0].update({
                            title: {
                                text: firstHeader
                            }
                        });

                        chart.yAxis[0].update({
                            title: {
                                text: secondHeader
                            }
                        });

                        $('.y-select').click(function(value) {
                            var option = $(value.target).text();
                            var newY = headers[option];
                            var xText = $('#xAxis').text();
                            var currentX = headers[xText];

                            var regressionInfo = '';
                            if(option !== xText){
                                var newRegInfo = regressionLookup[option][xText];
                                regressionInfo = ' r: ' + newRegInfo.r + ' rSquared:' + newRegInfo.rSquared + ' p:' + newRegInfo.p;
                            }

                            var pointsData = getPointsFromArrays(currentX, newY, labels);
                            updateSeries(pointsData);

                            // update y axis
                            chart.yAxis[0].update({
                                title: {
                                    text: option
                                }
                            });

                            $('#yAxis').text(option);
                            $('#regInfo').text(regressionInfo);
                        });

                        $('.x-select').click(function(value) {
                            var option = $(value.target).text();
                            var yText = $('#yAxis').text();

                            var newX = headers[option];
                            var currentY = headers[yText];

                            var regressionInfo = '';
                            if(option !== yText){
                                var newRegInfo = regressionLookup[option][yText];
                                regressionInfo = ' r: ' + newRegInfo.r + ' rSquared:' + newRegInfo.rSquared + ' p:' + newRegInfo.p;
                            }

                            var pointsData = getPointsFromArrays(newX, currentY, labels);
                            updateSeries(pointsData);

                            // update y axis
                            chart.xAxis[0].update({
                                title: {
                                    text: option
                                }
                            });

                            $('#xAxis').text(option);
                            $('#regInfo').text(regressionInfo);
                        });
                    }
                }
                $('#graphType').text($(value.target).text());
            });
        }
    });

});
