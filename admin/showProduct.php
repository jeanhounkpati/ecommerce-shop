
<?php include("includes/header.php") ?>


<div class='content'>
	<h2>Products</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Image</th>
	  <th scope="col">Edit</th>
	  <th scope="col">Delete</th>


    </tr>
  </thead>
  <tbody>
  		<?php
			include '../database.php';
			global $PDO;
			$req=$PDO->prepare('SELECT * FROM products');
			$req->execute();
			$products=$req->fetchAll(PDO::FETCH_OBJ);
		?>
		<?php foreach($products as $product):?>
			<tr>
				<th scope="row"><?= $product->id; ?></th>
				<td><?= $product->name; ?></td>
				<td><?= $product->description; ?></td>
				<td><img src="../uploads/<?= $product->file; ?>" style="width: 30px; height: 30px" alt="my_image"></td>
				<td><a href="updateProduct.php?id=<?= $product->id; ?>">Update</a></td>
				<td><a href="deleteProduct.php?id=<?= $product->id; ?>">Delete</a></td>
           </tr>				
		<?php endforeach ?>
  </tbody>
</table>
		
<?php include("includes/footer.php") ?>


		


		

