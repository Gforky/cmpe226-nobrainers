<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Assighment 4 by No Brainers</title>
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
    
        $stats = filter_input(INPUT_GET, "stats");
        
        try {
            // if (empty($stats) {
            //     throw new Exception("Missing stats.");
            // }
                
            print "<h1>Product statistics by certification</h1>\n";
        
            // Connect to the database.
            $con = new PDO("mysql:host=localhost;dbname=nobrainers",
                           "nobrainers", "sesame");
            $con->setAttribute(PDO::ATTR_ERRMODE,
                               PDO::ERRMODE_EXCEPTION);
            
            $query = "SELECT product.Certification, COUNT(product.ProductID) AS ProductCount 
                      FROM product
                      JOIN category
                      ON product.CategoryID = category.CategoryID
                      GROUP BY product.Certification
                      HAVING COUNT(*) > 1";

            $query2 = "SELECT product.Certification, MAX(product.Price) AS MaxPrice 
                       FROM product
                       JOIN category
                       ON product.CategoryID = category.CategoryID
                       GROUP BY product.Certification
                       HAVING COUNT(*) > 1";

            $query3 = "SELECT product.Certification, AVG(product.Price) AS AveragePrice 
                       FROM product
                       JOIN category
                       ON product.CategoryID = category.CategoryID
                       GROUP BY product.Certification
                       HAVING COUNT(*) > 1";
            
            if ($stats == "count") {
                $ps = $con->prepare($query);
            }
            else if ($stats == "max") {
                $ps = $con->prepare($query2);
            }
            else if ($stats == "average") {
                $ps = $con->prepare($query3);
            }

            // Fetch the matching row.
            $ps->execute(array(':stats' => $stats));
            $data = $ps->fetchAll(PDO::FETCH_ASSOC);
                        
            // $data is an array.
            if (count($data) > 0) {
                constructTable($data);
            }
            else {
                print "<h3>(No match.)</h3>\n";
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