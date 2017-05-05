$(document).ready(function() {
  var blue = "#0055A2", gold = "#E5A823", white = "#ffffff";
  var id = location.search.split('user=')[1] ? location.search.split('user=')[1] : 1;

  // chart of recipe data
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

  // chart of revenue per month
  var revenueMonthChart
  var revenueMonthChartConfig

  var generateRevenueMonthChart = function() {
    $.ajax({
      url: '/GreenFigs/static/updateRevenueMonthChart.php',
      type: 'POST',
      data: 'userID=' + id,
      success: function(response) {
        var data = $.parseJSON(response)
        // convert JSON object into javascript array
        revenueMonthChartConfig = {
          bindto: '.revenueChart',
          data: {
            x : 'x',
            columns: data,
            groups: []
          },
          axis: {
            x: {
              type: 'timeseries',
              tick: {
                  format: '%Y-%m'
              }
            },
            y: {
              label: { // ADD
                text: 'Revenue in US Dollars',
                position: 'outer-middle'
              },
              tick: {
                format: d3.format("$,") // ADD
              }
            }
          }
        }
        revenueMonthChart = c3.generate(revenueMonthChartConfig)
      },
      error: function(error) {
        console.log(error)
      }
    })
  }

  // chart of revenue per year
  var revenueYearChart
  var revenueYearChartConfig

  var generateRevenueYearChart = function() {
    $.ajax({
      url: '/GreenFigs/static/updateRevenueYearChart.php',
      type: 'POST',
      data: 'userID=' + id,
      success: function(response) {
        var data = $.parseJSON(response)
        // convert JSON object into javascript array
        revenueYearChartConfig = {
          bindto: '.revenueChart',
          data: {
            x : 'x',
            columns: data,
            groups: []
          },
          axis: {
            x: {
              type: 'timeseries',
              tick: {
                  format: '%Y'
              }
            },
            y: {
              label: { // ADD
                text: 'Revenue in US Dollars',
                position: 'outer-middle'
              },
              tick: {
                format: d3.format("$,") // ADD
              }
            }
          }
        }
        revenueYearChart = c3.generate(revenueYearChartConfig)
      },
      error: function(error) {
        console.log(error)
      }
    })
  }

  // chart of revenue per month
  var revenueDayChart
  var revenueDayChartConfig

  var generateRevenueDayChart = function() {
    $.ajax({
      url: '/GreenFigs/static/updateRevenueDayChart.php',
      type: 'POST',
      data: 'userID=' + id,
      success: function(response) {
        var data = $.parseJSON(response)
        // convert JSON object into javascript array
        revenueDayChartConfig = {
          bindto: '.revenueChart',
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
                text: 'Revenue in US Dollars',
                position: 'outer-middle'
              },
              tick: {
                format: d3.format("$,") // ADD
              }
            }
          }
        }
        revenueDayChart = c3.generate(revenueDayChartConfig)
      },
      error: function(error) {
        console.log(error)
      }
    })
  }

  generateRevenueMonthChart()

  $(".recipeChartBtn").click(function() {
    generateRecipeChart()
  })

  $(".revenueMonthChartBtn").click(function() {
    $('.revenueMonthChartBtn').toggleClass('chosenColor', true);
    $('.revenueYearChartBtn').toggleClass('chosenColor', false);
    $('.revenueDayChartBtn').toggleClass('chosenColor', false);
    generateRevenueMonthChart()
  })

  $(".revenueYearChartBtn").click(function() {
    $('.revenueMonthChartBtn').toggleClass('chosenColor', false);
    $('.revenueYearChartBtn').toggleClass('chosenColor', true);
    $('.revenueDayChartBtn').toggleClass('chosenColor', false);
    generateRevenueYearChart()
  })

  $(".revenueDayChartBtn").click(function() {
    $('.revenueMonthChartBtn').toggleClass('chosenColor', false);
    $('.revenueYearChartBtn').toggleClass('chosenColor', false);
    $('.revenueDayChartBtn').toggleClass('chosenColor', true);
    generateRevenueDayChart()
  })
})