<?php 

#To display Error if any on php file
/*ini_set('display_errors',1);*/

#Creating a Session to Access Logined User Details.

session_start();

#Storing value in local variable from Session variable.
$email=$_GET['email'];
//$password=$_SESSION['password'];

#Connecting Mongodb
$connection = new MongoClient();


#connecting to our database.
$db=$connection->dailydeals;


#Connection to User Collection.
$collection=$db->user;


$search=$collection->find();
foreach ($search as $document) 
{
	if($document['email']==$email)
		{
		
		$password=$document['password'];
		
		}
}



#Mail subject
$otp_subject="OTP For Login";

#Mail Message 
$otp_message="The login Password For you is ".$password." Don't Share it with anyone.";

#Retrieving data from User collection
$search=$collection->find();


foreach ($search as $document) 
{
	#Checking For Email.
	if($document["email"]==$email)
		{
			#Mail Being Sent
			#$result=mail($document["email"],$otp_subject,$otp_message);
			
			#To pass it to message function
			$mobile=$document["mobileno"];

			#To pass it to message function.
			$email=$document["email"];
		}
}


#OTP being send To Number

//echo $email;
//echo '<br>'.$otp_subject.$otp_message;
#Including API file for sms.
include ('way2sms.php');

#using function
send_sms('7776974084','E2859R',$mobile,$otp_message);
//send_sms('9765260829','F9884N',$mobile,$otp_message);


$alert_message="Mail and Message with Password had been send to".substr_replace($email, '',12, -10)." and ".substr_replace($mobile, '',10);
//echo $password;
#showing for confirmation.	
echo "<script type='text/javascript'> alert('$alert_message'); location='index.php';</script>";
die();
 ?>
