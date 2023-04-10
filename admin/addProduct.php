<?php include("includes/header.php") ?>

<div class='content'>
	<h2>Add a Product</h2>

	<form method="POST" action="categoryproductController.php" id="addproduct" enctype="multipart/form-data">
		<label class="my-1 mr-2" for="inlineFormCustomSelectPref">Category</label>

		<select class="custom-select my-1 mr-sm-2" name="category_id" id="category_id">
			<option selected>Select category</option>
			<?php
			include '../database.php';
			global $PDO;
			$req=$PDO->prepare('SELECT * FROM category');
			$req->execute();
			$categories=$req->fetchAll(PDO::FETCH_OBJ);
			if(count($categories) > 0)
			{				
				foreach($categories as $category){
				?>
					<option value="<?=$category->id; ?>"><?= $category->name;?></option>
				<?php
				}
			}
			else{
				echo "no category available";
			}
			?>				
		</select>

		<div class="form-group">
			<label for="InputName">Name</label>
			<input type="text" name="name" class="form-control" id="InputName" placeholder="Name">
		</div>

		<div class="form-group">
			<label for="InputDescription">Description</label>
			<input type="text" name="description" class="form-control" id="InputDescription" placeholder="Description">
		</div>

		<div class="form-group">
			<label for="InputPrice">Price</label>
			<input type="number" name="price" class="form-control" id="InputPrice" placeholder="Price">
		</div>

		<div class="form-group">
			<label for="FormControlFile">Upload an Image</label>
			<input type="file" name="file" class="form-control-file" id="FormControlFile">
		</div>

		<button type="submit" name="addProduct" class="btn btn-primary">Add a +
			Product</button>
	</form>
</div>

<?php include("includes/footer.php") ?>
