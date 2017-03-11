<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Query Results</title>
</head>

<body>
    <h1>Query Results</h1>
    <?php
        class Product
        {
            private $ProductID;
            private $Price;
            private $Name;
            private $Certification;
            private $CategoryName;
            
            public function getId()     { return $this->ProductID; }
            public function getPrice()  { return $this->Price; }
            public function getName()   { return $this->Name; }
            public function getCert()   { return $this->Certification; }
            public function getCat()   { return $this->CategoryName; }
        }

        function constructTable(Product $product)
        {
            print "        <tr>\n";
            print "            <td>" . $product->getId()     . "</td>\n";
            print "            <td>" . $product->getPrice()  . "</td>\n";
            print "            <td>" . $product->getName()   . "</td>\n";
            print "            <td>" . $product->getCert()   . "</td>\n";
            print "            <td>" . $product->getCat()   . "</td>\n";
            print "        </tr>\n";
        }   

        $name  = filter_input(INPUT_GET, "name");
        $cert  = filter_input(INPUT_GET, "cert");
        
        try {
            // Connect to the database.
            $con = new PDO("mysql:host=localhost;dbname=nobrainers",
                           "nobrainers", "sesame");
            $con->setAttribute(PDO::ATTR_ERRMODE,
                               PDO::ERRMODE_EXCEPTION);
                
            $query1 = "SELECT ProductID, Price, Name, Certification, CategoryName 
                       FROM product p, category c
                       WHERE p.CategoryID = c.CategoryID"; 
                
            // Fetch the matching database table rows.
            $data = $con->query($query1);
            $data->setFetchMode(PDO::FETCH_CLASS, "Product");
                
            // We're going to construct an HTML table.
            print "    <table border='1'>\n";

            // Fetch the database field names.
            $result = $con->query($query1);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            
            // Construct the header row of the HTML table.
            print "            <tr>\n";
            foreach ($row as $field => $value) {
                    print "                <th>$field</th>\n";
            }
            print "            </tr>\n";

            // Constrain the query if we got name and cert
            if ((strlen($name) > 0) && (strlen($cert) > 0)) {
                $query2 = "SELECT ProductID, Price, Name, Certification, CategoryName 
                           FROM product p, category c
                           WHERE p.CategoryID = c.CategoryID
                           AND Name = :name
                           AND Certification = :cert";

                $ps = $con->prepare($query2);
                $ps->bindParam(':name', $name);
                $ps->bindParam(':cert',  $cert);
            }
            else {
                $ps = $con->prepare($query1);
            }
        
            // Fetch the matching database table rows.
            $ps->execute();
            $ps->setFetchMode(PDO::FETCH_CLASS, "Product");
            
            // Construct the HTML table row by row.
            while ($product = $ps->fetch()) {
                constructTable($product);
            }
            
            print "    </table>\n";
        }
        catch(PDOException $ex) {
            echo 'ERROR: '.$ex->getMessage();
        }        
    ?>
</body>
</html>