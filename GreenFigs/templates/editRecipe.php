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
        class Recipe {
          private $RecipeName;
          private $CustomerID;
          private $Type;
          private $Description;

          public function getRecipeName() {
            return $this->RecipeName;
          }
          public function getCustomerID() {
            return $this->CustomerID;
          }
          public function getType() {
            return $this->Type;
          }
          public function getDescription() {
            return $this->Description;
          }
        }

        class Ingredient {
          private $RecipeName;
          private $CustomerID;
          private $ProductID;
          private $Amount;

          public function getRecipeName() {
            return $this->RecipeName;
          }
          public function getCustomerID() {
            return $this->CustomerID;
          }
          public function getProductID() {
            return $this->ProductID;
          }
          public function getAmount() {
            return $this->Amount;
          }
        }

        function constructTable($recipe, $id, $name, $ps2, $con)
        {
          print "<form action='/GreenFigs/static/updateRecipe.php?user=".$id."&original_name=".$name."' method='post' class='updateRecipeArea'>\n";
          print " <b style='font-size:14px;color:#E5A823'>Recipe Name:</b><br>\n";  
          print " <input type='text' style='width:500px; font-size:14px' name='recipeName' value='".$recipe->getRecipeName()."'>\n";  
          print " <br>\n"; 
          print " <b style='font-size:14px;color:#E5A823'>Description:</b><br>\n";
          print " <textarea style='width:500px; font-size:14px' cols='40' rows='10' name='description'>".$recipe->getDescription()."</textarea>\n";
          print " <b style='font-size:14px;color:#E5A823'>Change Products Amount Of Current Ingredients (Please Only Change The Values Of Product Amount):</b><br>\n";
          $ingredients = array(array(), array(), array());
          array_push($ingredients[0], "Product ID");
          array_push($ingredients[1], "Product Name");
          array_push($ingredients[2], "Product Amount");
          while($ingredient = $ps2->fetch()) {
            $query = "SELECT Name
                      FROM product
                      WHERE ProductID = :productID";

            $ps = $con->prepare($query);

            $ps->execute(array(":productID" => $ingredient->getProductID()));

            $productName = $ps->fetch();

            array_push($ingredients[0], $ingredient->getProductID());
            array_push($ingredients[1], $productName['Name']);
            array_push($ingredients[2], $ingredient->getAmount());
          }
          print " <textarea style='width:500px; font-size:14px' cols='40' rows='10' name='current_ingredients'>".json_encode($ingredients)."</textarea>\n";
          print " <br>\n";
          print " <b style='font-size:14px;color:#E5A823'>Add More Ingredients (Please Follow The Data Format Above):</b><br>\n"; 
          print " <textarea style='width:500px; font-size:14px' cols='40' rows='10' name='more_ingredients'></textarea>\n"; 
          print " <br><br>\n"; 
          print " <input style='width:70px;height:35px' type='submit' value='Update'>\n";  
          print "</form>\n";
        }
        
        $id = filter_input(INPUT_GET, 'user');
        $name = filter_input(INPUT_GET, 'recipeName');

        try {
            if (!(filter_var($id, FILTER_VALIDATE_INT) === 0 || !filter_var($id, FILTER_VALIDATE_INT) === false)) { 
            // fix bug: conflict with zero and FILTER_VALIDATE_INT
                throw new Exception("Missing User ID.");
            }
            
            // Connect to the database.
            $con = new PDO("mysql:host=localhost;dbname=nobrainers",
                       "nobrainers", "sesame");
            $con->setAttribute(PDO::ATTR_ERRMODE,
                           PDO::ERRMODE_EXCEPTION);

            $query1 = "SELECT * 
                       FROM recipe
                       WHERE CustomerID = :id
                       AND RecipeName = :name";
            $query2 = "SELECT * 
                       FROM iscontained
                       WHERE CustomerID = :id
                       AND RecipeName = :name";
                                                           
            $ps1 = $con->prepare($query1);
            $ps2 = $con->prepare($query2);

            // Fetch the matching row.
            $ps1->execute(array(":id" => $id, ":name" => $name));
            $ps1->setFetchMode(PDO::FETCH_CLASS, "Recipe");
            $recipe = $ps1->fetch();
            $ps2->execute(array(":id" => $id, ":name" => $name));
            $ps2->setFetchMode(PDO::FETCH_CLASS, "Ingredient");
            constructTable($recipe, $id, $name, $ps2, $con);
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