<?php
  $id = filter_input(INPUT_POST, 'userID');

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

# get sales revenue per month
  $query = "SELECT c.date AS `Date`, SUM(s.revenue) AS Revenue
            FROM nobrainers_analytical.calendar AS c, nobrainers_analytical.sales AS s
            WHERE c.calendarkey = s.calendarkey
            AND s.farmerkey = :id
            GROUP BY c.year";

  $ps = $con->prepare($query);
  $ps->execute(array(':id'=>$id));

  $data = [['x'],['revenue per year']];

  while($sales = $ps->fetch()) {
    $date = $sales['Date'];
    $revenue = $sales['Revenue'];

    array_push($data[0], $date);
    array_push($data[1], $revenue);
  }

  echo json_encode($data);
?>