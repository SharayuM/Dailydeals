<?php
$id = $_GET['id'];
//echo $id;
$con = new Mongoclient();
if($con){
	$database = $con->dailydeals;

	$delivery = $database->delivery;

	$delivery->remove(array('_id' => new MongoID($id)));

	header('Location:delivery.php');
}
else{
	die('database not connected');
}
?>