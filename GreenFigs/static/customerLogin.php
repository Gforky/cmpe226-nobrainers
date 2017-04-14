<?php
	$email = filter_input(INPUT_POST, "customerEmail");
	$passwd = filter_input(INPUT_POST, "customerPasswd");
	// Connect to the database.
    $con = new PDO("mysql:host=localhost;dbname=nobrainers",
                   "nobrainers", "sesame");
    $con->setAttribute(PDO::ATTR_ERRMODE,
                       PDO::ERRMODE_EXCEPTION);
    
    $query = "SELECT CustomerID
    		   FROM customer
    		   WHERE Email = :email 
    		   AND Password = :passwd";
                                                   
    $ps = $con->prepare($query);

    // Fetch the matching row.
    $ps->execute(array(':email' => $email, ':passwd' => $passwd));
    $data = $ps->fetch(PDO::FETCH_ASSOC);
                
    // $data is an array.
    if (count($data) > 0) {
        header('Location: http://localhost/GreenFigs/templates/index.html?user='.$data['CustomerID']);
		exit;
    }
    else {
        print "<h3>No User found or Wrong Password</h3>\n";
    }
?>