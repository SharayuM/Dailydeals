<?php
  if (isset($_POST['addbag'])) {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $size = $_POST['size'];
    $quantity = 1;
    //echo $id.'<br>'.$email.'<br>'.$size.'<br>'.$quantity;
    $check=0;
    $con = new MongoClient();

    if ($con) {
      //echo 'connect';
      $database = $con->dailydeals;

      $product = $database->product;

      $bag = $database->bag;

      $find = $bag->findOne(array('email' => $email));
     // echo count($find);

      if(!count($find)){
          $data = array('email' => $email,
                       'product' => array(array('product_id' => new MongoID($id),$size => $quantity)),
                       );
    
          $bag->save($data);
          $check=1;
      }
      else{
        $search = $bag->findOne(array('email'=> $email,'product'=>array('product_id' =>new MongoID($id),$size=>$quantity)));
        echo count($search);
        if (!count($search)) {
          $check=1;
        //echo 'absent';
          $document = array('product_id' => new MongoID($id),$size => $quantity);

          $bag->update(array('email' => $email),array( '$addToSet' => array('product' => $document)));

        }
        else{
          $check=0;
          echo 'present';
        }
        //$document = array('product_id' => new MongoID($id),$size => $quantity);
      /*  $search = $bag->findOne(array('email'=>$email,'product.product_id'=>new MongoID($id)));

        if(!count($search)){
          //echo 'no';
          $document = array('product_id' => new MongoID($id),$size => $quantity);

          $bag->update(array('email' => $email),array( '$addToSet' => array('product' => $document)));
          
          $check=1;
        }
        else{
          $result = $bag->find(array('email'=>$email,'product'=>array('product_id'=>new MongoID($id),$size=>$quantity)));
          echo count($result);
          if (count($result)==1) {
            
            $bag->update(array('email' => $email,'product.product_id' => new MongoID($id)),array('$set' => array('product.$.'.$size => $quantity)));
            $check=1;
          }
          else{
            $check=0;
            header('Location:pro_details.php?id='.$id);
          }
        }      */ 
      }
     // echo $check;
      if ($check==1) {
        $doc = $product->find(array('_id' => new MongoID($id)));

        foreach ($doc as $value) {
          $price = $value['price'];
          $discount = $value['discount'];
          $newprice = $value['new_price'];
          if($size=="S"){
            $nquantity = $value['quantity']['s_quantity']-$quantity;
            $value['quantity']['s_quantity']=$nquantity;//updating new value
            $product->save($value); //saving new document
          }
          else if($size=="M"){
            $nquantity = $value['quantity']['m_quantity']-$quantity;
            $value['quantity']['m_quantity']=$nquantity;
            $product->save($value);
          }
          else if($size=="L"){
            $nquantity = $value['quantity']['l_quantity']-$quantity;
            $value['quantity']['l_quantity']=$nquantity;
            $product->save($value);
          }
          else{
          $nquantity = $value['quantity']['xl_quantity']-$quantity;
          $value['quantity']['xl_quantity']=$nquantity;
          $product->save($value);
          }
        }
      }
      else{
        echo 'Not added!';
      }
    }
    else{
      echo 'disconnect';
    }
    header('Location:pro_details.php?id='.$id);
  }


?>


