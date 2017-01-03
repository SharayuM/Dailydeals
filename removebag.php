<?php
                          
                             $id = $_GET['id'];
                             $email = $_GET['email'];
                             $gender = $_GET['gender'];
                             $size = $_GET['size'];

                             //echo $size;
                             $quantity =1;
                             
                            
                             $con = new MongoClient();
                             if($con)
                            {
                              
                              $databse=$con->dailydeals;
                            
                              $bag=$databse->bag;

                              $product=$databse->product;
                                         

                              $doc = $product->find(array('_id' => new MongoID($id)));

                              foreach ($doc as $details ) {
                                if($size=="S"){
                                    $nquantity = $details['quantity']['s_quantity']+$quantity;
                                    $details['quantity']['s_quantity']=$nquantity;
                                    $product->save($details);
                                  }
                                  elseif ($size=="M") {
                                    $nquantity = $details['quantity']['m_quantity']+$quantity;
                                    $details['quantity']['m_quantity']=$nquantity;
                                    $product->save($details);
                                    
                                  }
                                  elseif ($size=="L") {
                                    $nquantity = $details['quantity']['l_quantity']+$quantity;
                                    $details['quantity']['l_quantity']=$nquantity;
                                    $product->save($details);
                                    
                                  }
                                  else{
                                    $nquantity = $details['quantity']['xl_quantity']+$quantity;
                                    $details['quantity']['xl_quantity']=$nquantity;
                                    $product->save($details);

                                  }
                              }


                              $bag->update(array('email'=>$email),array('$pull'=> array('product'=>array('product_id'=>new MongoID($id),$size=>$quantity))));
                              //db.coll.update({_id:presId},{$pull:{"slides._id": slidesId}}
                              //('$set' => array('product.$.'.$size => $quantity)));
                              
                              }
                              /*$doc=$bag->find(array('_id' => new MongoID($id)));
                              foreach ($doc as $value) {
                                $product_id = $value['product_id'];
                                $size = $value['size'];
                                $quantity = $value['quantity'];
                                $pro=$product->find(array('_id' => new MongoID($product_id)));
                                foreach ($pro as $details) {
                                  if($size=="S"){
                                    $nquantity = $details['quantity']['s_quantity']+$quantity;
                                    $details['quantity']['s_quantity']=$nquantity;
                                    $product->save($details);
                                  }
                                  elseif ($size=="M") {
                                    $nquantity = $details['quantity']['m_quantity']+$quantity;
                                    $details['quantity']['m_quantity']=$nquantity;
                                    $product->save($details);
                                    
                                  }
                                  elseif ($size=="L") {
                                    $nquantity = $details['quantity']['l_quantity']+$quantity;
                                    $details['quantity']['l_quantity']=$nquantity;
                                    $product->save($details);
                                    
                                  }
                                  else{
                                    $nquantity = $details['quantity']['xl_quantity']+$quantity;
                                    $details['quantity']['xl_quantity']=$nquantity;
                                    $product->save($details);

                                  }
                                }

                              }
                              $bag->remove(array('_id' => new MongoID($id)));*/
                               // $bag->save($final);
                                
                             
                             
                              
                               header('Location: bag.php?email='.$email.'&gender='.$gender);
                                //echo "You are successfully registered.";
                            
                
?>