<?php include("includes/header.php") ?>
<div class="content">
<div class="btn-group" role="group">
		<button type="button" class="btn active rounded m-3" style="width: 150px; height: 60px;" data-category="all">All PRODUCTS</button>
		<?php
		include 'database.php';
		global $PDO;
		$req=$PDO->prepare('SELECT * FROM category');
		$req->execute();
		$categories=$req->fetchAll(PDO::FETCH_OBJ);
		if(count($categories) > 0)
		{
		?>	
		<div id="stories-container">
			<?php	
				foreach($categories as $category){
				?>
					<button type="button" class="btn rounded m-3" style="width: 150px; height: 60px;" data-category="<?=$category->id; ?>">
					<img src="uploads/<?= $category->file; ?>" alt="Your Image" class="mr-2" width="50" height="50">
					<?= $category->name;?>
					</button>
				<?php
				}
			?>
		</div>
		<?php

		}
		?>
				
	</div>

<div id="product-list">
  <div class="row">
    <?php
    include 'database.php';
    global $PDO;
    $req=$PDO->prepare('SELECT * FROM products');
    $req->execute();
    $products=$req->fetchAll(PDO::FETCH_OBJ);
    ?>
    <?php foreach($products as $product):?>
	<div class="col-md-4 mx-auto d-flex align-items-center justify-content-center">
	  	<div class="card">
    		<div class="d-flex align-items-center justify-content-center" style="height: 100%;">
        		<img src="uploads/<?= $product->file; ?>" class="card-img-fluid hover-scale mt-4" style="width: 50%; height: 50%; object-fit: cover;" alt="<?= $product->name ?>">
    		</div>
    		<div class="card-body d-flex justify-content-between">
				<div>
					<h5 class="card-title"><?= $product->name ?></h5>
					<p class="card-text"><?= $product->price ?></p>
				</div>
				<div>
					<a href="showProductDetails.php?id=<?= $product->id; ?>">
						<i class="fa fa-eye" aria-hidden="true"></i>
					</a>
				</div>
    		</div>
		</div>

</div>

    <?php endforeach ?>
  </div>
</div>
</div>


<?php include("includes/footer.php") ?>