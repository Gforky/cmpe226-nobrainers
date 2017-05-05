<html ng-app="dashboard">
  <head>
    <link rel="stylesheet" href="/GreenFigs/static/style.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/css/bootstrap-responsive.min.css" class="cssdeck">

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
        $('.productrevenue').toggleClass('chosenColor');
        var id = location.search.split('user=')[1] ? location.search.split('user=')[1] : 1;
        $(".button.allProductsBtn").click(function() {
            window.location = "/GreenFigs/templates/farmerAllProducts.php?user=" + id + "&glutenFree=true&nonGmo=true&organic=true&vegetables=true&fruit=true&meat=true&seafood=true&pasta=true&condiment=true&dairy=true";
        })
        $(".button.productrevenue").click(function() {
            window.location = "/GreenFigs/templates/farmerProductRevenue.php?user=" + id;
        })
        $(".button.revenueDateBtn").click(function() {
            window.location = "/GreenFigs/templates/farmerRevenuePerDate.php?user=" + id;
        })
      })
      function addProduct(id) {
        window.location = "/GreenFigs/templates/addProduct.php?user=" + id;
      }
	  function logout(){
        window.location = "/GreenFigs/templates/login.html";
	  }
      function update(productID, name,price,certification,farmerID,description,category) {
        window.location = "/GreenFigs/templates/editProduct.php?id=" + productID + "&name=" + name + "&price="+price + "&certification="+certification + "&farmerID="+farmerID + "&description="+description + "&category="+category;
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
      <button class="button allProductsBtn">My Products</button>
      <button class="button productrevenue">Product Revenue</button>
      <button class="button revenueDateBtn">Revenue Per Date</button>
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
          public function getCategory() {
            if( $this->CategoryID == 1){
				return "vegetables";
            }else if($this->CategoryID == 2){
				return "fruit";
			}else if($this->CategoryID == 3){
				return "meat";
			}else if($this->CategoryID == 4){
				return "seafood";
			}else if($this->CategoryID == 5){
				return "pasta";
			}else if($this->CategoryID == 6){
				return "condiment";
			}else if($this->CategoryID == 7){
				return "dairy";
			}
          }
          public function getCategoryID() {
		 	return $this->CategoryID; 
		  }
		}	
		function convertCategory($category){
            if( $category == 1){
				return "vegetables";
            }else if($category == 2){
				return "fruit";
			}else if($category == 3){
				return "meat";
			}else if($category == 4){
				return "seafood";
			}else if($category == 5){
				return "pasta";
			}else if($category == 6){
				return "condiment";
			}else if($category == 7){
				return "dairy";
			}
		}
        function constructTable($con, $query1, $id, $glutenFree, $nonGmo, $organic, $vegetables, $fruit, $meat, $seafood, $pasta, $condiment, $dairy)
        {
          print "<form action='/GreenFigs/templates/farmerProductRevenue.php' method='get' style='margin:50px auto 50px 100px'>\n";
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
			
          print "<br></form>\n";
          if($query1 != "") {
            $ps1 = $con->prepare($query1);

            // Fetch the matching row.
            $ps1->execute();
            #$ps1->setFetchMode(PDO::FETCH_CLASS, "Product");
            print "<div style='display:inline-block; margin-left:50px'>\n";
            while($row = $ps1->fetch(PDO::FETCH_ASSOC)) {
              print "      <div style=\"float:left; margin-left:20px; margin-top:10px; margin-bottom:10px; 
                            border:1px solid; height:350px; width:250px; background: #0055A2 url('/GreenFigs/static/productImages/product.png') no-repeat right top\">\n";
              print "         <div style='height:300px; width:100%; overflow:scroll'>\n";
              print "           <b style='font-size:14px;color:#E5A823'>Product ID: </b><p style='font-size:12px;color:white'>" . $row["productid"] . "</p>\n";
              print "           <b style='font-size:14px;color:#E5A823'>Name: </b><p style='font-size:12px;color:white'>" . $row["productname"] . "</p>\n";
              print "           <b style='font-size:14px;color:#E5A823'>Unit Price: </b><p style='font-size:12px;color:white'>" . $row["productprice"] . "</p>\n";
              print "           <b style='font-size:14px;color:#E5A823'>Total Units Sold: </b><p style='font-size:12px;color:white'>" . $row["unitssold"] . "</p>\n";
              print "           <b style='font-size:14px;color:#E5A823'>Total Revenue: </b><p style='font-size:12px;color:white'>" . $row["revenue"] . "</p>\n";
              print "           <b style='font-size:14px;color:#E5A823'>Certification: </b><p style='font-size:12px;color:white'>" . $row["productcertification"] . "</p>\n";
              print "           <b style='font-size:14px;color:#E5A823'>Category: </b><p style='font-size:12px;color:white'>" . convertCategory($row["productcategory"]) . "</p>\n";
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
            $con = new PDO("mysql:host=localhost;dbname=nobrainers_analytical",
                           "nobrainers", "sesame");
            $con->setAttribute(PDO::ATTR_ERRMODE,
                               PDO::ERRMODE_EXCEPTION);
            
            $query1 = "SELECT product.productid,product.productname,product.productprice,SUM(unitssold) AS unitssold,SUM(revenue) AS revenue, product.productcertification, product.productcategory
                       FROM sales
					   join farmer on sales.farmerkey = farmer.farmerkey
					   join product on sales.productkey = product.productkey
					   WHERE farmer.farmerid = ".$id;

            if($glutenFree || $nonGmo || $organic || $vegetables || $fruit || $meat || $seafood || $pasta || $condiment || $dairy) {
              $query1 = $query1." AND";
            }

            if((!$glutenFree && !$nonGmo && !$organic) || (!$vegetables && !$fruit && !$meat && !$seafood && !$pasta && !$condiment && !$dairy)) {
              $query1 = "";
            } else {

              $query1 = $query1." ((";

              if($glutenFree) {
                $query1 = $query1." product.productcertification=\"gluten-free\" OR";
              }
              
              if($nonGmo) {
                $query1 = $query1." product.productcertification=\"non-gmo\" OR";
              }

              if($organic) {
                $query1 = $query1." product.productcertification=\"organic\" OR";
              }

              $query1 = substr($query1, 0, -2)." ) AND (";

              if($vegetables) {
                $query1 = $query1." product.productcategory=1 OR";
              }

              if($fruit) {
                $query1 = $query1." product.productcategory=2 OR";
              }

              if($meat) {
                $query1 = $query1." product.productcategory=3 OR";
              }

              if($seafood) {
                $query1 = $query1." product.productcategory=4 OR";
              }

              if($pasta) {
                $query1 = $query1." product.productcategory=5 OR";
              }

              if($condiment) {
                $query1 = $query1." product.productcategory=6 OR";
              }

              if($dairy) {
                $query1 = $query1." product.productcategory=7 OR";
              }

              $query1 = substr($query1, 0, -3)."))";
            }
			$query1 = $query1." GROUP BY sales.productkey";
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
