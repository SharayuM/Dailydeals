<?php
$count = 0;
session_start();
$email_logged = $_SESSION['email'];

//echo $email_logged;
$con  = new MongoClient();
if($con){
 // echo 'hi';
  $database = $con->dailydeals;

  $delivery = $database->user;

  $find = $delivery->find(array('email' => $email_logged));

  foreach ($find as $key) {
    $address[]=$key['addresses'];
    foreach ($address as $doc) {
      foreach ($doc as $value) {
        $count++;
      }
    }
    }
    //echo $count;
  }
else{
  die("Database are not connected");
}

?>
<script type="text/javascript">
function check(){
   if($('input[type=radio]:checked').size() > 0){
    return true;
   }
   else{
    alert("Please select one address");
    return false;
   }
}


</script>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta  charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <link rel="stylesheet" type="text/css" href="style.css">
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
    <div class="container">
      <div class="col-md-5" style="display:inline-block;border:1px solid #E8E1E1;margin-right:25px;margin-left:50px;">
        <h4>Delivery Address (New)</h4>
          <form role="form" method="POST" action="address.php">
  <div class="form-group">
      <label for="usr">Full Name*:</label>
      <input type="text" class="form-control" name="fullname" placeholder=" Enter Fullname"  pattern="[A-Za-z].{1,}" required>
  </div>
    <div class="form-group">
      <label for="usr">Mobile Number*:</label>
      <input type="text" class="form-control" name="mobile" placeholder=" Enter Mobile Number" pattern="^\d{10}$"required>
     
    </div>
    <input type="hidden" name="email" value="<?php echo $email_logged;?>">
    <div class="form-group">
      <label for="comment">Address*:</label>
      
      <textarea class="form-control" rows="5" name="address" placeholder=" Enter Address"  pattern="[A-Za-z].{1,}"required ></textarea>
    </div>
    <div class="form-group">
      <label for="usr">City*:</label>
      <input type="text" class="form-control" name="city" placeholder=" Enter City"  pattern="[A-Za-z].{1,}" required>
      
    </div>
     <div class="form-group">
      <label for="usr">State*:</label>
      <input type="text" class="form-control" name="state" placeholder=" Enter State"  pattern="[A-Za-z].{1,}" required>
      
    </div>
     <div class="form-group">
      <label for="usr">Country*:</label>
      <input type="text" class="form-control" name="country" placeholder=" Enter Country"  pattern="[A-Za-z].{1,}" required>
     
    </div>
     <div class="form-group">
      <label for="usr">Pincode*:</label>
      <input type="text" class="form-control" name="pincode" placeholder=" Enter Pincode" pattern="^\d{6}$" required>
      
    </div>
     
    <button type="submit" class="btn btn-default" name="register" style="border-radius:0px;">SUBMIT</button>
    <button type="reset" class="btn btn-default" style="float:right;border-radius:0px;">CANCEL</button>
  
  </form>
        
      </div>
      <div class="col-md-5" style="display:inline-block;border:1px solid #E8E1E1;margin-left:35px;">
        <?php
        if($con){
          $no=0;
          if($count>0){?>
            <form method="POST" action="payment.php" onsubmit="return check()">
           <?php echo '<h4 style="text-align:center;">Select Address</h4><hr>';
            foreach ($find as $key) {
              $address[]=$key['addresses'];
              foreach ($address as $doc) {
              foreach ($doc as $value) {
                //$id = $value['_id'];
              
              if($no!=$count){
                $no++;

              
              echo '
                    <h4><a href="payment.php?no='.$no.'"><input type="radio" name="addr" id="add" style="pointer-events:none;"></a>&nbsp;Address&nbsp;'.$no.'</h4>';?>
                    <!--input type="hidden" name="id" value="<?php //echo $value['_id']?>"-->
                   <?php echo '<p>Name:&nbsp;'.$value['fullname'].'</p>
                    <p>Contact No.:&nbsp;'.$value['mobile'].'</p>
                    <p>Address:&nbsp;'.$value['address'].'.</p>
                    <p style="padding-left:60px;">'.$value['city'].',&nbsp;'.$value['state'].'&nbsp;-&nbsp;'.$value['pincode'].'
                    <a href="removeadd.php?no='.$no.'" style="float:right;margin-right:20px;">Remove</a>
                    </p>
                    <hr>';
              }
              else{
                break;
              }
            }
            }
            }?>
            <!--input type="submit" class="btn btn-default" name="pay" value="Make Payment" style="border-radius:0px;padding:8px 28px;font-size:16px;margin-left:140px;"-->
            </form><?php

          }
          else{
            echo '<h4 style="padding-top:40%;text-align:center;padding-bottom:40%;">No Address Selected For Delivery!</h4>';
          }
        }
        else{
            die("Database are not connected");
          }

        ?>


      </div>

    </div>
</body>

</html>