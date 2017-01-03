<?php
$no = $_GET['no'];
$index =$_GET['index'];
session_start();
$email = $_SESSION['email'];
$con = new Mongoclient();
if($con){
$database = $con->dailydeals;

$bag = $database->bag;

$user = $database->user;

$product = $database->product;

$search = $user->find(array('email' => $email));

$count=1;
foreach ($search as $key) {
	$address[]=$key['addresses'];
	foreach ($address as $value) {
		foreach ($value as $item) {
			if ($count==$no) {
				//$add = $item['address'];
				$find = $bag->find(array('email' => $email));
				foreach ($find as $pro) {
					$prod[]=$pro['product'];
					foreach ($prod as $doc) {
						foreach ($doc as $log) {
							$price=0;
							$newprice=0;
							$discount=0;
							$id = $log['product_id'];
							$detect = $product->find(array('_id' => new MongoID($id)));
							foreach ($detect as $dk) {
								$price = $dk['price'];
								$newprice = $dk['new_price'];
								$discount = $price-$newprice;
							}
							if ($log['S']==1) {
								$size="S";
							}
							if ($log['M']==1) {
								$size="M";
							}
							if ($log['L']==1) {
								$size="L";
							}
							if ($log['XL']==1) {
								$size="XL";
							}
							$quantity=1;
							$document = array('product_id' => new MongoID($id),$size=>$quantity,'price' => $price,'discount'=>$discount,'newprice'=>$newprice);
							$user->update(array('email' => $email,'addresses.no' => new MongoID($index)),array('$addToSet' => array('addresses.$.bag' => $document)));
						}
					}
				}

			}
			else{
				$count++;
			}
		}
	}
}
$bag->remove(array('email' => $email));
}
else{
	die("Cannot connect");
}
header('Location:index.php');
?>