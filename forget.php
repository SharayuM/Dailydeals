<?php
  $user="";
  session_start();
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
      width: 2000px;
      height: 500px;
      margin: auto;
      position:relative;
  }
  .navbar1
  {
    background-color: #ebedef;
    -webkit-font-size:5px;
    height: 40px;
    
  }
  .btn-link
  {
    color:grey;
  }
  #profileImage {
  width: 30px;
  height: 30px;
  border-radius:50%;
  background: #FF0000;
  font-size: 20px;
  color: #fff;
  text-align: center;
  line-height: 30px;
  margin: 5px 0;
}
.pro{
  margin-left: 70px;
  margin-top: 20px;
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
              <div class="modal-footer">
          <a href="forget.php" style="float:right">Forgot Password?</a></p>
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
              $count = 0;
              foreach ($search as $key) {
                $count ++;
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
                   <span class="pro" id="fname">'.strtoupper($email_logged).'</span>';
         echo'<span class="caret"></span></a>
          <ul class="dropdown-menu">
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

<div class="container">
  <br>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">      <!-- Indicators -->
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1" ></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">     <!-- Wrapper for slides -->
      <div class="item active">
                     
                        <?php 
                        $conn = new MongoClient();  
                        if($conn){

                          $database=$conn->dailydeals;         //Connecting to database        
            
                          $collection=$database->product_men;
                          //$collection=$database->product_women;       //Connect to question_bank collection
                          $gender="men";
                          $range=['discount'=>['$gte'=>'75']];
                          $result=$collection->find($range);
                          foreach($result as $doc){
                          $id = $doc['_id'];
                         // $image = $doc['pic']->bin; 
                      ?><a href="#"><img src="data:image/jpeg;base64,<?php echo $doc['fpic']?>"></a><?php
                      
              }}
             ?>
                        
      </div>
      <div class="item">
                     <?php 
                         $conn = new MongoClient();  
                          if($conn){
                              $database=$conn->dailydeals;         //Connecting to database        
                            $collection=$database->product_women;       //Connect to question_bank collection
                            $gender="women";
                            $range=['discount'=>['$gte'=>'75']];
                            $result=$collection->find($range);
                            foreach($result as $doc){
                            $id = $doc['_id'];
                           // $image = $doc['pic']->bin; 
                        ?><a href="#"><img src="data:image/jpeg;base64,<?php echo $doc['fpic']?>"></a><?php
                        
                }}
               ?>
        </div>
        <div class="item">
                     <?php 
                         $conn = new MongoClient();  
                          if($conn){
                              $database=$conn->dailydeals;         //Connecting to database        
                            $collection=$database->product_kids;       //Connect to question_bank collection
                            $gender="kids";
                            $range=['discount'=>['$gte'=>'75']];
                            $result=$collection->find($range);
                            foreach($result as $doc){
                            $id = $doc['_id'];
                           // $image = $doc['pic']->bin; 
                        ?><a href="#"><img src="data:image/jpeg;base64,<?php echo $doc['fpic']?>"></a><?php
                        
                }}
               ?>
        </div>
      </div>


       
      <!--div class="item">
        <img src="longline.jpg" alt="longline" width="460" height="345">
        <div class="carousel-caption">
          <h3>Longline T-shirts</h3> 
        </div>
      </div>
      <div class="item">
        <img src="kids.jpg" alt="Kids" width="460" height="345">
        <div class="carousel-caption">
          <h3>Kids Collection</h3>
        </div>
      </div>
    </div-->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">      <!-- Left and right controls -->
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
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
        <a href="aboutus.html"><button type="button" class="btn btn-link">ABOUT US</button></a><br>
        <a href="aboutus.html"><button type="button" class="btn btn-link">DEVELOPERS</button></a><br>
       </div>
       <div class="mop">
       <p><b>METHOD OF PAYMENT</b></p>
       <img src="cod.png">
       </div>
        </div>
</footer>

            
</body>
</html>
