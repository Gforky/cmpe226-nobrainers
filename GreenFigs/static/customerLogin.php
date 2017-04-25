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
    if ($data) {
        header('Location: http://localhost/GreenFigs/templates/customerAllProducts.php?user='.$data['CustomerID']."&glutenFree=true&nonGmo=true&organic=true&vegetables=true&fruit=true&meat=true&seafood=true&pasta=true&condiment=true&dairy=true");
		exit;
    }
    else {
        print "<h3>No User found or Wrong Password</h3><br>\n";
        print "<h3>Try to <a href='/GreenFigs/templates/login.html'>Log In</a> again</h3><br>\n";
        print "<h3>Or sign up here <a href='/GreenFigs/templates/signup.html'> Sign Up</a>\n";
    }
?>