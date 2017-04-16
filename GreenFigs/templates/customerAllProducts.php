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
        $('.sysOpsButton').toggleClass('chosenColor');
        var id = location.search.split('user=')[1] ? location.search.split('user=')[1] : 1;
        $(".button.dataViewsButton").click(function() {
            window.location = "/GreenFigs/templates/customerAllRecipes.php?user=" + id;
        })
        $(".button.dataViewsButton").click(function() {
            window.location = "/GreenFigs/templates/customerAllRecipes.php?user=" + id;
        })
      })

      function buyIt(productID, userID) {
        $.ajax({
          type: "POST",
          url: "/GreenFigs/static/buyProduct.php",
          data: "productID=" + productID + "&userID=" + userID,
          success:function(msg) {
            alert(msg);
          },
          error: function(error) {
            console.log(error)
          }
        });
      }
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

        function constructTable($ps1, $id)
        {
          print "<div style='display:inline-block'>";
          while($product = $ps1->fetch()) {
            print "      <div style=\"float:left; margin-left:4%; margin-top:10px; margin-bottom:10px; 
                          border:1px solid; height:350px; width:20%; background: #0055A2 url('/GreenFigs/static/productImages/product.png') no-repeat right top\">\n";
            print "         <button style='width:70px;height:35px' type='button' onclick='buyIt(".$product->getProductID().", ".$id.")'>Buy</button>\n";
            print "         <div style='margin-top:60px'>\n";
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
        
        $id = filter_input(INPUT_GET, 'user');

        try {
            if (!(filter_var($id, FILTER_VALIDATE_INT) === 0 || !filter_var($id, FILTER_VALIDATE_INT) === false)) { 
            // fix bug: conflict with zero and FILTER_VALIDATE_INT
                throw new Exception("Missing order id.");
            }
        
            // Connect to the database.
            $con = new PDO("mysql:host=localhost;dbname=nobrainers",
                           "nobrainers", "sesame");
            $con->setAttribute(PDO::ATTR_ERRMODE,
                               PDO::ERRMODE_EXCEPTION);
            
            $query1 = "SELECT * 
                       FROM product";
                                                           
            $ps1 = $con->prepare($query1);

            // Fetch the matching row.
            $ps1->execute();
            $ps1->setFetchMode(PDO::FETCH_CLASS, "Product");
            constructTable($ps1, $id);
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