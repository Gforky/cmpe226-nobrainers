<html>

    <script type="text/javascript">
	  function done(){
        window.location = "/GreenFigs/templates/login.html";
	  }
    </script>
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


$query = "insert into nobrainers_analytical.customer(customerkey,customerid,customerfirstname,customerlastname,customeremail,customerpassword,customerstreet,customeraptnum,customercity,customerstate,customerzip,customercountry)
		  select null,CustomerID,FirstName,LastName,Email,Password,StreetName,AptNum,City,State,Zip,Country from nobrainers.customer
		  on duplicate key UPDATE customerfirstname=FirstName,customerlastname=LastName,customeremail=Email,customerpassword=Password,customeraptnum=AptNum,customerstreet=StreetName,customercity=City,customerstate=State,customercountry=Country,customerzip=Zip";

$ps = $con->prepare($query);
$ps->execute();

print "customer loaded<br>";

$query = "drop procedure if exists nobrainers_analytical.fillDates";
$ps = $con->prepare($query);
$ps->execute();

$query = "create procedure nobrainers_analytical.fillDates(dateStart DATE, dateEnd DATE)
  begin
    while dateStart <= dateEnd do
      insert ignore into nobrainers_analytical.calendar (calendarkey, date, month, quarter, dayofweek, year)
      values (null, dateStart, month(dateStart), quarter(dateStart), dayofweek(dateStart), year(dateStart));
      set dateStart = date_add(dateStart, interval 1 day);
    end while;
  end;";
$ps = $con->prepare($query);
$ps->execute();


$now = new DateTime();
$today = $now->format('Y-m-d');
$query = "call nobrainers_analytical.fillDates('2015-01-01','$today')";
$ps = $con->prepare($query);
$ps->execute();


print "calendar loaded<br>";

$query = "
INSERT into nobrainers_analytical.sales (tid,timeofday,unitssold,revenue,calendarkey,farmerkey,productkey,customerkey)
SELECT nobrainers.order.OrderID,
       nobrainers.order.DayTime,
	   nobrainers.isincludedproduct.Amount, 
       nobrainers.product.Price * nobrainers.isincludedproduct.Amount AS revenue,
       nobrainers_analytical.calendar.calendarkey,
       nobrainers_analytical.farmer.farmerkey,
       nobrainers_analytical.product.productkey,
       nobrainers_analytical.customer.customerkey
FROM nobrainers.order 
join nobrainers.isincludedproduct on nobrainers.order.OrderID = nobrainers.isincludedproduct.OrderID
join nobrainers.product on nobrainers.product.productID = nobrainers.isincludedproduct.productID
join nobrainers_analytical.calendar on nobrainers_analytical.calendar.date = nobrainers.order.Date
join nobrainers_analytical.farmer on nobrainers_analytical.farmer.farmerid = nobrainers.product.FarmerID
join nobrainers_analytical.product on nobrainers_analytical.product.productid = nobrainers.product.productID
join nobrainers_analytical.customer on nobrainers_analytical.customer.customerid = nobrainers.order.CustomerID
on duplicate key UPDATE
nobrainers_analytical.sales.unitssold = nobrainers.isincludedproduct.Amount,
nobrainers_analytical.sales.revenue = nobrainers.product.Price * nobrainers.isincludedproduct.Amount 
";

$ps = $con->prepare($query);
$ps->execute();

print "sales loaded<br>";

$query = "
INSERT into nobrainers_analytical.recipe (rtid,timeofday,calendarkey,customerkey)
SELECT CONCAT(nobrainers.recipe.Recipename ,':', nobrainers.recipe.CustomerID),
	   nobrainers.recipe.DayTime, 
       nobrainers_analytical.calendar.calendarkey,
       nobrainers_analytical.customer.customerkey
FROM nobrainers.recipe 
join nobrainers_analytical.calendar on nobrainers_analytical.calendar.date = nobrainers.recipe.Date
join nobrainers_analytical.customer on nobrainers_analytical.customer.customerid = nobrainers.recipe.CustomerID
on duplicate key UPDATE
nobrainers_analytical.recipe.timeofday = nobrainers.recipe.DayTime
";

$ps = $con->prepare($query);
$ps->execute();

print "recipe loaded<br>";


print "         <button style='width:70px;height:35px' type='button' onclick='done()'>Done</button>\n";

