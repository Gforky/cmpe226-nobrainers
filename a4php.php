<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>find customer info by id</title>
</head>
<body>
	<p>
		<?php
		$cid = filter_input(INPUT_POST,"cid");
		print $cid;
		echo "aaaaaaaaaa";
		
		try
		{
			//Connect to the database.
			$con = new PDO("mysql:host = localhost;dbname = nobrainers","nobrainers","sesame");
			$con-> setAttribute(PDO::ATTR_ERRMODE,
								PDO::ERRMODE_EXCEPTION);
			$query = "SELECT CustomerId,FirstName,LastName FROM customer".
				" WHERE CustomerId = '$cid'";
			 // construct an HTML table.
                print "<table border='1'>\n";
                
                // Query the database.
                $data = $con->query($query);
                $data->setFetchMode(PDO::FETCH_ASSOC);
                
                // Construct the HTML table row by row.
                // Start with a header row.
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
                    print "            <tr>\n";
                    foreach ($row as $name => $value) {
                        print "                <td>$value</td>\n";
                    }
                    print "            </tr>\n";
                }
                
                print "        </table>\n";
			
		}
		catch(PDOException $ex) {
                echo 'ERROR: '.$ex->getMessage();
            }  
              
		?>
	</p>
</body>
</html>