<?php include("includes/header.php") ?>


<div class='content'>
<h2>Categories</h2>

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
			$req=$PDO->prepare('SELECT * FROM category');
			$req->execute();
			$categories=$req->fetchAll(PDO::FETCH_OBJ);
		?>
		<?php foreach($categories as $category):?>
			<tr>
				<th scope="row"><?= $category->id; ?></th>
				<td><?= $category->name; ?></td>
				<td><?= $category->description; ?></td>
				<td><img src="../uploads/<?= $category->file; ?>" style="width: 30px; height: 30px"  alt="good"></td>
				<td><a href="updateCategory.php?id=<?= $category->id; ?>">Update</a></td>
				<td><a href="deleteCategory.php?id=<?= $category->id; ?>">Delete</a></td>
           </tr>				
		<?php endforeach ?>
  </tbody>
</table>
		
<?php include("includes/footer.php") ?>


		