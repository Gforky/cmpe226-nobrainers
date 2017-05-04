<?php
    $userID = filter_input(INPUT_POST, "userID");
    $recipeUserID = filter_input(INPUT_POST, "recipeUserID");
    $recipeName = filter_input(INPUT_POST, "recipeName");

    try {
            /*if(!is_numeric($amount) || $amount <=0 || $amount > 100) {
                echo "Please Enter Number Between 1 And 100 For Quantity";
                exit;
            }*/
            // Connect to the database.
            $con = new PDO("mysql:host=localhost;dbname=nobrainers",
                           "nobrainers", "sesame");
            $con->setAttribute(PDO::ATTR_ERRMODE,
                               PDO::ERRMODE_EXCEPTION);

            date_default_timezone_set('America/New_York');
            $time = date("His");
            $orderID = (int)(date("Ymd").$time.$userID);
            $purchaseTime = (int)$time;
            $con->exec("SET time_zone = '-04:00'");
            $msg = "User ".$userID." successfully purchased recipe \"".$recipeName."\"\nThe recipe contains products:\n";
            $totalPrice = 0;

            // order is a keyword in SQL, use backticks around column names to avoid the conflicts
            $query1 = "INSERT INTO `order`
                       VALUES (:orderID, :userID, $purchaseTime, DATE_FORMAT(NOW(), '%Y-%m-%d'))";
            $query2 = "INSERT INTO isincludedrecipe
                       VALUES (:recipeName, :userID, :orderID)";
            $query3 = "SELECT ProductID, Amount
                       FROM iscontained
                       WHERE RecipeName = :recipeName
                       AND CustomerID = :userID";

            $ps1 = $con->prepare($query1);
            $ps2 = $con->prepare($query2);
            $ps3 = $con->prepare($query3);

            $ps1->execute(array(":orderID"=>$orderID, ":userID"=>$userID));
            $ps2->execute(array(":orderID"=>$orderID, ":userID"=>$recipeUserID, ":recipeName"=>$recipeName));
            $ps3->execute(array(':recipeName'=>$recipeName, ":userID"=>$recipeUserID));

            while($product = $ps3->fetch(PDO::FETCH_ASSOC)) {
                $productID = $product["ProductID"];
                $amount = $product["Amount"];

                $query4 = "INSERT INTO isincludedproduct
                           VALUES (:orderID, :productID, :amount)";
                $query5 = "SELECT Name, Price
                           FROM product
                           WHERE ProductID = :productID";
                $ps4 = $con->prepare($query4);
                $ps5 = $con->prepare($query5);
                $ps4->execute(array(":orderID"=>$orderID, ":productID"=>$productID, ":amount"=>$amount));
                $ps5->execute(array(":productID"=>$productID));
                $data = $ps5->fetch(PDO::FETCH_ASSOC);
                $msg = $msg."Product Name: ".$data["Name"]."; Product ID: ".$productID."; Price: ".$data["Price"]."; Amount: ".$amount."\n";
                $totalPrice = $totalPrice + $data["Price"];
            }

            echo $msg."Total Price is ".$totalPrice."\n";
        }
        catch(PDOException $ex) {
            echo 'ERROR: '.$ex->getMessage();
        }    
        catch(Exception $ex) {
            echo 'ERROR: '.$ex->getMessage();
        }
?>