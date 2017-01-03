
<!--?php
$flag=0;
session_start();
$email_logged = $_SESSION['email'];
$con = new MongoClient();

$database = $con->dailydeals;

$delivery = $database->delivery;

$result  = $delivery->find(array('email' =>$email_logged));

if (!count($result)) {
  $flag=0;
}
else{
  $flag=1;
}
echo $flag;
?-->
<?php
session_start();
$email = $_SESSION['email'];
if(isset($_POST['register']))
{      
  $fullname = $_POST['fullname'];
    $mobile = $_POST['mobile'];
  $address = $_POST['address'];
  $country = $_POST['country'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $pincode = $_POST['pincode'];
  // connect to mongodb
   $con = new MongoClient();

  if($con)
  {
 
    //connecting to database
    $databse=$con->dailydeals;
    //echo "Database 'mydb' selected";
    
    //connect to specific collection
    $collection=$databse->delivery;
    //echo "Collection user Selected succsessfully";
 
    $query=array('email'=>$email);
    //checking for existing user
    $count=$collection->find($query);
 
    if(!count($count))
    {
      //Save the New user
      $user_data=array('fullname'=>$fullname,'mobile'=>$mobile,'address'=>$address,'country'=>$country,'pincode'=>$pincode, 'city'=>$city, 'state'=>$state);
      $collection->save($user_data);
      //echo "You are successfully registered.";
?>
        <script>alert('Successfully Submitted ');</script>

<?php
    }
    else
    {
      //echo "Email is already existed.Please register with another Email id!.";
?>
        <script>alert('error while registering you...');</script>
<?php
    }
 
  }else
  {
 
    die("Database are not connected");
  }

//========
  

}
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
      <a class="navbar-brand" href="page1.html"><img src="dd.jpeg"width="75" height="75"></a>
   </div>
  </div>
    </nav>
    <div class="container">
      <span class="col-md-5" style="border:1px solid #E8E1E1;margin-right:25px;margin-left:50px;">
        <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
          <h4 style="text-decoration:underline;">Delivery Address</h4>
  <div class="form-group">
      <label for="usr">Full Name*:</label>
      <input type="text" class="form-control" name="fullname" placeholder=" Enter Fullname"  pattern="[A-Za-z].{1,}" required>
  </div>
    <div class="form-group">
      <label for="usr">Mobile Number*</label>
      <input type="text" class="form-control" name="mobile" placeholder=" Enter Mobile Number" pattern="^\d{10}$"required>
     
    </div>
    <div class="form-group">
      <label for="comment">Address*:</label>
      
      <textarea class="form-control" rows="4" name="address" placeholder=" Enter Address"  pattern="[A-Za-z].{1,}"required ></textarea>
    </div>
     <div class="form-group">
      <label for="usr">Country*:</label>
      <input type="text" class="form-control" name="country" placeholder=" Enter Country"  pattern="[A-Za-z].{1,}" required>
     
    </div>
     <div class="form-group">
      <label for="usr">Pincode*:</label>
      <input type="text" class="form-control" name="pincode" placeholder=" Enter Pincode" pattern="^\d{6}$" required>
      
    </div>
     <div class="form-group">
      <label for="usr">City*:</label>
      <input type="text" class="form-control" name="city" placeholder=" Enter City"  pattern="[A-Za-z].{1,}" required>
      
    </div>
     <div class="form-group">
      <label for="usr">State*:</label>
      <input type="text" class="form-control" name="state" placeholder=" Enter State"  pattern="[A-Za-z].{1,}" required>
      
    </div>
    <button type="submit" class="btn btn-default active" name="register" style="padding:5px 25px;border-radius:0px;">SUBMIT</button>
  <button type="reset" class="btn btn-default" style="float:right;border-radius:0px;">CANCEL</button>
  </form>
      </span>
      <span class="col-md-5" style="border:1px solid #E8E1E1;margin-left:35px;"></span>
    </div>
    
</body>

</html>
