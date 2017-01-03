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
  if(isset($_POST['signup']))
  {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $mobile = $_POST['mobile'];
    $con = new MongoClient();     // connect to mongodb
    if($con)
    { 
      $databse=$con->dailydeals;    //connecting to database
      $collection=$databse->user;
      $query=array('email'=>$email);
      $count=$collection->findOne($query);
      if(!count($count))
      {
        $user_data=array('firstname'=>$fname,'lastname'=>$lname,'password'=>$pass,'email'=>$email,'mobileno'=>$mobile);   //Save the New user
        $collection->save($user_data);
        //echo "You are successfully registered.";
?>
        <script>alert('successfully registered ');</script>
<?php
      }
      else
      {
        //echo "Email is already existed.Please register with another Email id!.";
?>
        <script>alert('error while registering you...');</script>
<?php
      }
 
  }
  else{
 
    die("Database are not connected");
  }
}
?>


<?php
  session_start();
  $email_logged = $_SESSION['email'];
  
  
  if(isset($_POST['done']))
  {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $mobile = $_POST['mobile'];
    //echo $fname;

    $con = new MongoClient();     // connect to mongodb
    if($con)
    { 
      $databse=$con->dailydeals;    //connecting to database
      $user=$databse->user;
      
      if(!count($count))
      {
        $user_data=array('firstname'=>$fname,'lastname'=>$lname,'password'=>$pass,'email'=>$email_logged,'mobileno'=>$mobile);

          $user->update(array('email'=>$email_logged),array('firstname'=>$fname,'lastname'=>$lname,'mobileno'=>$mobile,'password'=>$pass,'email'=>$email_logged));
        //$bag->update(array('email'=>$email,'product.product_id' => new MongoID($id)),array('$addToSet' => array('product.$.sizes' => $add)));

          //echo $fname;
          //Save the New user
       // $collection->save($user_data);
        //echo "You are successfully registered.";
?>
        <script>alert('successfully registered ');</script>
<?php

      }
      else
      {
        //echo "Email is already existed.Please register with another Email id!.";
?>
        <!--script>alert('error while registering you...');</script-->
<?php
      }
 
  }
  else{
 
    die("Database are not connected");
  }
}

?>
<?php
     
    $con = new MongoClient();     // connect to mongodb
    if($con)
    { 
      $databse=$con->dailydeals;    //connecting to database
      $collection=$databse->user;
      //$query=array('email'=>$email);
      $count=$collection->find(array('email'=>$email_logged));
      foreach ($count as $doc ) {
        //echo $doc['firstname'];
      }
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
  <title>DailyDeals</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style type="text/css">
    .carousel-inner > .item > img,
    .carousel-inner > .item > a > img {
      width: 500px;
      height: 500px;
      margin: auto;
      position:relative;
  }
  #pro{
  margin-left: 40px;
  margin-top:-30px;
  padding-left: 5px;
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

$(document).ready(function(){
  var fname = $('#fname').text();
  var intials = $('#fname').text().charAt(0);
  var profileImage = $('#profileImage').text(intials);
});

  </script>
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
                      <button type="submit" class="btn btn-success btn-block" id="btnSubmit" name="signup"><span class="glyphicon glyphicon-off"></span> REGISTER</button>
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
              $countbag = 0;
              foreach ($search as $key) {
                $p[]=$key['product'];
                foreach ($p as $value) {
                  foreach ($value as $document) {
                    $countbag++;
                  }
                }
              }
              echo $countbag;
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


     <div class="inner-block">
    <div class="inbox">
      
      <?php 
      
         $email_logged = $_SESSION['email'];
         $con = new MongoClient();
         $db = $con->dailydeals;
         $collection = $db->user;
         $query=array('email'=>$email);
         $count=$collection->findOne($query);
         //echo $fname.'</br>';
         //echo $mobile.'</br>';
         //echo $pass;
      ?>
          
          <center>
           <div class="col-md-4" style="display:inline-block;border:1px solid grey;margin-left:450px;margin-top:20px;margin-bottom:30px;">
           <center><h3>Primary Information</h3></center>
        <form method="post">

                  <table>
              <!--php $q=(explode(" ",$num['user']));

              ?-->
                      <tr>
                        <td><i class="fa fa-user"></i> First Name</td>
                        <td> : <input type='text' name='fname' class='enableOnInput mp' disabled='disabled' id="p1" value="<?php echo $doc['firstname'];?>" /> <!--<input type="text" name="mn" placeholder="<?php echo $q[0]; ?>" class="mp" id="p1" />-->
                     </td>
                      </tr>
                     
                      <tr>
                        <td><i class="fa fa-user"></i> Last Name</td><br/>
                        <td> : <input type='text' name='lname' class='enableOnInput mp' disabled='disabled' id="p3" value="<?php echo $doc['lastname'];?>" /> <!--:<input type="text" name="ln" placeholder="<?php echo $q[2]; ?>" class="mp" required id="p3"/>--></td>
                      </tr>
                      <tr>
                      <br/>
                        <td><i class="fa fa-envelope"></i> Email Id</td>
                        <td> : <input type='text' name='email' class='enableOnInput1 mp' disabled='disabled' id="p4" value="<?php echo $doc['email'];?>" /> <!--:<input type="email" name="email" placeholder="<?php echo $num['email'];?>" class="mp" required id="p4" />--></td>
                      </tr>
                      <tr>
                        <td><i class="fa fa-lock"></i> Password</td>
                        <td> : <input type='text' name='pass' class='enableOnInput mp' disabled='disabled' id="p5" value="<?php echo $doc['password'];?>" /> <!--<input type="password" name="pass" placeholder="<?php echo $num['password'];?>" class="mp" required id="p5"/>--></td>
                      </tr>
                      <tr>
                        <td><i class="fa fa-phone"></i> Phone No</td>
                        <td> : <input type='text' name='mobile' class='enableOnInput mp' disabled='disabled' id="p6" value="<?php echo $doc['mobileno'];?>" /> <!--<input type="tel" name="phno" placeholder="<?php echo $num['phone'];?>" class="mp" required id="p6" />--></td>
                      </tr>
                      
                      <tr>
                        <td></td>
                       
                        <td><input type="button" value="Edit" name="edit" id="edit" style="margin-left:45px;margin-top:35px"></input>
                        </td>

                        <td></td>
                      </tr>
                      <!--tr id="np" style="display:none;">
                        <td><i class="fa fa-lock"></i> New Password</td>
                        <td> : <input type="password" name="pass" placeholder="New Password" class="mp" id="p9"/></td>
                      </tr>
                      <tr id="cp" style="display:none;">
                        <td><i class="fa fa-lock"></i>Confirm Password</td>
                        <td> : <input type="password" name="cpass" placeholder="Confirm Password" class="mp" id="p10"/></td>
                      </tr>
                      <tr-->
                        <td></td><br/><br/>
                        <td><input type="submit" value="Save" name="done" id="done1" onclick="return Validate(); ClearFields();" style="margin-left:45px;margin-top:10px"></input>
                        </td>
                      </tr>
                  </table>
               </form>
              </div>
             </center>
           


               <script type="text/javascript">

              var el  = document.getElementById('edit');
              var p1 = document.getElementById('p1');
              var p2 = document.getElementById('p2');
              var p3 = document.getElementById('p3');
              var p4 = document.getElementById('p4');
              var p5 = document.getElementById('p5');
              var p6 = document.getElementById('p6');
              var p8 = document.getElementById('p8');
              var p9 = document.getElementById('p9');
              var p10 = document.getElementById('p10');
              el.addEventListener('click', function(){
                  p1.disabled = false;
                  p2.disabled = false;
                  p3.disabled = false;
                  p4.disabled = true;
                  p5.disabled = false;
                  p6.disabled = false;
                  p8.disabled = false;
                  p9.disabled = false;
                  p10.disabled = false;

                  p1.focus(); // set the focus on the editable field
                });

              $("#edit").click(function () {
                    $('#done').toggle();
                    $(this).toggle();
                    $('#np').eq(0).toggle();
                    $('#cp').eq(0).toggle();
                    $('#dd').eq(0).toggle();
                });

              $(function(){
                   $('#edit').click(function(){
                  $('.enableOnInput').prop('disabled', false);
                    //$('#submitBtn').val('Update');
                   });
                });
                
               </script>

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
</body>
</html>