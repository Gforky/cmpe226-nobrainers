<html ng-app="dashboard">
  <head>
    <link rel="stylesheet" href="/GreenFigs/static/style.css">
    <!-- load c3.css-->
    <link rel="stylesheet" href="/GreenFigs/static/c3.css">
    <!-- load angular js-->
    <!--script(type='text/javascript', src='https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js')-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
    <script type="text/javascript" src="https://code.angularjs.org/1.5.8/angular-animate.min.js"></script>
    <script type="text/javascript" src="https://code.angularjs.org/1.5.8/angular-touch.min.js"></script>
    <!-- load jquery-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <!-- load c3.js and d3.js-->
    <script src="/GreenFigs/static/d3.js" charset="utf-8"></script>
    <script src="/GreenFigs/static/c3.js"></script>
    <!-- external js to generate charts-->
    <script src="/GreenFigs/static/chartGen.js"></script>
    <!-- load dashboard angularjs application-->
    <script src="/GreenFigs/static/dashboard-angular.js"></script>
    <!-- load js app to fix the switchViewButtons at top-->
    <script src="/GreenFigs/static/scrollANDfix.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        $('.dataViewsButton').toggleClass('chosenColor');
        $('.cpuUsage').toggleClass('chosenColor');
        $('.imgStorage').toggleClass('chosenColor');
        $('.AP').toggleClass('chosenColor');
        var id = location.search.split('user=')[1] ? location.search.split('user=')[1] : 1;
        $(".button.dataViewsButton").click(function() {
            window.location = "/GreenFigs/templates/customerAllRecipes.php?user=" + id;
        })
        $(".button.sysOpsButton").click(function() {
            window.location = "/GreenFigs/templates/customerAllProducts.php?user=" + id;
        })
      })
    </script>
  </head>
  <title>Green Figs</title>
  <body>
    <div class="header">
      <h1 class="page-title">Green Figs Dashboard</h1>
    </div>
    <div class="switchViewButtons">
      <button class="button sysOpsButton">All Products</button>
      <button class="button dataViewsButton">All Recipes</button>
    </div>
    <div ng-app="dashboard" class="dashboard">
      <!-- data visualization webpage-->
      <div class="dataViews">
        <div class="dbStat">
          <h2>Database Status</h2>
          <div class="chartButtons">
            <button onclick="setChartButtonsVisualbility([&quot;.imgStorage&quot;, &quot;.dbIO&quot;, &quot;.datasetSize&quot;, &quot;.dbQuery&quot;, &quot;.imgConf&quot;, &quot;.upImg&quot;])" class="button imgStorage">Total Images in Database</button>
            <button onclick="setChartButtonsVisualbility([&quot;.datasetSize&quot;, &quot;.imgStorage&quot;, &quot;.dbIO&quot;, &quot;.dbQuery&quot;, &quot;.imgConf&quot;, &quot;.upImg&quot;])" class="button datasetSize">Images automatically<br>rejected by the algorithm</button>
            <button onclick="setChartButtonsVisualbility([&quot;.imgConf&quot;, &quot;.upImg&quot;, &quot;.imgStorage&quot;, &quot;.dbIO&quot;, &quot;.datasetSize&quot;, &quot;.dbQuery&quot;])" class="button imgConf">Images Confirmed by Administrators</button>
            <button onclick="setChartButtonsVisualbility([&quot;.upImg&quot;, &quot;.imgConf&quot;, &quot;.imgStorage&quot;, &quot;.dbIO&quot;, &quot;.datasetSize&quot;, &quot;.dbQuery&quot;])" class="button upImg">Uploaded Images</button>
            <button onclick="setChartButtonsVisualbility([&quot;.dbIO&quot;, &quot;.datasetSize&quot;, &quot;.imgStorage&quot;, &quot;.dbQuery&quot;, &quot;.imgConf&quot;, &quot;.upImg&quot;])" class="button dbIO">I/O Traffic</button>
            <button onclick="setChartButtonsVisualbility([&quot;.dbQuery&quot;, &quot;.datasetSize&quot;, &quot;.dbIO&quot;, &quot;.imgStorage&quot;, &quot;.imgConf&quot;, &quot;.upImg&quot;])" class="button dbQuery">Database Queries</button>
          </div>
          <div ng-controller="chartCtrl" class="dbChart"></div>
        </div>
        
        <div class="sysStat">
          <h2>System Status</h2>
          <div class="chartButtons">
            <button onclick="setChartButtonsVisualbility([&quot;.cpuUsage&quot;, &quot;.memLoad&quot;, &quot;.netTraff&quot;, &quot;.cpuTemp&quot;])" class="button cpuUsage">CPU Usage</button>
            <button onclick="setChartButtonsVisualbility([&quot;.memLoad&quot;, &quot;.cpuUsage&quot;, &quot;.netTraff&quot;, &quot;.cpuTemp&quot;])" class="button memLoad">Memory Load</button>
            <button onclick="setChartButtonsVisualbility([&quot;.netTraff&quot;, &quot;.memLoad&quot;, &quot;.cpuUsage&quot;, &quot;.cpuTemp&quot;])" class="button netTraff">Network Traffic</button>
            <button onclick="setChartButtonsVisualbility([&quot;.cpuTemp&quot;, &quot;.memLoad&quot;, &quot;.netTraff&quot;, &quot;.cpuUsage&quot;])" class="button cpuTemp">CPU Temprature</button>
          </div>
          <div ng-controller="chartCtrl" class="sysChart"></div>
        </div>
        
        <div class="nnStat">
          <h2>Neural Network Status</h2>
          <div class="chartButtons">
            <button onclick="setChartButtonsVisualbility([&quot;.AP&quot;, &quot;.detectedObjects&quot;])" class="button AP">Mean Accuracy</button>
            <button onclick="setChartButtonsVisualbility([&quot;.detectedObjects&quot;, &quot;.AP&quot;])" class="button detectedObjects">Detected Objects</button>
          </div>
          <div ng-controller="chartCtrl" class="nnChart"></div>
        </div>
        <!--<iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyB-denz3OyVbLzOvKpehCzSLJzNohqAebo &amp;q=Space+Needle,Seattle+WA" allowfullscreen class="detectLocations">       </iframe>-->
      </div>
    </div>
    <div class="footer">
      <p>Copyright © 2017 Wendy Boo, Hanchen Tang, Luwen Miao, Zhenyu Zhong</p>
    </div>
  </body>
</html>