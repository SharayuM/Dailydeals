<?php
if(isset($_POST['register']))
{      
	$fullname = $_POST['fullname'];
  $mobile = $_POST['mobile'];
	$address = $_POST['address'];
	$country = $_POST['country'];
  $pincode = $_POST['pincode'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	
	// connect to mongodb
   $con = new MongoClient();

//==========================
	if($con)
	{
 
		//connecting to database
		$databse=$con->dailydeals;
		//echo "Database 'mydb' selected";
		
		//connect to specific collection
		$collection=$databse->delivery;
		//echo "Collection user Selected succsessfully";
 
		$query=array('address'=>$address);
		//checking for existing user
		$count=$collection->findOne($query);
 
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
  <div class="shipping">
      <p style="text-align:center;"><u style="color:blue;">BAG</u>-----<u style="color:blue;">DELIVERY</u>-----PAYMENT</p>
      </div>
    </nav>
    <br>
    <div class="panel panel-default">
    <div class="panel-body" style="padding-left:30%;">
   <div class="col-sm-6">
    <div class="container">
    <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" action="demo_form.asp">
    <div class="col-xs-4">
	<div class="form-group">
      <label for="usr">Full Name*:</label>
      <input type="text" class="form-control" name="fullname" placeholder=" Enter Fullname"  pattern="[A-Za-z].{1,}" required>
	</div>
    <div class="form-group">
      <label for="usr">Mobile Number*:</label>
      <input type="text" class="form-control" name="mobile" placeholder=" Enter Mobile Number" pattern="^\d{10}$"required>
     
    </div>
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
    <button type="reset" class="btn btn-default" style="margin-right:85px;">CANCEL</button>
  	<button type="submit" class="btn btn-default" name="register">SUBMIT</button>
	</div>
  </form>
  <?php
  $nprice = $_GET['nprice'];
  ?>
 <a href="payment.php?nprice=<?php echo $nprice;?>" class="btn btn-default" style="margin-left:100px;margin-top:25px;">CONTINUE TO PAYMENT</a>

</div>
</div>
</div>
  </div>
</body>

</html>
