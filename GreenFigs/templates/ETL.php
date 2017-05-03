<?php

print "ETL Staring<br>";

try{
	$con = new PDO("mysql:host=localhost;dbname=nobrainers","nobrainers", "sesame");
	$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $ex) {
	echo 'connection failed1';
	echo 'ERROR: '.$ex->getMessage();
}catch(Exception $ex) {
	echo 'connection failed2';
	echo 'ERROR: '.$ex->getMessage();
}

$query = "insert into nobrainers_analytical.product(productkey,productid,productname,productprice,productcategory,productcertification) 
		  select null,ProductID,Name,Price,CategoryID,Certification from nobrainers.product 
		  on duplicate key UPDATE productname=Name,productprice=Price,productcategory=CategoryID,productcertification=Certification";

$ps = $con->prepare($query);
$ps->execute();

print "product loaded<br>";


$query = "insert into nobrainers_analytical.farmer(farmerkey,farmerid,farmerfirstname,farmerlastname,farmeremail,farmerpassword,farmeraptnum,farmerstreet,farmercity,farmerstate,farmercountry,farmerzip)
		  select null,FarmerID,FirstName,LastName,Email,Password,AptNum,StreetName,City,State,Country,Zip from nobrainers.farmer
		  on duplicate key UPDATE farmerfirstname=FirstName,farmerlastname=LastName,farmeremail=Email,farmerpassword=Password,farmeraptnum=AptNum,farmerstreet=StreetName,farmercity=City,farmerstate=State,farmercountry=Country,farmerzip=Zip";

$ps = $con->prepare($query);
$ps->execute();

print "farmer loaded<br>";


