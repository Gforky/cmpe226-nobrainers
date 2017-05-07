<?php
  $id = filter_input(INPUT_POST, 'userID') + 1;

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

  # get number of recipes per customer
  $query = "SELECT calendarkey AS calendar, customerfirstname AS FName, customerlastname AS LName, COUNT(*) AS Sum
            FROM nobrainers_analytical.recipe, nobrainers_analytical.customer
            WHERE nobrainers_analytical.recipe.customerkey = :id
            AND nobrainers_analytical.customer.customerkey = :id
            GROUP BY nobrainers_analytical.recipe.calendarkey
            HAVING COUNT(*) >= 1";

  $ps = $con->prepare($query);
  $ps->execute(array(':id'=>$id));

  $data = [['x'],['recipe']];

  while($number = $ps->fetch()) {
    $calendar = $number['calendar'];
    $query = "SELECT  `date` AS pDate
              FROM nobrainers_analytical.calendar
              WHERE calendarkey = $calendar";
    $ps1 = $con->prepare($query);
    $ps1->execute();
    $pDate = $ps1->fetch();

    array_push($data[0], $pDate['pDate']);
    array_push($data[1], $number['Sum']);
  }

  echo json_encode($data);
?>