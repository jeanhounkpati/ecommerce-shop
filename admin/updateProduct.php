<?php require 'includes/header.php'; ?>

<?php
include '../database.php';
if(isset($_GET['id'])){    
    global $PDO;
    $req=$PDO->prepare("SELECT * FROM products WHERE id=:id");
    $req->execute(['id'=>$_GET['id']]);
    $product=$req->fetchAll(PDO::FETCH_OBJ); 
    ?>
   
   <div class='content'>
	<h2>Update a product</h2>
	<form method="POST" action="categoryproductController.php" id="updateproduct" enctype = "multipart/form-data">  
		<input type="hidden" name ='product_id' value='<?= $product[0]->id ; ?>'>

		<!-- <div class="form-group">
			<label for="InputCurrentCategory">Current Category</label>
			<input type="text" name="current_category" class="form-control" value ='<?= $product[0]->category_name; ?>' id="InputCurrentCategory" readonly>
		</div> -->

		<label class="my-1 mr-2" for="inlineFormCustomSelectPref">New Category</label>
		<select class="custom-select my-1 mr-sm-2" name="category_id" id="category_id">
			<option selected>Choose...</option>
			<?php
				include '../database.php';
				global $PDO;
				$req=$PDO->prepare('SELECT * FROM category');
				$req->execute();
				$categories=$req->fetchAll(PDO::FETCH_OBJ);
				if($categories>0)
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
			<input type="text" name="name" class="form-control" value ='<?= $product[0]->name; ?>' id="InputName" placeholder="Name">
		</div>
		<div class="form-group">
			<label for="InputDescription">Description</label>
			<input type="text" name="description" value='<?= $product[0]->description; ?>' class="form-control" id="InputDescription" placeholder="Description">
		</div>
		<div class="form-group">
			<label for="InputPrice">Price</label>
			<input type="number" name="price"  value='<?= $product[0]->price; ?>' class="form-control" id="InputPrice" placeholder="Price">
		</div>
		<div class="form-group">
			<label for="FormControlFile">Current Image</label><br>
			<img src="../uploads/<?= $product[0]->file ?>" height="100"><br>
			<label for="FormControlFile">New Image</label>
			<input type="file" name="file" class="form-control-file" id="FormControlFile" placeholder="upload your image">
		</div>
		<input type="hidden" name ='old_file' value='<?= $product[0]->file ; ?>'>

		<button type="submit" name="updateProduct" class="btn btn-primary">updateProduct</button>
	</form>
</div>



    <?php
    }
    else {
    echo "product not found";
    }
    ?>



