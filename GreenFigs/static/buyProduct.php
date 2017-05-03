<?php
    $productID = filter_input(INPUT_POST, "productID");
    $userID = filter_input(INPUT_POST, "userID");
    $amount = filter_input(INPUT_POST, "amount");

    try {
            if(!is_numeric($amount) || $amount <=0 || $amount > 100) {
                echo "Please Enter Number Between 1 And 100 For Quantity";
                exit;
            }
            // Connect to the database.
            $con = new PDO("mysql:host=localhost;dbname=nobrainers",
                           "nobrainers", "sesame");
            $con->setAttribute(PDO::ATTR_ERRMODE,
                               PDO::ERRMODE_EXCEPTION);

            $purchaseTime = date("YmdHis");
            $tempTime = strtotime($purchaseTime);
            $year = (int)date("Y", $tempTime);
            $month = (int)date("m", $tempTime);
            $day = (int)date("d", $tempTime);
            $dayTime = (int)date("His", $tempTime);

            $orderID = (int)($purchaseTime.$userID);

            // order is a keyword in SQL, use backticks around column names to avoid the conflicts
            $query1 = "INSERT INTO `order`
                    VALUES ($orderID, $userID, $year, $month, $day, $dayTime)";
            $query2 = "INSERT INTO isincludedproduct
                    VALUES ($orderID, $productID, $amount)";
            $query3 = "SELECT Name, Price
                       FROM product
                       WHERE ProductID = :productID";

            $ps1 = $con->prepare($query1);
            $ps2 = $con->prepare($query2);
            $ps3 = $con->prepare($query3);

            $ps1->execute();
            $ps2->execute();
            $ps3->execute(array(':productID' => $productID));

            $data = $ps3->fetch(PDO::FETCH_ASSOC);

            echo "User ".$userID." successfully purchased ".$amount." ".$data['Name']."\n";
            echo "Total Price is ".$data["Price"]*$amount;
        }
        catch(PDOException $ex) {
            echo 'ERROR: '.$ex->getMessage();
        }    
        catch(Exception $ex) {
            echo 'ERROR: '.$ex->getMessage();
        }
?>