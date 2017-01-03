<?php
$id = $_GET['id'];
//echo $id;
session_start();
$email_logged = $_SESSION['email'];
//echo $email_logged;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <link rel="stylesheet" type="text/css" href="style.css">
  <style>
  .blur {
   color: #F2F4F4;
   text-shadow: 0 0 5px rgba(0,0,0,0.5);
}
  </style>
</head>

<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><img src="dd.jpeg"width="75" height="75"></a>
   </div>
  </div>
</nav>
  <div class="container" style="border:1px solid #E8E1E1;width:700px;height:400px;"><h4 style="font-weight:bold;text-align:center;">ORDER SUMMARY</h4><hr>
    <div>
      <span style="display:inline-block;margin-right:20px;margin-left:20px;">
        <p style="font-size:17px;font-weight:bold;">Bag Total:</p>
        <?php 
          //$email = $email_logged;
          $price = 0;
          $discount = 0;
          $newprice = 0;
          $con = new Mongoclient();
          if ($con) {
            $database = $con->dailydeals;
            $bag = $database->bag;
            //echo $email;
            $find = $bag->find(array('email'=>$email_logged));
            foreach ($find as $doc) {
              $price = $price+$doc['price'];
              $newprice = $newprice+$doc['newprice']*$doc['quantity'];
            }
            $discount = $price-$newprice;
            echo '<p>Bag Total:<span style="padding-left:55px;">Rs.'.$price.'<span></p>
                  <p>Bag Discount:<span style="padding-left:30px;">-Rs.'.$discount.'</span></p>
                  <p><b>Order Total:<span style="padding-left:45px;">Rs.'.$newprice.'</span></b></p>';

        ?>
      </span>
      <span style="float:right;margin-right:45px;">
        <p style="font-size:17px;font-weight:bold;">Deliver To:</p>
        <?php
        $delivery = $database->delivery;
        $result = $delivery->find(array('_id' => new MongoID($id)));
       // echo $id;
        foreach ($result as $key) {
          echo '<p style="font-weight:bold;">'.$key['fullname'].'</p>
                <p>'.$key['address'].'.</p>
                <p>'.$key['city'].',&nbsp;'.$key['state'].'&nbsp;-'.$key['pincode'].'</p>';
        }
        
        }
          else{
            die('Database not connected!');
          }

        ?>
      </span>
    </div>
    <hr>
    <?php 
    $temp=$newprice*100;
    ?>
    <div class="mop" style="padding-left:20px;">
      <p style="font-weight:bold;font-size:16px;">Method Of Payment</p>
       <form action="charge.php" method="POST">
         <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="pk_test_JT3ZR5DlBuIUJ2dMaWkc8PVU"
            data-amount="<?php echo $temp?>"
            data-name="Daily Deals"
            data-description="Payment"
            data-currency="inr"
            data-image="dd.jpeg"
            data-locale="auto">
         </script>
      </form>

    </div>
  </div>
   </body>
   </html>