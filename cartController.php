<?php
session_start();
if(isset($_SESSION['auth']))
{
    if(isset($_POST['scope']))
    {
        $scope = $_POST['scope'];
        switch($scope)
        {
            case 'add':
                $prod_id = $_POST['prod_id'];
                $prod_qty = $_POST['prod_qty'];
                $user_id = $_SESSION["auth_user"]["id"];
                include 'database.php';

                global $PDO;
                $req = $PDO->prepare("SELECT price FROM products WHERE id = :prod_id");
                $req->execute(['prod_id' => $prod_id]);
                $product_price = $req->fetch(PDO::FETCH_OBJ)->price;
                //chack if cart exists already exists
                $cart_id = isset($_SESSION['cart_id']) ? $_SESSION['cart_id'] : null;
                if($cart_id){
                    //check if product exists in the cart
                    $req = $PDO->prepare("SELECT * FROM cartproducts WHERE prod_id = :prod_id AND cart_id = :cart_id");
                    $req->execute(['prod_id' => $prod_id,
                                    'cart_id'=> $cart_id
                ]);
                    $result = $req->fetch(PDO::FETCH_OBJ);
                    $subtotal = $prod_qty * $product_price;

                    if ($result != false)
                    {
                        echo "existing";
                    }
                    else{
                         // Add the product to the cartproducts
                        $subtotal = $prod_qty * $product_price;
                        $q=$PDO->prepare("INSERT INTO cartproducts(cart_id,prod_id,prod_qty,subtotal) VALUES(:cart_id,:prod_id,:prod_qty,:subtotal)");
                        $q->execute([
                            'cart_id'=>$cart_id,
                            'prod_id'=>$prod_id,
                            'prod_qty'=>$prod_qty,
                            'subtotal'=>$subtotal,
                        ]);

                         // Update the cart total
                        $req = $PDO->prepare("SELECT SUM(subtotal) as total FROM cartproducts WHERE cart_id = :cart_id");
                        $req->execute(['cart_id' => $cart_id]);
                        $total = $req->fetch(PDO::FETCH_OBJ)->total;
                        $q=$PDO->prepare("UPDATE carts SET total = :total WHERE id = :cart_id");
                        $q->execute([
                            'total'=>$total,
                            'cart_id'=>$cart_id,
                        ]);

                    }

                }
                else{
                    // Create a new cart for the user
                    $req = $PDO->prepare("SELECT * FROM cartproducts WHERE prod_id = :prod_id");
                    $req->execute(['prod_id' => $prod_id,]);
                    $result = $req->fetch(PDO::FETCH_OBJ);
                    $subtotal = $prod_qty * $product_price;

                    $q=$PDO->prepare("INSERT INTO carts(user_id,total) VALUES(:user_id,:total)");
                    $q->execute(['user_id'=>$user_id,
                                'total'=>$subtotal,
                    ]);

                     // Add the product to the cartproducts
                        $cart_id = $PDO->lastInsertId();
                        $subtotal = $prod_qty * $product_price;
                        $q=$PDO->prepare("INSERT INTO cartproducts(cart_id,prod_id,prod_qty,subtotal) VALUES(:cart_id,:prod_id,:prod_qty,:subtotal)");
                        $q->execute([
                            'cart_id'=>$cart_id,
                            'prod_id'=>$prod_id,
                            'prod_qty'=>$prod_qty,
                            'subtotal'=>$subtotal,
                        ]);
                        $_SESSION['cart_id'] = $cart_id;
                }
                break;
            case 'update':
                $prod_id = $_POST['prod_id'];
                $prod_qty = $_POST['prod_qty'];
                $user_id = $_SESSION["auth_user"]["id"];
                include 'database.php';
                global $PDO;
                $req = $PDO->prepare("SELECT price FROM products WHERE id = :prod_id");
                $req->execute(['prod_id' => $prod_id]);
                $product_price = $req->fetch(PDO::FETCH_OBJ)->price;
                //check if cart exists already exists
                $cart_id = $_SESSION['cart_id'];
                if($cart_id){
                    //update the product in cartproduct
                    $req = $PDO->prepare("UPDATE cartproducts SET prod_qty = :prod_qty, subtotal = :subtotal WHERE prod_id = :prod_id AND cart_id = :cart_id");
                    $req->execute([
                        'prod_qty' => $prod_qty,
                        'subtotal' => $prod_qty * $product_price, // calculate the new subtotal based on the updated quantity and the product price
                        'prod_id' => $prod_id,
                        'cart_id' => $cart_id
                    ]);
                    
                 // Update the cart total
                 $req = $PDO->prepare("SELECT SUM(subtotal) as total FROM cartproducts WHERE cart_id = :cart_id");
                 $req->execute(['cart_id' => $cart_id]);
                 $total = $req->fetch(PDO::FETCH_OBJ)->total;
                 $q=$PDO->prepare("UPDATE carts SET total = :total WHERE id = :cart_id");
                 $q->execute([
                     'total'=>$total,
                     'cart_id'=>$cart_id,
                 ]);
                }
                 else{
                    echo "something went wrong";
                 }        
                break;
            case "delete":
                $prod_id = $_POST['prod_id'];
                include 'database.php';
                global $PDO;
                //check if cart exists already exists
                $cart_id = $_SESSION['cart_id'];
                if($cart_id){
                    //delete the product in cartproduct
                    $req = $PDO->prepare("DELETE FROM cartproducts WHERE prod_id = :prod_id AND cart_id = :cart_id");
                    $req->execute([
                        'prod_id' => $prod_id,
                        'cart_id' => $cart_id
                    ]);
                    // Update the cart total
                    $req = $PDO->prepare("SELECT SUM(subtotal) as total FROM cartproducts WHERE cart_id = :cart_id");
                    $req->execute(['cart_id' => $cart_id]);
                    $total = $req->fetch(PDO::FETCH_OBJ)->total;
                    $q=$PDO->prepare("UPDATE carts SET total = :total WHERE id = :cart_id");
                    $q->execute([
                        'total'=>$total,
                        'cart_id'=>$cart_id,
                    ]);
                    echo 200;

                }
                else{
                    echo 500;
                }
                break;

                case "deleteCart":
                    include 'database.php';
                    global $PDO;
                    //check if cart exists already exists
                    $cart_id = $_SESSION['cart_id'];
                    if($cart_id){
                        //delete the product in cartproduct
                        $req = $PDO->prepare("DELETE FROM cartproducts WHERE cart_id = :cart_id");
                        $req->execute([
                            'cart_id' => $cart_id,
                        ]);
                         // update the cart
                         $q=$PDO->prepare("UPDATE carts SET total = :total WHERE id = :cart_id");
                         $q->execute([
                             'total'=>0,
                             'cart_id'=>$cart_id,
                         ]); 
                            echo 200;

                        }
                        else{
                            echo 500;
                        }
                        break;


        }
    }
}
?>
