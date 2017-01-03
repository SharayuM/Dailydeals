<?php
  $no = $_GET['no'];
  $index =$_GET['index'];
    //echo "<h1>line one<h1>";
    require_once ('vendor/autoload.php');
     Stripe::setApiKey('sk_test_A16OaAOq71k5SExWI4oSLDmy');
    // echo "<h2>line two<h2>";
    //require_once('success.php');

      //echo $_POST['stripeToken'];
      if(isset($_POST['stripeToken'])) {

    $token = $_POST['stripeToken'];
        // echo "<h3>line three<h3>";
    Stripe_Charge::create(array(
  "amount" => 2000,
  "currency" => "usd",
  "source" => $token, 
  "description" => "Charge for sofia.smith@example.com"
));
    header('Location:order.php?no='.$no.'&index='.$index);
    //header('Location:pro_details.php?id='.$id);
      
}
?>
