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
    <!-- load js app to fix the switchViewButtons at top-->
    <script src="/GreenFigs/static/scrollANDfix.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        $('.myRecipesBtn').toggleClass('chosenColor');
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
      })

      function editRecipe(name, id) {
        window.location = "/GreenFigs/templates/editRecipe.php?user=" + id + "&recipeName=" + name;
      }

      function addRecipe(id) {
        window.location = "/GreenFigs/templates/addRecipe.php?user=" + id;
      }
    </script>
  </head>
  <title>Green Figs</title>
  <body>
    <div class="header">
      <h1 class="page-title">Green Figs Dashboard</h1>
    </div>
    <div class="switchViewButtons">
      <button class="button allProductsBtn">All Products</button>
      <button class="button allRecipesBtn">All Recipes</button>
      <button class="button myRecipesBtn">My Recipes</button>
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

        function constructTable($ps1, $con, $id)
        {
          print "<button style='text-decoration:none; float:right; width:70px;height:35px; margin:20px 50px 20px' type='button' onclick='addRecipe(".$id.")'>Add Recipe</button>\n";
          print "<div style='display:inline-block; margin-top:60px; margin-left:50px'>";
          while($recipe = $ps1->fetch()) {
            $query2 = "SELECT * 
                       FROM iscontained
                       WHERE CustomerID = :id
                       AND RecipeName = :name";

            $ps2 = $con->prepare($query2);

            $ps2->execute(array(":id" => $id, ":name" => $recipe->getRecipeName()));
            $ps2->setFetchMode(PDO::FETCH_CLASS, "Ingredient");

            print "      <div style=\"float:left; margin-left:20px; margin-top:10px; margin-bottom:10px; 
                          border:1px solid; height:350px; width:250px; background: #0055A2 url('/GreenFigs/static/productImages/product.png') no-repeat right top\">\n";
            print "         <button style='width:70px;height:35px' type='button' onclick='editRecipe(\"".$recipe->getRecipeName()."\", ".$id.")'>Edit</button>\n";
            print "         <div style='margin-top:60px; height:240px; width:100%; overflow:scroll'>\n";
            print "           <b style='font-size:14px;color:#E5A823'>Recipe Name: </b><p style='font-size:12px;color:white'>" . $recipe->getRecipeName() . "</p>\n";
            print "           <b style='font-size:14px;color:#E5A823'>Shared By User: </b><p style='font-size:12px;color:white'>" . $recipe->getCustomerID() . "</p>\n";
            print "           <b style='font-size:14px;color:#E5A823'>User Type: </b><p style='font-size:12px;color:white'>" . $recipe->getType() . "</p>\n";
            print "           <b style='font-size:14px;color:#E5A823'>Description: </b><p style='font-size:12px;color:white'>" . $recipe->getDescription() . "</p>\n";
            print "           <b style='font-size:14px;color:#E5A823'>Ingredients: </b>\n";
            while($ingredient = $ps2->fetch()) {
            $query = "SELECT Name
                      FROM product
                      WHERE ProductID = :productID";

            $ps = $con->prepare($query);

            $ps->execute(array(":productID" => $ingredient->getProductID()));

            $productName = $ps->fetch();

            print "<div style='border-top:1px solid'><p style='font-size:12px;color:white'>Product ID: ".$ingredient->getProductID()."; Product Name: ".$productName['Name']."; Product Amount: ".$ingredient->getAmount()."</p></div>\n";
          }
            print "         </div>\n";
            print "      </div>\n";
          }
          print "</div>";
        }
        
        $id = filter_input(INPUT_GET, 'user');

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
                       WHERE CustomerID = :id";
                                                           
            $ps1 = $con->prepare($query1);

            // Fetch the matching row.
            $ps1->execute(array(":id" => $id));
            $ps1->setFetchMode(PDO::FETCH_CLASS, "Recipe");
            constructTable($ps1, $con, $id);
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