<?php
session_start();
$email_logged = $_SESSION['email'];
if(isset($_POST['login']) )
{  
  $email = $_POST['email'];
  $upass = $_POST['pass'];
  $id = $_POST['id'];
  $gender = $_POST['gender'];
  
  // connect to mongodb
   $con = new MongoClient();
    //  Select Database
      $db = $con->dailydeals;
      //echo "Database mydb selected";
    //  Select Collection
      $collection = $db->user;
      //echo "Collection Selected succsessfully";
    
  $qry = array("email" => $email,"password" => $upass);
  $result = $collection->findOne($qry);
  if($result){
   // echo '<script>alert("Logged In Successfully")</script>';
    $_SESSION['email'] =$email;
    $email_logged=$email;
    $flag=1;

    
  }
else{
    echo '<script>alert("InCorrect Info.")</script>';
  }
  header('Location: pro_details.php?id='.$id.'&gender='.$gender.'&email='.$email_logged);

}
?>