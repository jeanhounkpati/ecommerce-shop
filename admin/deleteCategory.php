<?php require '../header.php'; ?>
<?php
		include '../database.php';
		if(isset($_GET['id'])){    
			global $PDO;
            $req=$PDO->prepare("SELECT * FROM category WHERE id=:id");
            $req->execute(['id'=>$_GET['id']]);			
			var_dump($category=$req->fetchAll(PDO::FETCH_OBJ));
            $file = $category[0]->file;
            $req=$PDO->prepare("DELETE FROM category WHERE id=:id");
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