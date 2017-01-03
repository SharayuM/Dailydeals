<?php
if(isset($_POST['register']))
{      
  $email = $_POST['email'];
  $fullname = $_POST['fullname'];
  $mobile = $_POST['mobile'];
  $address = $_POST['address'];
  $country = $_POST['country'];
  $pincode = $_POST['pincode'];
  $city = $_POST['city'];
  $state = $_POST['state'];

  //echo $email;
  
  // connect to mongodb
   $con = new MongoClient();

//==========================
  if($con)
  {
 
    //connecting to database
    $database=$con->dailydeals;
    //echo "Database 'mydb' selected";
    
    //connect to specific collection
    $collection=$database->user;
    

   // $fetch = $collection->find(array('email'=>$email));

    $doc = array('addresses'=>array('no' => new MongoID(),'fullname'=>$fullname,'mobile'=>$mobile,'address'=>$address,'country'=>$country,'pincode'=>$pincode,'city'=>$city,'state'=>$state));

    $collection->update(array('email'=>$email),
                        array('$addToSet'=>$doc));
    //$query = $collection->save($doc);
    header('Location:delivery.php');
  

}
}
?>