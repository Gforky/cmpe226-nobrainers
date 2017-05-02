<?php
    $farmerID = filter_input(INPUT_GET, "farmerID");
    $productID = filter_input(INPUT_GET, "productID");
    $productName = filter_input(INPUT_POST, "productName");
    $description = filter_input(INPUT_POST, "productDesc");
    $price = filter_input(INPUT_POST, "price");
    $certification = filter_input(INPUT_POST, "certification");
    $category = filter_input(INPUT_POST, "category");

print "1.".$farmerID;
print "2.".$productID;
print "3.".$productName;
print "4.".$description;
print "5.".$price;
print "6.".$certification;
print "7.".$category;

    try {
            // Connect to the database.
            $con = new PDO("mysql:host=localhost;dbname=nobrainers",
                           "nobrainers", "sesame");
            $con->setAttribute(PDO::ATTR_ERRMODE,
                               PDO::ERRMODE_EXCEPTION);

            $query1 = "UPDATE product
                       SET Price = :price, Description = :description , Name = :name, Certification = :certification,CategoryID = :categoryID
                       WHERE ProductID = :productID";
print $query1;
            $ps1 = $con->prepare($query1);

            $ps1->execute(array(":price"=>$price, ":name"=>$productName, ":certification"=>$certification, ":description"=>$description, ":categoryID"=>$category,":productID"=>$productID));

        	header('Location: http://localhost/GreenFigs/templates/farmerAllProducts.php?user='.$farmerID."&glutenFree=true&nonGmo=true&organic=true&vegetables=true&fruit=true&meat=true&seafood=true&pasta=true&condiment=true&dairy=true");

        }
        catch(PDOException $ex) {
            echo 'ERROR: '.$ex->getMessage();
        }    
        catch(Exception $ex) {
            echo 'ERROR: '.$ex->getMessage();
        }
?>
