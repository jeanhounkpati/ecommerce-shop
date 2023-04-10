<?php require 'includes/header.php'; ?>

<?php
include '../database.php';
if(isset($_GET['id'])){    
    global $PDO;
    $req=$PDO->prepare("SELECT * FROM category WHERE id=:id");
    $req->execute(['id'=>$_GET['id']]);
    $category=$req->fetchAll(PDO::FETCH_OBJ); 
    ?>
<div class='content'>
	<h2>Update a category</h2>
	<form method="POST" action="categoryproductController.php" id="updatecategory"  enctype = "multipart/form-data">
		<input type="hidden" name ='category_id' value='<?= $category[0]->id ; ?>'>

		<div class="form-group">
			<label for="InputName">Name</label>
			<input type="text" name="name" value ="<?= $category[0]->name; ?>" class="form-control" id="InputName" placeholder="Name">
		</div>
		<div class="form-group">
			<label for="InputDescription">Description</label>
			<input type="text" name="description" value="<?= $category[0]->description; ?>" class="form-control" id="InputDescription" placeholder="Description">
		</div>
		<div class="form-group">
			<label for="FormControlFile">Image</label>
			<input type="file" name="file" class="form-control-file" id="FormControlFile" placeholder="upload your image">
		</div>
		<input type="hidden" name ='old_file' value='<?= $category[0]->file ; ?>'>

		<button type="submit" name="updateCategory" class="btn btn-primary">Update</button>
	</form>
</div>
    <?php
    }
    else {
    echo "category not found";
    }
    ?>







