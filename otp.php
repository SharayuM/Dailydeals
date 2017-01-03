<!--?php 

#To display Error if any on php file
/*ini_set('display_errors',1);*/

#Creating a Session to Access Logined User Details.

session_start();

#Storing value in local variable from Session variable.
$email=$_SESSION['email'];


#Connecting Mongodb
$connection = new MongoClient();


#connecting to our database.
$db=$connection->dailydeals;




#Connection to User Collection.
$collection=$db->user;

#Storing OTP to send through emails and message.
$search=$collection->find();
foreach ($search as $document) 
{
	if($document["email"]==$email)
		{
		$otp_password=$document["otp_password"];
		
		}
}


#Sending OTP To Mail

#Mail subject
$otp_subject="OTP For Login";

#Mail Message 
$otp_message="The One Time Password For Login is ".$otp_password." Don't Share it with anyone.";

#Retrieving data from User collection
$search=$collection->find();


foreach ($search as $document) 
{
	#Checking For Email.
	if($document["email"]==$email)
		{
			#Mail Being Sent
			$result=mail($document["email"],$otp_subject,$otp_message);
			
			#To pass it to message function
			$mobile=$document["mobileno"];

			#To pass it to message function.
			$email=$document["email"];
		}
}


#OTP being send To Number


#Including API file for sms.
include ('way2sms.php');

#using function
#send_sms('7776974084','E2859R',$mobile,$otp_message);
send_sms('9765260829','F9884N',$mobile,$otp_message);


$alert_message="Mail and Message with OTP had been send to ".substr_replace($email, '',5, -10)." and ".substr_replace($mobile, '',10);

#showing for confirmation.	
echo "<script type='text/javascript'> alert('$alert_message'); location='otp.html';</script>";
		die();
 ?-->


<?php


#Creating a Session to Access Logined User Details.
session_start();

#To Store user in local variable.
$email=$_SESSION["email"];

#To display Error if any on php file
/*ini_set('display_errors',1);*/

#Connecting Mongodb
$connection = new MongoClient();

#connecting to our database.
$db=$connection->dailydeals;

#Connection to User Collection.
$collection=$db->user;


#Storing data in variables 

#To store otp password.
$otp_password=$_POST["otp_password"];

/*Checking for already voted or not*/

#Retrieving User info to check if voted or not.
/*
$search=$collection1->find();

foreach ($search as $document)
{
	if($document["_aadhar_no"]==$aadhar_no)
	{
		if(!empty($document["status"]))
		{
		header('Location:index.php');
		die();		
		}
	}
	
}
*/
#Retrieving data from database and Aadhar_info Collection.
$search=$collection->find();

foreach ($search as $document) 
{
	if($document["email"]==$email)
		{
			#Checking With the Current OTP.
			if($document["otp_password"]==$otp_password)
				{
				header('Location:index.php');
				die();
				}	
		}	
}
		#Giving Alert if Wrong OTP Entered.
		echo "<script type='text/javascript'> alert('Wrong OTP Entered.Try Again !!'); location='otp.html';</script>";
		die();
?>



