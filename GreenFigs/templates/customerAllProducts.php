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
        $('.allProductsBtn').toggleClass('chosenColor');
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

      function buyIt(productID, userID) {
        $.ajax({
          type: "POST",
          url: "/GreenFigs/static/buyProduct.php",
          data: "productID=" + productID + "&userID=" + userID + "&amount=" + $("input#buyAmount" + productID).val(),
          success:function(msg) {
            alert(msg);
          },
          error: function(error) {
            console.log(error)
          }
        });
      }

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
        class Product {
          private $ProductID;
          private $Price;
          private $Name;
          private $Certification;
          private $FarmerID;
          private $Description;
          private $CategoryID;

          public function getProductID() {
            return $this->ProductID;
          }
          public function getPrice() {
            return $this->Price;
          }
          public function getName() {
            return $this->Name;
          }
          public function getCertification() {
            return $this->Certification;
          }
          public function getFarmerID() {
            return $this->FarmerID;
          }
          public function getDescription() {
            return $this->Description;
          }
          public function getCategoryID() {
            return $this->CategoryID;
          }
        }

        function constructTable($con, $query1, $id, $glutenFree, $nonGmo, $organic, $vegetables, $fruit, $meat, $seafood, $pasta, $condiment, $dairy)
        {
          print "<form action='/GreenFigs/templates/customerAllProducts.php' method='get' style='margin:50px auto 50px 100px'>\n";
          print " <input type='hidden' name='user' value=".$id.">\n";
          print " <b style='font-size:14px;color:#E5A823'>Certifications:</b><br>\n"; 
          if($glutenFree) {
            print " Gluton-Free<input type='checkbox' name='glutenFree' value='true' checked>\n";
          } else {
            print " Gluton-Free<input type='checkbox' name='glutenFree' value='true'>\n";
          }
          if($nonGmo) {
            print " Non-GMO<input type='checkbox' name='nonGmo' value='true' checked>\n";
          } else {
            print " Non-GMO<input type='checkbox' name='nonGmo' value='true'>\n";
          }
          if($organic) {
            print " Organic<input type='checkbox' name='organic' value='true' checked>\n";
          } else {
            print " Organic<input type='checkbox' name='organic' value='true'>\n";
          }
          print "<br><br>\n";
          print " <b style='font-size:14px;color:#E5A823'>Categories:</b><br>\n"; 
          if($vegetables) {
            print " Vegetables<input type='checkbox' name='vegetables' value='true' checked>\n";
          } else {
            print " Vegetables<input type='checkbox' name='vegetables' value='true'>\n";
          }
          if($fruit) {
            print " Fruit<input type='checkbox' name='fruit' value='true' checked>\n";
          } else {
            print " Fruit<input type='checkbox' name='fruit' value='true'>\n";
          }
          if($meat) {
            print " Meat<input type='checkbox' name='meat' value='true' checked>\n";
          } else {
            print " Meat<input type='checkbox' name='meat' value='true'>\n";
          }
          if($seafood) {
            print " Seafood<input type='checkbox' name='seafood' value='true' checked>\n";
          } else {
            print " Seafood<input type='checkbox' name='seafood' value='true'>\n";
          }
          if($pasta) {
            print " Pasta<input type='checkbox' name='pasta' value='true' checked>\n";
          } else {
            print " Pasta<input type='checkbox' name='pasta' value='true'>\n";
          }
          if($condiment) {
            print " Condiment<input type='checkbox' name='condiment' value='true' checked>\n";
          } else {
            print " Condiment<input type='checkbox' name='condiment' value='true'>\n";
          }
          if($dairy) {
            print " Dairy<input type='checkbox' name='dairy' value='true' checked>\n";
          } else {
            print " Dairy<input type='checkbox' name='dairy' value='true'>\n";
          }
          print "<br><br> <input type='submit' style='width:70px;height:35px' value='Filter'>\n";
          print "</form>\n";
          if($query1 != "") {
            $ps1 = $con->prepare($query1);

            // Fetch the matching row.
            $ps1->execute();
            $ps1->setFetchMode(PDO::FETCH_CLASS, "Product");
            print "<div style='display:inline-block; margin-left:50px'>\n";
            while($product = $ps1->fetch()) {
              print "      <div style=\"float:left; margin-left:20px; margin-top:10px; margin-bottom:10px; 
                            border:1px solid; height:350px; width:250px; background: #0055A2 url('/GreenFigs/static/productImages/product.png') no-repeat right top\">\n";
              print "         <button style='width:70px;height:35px' type='button' onclick='buyIt(".$product->getProductID().", ".$id.")'>Buy</button>\n";
              print "         <p style='margin-top:60px; color:#E5A823'>Quantity (between 1 and 100)</p> <input id='buyAmount".$product->getProductID()."' type='number' min='1' max='100'>\n";
              print "         <div style='height:180px; width:100%; overflow:scroll'>\n";
              print "           <b style='font-size:14px;color:#E5A823'>Product ID: </b><p style='font-size:12px;color:white'>" . $product->getProductID() . "</p>\n";
              print "           <b style='font-size:14px;color:#E5A823'>Name: </b><p style='font-size:12px;color:white'>" . $product->getName() . "</p>\n";
              print "           <b style='font-size:14px;color:#E5A823'>Price: </b><p style='font-size:12px;color:white'>" . $product->getPrice() . "</p>\n";
              print "           <b style='font-size:14px;color:#E5A823'>Certification: </b><p style='font-size:12px;color:white'>" . $product->getCertification() . "</p>\n";
              print "           <b style='font-size:14px;color:#E5A823'>Seller ID: </b><p style='font-size:12px;color:white'>" . $product->getFarmerID() . "</p>\n";
              print "           <b style='font-size:14px;color:#E5A823'>Description: </b><p style='font-size:12px;color:white'>" . $product->getDescription() . "</p>\n";
              print "         </div>\n";
              print "      </div>\n";
            }
            print "</div>";
          }
        }
        
        $id = filter_input(INPUT_GET, 'user');
        $glutenFree = filter_input(INPUT_GET, 'glutenFree');
        $nonGmo = filter_input(INPUT_GET, 'nonGmo');
        $organic = filter_input(INPUT_GET, 'organic');
        $vegetables = filter_input(INPUT_GET, 'vegetables');
        $fruit = filter_input(INPUT_GET, 'fruit');
        $meat = filter_input(INPUT_GET, 'meat');
        $seafood = filter_input(INPUT_GET, 'seafood');
        $pasta = filter_input(INPUT_GET, 'pasta');
        $condiment = filter_input(INPUT_GET, 'condiment');
        $dairy = filter_input(INPUT_GET, 'dairy');

        //print $glutonFree;

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
                       FROM product";

            if($glutenFree || $nonGmo || $organic || $vegetables || $fruit || $meat || $seafood || $pasta || $condiment || $dairy) {
              $query1 = $query1." WHERE";
            }

            if((!$glutenFree && !$nonGmo && !$organic) || (!$vegetables && !$fruit && !$meat && !$seafood && !$pasta && !$condiment && !$dairy)) {
              $query1 = "";
            } else {

              $query1 = $query1." (";

              if($glutenFree) {
                $query1 = $query1." Certification=\"gluten-free\" OR";
              }
              
              if($nonGmo) {
                $query1 = $query1." Certification=\"non-gmo\" OR";
              }

              if($organic) {
                $query1 = $query1." Certification=\"organic\" OR";
              }

              $query1 = substr($query1, 0, -2)." ) AND (";

              if($vegetables) {
                $query1 = $query1." CategoryID=1 OR";
              }

              if($fruit) {
                $query1 = $query1." CategoryID=2 OR";
              }

              if($meat) {
                $query1 = $query1." CategoryID=3 OR";
              }

              if($seafood) {
                $query1 = $query1." CategoryID=4 OR";
              }

              if($pasta) {
                $query1 = $query1." CategoryID=5 OR";
              }

              if($condiment) {
                $query1 = $query1." CategoryID=6 OR";
              }

              if($dairy) {
                $query1 = $query1." CategoryID=7 OR";
              }

              $query1 = substr($query1, 0, -3).")";
            }

            constructTable($con, $query1, $id, $glutenFree, $nonGmo, $organic, $vegetables, $fruit, $meat, $seafood, $pasta, $condiment, $dairy);
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