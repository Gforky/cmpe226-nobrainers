<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Assighment 5 by No Brainers</title>
</head>

<body>
    <?php
        class Product
        {
            private $certification;
            private $count;

            public function getCertification() { return $this->certification; }
            public function getCount()         { return $this->count; }
        }

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
            print "<h1>Product count by certification</h1>\n";
        
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

            $ps = $con->prepare($query);

            // Fetch the matching row.
            $ps->execute();
            $ps->setFetchMode(PDO::FETCH_CLASS, "Product");
                        
            // $ps is an array.
            if (count($ps) > 0) {
                constructTable($ps);
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