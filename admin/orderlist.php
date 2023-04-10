
<?php include("includes/header.php") ?>
<div class="content">

<div class="col-md-12">

<h2 class="text-center">Orders</h2>

<div class="d-flex justify-content-center align-items-center">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Total</th>
      <th scope="col">Date</th>
	  <th scope="col">Status</th>



    </tr>
  </thead>
  <tbody>
  		<?php
			include '../database.php';
			global $PDO;
			$req=$PDO->prepare('SELECT * FROM orders');
			$req->execute([ ]);
			$orders=$req->fetchAll(PDO::FETCH_OBJ);
		?>
		<?php foreach($orders as $order):?>
			<tr>
				<th scope="row">ORDER <a href="orderdetail.php?id=<?= $order->id; ?>"><?= $order->id; ?></a></th>
				<td><?= $order->name; ?></td>
				<td><?= $order->total; ?></td>
				<td><?= $order->created_at; ?></td>
				<td>status</td>

      </tr>				
		<?php endforeach ?>
  </tbody>
</table>
</div>
</div>
</div>
		
<?php include("includes/footer.php") ?>






		

