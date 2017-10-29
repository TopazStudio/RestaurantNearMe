<?php

include('connection.php');

//To get total likes
$sql = "SELECT SUM(Likes) AS 'sum' FROM cuisine WHERE restaurantid=''";

$result = mysqli_query($db, $sql);

$row = mysqli_fetch_assoc($result); 

$numliked = $row['sum'];

mysqli_free_result($result);



//To get the number of dislikes
$sql = "SELECT SUM(dislikes) AS 'sum' FROM cuisine WHERE restaurantid=''";

$result = mysqli_query($db, $sql);

$row = mysqli_fetch_assoc($result); 

$numdisliked = $row['sum'];

mysqli_free_result($result);




?>