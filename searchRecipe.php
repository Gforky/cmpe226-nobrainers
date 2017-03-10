<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Assighment#4 NoBrainers</title>
</head>

<body>
    <?php
    	class Recipe {
			private $ProductID;
			private $Price;
			private $Name;
			private $Certification;
			private $FarmerID;
			private $FirstName;
			private $LastName;

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
			public function getFirstName() {
				return $this->FirstName;
			}
			public function getLastName() {
				return $this->LastName;
			}
		}

        function constructTable(Recipe $recipe)
        {             
            print "        <tr>\n";
            print "				<td>" . $recipe->getProductID() . "</td>\n";
            print "				<td>" . $recipe->getPrice() . "</td>\n";
            print "				<td>" . $recipe->getName() . "</td>\n";
            print "				<td>" . $recipe->getCertification() . "</td>\n";
            print "				<td>" . $recipe->getFarmerID() . "</td>\n";
            print "				<td>" . $recipe->getFirstName() . "</td>\n";
            print "				<td>" . $recipe->getLastName() . "</td>\n";
            print "        </tr>\n";
    	}
    
        $id = filter_input(INPUT_GET, "id");
        $recipe = filter_input(INPUT_GET, "recipe");
        
        try {
            if (!(filter_var($id, FILTER_VALIDATE_INT) === 0 || !filter_var($id, FILTER_VALIDATE_INT) === false)) { 
            // fix bug: conflict with zero and FILTER_VALIDATE_INT
                throw new Exception("Missing id.");
            }
            if (empty($recipe)) {
                throw new Exception("Missing recipe name.");
            }
                
        
            // Connect to the database.
            $con = new PDO("mysql:host=localhost;dbname=nobrainers",
                           "nobrainers", "sesame");
            $con->setAttribute(PDO::ATTR_ERRMODE,
                               PDO::ERRMODE_EXCEPTION);
            
            $query1 = "SELECT concat(FirstName, ' ', LastName) AS name, Type 
            			FROM customer, recipe WHERE customer.CustomerID = :id AND recipe.CustomerID = :id AND RecipeName = :recipe";

            $ps1 = $con->prepare($query1);

            // Fetch the matching row.
            $ps1->execute(array(':id' => $id, ':recipe' => $recipe));
                        
            $row = $ps1->fetch( PDO::FETCH_ASSOC );
            if($row['name']) { // check if any result returned
            	print "<h1>Products included in \"".$recipe."\" shared by ".$row['Type']." \"".$row['name']."\"</h1>\n"; 
	            // We're going to construct an HTML table.
	        	print "    <table border='1'>\n";
	        	
	        	print "        <tr>\n";
	            print "				<td>ProductID</td>\n";
	            print "				<td>Price</td>\n";
	            print "				<td>Name</td>\n";
	            print "				<td>Certification</td>\n";
	            print "				<td>FarmerID</td>\n";
	            print "				<td>FirstName</td>\n";
	            print "				<td>LastName</td>\n";
	            print "        </tr>\n";

	            $query2 = "SELECT ProductID, Price, Name, Certification, farmer.FarmerID, FirstName, LastName 
	                        FROM product, farmer WHERE ProductID IN (SELECT ProductID 
	                                                                FROM iscontained
	                                                                WHERE RecipeName = :recipe AND CustomerID = :id
	                                                                ) AND product.FarmerID = farmer.FarmerID
	                                                                ORDER BY ProductID";

	        	$ps2 = $con->prepare($query2);
	        	$ps2->execute(array(':id' => $id, ':recipe' => $recipe));
	        	$ps2->setFetchMode(PDO::FETCH_CLASS, "Recipe");
	            while($recipe = $ps2->fetch()) {
	            	constructTable($recipe);
	            }
	            print "    </table>\n";
            } else {
            	print "<h3>No Match</h3>";
            }

        }
        catch(PDOException $ex) {
            echo 'ERROR: '.$ex->getMessage();
        }    
        catch(Exception $ex) {
            echo 'ERROR: '.$ex->getMessage();
        }
    ?>
</body>
</html>