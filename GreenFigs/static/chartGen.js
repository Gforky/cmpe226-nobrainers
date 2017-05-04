$(document).ready(function() {
  var blue = "#0055A2", gold = "#E5A823", white = "#ffffff";
  var id = location.search.split('user=')[1] ? location.search.split('user=')[1] : 1;

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
  var recipeChart
  var recipeChartConfig

  var generateRecipeChart = function() {
    $.ajax({
      url: '/GreenFigs/static/updateRecipeChart.php',
      type: 'POST',
      data: 'userID=' + id,
      success: function(response) {
        var data = $.parseJSON(response)
        // convert JSON object into javascript array
        recipeChartConfig = {
          bindto: '.recipeChart',
          data: {
            x : 'x',
            columns: data,
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
                text: 'Number of Recipes',
                position: 'outer-middle'
              },
              tick: {
                format: d3.format(",") // ADD
              }
            }
          }
        }
        recipeChart = c3.generate(recipeChartConfig)
      },
      error: function(error) {
        console.log(error)
      }
    })
  }

  generateRecipeChart()

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
        //recipeChart.transform('bar')
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
        //recipeChart.transform('bar')
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
        //recipeChart.transform('bar')
        dbChart.axis.labels({ y : 'Images Uploaded'})
      },
      error: function(error) {
        console.log(error)
      }
    })
  })

  // button clicks of Neural Network Status Chart
  $(".recipeChartBtn").click(function() {
    generateRecipeChart()
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
        recipeChartConfig.axis.y.tick = { format : function (d) { return d + ""; } }
        recipeChartConfig.data = {
          x : 'x',
          columns: $.parseJSON(response),
          groups: [['mattress', 'couch', 'tv-monitor']],
          type: 'bar'
        }
        recipeChart = c3.generate(recipeChartConfig)
        //recipeChart.transform('bar')
        recipeChart.axis.labels({ y : 'Detected Objects'})
      },
      error: function(error) {
        console.log(error)
      }
    })
  })
})