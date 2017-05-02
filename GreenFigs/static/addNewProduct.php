<?php
    $name = filter_input(INPUT_POST, "productName");
    $id = filter_input(INPUT_GET, "user");
    $description = filter_input(INPUT_POST, "productDesc");
    $price = filter_input(INPUT_POST, "price");
    $certification = filter_input(INPUT_POST, "certification");
    $catagory = filter_input(INPUT_POST, "catagory");

    try {
            // Connect to the database.
            $con = new PDO("mysql:host=localhost;dbname=nobrainers",
                           "nobrainers", "sesame");
            $con->setAttribute(PDO::ATTR_ERRMODE,
                               PDO::ERRMODE_EXCEPTION);

            if($name == "" || $description == "") {
                echo "Please Fill Out All The Information For Your Product";
                exit;
            }


            $query1 = "INSERT INTO product (Price,Name,Description,Certification,CategoryID,FarmerID)
                       VALUES (:price,:name, :description, :certification, :catagory, :farmerID)";

            $ps1 = $con->prepare($query1);

            $ps1->execute(array(":price"=>$price, ":name"=>$name, ":description"=>$description, ":certification"=>$certification, ":catagory"=>$catagory, "farmerID"=>$id));

            
            $ingredients = json_decode($ingredients);

            foreach($ingredients[0] as $key=>$ProductID) {
                if($key == 0) {
                    continue;
                }
                $amount = $ingredients[2][$key];
                if(!is_numeric($amount) || $amount < 1) {
                    echo "Please Enter Value Larger Than Or Equal To One For Product Quantity";
                    exit;
                } else {
                    $query2 = "INSERT INTO iscontained
                           VALUES (:RecipeName, :CustomerID, :id, :amount)";

                    $ps2 = $con->prepare($query2);

                    $ps2->execute(array(":amount"=>$amount, ":id"=>$ProductID, ":RecipeName"=>$name, ":CustomerID"=>$id));
                }
            }

            header('Location: http://localhost/GreenFigs/templates/farmerAllProducts.php?user='.$id."&glutenFree=true&nonGmo=true&organic=true&vegetables=true&fruit=true&meat=true&seafood=true&pasta=true&condiment=true&dairy=true");
        }
        catch(PDOException $ex) {
            echo 'ERROR: '.$ex->getMessage();
        }    
        catch(Exception $ex) {
            echo 'ERROR: '.$ex->getMessage();
        }
?>
