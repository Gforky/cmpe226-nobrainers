<html ng-app="dashboard">
  <head>
    <link rel="stylesheet" href="/GreenFigs/static/style.css">
    <link rel="stylesheet" href="/GreenFigs/static/c3.css">
    <!-- load angular js-->
    <!--script(type='text/javascript', src='https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js')-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
    <script type="text/javascript" src="https://code.angularjs.org/1.5.8/angular-animate.min.js"></script>
    <script type="text/javascript" src="https://code.angularjs.org/1.5.8/angular-touch.min.js"></script>
    <!-- load jquery-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <!-- load dashboard angularjs application-->
    <script src="/GreenFigs/static/dashboard-angular.js"></script>
    <!-- load js app to fix the switchViewButtons at top-->
    <script src="/GreenFigs/static/scrollANDfix.js"></script>
    <script type="text/javascript" src="/GreenFigs/static/chartGen.js"></script>
    <script type="text/javascript" src="/GreenFigs/static/d3.js"></script>
    <script type="text/javascript" src="/GreenFigs/static/c3.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        $('.recipeDataBtn').toggleClass('chosenColor');
        var id = location.search.split('user=')[1] ? location.search.split('user=')[1] : 1;
        $(".button.allProductsBtn").click(function() {
            window.location = "/GreenFigs/templates/customerAllProducts.php?user=" + id;
        })
        $(".button.allRecipesBtn").click(function() {
            window.location = "/GreenFigs/templates/customerAllRecipes.php?user=" + id;
        })
        $(".button.myRecipesBtn").click(function() {
            window.location = "/GreenFigs/templates/customerSelfRecipes.php?user=" + id;
        })
        $(".button.recipeDataBtn").click(function() {
            window.location = "/GreenFigs/templates/customerRecipesData.php?user=" + id;
        })
      })

      function logout(){
        window.location = "/GreenFigs/templates/login.html";
      }
    </script>
  </head>
  <title>Green Figs</title>
  <body>
    <div class="header">
      <h1 class="page-title">Green Figs Dashboard</h1>
      <button type='button' style='width:70px;height:35px' onclick='logout()'>Logout</button>
    </div>
    <div class="switchViewButtons">
      <button class="button allProductsBtn">All Products</button>
      <button class="button allRecipesBtn">All Recipes</button>
      <button class="button myRecipesBtn">My Recipes</button>
      <button class="button recipeDataBtn">Recipe Data Visualization</button>
    </div>
    <div ng-app="dashboard" class="dashboard">
      <!-- system opertations webpage-->
        <!--<div class="realTime-dataset"><span style="color:#008CBA">Dataset Size of Current Training Process:</span>
          <br>
          Mattress: <span my-current-dataset style="color:#ff4000"></span>
          <br>
          Couch: <span my-current-dataset style="color:#ff4000"></span>
          <br>
          Fridge: <span my-current-dataset style="color:#ff4000"></span>
          <br>
          Chair: <span my-current-dataset style="color:#ff4000"></span>
          <br>
          TV-Monitor: <span my-current-dataset style="color:#ff4000"></span></div>
        </div>-->
      <div class="nnStat">
        <h2>Recipes Shared By Customer</h2>
        <div class="chartButtons">
          <button class="button recipeChartBtn">Refresh</button>
        </div>
        <div ng-controller="chartCtrl" class="recipeChart"></div>
      </div>
    </div>
    <div class='footer'>
      <p>Copyright © 2017 Wendy Boo, Hanchen Tang, Luwen Miao, Zhenyu Zhong</p>
    </div>
  </body>
</html>