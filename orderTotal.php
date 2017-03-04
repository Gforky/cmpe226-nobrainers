<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Assighment#4 NoBrainers</title>
</head>

<body>
    <?php
        function constructTable($data)
        {
            // We're going to construct an HTML table.
            print "    <table border='1'>\n";
                
            // Construct the HTML table row by row.
            $doHeader = true;
            foreach ($data as $row) {
                    
                // The header row before the first data row.
                if ($doHeader) {
                    print "        <tr>\n";
                    foreach ($row as $name => $value) {
                        print "            <th>$name</th>\n";
                    }
                    print "        </tr>\n";
                    $doHeader = false;
                }
                    
                // Data row.
                print "        <tr>\n";
                foreach ($row as $name => $value) {
                    print "            <td>$value</td>\n";
                }
                print "        </tr>\n";
            }
            
            print "    </table>\n";
        }
    
        $id = filter_input(INPUT_GET, "id");
        
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
            
            $query1 = "SELECT isincludedproduct.OrderID, SUM(Price) 
					   FROM isincludedproduct, nobrainers.order, product
					   WHERE isincludedproduct.ProductID = product.ProductID
					   AND isincludedproduct.OrderID = nobrainers.order.OrderID
					   GROUP BY isincludedproduct.OrderID
					   HAVING isincludedproduct.OrderID = :id";
                                                           
            $ps1 = $con->prepare($query1);

            // Fetch the matching row.
            $ps1->execute(array(':id' => $id));
            $data1 = $ps1->fetchAll(PDO::FETCH_ASSOC);
                        
            // $data is an array.
            if (count($data1) > 0) {
                constructTable($data1);
            }
            else {
                print "<h3>(Order ID No match.)</h3>\n";
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
