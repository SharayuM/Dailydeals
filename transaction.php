<?php
session_start();

$email_logged = $_SESSION['email'];

//echo $email_logged;
$con  = new MongoClient();
if($con){
 // echo 'hi';
  $database = $con->dailydeals;

  $delivery = $database->user;

  $find = $delivery->find(array('email' => $email_logged));

  if(!count($find)){
          $doc = array('email' => $email,
                       'orders' => array(array('order_id' => new MongoID($id),'sizes' => array(array('size'=>$size,'quantity'=>$quantity)))));
          $bag->save($doc);
      }
      else{
      	
      }

  echo $email_logged;
  // header('Location: index.php');


 }

?>
