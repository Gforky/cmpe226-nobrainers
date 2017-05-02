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
      <?php
        function constructTable($id)
        {
          print "<form action='/GreenFigs/static/addNewProduct.php?user=".$id."' method='post' class='updateRecipeArea' >\n";
          print " <b style='font-size:14px;color:#E5A823'>Product Name:</b><br>\n";  
          print " <input type='text' style='width:500px; font-size:14px' name='productName' required>\n";  
          print " <br>\n"; 
          print " <b style='font-size:14px;color:#E5A823'>Description:</b><br>\n";
          print " <textarea style='width:500px; font-size:14px' cols='40' rows='10' name='productDesc' required></textarea>\n";
          print " <br>\n";
          print " <b style='font-size:14px;color:#E5A823'>Price:</b><br>\n";  
          print " <input type='text' style='width:500px; font-size:14px' name='price' required>\n";  
          print " <br>\n";
          print " <b style='font-size:14px;color:#E5A823'>Certification:</b><br>\n";  
          print " <select type='text' style='width:500px; font-size:14px' name='certification' required>
					<option value='non-gmo'>Non-GMO</option>
					<option value='gluten-free'>Gluten-Free</option>
					<option value='organic'>Organic</option>
				  </select>\n";
          print " <br>\n";
          print " <b style='font-size:14px;color:#E5A823'>Category:</b><br>\n";  
          print " <select type='text' style='width:500px; font-size:14px' name='catagory' required>
					<option value='1'>Vegetables</option>
					<option value='2'>Fruit</option>
					<option value='3'>Meat</option>
					<option value='4'>Seafood</option>
					<option value='5'>Pasta</option>
					<option value='6'>Condiment</option>
					<option value='7'>Dairy</option>
				  </select>\n";
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
