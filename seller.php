<?php
if(isset($_POST['submit']))
{
  ini_set("display_errors", "1");

  $seller = $_POST['seller'];
  $name = $_POST['name'];
  $brand = $_POST['brand'];
  $describe = $_POST['describe'];
  $care = $_POST['care'];
  $gender = $_POST['sex'];
  $s_quantity = $_POST['s_quantity'];
  $m_quantity = $_POST['m_quantity'];
  $l_quantity = $_POST['l_quantity'];
  $xl_quantity = $_POST['xl_quantity'];
  $price = $_POST['price'];
  $discount = $_POST['discount'];
  $fpic = file_get_contents($_FILES['fpic']['tmp_name']);
  $bpic = file_get_contents($_FILES['bpic']['tmp_name']);
  $spic = file_get_contents($_FILES['spic']['tmp_name']);

  $new_price = $price - ($price * ($discount / 100));

  // connect to mongodb
   $con = new MongoClient();

  if($con)
  {
 
    //connecting to database
    $database=$con->dailydeals;

    $collection=$database->product;
    
      $doc=array(
         'gender'=>$gender,
         'seller'=>$seller,
         'name'=>$name,
         'brand'=>$brand,
         'describe'=>$describe,
         'care'=>$care,
         'quantity'=>array('s_quantity'=>$s_quantity,
                           'm_quantity'=>$m_quantity,
                           'l_quantity'=>$l_quantity,
                           'xl_quantity'=>$xl_quantity,),
         'price'=>$price,
         'discount'=>$discount,    
         'new_price'=>$new_price, 
         "fpic"=>base64_encode($fpic),
         "bpic"=>base64_encode($bpic),
         "spic"=>base64_encode($spic)
      );

     $query=$collection->save($doc);
 
     if(isset($query)){
        ?><script>alert("Details Entered Successfully...")</script>
      <?php }
      else{
        ?><script>alert("Unable to Enter the Details!!!")</script>
     <?php }

    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Seller </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Product Details:</h2>
  <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
    <div class="form-group">
      <label class="control-label col-sm-2" for="seller">Seller Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="seller" placeholder="Enter seller name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="Brand">Brand:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="brand" placeholder="Enter brand name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="name">Product Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="name" placeholder="Enter product name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="describe">Product Description:</label>
      <div class="col-sm-10">
        <textarea class="form-control" rows="5" name="describe" placeholder="Enter product description"></textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="care">Care:</label>
      <div class="col-sm-10">
        <textarea class="form-control" rows="3" name="care" placeholder="Enter care"></textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="quantity">Collection:</label>
    <label class="radio-inline">
      <input type="radio" name="sex" value="men">Men
    </label>
    <label class="radio-inline">
      <input type="radio" name="sex" value="women">Women
    </label>
    <label class="radio-inline">
      <input type="radio" name="sex" value="kids">Kids
    </label>
  </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="quantity">S(size):</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" name="s_quantity" placeholder="Enter quantity for size S ">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="quantity">M(size):</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" name="m_quantity" placeholder="Enter quantity for size M">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="quantity">L(size):</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" name="l_quantity" placeholder="Enter quantity for size L">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="quantity">XL(size):</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" name="xl_quantity" placeholder="Enter quantity for size XL">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="price">Price:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="price" placeholder="Enter price">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="discount">Discount:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="discount" placeholder="Enter discount">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="fpic">Front Image:</label>
      <div class="col-sm-10">
        <input type="file" name="fpic">
    </div>
  </div>
    
     <div class="form-group">
      <label class="control-label col-sm-2" for="bpic">Back Image:</label>
      <div class="col-sm-10">
        <input type="file" name="bpic">
    </div>
  </div>

  <div class="form-group">
      <label class="control-label col-sm-2" for="spic">Side Image:</label>
      <div class="col-sm-10">
        <input type="file" name="spic">
    </div>
  </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default" name="submit">Submit</button>
      </div>
    </div>
  </form>
</div>

</body>
</html>

