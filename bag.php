  <?php

$flag=0;
session_start();
$email_logged = $_SESSION['email'];
$user="";

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bag</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <link rel="stylesheet" type="text/css" href="style.css">
   <style>
   .footer {
    /*border-top: 1px solid black;*/
    padding: 10px;
    color:white;
    clear: left;
    width: 100%;
    bottom: 0;
    height: 150px;
    position:relative;
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
<a class="navbar-brand" href="index.php"><img src="dd.jpeg"width="75" height="75"></a>
    </div>
    
    </div>
</nav>
     <br/><h3 class="container" style="padding-left:110px">Your Shopping Bag</h3>
     <div class="container" style="display:inline-block;margin-left:50px;">
    <?php
   // $id = $_SESSION['id'];
    $oprice=0;
    $nprice=0;
    $dprice=0;
    $email = $_SESSION['email'];
    $con = new MongoClient();
    if($con){
      $databse=$con->dailydeals; 
    
      $bag=$databse->bag;     

      $product = $databse->product;

      $result = $bag->find(array('email' => $email));

      foreach ($result as $key) {
        //echo $key['count'];
        $p[]=$key['product'];
        //print_r($p);
        foreach ($p as $index) {
          foreach ($index as $item) {
            $id = $item['product_id'];
            $output = $product->findOne(['_id' =>new MongoID($id)]);
              $oprice = $oprice+$output['price'];
              $nprice = $nprice+$output['new_price'];
            if($item['L']==1){
        
              $size = "L";
              //$image = $output['fpic']->bin; 
              echo'
              <div class="col-md-8" style="padding:0px;border:1px solid #E8E1E1;margin-left:100px;margin-right:10px;margin-bottom:10px;width:600px;">
               <span class="col-md-4" style="margin:5px;">';?> <img src="data:image/jpeg;base64,<?php echo $output['fpic'];?>" height="140px" width="110px"><?php
              echo '</span>
              
              <span class="col-md-4"><p><span>'.$output['brand'].$output['name'].'Rs.'.$output['new_price'].'</span></p>
              <p><span>Size:&nbsp;L</span><span style="padding-left:20px;">Quantity:&nbsp;1</span><span style="padding-left:60%;color:red;"><del>Rs.'.$output['price'].'</del>('.$output['discount'].'%Off)</span></p>
              <p>Sold By: '.$output['seller'].'</p>
              <p><a href="removebag.php?id='.$id.'&gender='.$gender.'&email='.$email_logged.'&size='.$size.'" class="btn btn-link" style="margin-left:270px;margin-bottom:0px;color:red">Remove</a></p>
              </span>
              </div>';
              //echo 'L';
            }
            if($item['S']==1){
             
              $size = "S";
              //$image = $output['fpic']->bin; 
              echo'
              <div class="col-md-8" style="padding:0px;border:1px solid #E8E1E1;margin-left:100px;margin-right:10px;margin-bottom:10px;width:600px;">
               <span class="col-md-4" style="margin:5px;">';?> <img src="data:image/jpeg;base64,<?php echo $output['fpic'];?>" height="140px" width="110px"><?php
              echo '</span>
              
              <span class="col-md-4"><p><span>'.$output['brand'].$output['name'].'Rs.'.$output['new_price'].'</span></p>
              <p><span>Size:&nbsp;S</span><span style="padding-left:20px;">Quantity:&nbsp;1</span><span style="padding-left:60%;color:red;"><del>Rs.'.$output['price'].'</del>('.$output['discount'].'%Off)</span></p>
              <p>Sold By: '.$output['seller'].'</p>
              <p><a href="removebag.php?id='.$id.'&gender='.$gender.'&email='.$email_logged.'&size='.$size.'" class="btn btn-link" style="margin-left:270px;margin-bottom:0px;color:red">Remove</a></p>
              </span>
              </div>';
              //echo 'S';
            }
            if($item['M']==1){
              
              $size = "M";
              //$image = $output['fpic']->bin; 
              echo'
              <div class="col-md-8" style="padding:0px;border:1px solid #E8E1E1;margin-left:100px;margin-right:10px;margin-bottom:10px;width:600px;">
               <span class="col-md-4" style="margin:5px;">';?> <img src="data:image/jpeg;base64,<?php echo $output['fpic'];?>" height="140px" width="110px"><?php
              echo '</span>
              
              <span class="col-md-4"><p><span>'.$output['brand'].$output['name'].'Rs.'.$output['new_price'].'</span></p>
              <p><span>Size:&nbsp;M</span><span style="padding-left:20px;">Quantity:&nbsp;1</span><span style="padding-left:60%;color:red;"><del>Rs.'.$output['price'].'</del>('.$output['discount'].'%Off)</span></p>
              <p>Sold By: '.$output['seller'].'</p>
              <p><a href="removebag.php?id='.$id.'&gender='.$gender.'&email='.$email_logged.'&size='.$size.'" class="btn btn-link" style="margin-left:270px;margin-bottom:0px;color:red">Remove</a></p>
              </span>
              </div>';
              //echo 'M';
            }
            if($item['XL']==1){
              
              $size = "XL";
              //$image = $output['fpic']->bin; 
              echo'
              <div class="col-md-8" style="padding:0px;border:1px solid #E8E1E1;margin-left:100px;margin-right:10px;margin-bottom:10px;width:600px;">
               <span class="col-md-4" style="margin:5px;">';?> <img src="data:image/jpeg;base64,<?php echo $output['fpic'];?>" height="140px" width="110px"><?php
              echo '</span>
              
              <span class="col-md-4"><p><span>'.$output['brand'].$output['name'].'Rs.'.$output['new_price'].'</span></p>
              <p><span>Size:&nbsp;XL</span><span style="padding-left:20px;">Quantity:&nbsp;1</span><span style="padding-left:60%;color:red;"><del>Rs.'.$output['price'].'</del>('.$output['discount'].'%Off)</span></p>
              <p>Sold By: '.$output['seller'].'</p>
              <p><a href="removebag.php?id='.$id.'&gender='.$gender.'&email='.$email_logged.'&size='.$size.'" class="btn btn-link" style="margin-left:270px;margin-bottom:0px;color:red">Remove</a></p>
              </span>
              </div>';
              //echo 'XL';
            }
            //echo $item['product_id'].'<br>';
          }
        }
      }
      /*foreach ($result as $doc) {
      
              $product = $databse->product;
              $id = $doc['_id'];
              $productid = $doc['product_id'];
              $size = $doc['size'];
              $quantity = $doc['quantity'];
              
              $output = $product->findOne(['_id' =>new MongoID($productid)]);

              $oprice = $oprice+$doc['price'];
              $nprice = $nprice+$doc['newprice']*$doc['quantity'];
              
              //$image = $output['fpic']->bin; 
              echo'
              <div class="col-md-8" style="padding:0px;border:1px solid #E8E1E1;margin-left:100px;margin-right:10px;margin-bottom:10px;width:600px;">
               <span class="col-md-4" style="margin:5px;">';?> <img src="data:image/jpeg;base64,<?php echo $output['fpic'];?>" height="140px" width="110px"><?php
              echo '</span>
              
              <span class="col-md-4"><p><span>'.$output['brand'].$output['name'].'Rs.'.$output['new_price'].'</span></p>
              <p><span>Size:&nbsp;'.$doc['size'].'</span><span style="padding-left:20px;">Quantity:&nbsp;'.$doc['quantity'].'</span><span style="padding-left:60%;color:red;"><del>Rs.'.$output['price'].'</del>('.$output['discount'].'%Off)</span></p>
              <p>Sold By: '.$output['seller'].'</p>
              <p><a href="removebag.php?id='.$id.'&gender='.$gender.'&email='.$email_logged.'" class="btn btn-link" style="margin-left:270px;margin-bottom:0px;">Remove</a></p>
              </span>
              </div>';
            }*/?>
             <div style="display:inline-block;border:1px solid #E8E1E1;margin:left:40px;width:300px;padding:20px;">
              <?php
              $exp=0;
              foreach ($result as $show) {
                $pro[]=$show['product'];
                foreach ($pro as $mad) {
                  foreach ($mad as $idiot) {
                    $exp++;
                  }
                }
              }
              //echo $exp;
              if ($exp==0) {
                echo '<div style="width:500px;height:500px;">No items added to bag</div>';
              }
              else{
              $dprice = $oprice-$nprice;
              echo '<p><b>Price Details</b></p>
              <p>Bag Total:<span style="float:right;">Rs.'.$oprice.'</span></p>
              <p>Bag Discount:<del style="float:right;color:red;">-Rs.'.$dprice.'</del></p>
              <p>Delivery:<span style="float:right;">';if($nprice<=500){echo '+Rs.30'; $nprice=$nprice+30;}else{echo 'FREE';}echo '</span></p><hr>
              <p><b>Order Total<span style="float:right;">Rs.'.$nprice.'</span><b></p>
              <hr>
              <p> <a href="delivery.php" class="btn btn-default" style="margin-left:40px;padding:10px 25px;border-radius:0px;">PLACE ORDER </a></p>'
              ?>
              </div>
              <?php
            }
            
    }

  ?></div>
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
    $(".btn-primary").click(function(){
        $("[data-toggle='popover']").popover('show');
    });
  });
</script>
    </body>
    </html>
