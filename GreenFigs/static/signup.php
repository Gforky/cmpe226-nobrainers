<?php
    $role = filter_input(INPUT_POST, "role");
	$email = filter_input(INPUT_POST, "email");
	$passwd = filter_input(INPUT_POST, "passwd");
    $firstname = filter_input(INPUT_POST, "firstname");
    $lastname = filter_input(INPUT_POST, "lastname");
    $phone = filter_input(INPUT_POST, "phone");
    $street = filter_input(INPUT_POST, "street");
    $apt = filter_input(INPUT_POST, "apt");
    $city = filter_input(INPUT_POST, "city");
    $zip = filter_input(INPUT_POST, "zip");
    $state = filter_input(INPUT_POST, "state");
    $country = filter_input(INPUT_POST, "country");   

	// Connect to the database.
    $con = new PDO("mysql:host=localhost;dbname=nobrainers",
                   "nobrainers", "sesame");
    $con->setAttribute(PDO::ATTR_ERRMODE,
                       PDO::ERRMODE_EXCEPTION);

    switch ($role) {
        case 'customer':
            $query = "SELECT *
              FROM customer
              WHERE Email = :email";
            $query1 = "SELECT COUNT(*) 
               AS total
               FROM customer";
            break;
        case 'farmer':
            $query = "SELECT *
              FROM farmer
              WHERE Email = :email";
            $query1 = "SELECT COUNT(*)
               AS total
               FROM farmer";
            break;
        default:
            # code...
            break;
    }

    $ps = $con->prepare($query);

    $ps->execute(array(':email' => $email));
    $data = $ps->fetchall(PDO::FETCH_ASSOC);

    if(count($data) > 0) {
        print "<h3>User with the same email already existed,</h3>\n";
        print "<h3>please log in here<a href='/GreenFigs/templates/login.html'>Log In</a></h3>\n";
        exit;
    }
                                                   
    $ps1 = $con->prepare($query1);

    // Fetch the matching row.
    $ps1->execute();
    $count = $ps1->fetch(PDO::FETCH_ASSOC);

    $id = $count['total'] + 1;

    switch ($role) {
        case 'customer':
            $query2 = "INSERT INTO customer
               VALUES ($id, :firstname, :lastname, :email, :passwd, :street, :apt, :city, :state, :zip, :country)";
            $query3 = "INSERT INTO customerphone
                VALUES (:phone, $id)";
            break;
        case 'farmer':
            $query2 = "INSERT INTO farmer
               VALUES ($id, :firstname, :lastname, :email, :passwd, :street, :apt, :city, :state, :zip, :country)";
            $query3 = "INSERT INTO farmerphone
                VALUES (:phone, $id)";
            break;
        default:
            # code...
            break;
    }

    $ps2 = $con->prepare($query2);

    $ps2->execute(array(':firstname' => $firstname,
                        ':lastname' => $lastname,
                        ':email' => $email,
                        ':passwd' => $passwd,
                        ':street' => $street,
                        ':apt' => $apt,
                        ':city' => $city,
                        ':state' => $state,
                        ':zip' => $zip,
                        ':country' => $country));

    $ps3 = $con->prepare($query3);

    $ps3->execute(array(':phone' => $phone));
                
    header('Location: http://localhost/GreenFigs/templates/index.html?user='.$id);
    exit;
?>