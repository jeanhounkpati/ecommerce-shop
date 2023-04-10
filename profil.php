
<?php include("includes/header.php") ?>
<div class="col-md-12">

<h2 class="text-center">your orders</h2>

<div class="d-flex justify-content-center align-items-center">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Shipping Adress</th>
      <th scope="col">Date</th>


    </tr>
  </thead>
  <tbody>
  		<?php
			include 'database.php';
			global $PDO;
      $user_id = $_SESSION["auth_user"]["id"];
      $cart_id = $_SESSION['cart_id'];
			$req=$PDO->prepare('SELECT o.id, o.name, o.email, o.phone, o.shipping_address,o.created_at, c.user_id FROM orders o JOIN carts c ON o.cart_id = c.id WHERE c.id = :cart_id AND c.user_id = :user_id');
			$req->execute(['cart_id'=>$cart_id,
                      'user_id'=>$user_id
    ]);
			$orders=$req->fetchAll(PDO::FETCH_OBJ);
		?>
		<?php foreach($orders as $order):?>
			<tr>
				<th scope="row">#ORDER<a href="orderdetails.php?id=<?= $order->id; ?>"><?= $order->id; ?></a></th>
				<td><?= $order->name; ?></td>
				<td><?= $order->email; ?></td>
        <td><?= $order->phone; ?></td>
        <td><?= $order->shipping_address; ?></td>
        <td><?= $order->created_at; ?></td>


      </tr>				
		<?php endforeach ?>
  </tbody>
</table>
</div>
</div>
		
<?php include("includes/footer.php") ?>






		

