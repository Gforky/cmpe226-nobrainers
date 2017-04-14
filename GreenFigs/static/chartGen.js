$(document).ready(function() {
  var blue = "#0055A2", gold = "#E5A823", white = "#ffffff";
// chart of system status
  var sysChartConfig = {
    bindto: '.sysChart',
    data: {
      x : 'x',
      columns: [
        ['x', '2013-01-01', '2013-01-02', '2013-01-03', '2013-01-04', '2013-01-05', '2013-01-06'],
        ['CPU Usage', 0.55, 0.80, 0.70, 0.68, 0.98, 0.88]
      ],
      type: 'bar'
    },
    axis: {
      x: {
        type: 'timeseries',
        tick: {
            format: '%Y-%m-%d'
        }
      },
      y: {
        label: { // ADD
          text: 'CPU Usage',
          position: 'outer-middle'
        },
        tick: {
          format: d3.format(",%") // ADD
        }
      }
    }
  }

  var sysChart = c3.generate(sysChartConfig)

// chart of database status
  var dbChartConfig = {
    bindto: '.dbChart',
    data: {
      x : 'x',
      columns: [['x', 0], ['mattress', 298], ['couch', 276], ['tv-monitor', 198]],
      type : 'pie'
    },
    pie: {
      label: {
        format: function (value, ratio, id) {
          return d3.format('')(value);
        }
      }
    },
    axis: {
      x: {
        type: 'timeseries',
        tick: {
            format: '%Y-%m-%d'
        }
      },
      y: {
        label: { // ADD
          position: 'outer-middle'
        },
        tick: {
          // ADD
        }
      }
    }
  }

  var dbChart = c3.generate(dbChartConfig)

  // chart of neural network status
  var nnChartConfig = {
    bindto: '.nnChart',
    data: {
      x : 'x',
      columns: [
        ['x', '2013-01-01', '2013-01-02', '2013-01-03', '2013-01-04', '2013-01-05', '2013-01-06'],
        ['mattress', 55, 80, 70, 68, 98, 88],
        ['couch', 76, 85, 96, 97, 86, 78],
        ['tv-monitor', 45, 55, 63, 75, 80, 92]
      ],
      groups: []
    },
    axis: {
      x: {
        type: 'timeseries',
        tick: {
            format: '%Y-%m-%d'
        }
      },
      y: {
        label: { // ADD
          text: 'Average Precisions',
          position: 'outer-middle'
        },
        tick: {
          format: d3.format(",%") // ADD
        }
      }
    }
  }

  var nnChart = c3.generate(nnChartConfig)

  // chart of client usage status
  var cuChartConfig = {
    bindto: '.cuChart',
    data: {
      x : 'x',
      columns: [
        ['x', '2013-01-01', '2013-01-02', '2013-01-03', '2013-01-04', '2013-01-05', '2013-01-06'],
        ['mattress', 0.55, 0.80, 0.70, 0.68, 0.98, 0.88],
        ['couch', 0.76, 0.85, 0.96, 0.97, 0.86, 0.78]
      ]
    },
    axis: {
      x: {
        type: 'timeseries',
        tick: {
            format: '%Y-%m-%d'
        }
      },
      y: {
        label: { // ADD
          text: 'Compelted Tasks',
          position: 'outer-middle'
        },
        tick: {
          format: d3.format(",%") // ADD
        }
      }
    }
  }

  var cuChart = c3.generate(cuChartConfig)
  
  // button clicks of System Status Chart
  $(".cpuUsage").click(function() {
    //chart.axis.ticks{x : {format: '%Y-%m-%d'}, y : {format: d3.format(",%")}}
    $.ajax({
      url: '/getCpuUsage',
      type: 'POST',
      success: function(response) {
        console.log(response)
        // convert JSON object into javascript array
        sysChartConfig.axis.y.tick = { format : function (d) { return d + "%"; } }
        sysChart = c3.generate(sysChartConfig)
        sysChart.axis.labels({y : 'CPU Usage'})
        //sysChart.transform('bar');
        sysChart.load({
          columns: $.parseJSON(response), 
          type: 'bar'})
        sysChart.unload({ids: ['Memory Load', 'Network Traffic', 'CPU Temperature']})
      },
      error: function(error) {
        console.log(error)
      }
    })
  })

  $(".memLoad").click(function() {
    //chart.axis.ticks{x : {format: '%Y-%m-%d'}, y : {format: d3.format(",%")}}
    $.ajax({
      url: '/getMemLoad',
      type: 'POST',
      success: function(response) {
        console.log(response)
        // convert JSON object into javascript array
        sysChartConfig.axis.y.tick = { format : function (d) { return d + "%"; } }
        sysChart = c3.generate(sysChartConfig)
        sysChart.axis.labels({y : 'Memory Load'})
        //sysChart.transform('bar');
        sysChart.load({
          columns: $.parseJSON(response), 
          type: 'line'})
        sysChart.unload({ids: ['CPU Usage', 'Network Traffic', 'CPU Temperature']})
      },
      error: function(error) {
        console.log(error)
      }
    })
  })

  $(".netTraff").click(function() {
    //chart.axis.ticks{x : {format: '%Y-%m-%d'}, y : {format: d3.format(",%")}}
    $.ajax({
      url: '/getNetTraff',
      type: 'POST',
      success: function(response) {
        console.log(response)
        // convert JSON object into javascript array
        sysChartConfig.axis.y.tick = { format : function (d) { return d + "MB/s"; } }
        sysChart = c3.generate(sysChartConfig)
        sysChart.axis.labels({y : 'Network Traffic'})
        //sysChart.transform('bar');
        sysChart.load({
          columns: $.parseJSON(response), 
          type: 'line'})
        sysChart.unload({ids: ['CPU Usage', 'Memory Load', 'CPU Temperature']})
      },
      error: function(error) {
        console.log(error)
      }
    })
  })

  $(".cpuTemp").click(function() {
    //chart.axis.ticks{x : {format: '%Y-%m-%d'}, y : {format: d3.format(",%")}}
    $.ajax({
      url: '/getCpuTemp',
      type: 'POST',
      success: function(response) {
        console.log(response)
        // convert JSON object into javascript array
        sysChartConfig.axis.y.tick = { format : function (d) { return d + "ºF"; } }
        sysChart = c3.generate(sysChartConfig)
        sysChart.axis.labels({y : 'CPU Temperature'})
        //sysChart.transform('bar');
        sysChart.load({
          columns: $.parseJSON(response), 
          type: 'line'})
        sysChart.unload({ids: ['CPU Usage', 'Memory Load', 'Network Traffic']})
      },
      error: function(error) {
        console.log(error)
      }
    })
  })

  // button clicks of Database Status Chart
  $(".imgStorage").click(function() {
    //chart.axis.ticks{x : {format: '%Y-%m-%d'}, y : {format: d3.format(",%")}}
    //dbChart.axis.labels({y : 'Image Storage'})
    $.ajax({
      url: '/getImgStorage',
      type: 'POST',
      success: function(response) {
        console.log(response)
        // convert JSON object into javascript array
        //sysChart.transform('bar');
        dbChart.transform('pie')
        dbChart.load({
          columns: $.parseJSON(response), 
          type: 'pie'})
        dbChart.unload({ids: ['Database I/O Traffic', 'Database Queries']})
      },
      error: function(error) {
        console.log(error)
      }
    })
  })

  $(".datasetSize").click(function() {
    //chart.axis.ticks{x : {format: '%Y-%m-%d'}, y : {format: d3.format(",%")}}
    $.ajax({
      url: '/getDatasetSize',
      type: 'POST',
      success: function(response) {
        console.log(response)
        // convert JSON object into javascript array
        //sysChart.transform('bar');
        dbChartConfig.axis.y.tick = { format : function (d) { return d + ""; } }
        dbChartConfig.data = {
          x : 'x',
          columns: $.parseJSON(response),
          groups: [['mattress', 'couch', 'tv-monitor']],
          type: 'bar'
        }
        dbChart = c3.generate(dbChartConfig)
        //nnChart.transform('bar')
        dbChart.axis.labels({ y : 'Dataset Size'})
      },
      error: function(error) {
        console.log(error)
      }
    })
  })

  $(".imgConf").click(function() {
    //chart.axis.ticks{x : {format: '%Y-%m-%d'}, y : {format: d3.format(",%")}}
    $.ajax({
      url: '/getImgConf',
      type: 'POST',
      success: function(response) {
        console.log(response)
        // convert JSON object into javascript array
        //sysChart.transform('bar');
        dbChartConfig.axis.y.tick = { format : function (d) { return d + ""; } }
        dbChartConfig.data = {
          x : 'x',
          columns: $.parseJSON(response),
          groups: [['mattress', 'couch', 'tv-monitor']],
          type: 'bar'
        }
        dbChart = c3.generate(dbChartConfig)
        //nnChart.transform('bar')
        dbChart.axis.labels({ y : 'Images Confirmed'})
      },
      error: function(error) {
        console.log(error)
      }
    })
  })

  $(".upImg").click(function() {
    //chart.axis.ticks{x : {format: '%Y-%m-%d'}, y : {format: d3.format(",%")}}
    $.ajax({
      url: '/getUpImg',
      type: 'POST',
      success: function(response) {
        console.log(response)
        // convert JSON object into javascript array
        //sysChart.transform('bar');
        dbChartConfig.axis.y.tick = { format : function (d) { return d + ""; } }
        dbChartConfig.data = {
          x : 'x',
          columns: $.parseJSON(response),
          groups: [['mattress', 'couch', 'tv-monitor']],
          type: 'bar'
        }
        dbChart = c3.generate(dbChartConfig)
        //nnChart.transform('bar')
        dbChart.axis.labels({ y : 'Images Uploaded'})
      },
      error: function(error) {
        console.log(error)
      }
    })
  })

  $(".dbIO").click(function() {
    //chart.axis.ticks{x : {format: '%Y-%m-%d'}, y : {format: d3.format(",%")}}
    //dbChart.axis.labels({y : 'I/O Traffic'})
    $.ajax({
      url: '/getDBIO',
      type: 'POST',
      success: function(response) {
        console.log(response)
        // convert JSON object into javascript array
        //sysChart.transform('bar');
        dbChartConfig.axis.y.tick = { format : function (d) { return d + " queries/second"; } }
        dbChart = c3.generate(dbChartConfig)
        dbChart.transform('line')
        dbChart.load({
          columns: $.parseJSON(response), 
          type: 'line'})
        dbChart.axis.labels({ y : 'Database I/O Traffic'})
        dbChart.unload({ids: ['mattress', 'couch', 'tv-monitor', 'Database Queries']})
      },
      error: function(error) {
        console.log(error)
      }
    })
  })

  $(".dbQuery").click(function() {
    //chart.axis.ticks{x : {format: '%Y-%m-%d'}, y : {format: d3.format(",%")}}
    //dbChart.axis.labels({y : 'Database Queries'})
    $.ajax({
      url: '/getDBQuery',
      type: 'POST',
      success: function(response) {
        console.log(response)
        // convert JSON object into javascript array
        //sysChart.transform('bar');
        dbChartConfig.axis.y.tick = { format : function (d) { return d + " queries"; } }
        dbChart = c3.generate(dbChartConfig)
        dbChart.transform('line')
        dbChart.load({
          columns: $.parseJSON(response),
          type: 'line'})
        dbChart.axis.labels({ y : 'Database Queries'})
        dbChart.unload({ids: ['mattress', 'couch', 'tv-monitor', 'Database I/O Traffic']})
      },
      error: function(error) {
        console.log(error)
      }
    })
  })

  // button clicks of Neural Network Status Chart
  $(".AP").click(function() {
    //chart.axis.ticks{x : {format: '%Y-%m-%d'}, y : {format: d3.format(",%")}}
    $.ajax({
      url: '/getAP',
      type: 'POST',
      success: function(response) {
        console.log(response)
        // convert JSON object into javascript array
        //sysChart.transform('bar');
        nnChartConfig.axis.y.tick = { format : function (d) { return d + "%"; } }
        nnChartConfig.data = {
          x : 'x',
          columns: $.parseJSON(response),
          type: 'line'
        }
        nnChart = c3.generate(nnChartConfig)
        nnChart.axis.labels({ y : 'Avergae Precisions'})
      },
      error: function(error) {
        console.log(error)
      }
    })
  })

  $(".detectedObjects").click(function() {
    //chart.axis.ticks{x : {format: '%Y-%m-%d'}, y : {format: d3.format(",%")}}
    $.ajax({
      url: '/getDetectedObj',
      type: 'POST',
      success: function(response) {
        console.log(response)
        // convert JSON object into javascript array
        //sysChart.transform('bar');
        nnChartConfig.axis.y.tick = { format : function (d) { return d + ""; } }
        nnChartConfig.data = {
          x : 'x',
          columns: $.parseJSON(response),
          groups: [['mattress', 'couch', 'tv-monitor']],
          type: 'bar'
        }
        nnChart = c3.generate(nnChartConfig)
        //nnChart.transform('bar')
        nnChart.axis.labels({ y : 'Detected Objects'})
      },
      error: function(error) {
        console.log(error)
      }
    })
  })
})