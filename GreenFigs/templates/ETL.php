<?php

print "ETL Staring\n";

try{
	$con = new PDO("mysql:host=localhost;","nobrainers", "sesame");
	$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $ex) {
	echo 'connection failed1';
	echo 'ERROR: '.$ex->getMessage();
}catch(Exception $ex) {
	echo 'connection failed2';
	echo 'ERROR: '.$ex->getMessage();
}

$query = "select * from nobrainers.farmer";

print $query;
$ps = $con->prepare($query);
$ps->execute();
$data = $ps->fetch(PDO::FETCH_ASSOC);

foreach($data as $row){
	print $row;
}
