<?php
  $user="";
  session_start();
 // $password=$_SESSION['password'];
  $email_logged = $_SESSION['email'];
  if(isset($_POST['login']) )
  {  
    $email = $_POST['email'];
    $upass = $_POST['pass'];
    // connect to mongodb
    $con = new MongoClient();
    //  Select Database
    $db = $con->dailydeals;
      //echo "Database mydb selected";
    //  Select Collection
    $collection = $db->user;

    #function to  Generate OTP
$otp=rand(100000,999999);

#Updating the otp with new one on every login.
$collection->update(array("email" => $email),array('$set'=>array('otp_password' => $otp)));

#To check if email is invalid or password.
$flag_email=0;

#To check if email is invalid or password.
$flag_pass=0;

#Retrieving data from database and User Collection.
$search=$collection->find();

#Looking up in User Login info
foreach ($search as $document) 
{
  #To match the email from User Collection.
  if($document["email"]==$email)
    {
      #Valid email found.
      $flag_email=1;

      #To match the password with the email respectively.
      if($document["pass"]==$pass)
        {
          #Valid password  
          $_SESSION['email']=$email;
          $flag_pass=1;
          header('Location:otpgeneratedbackup.php');
          die();
        } 
      
    } 
    
}
    
      //echo "Collection Selected succsessfully";    
    $qry = array("email" => $email,"password" => $upass);
    $result = $collection->findOne($qry);
    if($result){
      $user = $result['firstname'];
      $_SESSION['email'] =$email;
      $email_logged=$email;  
    }
    else{
      echo '<script>alert("InCorrect Info.")</script>';
    }
  }
?>



<?php
$id = $_GET['id'];
$gender = $_GET['gender'];
session_start();
$email_logged = $_SESSION['email'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Product</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <link rel="stylesheet" type="text/css" href="style.css">
  
<script type="text/javascript">
    $(function () {
        $("#btnSubmit").click(function () {
            var password = $("#txtPassword").val();
            var confirmPassword = $("#txtConfirmPassword").val();
            if (password != confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        });
    });

</script>
<style type="text/css">
.img-thumbnail{
  margin-left: 15px;
  margin-right: 15px;
  border-radius: 0px;
  padding: 0px;
}
.img-thumbnail:hover{
  border:1px solid #555555;
}
* {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

.item {
  position: relative;
  margin: 2%;
  overflow: auto;
}
.item img {
  max-width: 100%;
  
  -moz-transition: all 0.3s;
  -webkit-transition: all 0.3s;
  transition: all 0.3s;
}
.item:hover img {
  -moz-transform: scale(2.5);
  -webkit-transform: scale(2.5);
  transform: scale(2.5);
}
#pro{
  margin-left: 40px;
  margin-top:-30px;
  padding-left: 5px;
  }
</style>
</head>
<body>
  <div class="<?php if(isset($email_logged)){echo 'hidenav';}?>">
    <nav class="navbar1"> 
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" class="btn btn-lg btn-link" data-toggle="modal" data-target="#SignModal" id="butns"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
          <div class="modal fade" id="SignModal" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header" style="padding:30px 50px;">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4><span class="glyphicon glyphicon-lock"></span> SignUp</h4>
                </div>
                <div class="modal-body" style="padding:40px 50px;">
                  <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" >
                    <div class="form-group">
                      <label for="name"><span class="glyphicon glyphicon-user"></span> Name</label>
                      <input type="text" class="form-control" name="fname" placeholder=" Enter Firstname"  pattern="[A-Za-z].{1,}" required><br>
                      <input type="text" class="form-control" name="lname" placeholder="Enter Lastname"  pattern="[A-Za-z].{1,}" required>
                    </div>
                    <div class="form-group">
                      <label for="usrname"><span class="glyphicon glyphicon-user"></span> Email-id</label>
                      <input type="text" class="form-control" name="email" placeholder="Enter email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                    </div>
                    <div class="form-group">
                      <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                      <input type="password" class="form-control" name="pass"  id="txtPassword" placeholder="Enter password" pattern=".{6,}" required>
                    </div>
                    <div class="form-group">
                      <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Confirm Password</label>
                      <input type="password" class="form-control" name="cpass" id="txtConfirmPassword" placeholder="Confirm password" pattern=".{6,}" required><?php echo $pass;?>
                    </div>
                    <div class="form-group">
                      <label for="mobile no"><span class="glyphicon glyphicon-phone"></span>Mobile No.(format:10 Digit number):</label>
                      <input type="tel" class="form-control" name="mobile" placeholder="Enter Mobile No"  pattern="^\d{10}" required>  
                    </div>
                     <a href="signup.php"> <button type="submit" class="btn btn-success btn-block" id="btnSubmit" name="signup"><span class="glyphicon glyphicon-off"></span> REGISTER</button></a>
                  </form>
                </div> 
              </div>
            <script>
              $(document).ready(function(){
                $("#myBtn").click(function(){
                    $("#myModal").modal();
                });
            });
            </script>
          </div>
        </div>
      </li>
      <li><a href="#" class="btn btn-lg btn-link" data-toggle="modal" data-target="#basicModal" id="butns"><span class="glyphicon glyphicon-lock"></span> Login</a><!-- Modal -->
        <div class="modal fade" id="basicModal" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">    <!-- Modal content-->
              <div class="modal-header" style="padding:30px 50px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
              </div>
              <div class="modal-body" style="padding:40px 50px;">
                <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                  <div class="form-group">
                    <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
                    <input type="text" class="form-control" name="email" placeholder="Enter email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                  </div>
                  <div class="form-group">
                    <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                    <input type="password" class="form-control" name="pass" placeholder="Enter password"  pattern=".{6,}" required>
                  </div>
                  <div class="checkbox">
                    <label><input type="checkbox" value="" checked>Remember me</label>
                  </div>
                  <button type="submit" class="btn btn-success btn-block" id="btnSubmit" name="login"><span class="glyphicon glyphicon-off"></span> Login</button>
                </form>
              </div>
             
         <div class="container">
  <a href="#" data-target="#pwdModal" data-toggle="modal">Forgot password?</a>
</div>
        
            </div>  
          </div>
        </div>
        <div id="pwdModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center">What's My Password?</h1>
      </div>
      <div class="modal-body">
          <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                          
                          <p>If you have forgotten your password you can reset it here.</p>
                            <div class="panel-body">
                                <fieldset><form action='forgetpassword.php' method='GET'>
                                    <div class="form-group">
                                        <input class="form-control input-lg" placeholder="E-mail Address" name="email" type="email">
                                    </div>
                                    <input class="btn btn-lg btn-primary btn-block" type="submit"></form>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
          <div class="col-md-12">
          <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
      </div>  
      </div>
  </div>
  </div>
</div>

        <script>
        $(document).ready(function(){
            $("#myBtn").click(function(){
                $("#myModal").modal();
            });
        });

        $(document).ready(function(){
  var fname = $('#fname').text();
  var intials = $('#fname').text().charAt(0);
  var profileImage = $('#profileImage').text(intials);
});
        </script>
      </li>
    </ul>
  </nav>
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php"><img src="dd.jpeg"width="75" height="75"></a>
    </div>
    <ul class="nav navbar-nav">
       <li><a href="men.php" >MEN</a></li>
        <li><a href="women.php" >WOMEN</a></li>
        <li><a href="kids.php" >KIDS</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
       <?php if(isset($email_logged)){
          echo '<li><a href="bag.php?email='.$email.'"><span class="fa fa-shopping-bag" aria-hidden="true"></span>Bag <span class="badge">';?>
          <?php 
            $con = new MongoClient();
            if($con){
              $database = $con->dailydeals;
              $bag = $database->bag;
              $search = $bag->find(array('email'=>$email_logged));
              $count = 0;
              foreach ($search as $key) {
                $p[]=$key['product'];
                foreach ($p as $value) {
                  foreach ($value as $doc) {
                    $count++;
                  }
                }
              }
              echo $count;
            }
          ?>
          <?php echo '</span></a></li>
         <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              ';
              //<img src="default_profile.png" width="auto" height="22px" style="border-radius:15px"> 
              //echo $email_logged;
              echo '
                   <div id="profileImage"></div>
                   <div id="pro">
                   <span class="pro" id="fname">'.strtoupper($email_logged).'</span></div>';

         echo'</a>
          <ul class="dropdown-menu">
            <li><a href="myprofile.php"><span class="fa fa-user"></span>My Account</a></li>
           
            <li><a href="delivery.php"><span class="fa fa-location-arrow"></span>Saved Addresses</a></li>
             <li><a href="logout.php"><span class="fa fa-sign-out"></span> Logout</a></li>
          </ul>
        </li>';}
        else{
           ?><li><a href="#" onclick="alert('Please login to view bag!!')"><span class="fa fa-shopping-bag" aria-hidden="true"></span>Bag <span class="badge">0</span></a></li>
    <?php  }
        ?>
    </ul>   
  </div>
</nav>

  
<?php
 //echo $gender."hi";
  

    $conn1 = new MongoClient();                      //Connect To MongoDB
        
        if($conn1){

            $database=$conn1->dailydeals;                   //Connecting to database                
              
              $collection=$database->product;

              
              $result = $collection->find(array('_id' => new MongoID($id)));
              //var_dump();
               
                    foreach($result as $doc) {
                      $s = $doc['quantity']['s_quantity'];
                      $m = $doc['quantity']['m_quantity'];
                      $l = $doc['quantity']['l_quantity'];
                      $xl = $doc['quantity']['xl_quantity'];
                     
                      echo '<div class="container"><div class="row">
                        <div class="col-md-4">
                        ';?>
                        <div class="item">
                       <img src="data:image/jpeg;base64,<?php echo $doc['fpic'];?>" class="img-responsive" id="myImage"  alt="image1" width="300" height="350" >';
                
                       <div class="item-overlay top"></div></div>
                       <br><div>
                       <span><a href="#" onclick="document.getElementById('myImage').src='data:image/jpeg;base64,<?php echo $doc['fpic'];?>'"><img src="data:image/jpeg;base64,<?php echo $doc['fpic'];?>" class="img-thumbnail"  alt="image1" width="70" height="40"></a></span>
                       <span><a href="#" onclick="document.getElementById('myImage').src='data:image/jpeg;base64,<?php echo $doc['bpic'];?>'"><img src="data:image/jpeg;base64,<?php echo $doc['bpic'];?>" class="img-thumbnail"  alt="image2" width="70" height="40"></a></span>
                       <span><a href="#" onclick="document.getElementById('myImage').src='data:image/jpeg;base64,<?php echo $doc['spic'];?>'"><img src="data:image/jpeg;base64,<?php echo $doc['spic'];?>" class="img-thumbnail"  alt="image3" width="70" height="40"></a></span>
                       
                       </div>

                      <?php                      
                       echo '<div style="margin-left:15px;margin-top:10px;">Seller: '.$doc['seller'].'</div></div>
                        <div class="col-md-8">
                          
  <div style="padding-left:15px;"><h3>'.$doc['brand'].'</h3><h5>'.$doc['name'].'</h5><h4><b>Rs.'.$doc['new_price'].'</b><b style="padding-left:50px;"><del>Rs.'.$doc['price'].'</del></b><b style="color:red;">('.$doc['discount'].'%OFF)</b></h4></div>
 <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Product Details</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body">'.$doc['describe'].'.</div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Material & Care</a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">'.$doc['care'].'</div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Sizing Chart</a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body">
        <table class="table table-bordered">
    <thead>
      <tr>
        <th>Size</th>
        <th>S</th>
        <th>M</th>
        <th>L</th>
        <th>XL</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Chest (INCHES)</td>
        <td>38</td>
        <td>40</td>
        <td>42</td>
        <td>44</td>
      </tr>
      <tr>
        <td>Across Shoulder (INCHES)</td>
        <td>15.5</td>
        <td>16.5</td>
        <td>17.5</td>
        <td>18.5</td>
      </tr>
      <tr>
        <td>Length (INCHES)</td>
        <td>26</td>
        <td>27</td>
        <td>28</td>
        <td>29</td>
      </tr>
    </tbody>
  </table>
        </div>
      </div>
    </div>
  </div> ';?>
  <?php
                        $err="";
                        if(isset($email_logged)){?>
                          <form method="POST" action="addtobag.php">
                            <div class="form-group">
                                  <?php
                                  echo '<label for="size" style="padding-left:15px;">Size:</label>';

                                    if($s==0){
                                      echo '<label class="radio-inline">
                                  <input type="radio" name="size" value="S" disabled>S
                                </label>';
                                    }
                                    else{
                                      echo '<label class="radio-inline">
                                  <input type="radio" name="size" value="S">S
                                </label>';
                                    }

                                    if($m==0){
                                      echo '<label class="radio-inline">
                                  <input type="radio" name="size" value="M" disabled>M
                                </label>';
                                    }
                                    else{
                                      echo '<label class="radio-inline">
                                  <input type="radio" name="size" value="M">M
                                </label>';
                                    }

                                    if($l==0){
                                      echo '<label class="radio-inline">
                                  <input type="radio" name="size" value="L" disabled>L
                                </label>';
                                    }
                                    else{
                                      echo '<label class="radio-inline">
                                  <input type="radio" name="size" value="L">L
                                </label>';
                                    }

                                    if($xl==0){
                                      echo '<label class="radio-inline">
                                  <input type="radio" name="size" value="XL" disabled>XL
                                </label>';
                                    }
                                    else{
                                      echo '<label class="radio-inline">
                                  <input type="radio" name="size" value="XL">XL
                                </label>';
                                    }                                
                                    
                                  ?>              
                            </div>         
                        
                        <br></br>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">          
                        <input type="hidden" name="email" value="<?php echo $email_logged; ?>">
                        <button type="submit" name="addbag" class="btn btn-default" style="border-radius:0px;padding:8px 20px;">ADD TO BAG</button>
                        </form>
                       <?php }
                        else{?>
                          <form>
                             <div class="form-group" style="padding-left:15px;">  
                              Size:&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="radio-inline">
                                  <input type="radio" name="size">S
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="size">M
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="size">L
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="size">XL
                                </label>                      
  
                            <!--div class="col-md-4">
                             <label for="size">Quantity:</label>
                                <input type="number" class="form-control" name="quantity" min="1" max="5" placeholder="select quantity" required> 
                          </div-->
                          
                            </div>                                     
                        <br></br>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="gender" value="<?php echo $gender;?>">
                        <input type="hidden" name="email" value="<?php echo $email_logged; ?>">
                        <a href="#" class="btn btn-default" onclick="alert('Please login to add product to bag!!')">ADD TO BAG</a>
                        </form>
                       <?php   }
echo '</div>

                        </div>
                      </div>';
            }
        }

                        ?>
                        

                        
                            
                       
                         </div>
                         </div>
              
    
</div>

<script>
$(document).ready(function(){
    $(".btn-primary").click(function(){
        $("[data-toggle='popover']").popover('show');
    });
  });
</script>


</body>
      
</html>