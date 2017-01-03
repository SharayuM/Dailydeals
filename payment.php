<?php
//$id = $_POST['id'];
$no = $_GET['no'];
//echo $id;
//echo $no;
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
  margin-left: 200px;
        }
   .input
   {
    margin-left: 200px;
   }
   .cbtn
   {
    margin-left: 255px;
   }
   .btn-cod{
    margin-left: 150px;
    margin-top:-55px;
    background-color:rgb(40, 160, 229);
    color:white;
    padding:2.5px 15px;
  }
  .button2-link{
    margin-left: 430px;
    background-color:black;
    border-radius: 5px;

  }
  .footer {
    /*border-top: 1px solid black;*/
    padding: 10px;
    color:white;
    clear: left;
    width: 100%;
    bottom: 0;
    height: 150px;
    position:fixed;
    background:#454545;
    padding-top: 2px;
   padding-left: -40px;
   padding-right: 50px;
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
            $product = $database->product;
            $delivery = $database->user;
            //echo $email;
            /*$result = $bag->find(array('email' => $email));

      foreach ($result as $key) {
        //echo $key['count'];
        $p[]=$key['product'];
        //print_r($p);
        foreach ($p as $index) {
          foreach ($index as $item) {
            $id = $item['product_id'];
            $output = $product->findOne(['_id' =>new MongoID($id)]);
              $oprice = $oprice+$output['price'];
              $nprice = $nprice+$output['new_price'];*/
             // echo $price;
            $find = $bag->find(array('email'=>$email_logged));
            foreach ($find as $doc) {
              $p[]=$doc['product'];
              foreach ($p as $index) {
                foreach ($index as $item) {
                  $id = $item['product_id'];
                  $fetch = $product->findOne(['_id' =>new MongoID($id)]);
                  //var_dump($fetch);
                  $price = $price+$fetch['price'];
                  $newprice = $newprice+$fetch['new_price'];
                }
              }
            }
            $discount = $price-$newprice;
            echo '<p>Bag Total:<span style="padding-left:55px;">Rs.'.$price.'<span></p>
                  <p>Bag Discount:<span style="padding-left:30px;">-Rs.'.$discount.'</span></p>
                  <p><b>Order Total:<span style="padding-left:45px;">Rs.'.$newprice.'</span></b></p>';

        ?>
      </span>
      <span style="float:right;">
        <p style="font-size:17px;font-weight:bold;">Deliver To:</p>
        <?php
        $m=1;
        $result = $delivery->find(array('email' => $email_logged));
       // var_dump($result);
        //echo $m;
        foreach ($result as $key) {
          //echo $key['firstname'];
          $address[]=$key['addresses'];
          foreach ($address as $value) {
            foreach ($value as $display) {
              if($m==$no){
                $index=$display['no'];
                echo '<p style="font-weight:bold;">'.$display['fullname'].'</p>
                <p>'.$display['address'].'</p>
                <p>'.$display['city'].$display['state'].$display['pincode'].'</p>';
                break;
              }
              else{
                $m++;
                //continue;
              }
            }
          }
        }
        /*foreach ($result as $key) {
          echo '<p style="font-weight:bold;">'.$key['fullname'].'</p>
                <p>'.$key['address'].'</p>
                <p>'.$key['city'].$key['state'].$key['pincode'].'</p>';
        }*/
        
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
      <p style="font-weight:bold;font-size:16px;">Method Of Payment</p></br>
       <form action="charge.php?no=<?php echo $no;?>&index=<?php echo $index;?>" method="POST">
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
    
    <button class="btn btn-cod" data-toggle="modal" data-target="#SignModal" id="butns"><b>COD</b></button>
          <div class="modal fade" id="SignModal" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header" style="padding:30px 50px;height:50px">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4><b>Cash On Delivery</b></h4>
                </div>
                 <div class="modalbody" style="padding:5px 5px;">
                 <head>
<script type="text/javascript">
function Captcha(){
var alpha = new Array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',0,1,2,3,4,5,6,7,8,9,'@','$','#','*');
var i;
for (i=0;i<6;i++){
var a = alpha[Math.floor(Math.random() * alpha.length)];
var b = alpha[Math.floor(Math.random() * alpha.length)];
var c = alpha[Math.floor(Math.random() * alpha.length)];
var d = alpha[Math.floor(Math.random() * alpha.length)];
var e = alpha[Math.floor(Math.random() * alpha.length)];
var f = alpha[Math.floor(Math.random() * alpha.length)];
var g = alpha[Math.floor(Math.random() * alpha.length)];
}
var code = a + ' ' + b + ' ' + ' ' + c + ' ' + d + ' ' + e + ' '+ f + ' ' + g;
document.getElementById("mainCaptcha").value = code
}
function ValidCaptcha(){
var string1 = removeSpaces(document.getElementById('mainCaptcha').value);                      
var string2 = removeSpaces(document.getElementById('txtInput').value);
if (string1 == string2){
return true;
}
else{
return false;
}
}
function removeSpaces(string){
return string.split(' ').join('');
}
</script>
</head>

<body onload="Captcha();">

<table>
<tr>
<td>
<br>
</td>
</tr>

<tr>
<td>
<input class="blur" type="text" id="mainCaptcha"  disabled>
<input type="button" id="refresh" value="Refresh" onclick="Captcha();" />
</td>
</tr>


<tr>
<td>
<input class="input"type="text" id="txtInput"/></br>
</td>
</tr>

<tr>
<td>
<input class='cbtn' id="Button1" type="button" value="Check" onclick="alert(ValidCaptcha());"/></br></br>
<a href="order.php?no=<?php echo $no;?>&index=<?php echo $index;?>"><button class="buttons button2-link">PAY ON DELIVERY</button></a> 
</td>
</tr>
</table>
 </div>
</div>
</div>
   
    
  </div>
</div>
<!--button class="buttons button2">PAY ON DELIVERY</button-->    
    
  </div>
</div>
    </div>
  </div>
  </div>

              </div>

              <footer>
  <br>
      <div class="footer">
      <p><b>Online Shopping</b></p>
      <a href="men.php"><button type="button" class="btn btn-link">MEN</button></a><br>
       <a href="women.php"><button type="button" class="btn btn-link">WOMEN</button></a><br>
        <a href="kids.php"><button type="button" class="btn btn-link">KIDS</button></a>
        <div class="foot">
        <p><b>USEFUL LINKS</b></p>
        <a href="about_us.php"><button type="button" class="btn btn-link">ABOUT US</button></a><br>
        <a href="developers.php"><button type="button" class="btn btn-link">DEVELOPERS</button></a><br>
       </div>
       <div class="map">
       <p><b>METHOD OF PAYMENT</b></p>
       <img src="cod.png">
       </div>
        </div>
</footer>
            <script>
              $(document).ready(function(){
                $("#myBtn").click(function(){
                    $("#myModal").modal();
                });
            });
            </script>
          
          </div>
        </div>
      
  </div>
   </body>
   </html>