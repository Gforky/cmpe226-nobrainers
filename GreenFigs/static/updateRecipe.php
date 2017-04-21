<?php
    $original_name = filter_input(INPUT_GET, "original_name");
    $new_name = filter_input(INPUT_POST, "recipeName");
    $id = filter_input(INPUT_GET, "user");
    $description = filter_input(INPUT_POST, "description");
    $current_ingredients = filter_input(INPUT_POST, "current_ingredients");
    $more_ingredients = filter_input(INPUT_POST, "more_ingredients");

    try {
            // Connect to the database.
            $con = new PDO("mysql:host=localhost;dbname=nobrainers",
                           "nobrainers", "sesame");
            $con->setAttribute(PDO::ATTR_ERRMODE,
                               PDO::ERRMODE_EXCEPTION);

            $query1 = "UPDATE recipe
                       SET RecipeName = :new_name, Description = :description
                       WHERE RecipeName = :original_name 
                       AND CustomerID = :id";

            $ps1 = $con->prepare($query1);

            $ps1->execute(array(":new_name"=>$new_name, ":original_name"=>$original_name, ":id"=>$id, ":description"=>$description));

            $current_ingredients = json_decode($current_ingredients);

            foreach($current_ingredients[0] as $key=>$ProductID) {
                if($key == 0) {
                    continue;
                }
                $amount = $current_ingredients[2][$key];
                if(!is_numeric($amount) || $amount < 0) {
                    echo "Please Enter Value Larger Than Or Equal To Zero For Product Quantity";
                    exit;
                } else if($amount == 0) {
                    $query2 = "DELETE FROM iscontained
                           WHERE ProductID = :id";

                    $ps2 = $con->prepare($query2);

                    $ps2->execute(array(":id"=>$ProductID));
                } else {
                    $query2 = "UPDATE iscontained
                           SET Amount = :amount
                           WHERE ProductID = :id";

                    $ps2 = $con->prepare($query2);

                    $ps2->execute(array(":amount"=>$amount, ":id"=>$ProductID));
                }
            }

            if($more_ingredients != "") {
                $more_ingredients = json_decode($more_ingredients);

                foreach($more_ingredients[0] as $key=>$ProductID) {
                    if($key == 0) {
                        continue;
                    }
                    $amount = $more_ingredients[2][$key];
                    if(!is_numeric($amount) || $amount < 1) {
                        echo "Please Enter Value Larger Than Or Equal To One For Product Quantity";
                        exit;
                    } else {
                        $query3 = "INSERT INTO iscontained
                               VALUES (:RecipeName, :CustomerID, :id, :amount)";

                        $ps3 = $con->prepare($query3);

                        $ps3->execute(array(":amount"=>$amount, ":id"=>$ProductID, ":RecipeName"=>$new_name, ":CustomerID"=>$id));
                    }
                }
            }
            header('Location: http://localhost/GreenFigs/templates/customerSelfRecipes.php?user='.$id);
        }
        catch(PDOException $ex) {
            echo 'ERROR: '.$ex->getMessage();
        }    
        catch(Exception $ex) {
            echo 'ERROR: '.$ex->getMessage();
        }
?>