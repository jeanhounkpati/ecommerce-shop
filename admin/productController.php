<!-- add a product -->
<?php 
		if(isset($_POST['valider']))
		{
			extract($_POST);
			if (!empty($name) && !empty($description) && !empty($price))
			{
				include 'database.php';
				global $PDO;

                $q=$PDO->prepare("INSERT INTO products (name,description,price) VALUES(:name,:description,:price)");
								$q->execute([
									'name'=>$name,
									'description'=>$description
                                    'price'=>$price
								]);
			}
			else
			{
				echo "May complete the fields";
			}
		}
	 ?>
<!-- get all the products -->

<?php
        include 'database.php';
        global $PDO;
        $req=$PDO->prepare('SELECT * FROM products');
        $req->execute();
        $products=$req->fetchAll(PDO::FETCH_OBJ);
?>


<!-- get a single product -->
<?php
include 'database.php';
if(isset($_GET['id'])){    
    global $PDO;
    $req=$PDO->prepare("SELECT id FROM products WHERE id=:id");
    $req->execute(['id'=>$_GET['id']]);
    var_dump($product=$req->fetchAll(PDO::FETCH_OBJ));
?>

<!-- delete a product -->

<?php
include 'database.php';
if(isset($_GET['id'])){    
    global $PDO;
    // $req=$PDO->prepare("SELECT id FROM products WHERE id=:id");
	 $req=$PDO->prepare("DELETE * FROM products WHERE id=:id")
    $req->execute(['id'=>$_GET['id']]);
    var_dump($product=$req->fetchAll(PDO::FETCH_OBJ));
?>


<?php 

	if(isset($_POST['submit']))
	{
		extract($_POST);
		extract($_FILES);
		var_dump($_POST);
		if (!empty($name) && !empty($description) && !empty($price) && !empty($file))
		{
			include '../../database.php';
			global $PDO;
			// $category_id = $_POST['category_id'];
			$file = $_FILES['file']['name'];
			$path = "../../uploads";
			$image_ext = pathinfo($file,PATHINFO_EXTENSION);
			$filename = time().'.'.$image_ext;
			

			$q=$PDO->prepare("INSERT INTO products (category_id,name,description,price,file) VALUES(:category_id,:name,:description,:price,:file)");
			
							$q->execute([
								'category_id'=>$category_id,
								'name'=>$name,
								'description'=>$description,
								'price'=>$price,
								'file'=>$filename
							]);
			move_uploaded_file($_FILES['file']['tmp_name'],$path.'/'.$filename);
			header('location:showProduct.php');
			
		}
		else
		{
			echo "May complete the fields";
		}
	}
			
	?>


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


<!-- <form method="post" id="add" enctype = "multipart/form-data" >
			<select name="category_id" id="category_id">
				<option selected>Select catagory</option>
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
			<input type="text" name="name" placeholder="Name"><br>
			<input type="text" name="description" placeholder="Description"><br>
			<input type="number" name="price" placeholder="price"><br>
			<input type="file" name="file" placeholder="upload your image"><br>
			<input type="submit" name="submit"> 
</form>	 -->

<div class='content'>

		<?php
			include '../database.php';
			global $PDO;
			$req=$PDO->prepare('SELECT * FROM products');
			$req->execute();
			$products=$req->fetchAll(PDO::FETCH_OBJ);
		?>
			<?php foreach($products as $product):?>
				<div class="extra">
					<div class='img'>						
					<img src="../uploads/<?= $product->file; ?>" alt="good">
					</div>
					
					<div class="info">
						<?= $product->name; ?>	
						<?= $product->price; ?>	
										
					</div>
					<a href="deleteProduct.php?id=<?= $product->id; ?>">delete</a>
					<a href="updateProduct.php?id=<?= $product->id; ?>">update</a>
					<a href="showProductDetails.php?id=<?= $product->id; ?>">show</a>
					<a class="add"  href="../../cart/cartController.php?id=<?= $product->id; ?>">Add to Cart</a>
								
				</div>
			<?php endforeach ?>
</div>	