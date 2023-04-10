<?php include("includes/header.php") ?>

<!-- <form method="post" id="add" enctype = "multipart/form-data">
			<input type="text" name="name" placeholder="Name"><br>
			<input type="text" name="description" placeholder="Description"><br>
			<input type="file" name="file" placeholder="upload your image"><br>
			<input type="submit" value="send the file" name="submit"> 
</form>	 -->
<div class='content'>
<h2>Add a Category</h2>

  <form method="POST" action="categoryproductController.php"  id="addcategory" enctype = "multipart/form-data">
    <div class="form-group">
      <label for="InputName">Name</label>
      <input type="text" name="name" class="form-control" id="InputName" placeholder="Name">
    </div>
    <div class="form-group">
      <label for="InputDescription">Description</label>
      <input type="text" name="description" class="form-control" id="InputDescription" placeholder="Description">
    </div>
    <div class="form-group">
      <label for="FormControlFile"> Upload an Image</label>
      <input type="file" name="file" class="form-control-file" id="FormControlFile" placeholder="upload your image">
    </div>
    <button type="submit" name="addCategory" class="btn btn-primary">Add a Category</button>
  </form>
</div>
        
<?php include("includes/footer.php") ?>



