
    /**
     * Get histogram data out of xy data
     * @param   {Array} data  Array of tuples [x, y]
     * @param   {Number} step Resolution for the histogram
     * @returns {Array}       Histogram data
     */
    function histogram(data, step) {
        var histo = {},
            x,
            i,
            arr = [];

        // Group down
        for (i = 0; i < data.length; i++) {
            x = Math.floor(data[i][0] / step) * step;
            if (!histo[x]) {
                histo[x] = 0;
            }
            histo[x]++;
        }

        // Make the histo group into an array
        for (x in histo) {
            if (histo.hasOwnProperty((x))) {
                arr.push([parseFloat(x), histo[x]]);
            }
        }

        // Finally, sort the array
        arr.sort(function (a, b) {
            return a[0] - b[0];
        });

        return arr;
    }

    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Contributions to Candidates'
        },
        xAxis: {
            gridLineWidth: 1
        },
        yAxis: [{
            title: {
                text: 'Contribution Frequency'
            }
        }, {
            opposite: true,
            title: {
                text: 'Contribution Amount'
            }
        }],
        series: [{
            name: 'Histogram',
            type: 'column',
            data: histogram(data, 1000),
            pointPadding: 0,
            groupPadding: 0,
            pointPlacement: 'between'
        }, {
            name: 'Contribution data',
            type: 'scatter',
            data: data,
            yAxis: 1,
            marker: {
                radius: 1.5
            }
        }]
    });
