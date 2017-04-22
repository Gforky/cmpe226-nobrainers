<?php
    $name = filter_input(INPUT_POST, "recipeName");
    $id = filter_input(INPUT_GET, "user");
    $description = filter_input(INPUT_POST, "description");
    $ingredients = filter_input(INPUT_POST, "ingredients");

    try {
            // Connect to the database.
            $con = new PDO("mysql:host=localhost;dbname=nobrainers",
                           "nobrainers", "sesame");
            $con->setAttribute(PDO::ATTR_ERRMODE,
                               PDO::ERRMODE_EXCEPTION);

            if($name == "" || $description == "" || $ingredients == "") {
                echo "Please Fill Out All The Information For Your Recipe";
                exit;
            }

            $type = "";
            if($id == 0) {
                $type = "Chef";
            } else {
                $type = "Customer";
            }

            $query1 = "INSERT INTO recipe
                       VALUES (:RecipeName, :CustomerID, :Type, :Description)";

            $ps1 = $con->prepare($query1);

            $ps1->execute(array(":RecipeName"=>$name, ":CustomerID"=>$id, ":Description"=>$description, ":Type"=>$type));

            
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

            header('Location: http://localhost/GreenFigs/templates/customerSelfRecipes.php?user='.$id);
        }
        catch(PDOException $ex) {
            echo 'ERROR: '.$ex->getMessage();
        }    
        catch(Exception $ex) {
            echo 'ERROR: '.$ex->getMessage();
        }
?>