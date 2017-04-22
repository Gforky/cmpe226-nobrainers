<html ng-app="dashboard">
  <head>
    <link rel="stylesheet" href="/GreenFigs/static/style.css">
    <!-- load angular js-->
    <!--script(type='text/javascript', src='https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js')-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
    <script type="text/javascript" src="https://code.angularjs.org/1.5.8/angular-animate.min.js"></script>
    <script type="text/javascript" src="https://code.angularjs.org/1.5.8/angular-touch.min.js"></script>
    <!-- load jquery-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <!-- load dashboard angularjs application-->
    <script src="/GreenFigs/static/dashboard-angular.js"></script>
  </head>
  <title>Green Figs</title>
  <body>
    <div class="header">
      <h1 class="page-title">Green Figs Dashboard</h1>
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
      <?php
        function constructTable($id)
        {
          print "<form action='/GreenFigs/static/addNewRecipe.php?user=".$id."' method='post' class='updateRecipeArea'>\n";
          print " <b style='font-size:14px;color:#E5A823'>Recipe Name:</b><br>\n";  
          print " <input type='text' style='width:500px; font-size:14px' name='recipeName'>\n";  
          print " <br>\n"; 
          print " <b style='font-size:14px;color:#E5A823'>Description:</b><br>\n";
          print " <textarea style='width:500px; font-size:14px' cols='40' rows='10' name='description'></textarea>\n";
          print " <br>\n";
          print " <b style='font-size:14px;color:#E5A823'>Add Ingredients (Please Follow The Data Format: <p style='font-size:14px;color:#0055A2'>[[\"Product ID\",\"19\",\"21\"],[\"Product Name\",\"tomato\",\"salt\"],[\"Product Amount\",\"1\",\"1\"]]</p>):</b><br>\n"; 
          print " <textarea style='width:500px; font-size:14px' cols='40' rows='10' name='ingredients'></textarea>\n"; 
          print " <br><br>\n"; 
          print " <input style='width:70px;height:35px' type='submit' value='Add'>\n";  
          print "</form>\n";
        }
        
        $id = filter_input(INPUT_GET, 'user');

        try {
            if (!(filter_var($id, FILTER_VALIDATE_INT) === 0 || !filter_var($id, FILTER_VALIDATE_INT) === false)) { 
            // fix bug: conflict with zero and FILTER_VALIDATE_INT
                throw new Exception("Missing User ID.");
            }
            
            constructTable($id);
        }
        catch(PDOException $ex) {
            echo 'ERROR: '.$ex->getMessage();
        }    
        catch(Exception $ex) {
            echo 'ERROR: '.$ex->getMessage();
        }
      ?>
    </div>
    <div class='footer'>
      <p>Copyright © 2017 Wendy Boo, Hanchen Tang, Luwen Miao, Zhenyu Zhong</p>
    </div>
  </body>
</html>