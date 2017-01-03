<?php
if(isset($_POST['signup']))
{
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $cpass = $_POST['cpass'];
  $mobile = $_POST['mobile'];
  $id = $_POST['id'];
  $gender = $_POST['gender'];
  // connect to mongodb
   $con = new MongoClient();

//==========================
  if($con)
  {
 
    //connecting to database
    $databse=$con->dailydeals;
    //echo "Database 'mydb' selected";
    
    //connect to specific collection
    $collection=$databse->user;
    //echo "Collection user Selected succsessfully";
 
    $query=array('email'=>$email);
    //checking for existing user
    $count=$collection->findOne($query);
 
    if(!count($count))
    {
      //Save the New user
      $user_data=array('firstname'=>$fname,'lastname'=>$lname,'password'=>$pass,'email'=>$email,'mobileno'=>$mobile);
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
 
  }else
  {
 
    die("Database are not connected");
  }
}

header('Location: pro_details.php?id='.$id.'&gender='.$gender);


?>