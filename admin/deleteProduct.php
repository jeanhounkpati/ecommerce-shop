<?php require '../header.php'; ?>
<?php
		include '../database.php';
		if(isset($_GET['id'])){    
			global $PDO;
            $req=$PDO->prepare("SELECT * FROM products WHERE id=:id");
            $req->execute(['id'=>$_GET['id']]);			
			var_dump($product=$req->fetchAll(PDO::FETCH_OBJ));
            $file = $product[0]->file;
            $req=$PDO->prepare("DELETE FROM products WHERE id=:id");
            $req->execute(['id'=>$_GET['id']]);
            
            if(file_exists("../uploads/".$file))
            {
                unlink("../uploads/".$file);
            }
            else
            {
                echo "something went wrong";
            }
        }
?>

<div>
   Delete succesfully
</div>