<?php include("includes/header.php") ?>
<?php
		if (isset($_POST['submit'])) 
		{
			extract($_POST);
			if (!empty($email) && !empty($name) && !empty($phone) && !empty($shipping_address)&& !empty($shipping_address))
				{
                    include 'database.php';
                    global $PDO;
                    $cart_id = $_SESSION['cart_id'];
                    $req = $PDO->prepare("SELECT total FROM carts WHERE id = :cart_id");
                    $req->execute(['cart_id' => $cart_id]);
                    $total = $req->fetch(PDO::FETCH_OBJ)->total;
                    $q=$PDO->prepare("INSERT INTO orders(cart_id,name,phone,email,shipping_address,total,payement_mode) VALUES(:cart_id,:name,:phone,:email,:shipping_address,:total,:payement_mode)");
                    $q->execute([
                        'cart_id'=>$cart_id,
                        'name'=>$name,
                        'phone'=>$phone,
                        'email'=>$email,
                        'shipping_address'=>$shipping_address,
                        'total'=>$total,
                        'payement_mode'=>$payement_mode
                    ]);
                    $_SESSION['message'] = "ordered succesfully";
							      header('location:profil.php');
				}
			else
			{
				$_SESSION['message'] = "Complete all the fields";
			}
		}
?>
  <div class="row">
    <div class="col-md-6">
      <form method="POST" id="checkout" class="mx-auto m-2 p-4">
        <div class="form-row">        
          <div class="form-group col-md-6">
            <label for="Name">Name</label>
            <input type="text" name="name" class="form-control" id="Name" placeholder="Name">
          </div>
        <div class="form-group col-md-6">
          <label for="phone">Enter your phone number:</label>
          <input type="tel" name="phone" class="form-control" id="phone">
        </div>
        <div class="form-group col-md-6">
            <label for="Email">Email</label>
            <input type="email" name="email" class="form-control" id="Email" placeholder="Email">
          </div>
        <div class="form-group col-md-6">
          <label for="Shipping_Address">Shipping Address</label>
          <input type="text" name="shipping_address" class="form-control" id="Shipping_Address" placeholder="1234 Main St">
        </div>
        <input type="hidden" name="payement_mode" value="tmoney"></input> 
        <button type="submit" name="submit" class="btn btn-primary mt-4">Order</button>
      </form>
    </div>
  </div>

  <div class="col-md-6">
    <?php
    if(isset($_SESSION['auth']) && isset($_SESSION['cart_id']))
    {
        include 'database.php';
        global $PDO;
        $cart_id = $_SESSION['cart_id'];
        $req = $PDO->prepare("SELECT cp.prod_id, p.name, p.file, cp.prod_qty, cp.subtotal, p.price FROM cartproducts cp JOIN products p ON cp.prod_id = p.id WHERE cp.cart_id = :cart_id");
        $req->execute(['cart_id' => $cart_id]);
        $cart_products = $req->fetchAll(PDO::FETCH_OBJ);
        $count = count($cart_products);
        $_SESSION['cart_count'] = $count;
        $req = $PDO->prepare("SELECT total FROM carts WHERE id = :cart_id");
        $req->execute(['cart_id' => $cart_id]);
        $total = $req->fetch(PDO::FETCH_OBJ)->total;
    ?>

        <h2 class="text-center">Your Cart</h2>
        <a href="cart.php">Go back to cart</a>

  <div class="container"> 
      <div class="row">
          <div class="col-md-12">
              <table class="table">
                  <thead>
                  <tr>
                      <th>Image</th>
                      <th>Name</th>
                      <th class="text-center">Quantity</th>
                      <th>Price</th>
                      <th>Subtotal</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($cart_products as $product) : ?>
                      <tr>
                      <td><img src="uploads/<?= $product->file; ?>" style="width:30px; height:30px"  alt="my image"></td>
                      <td><?= $product->name ?></td>
                      <td>
                      <div class="input-group input-group-sm product_data">
                              <input type="number" class="form-control text-center quantity-input" value="<?= $product->prod_qty ?>">
                      </div>
                      </td>    
                      <td><?= $product->price ?></td>
                      <td><?= $product->subtotal ?></td>
                      </tr>
                  <?php endforeach; ?>
                  </tbody>
              </table> 
              <div class="btn btn-success btn-block mt-4">
                          Total: $<?= $total ?>
              </div>           
          </div>        
      </div>   
  </div>
  <?php
  }
  else
  {
      echo "You need to login and add products to your cart first.";
  }
  ?>

  </div>
<!-- </div> -->



<?php include("includes/footer.php") ?>
