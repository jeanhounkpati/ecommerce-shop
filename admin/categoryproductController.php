<?php 

	if(isset($_POST['addCategory']))
	{
		extract($_POST);
		extract($_FILES);
		if (!empty($name) && !empty($description) && !empty($file))
		{
			include '../database.php';
			global $PDO;
			$file = $_FILES['file']['name'];
			$path = "../uploads";
			$image_ext = pathinfo($file,PATHINFO_EXTENSION);
			$filename = time().'.'.$image_ext;
			

			$q=$PDO->prepare("INSERT INTO category (name,description,file) VALUES(:name,:description,:file)");		
							$q->execute([
								'name'=>$name,
								'description'=>$description,
								'file'=>$filename
							]);
			move_uploaded_file($_FILES['file']['tmp_name'],$path.'/'.$filename);
			header('location:showCategory.php');
			
		}
		else
		{
			echo "May complete the fields";
		}
	}

	elseif(isset($_POST['updateCategory']))
	{			
			extract($_POST);
			extract($_FILES);
			if (!empty($name) && !empty($description) && !empty($file))
			{
				include '../database.php';
				global $PDO;
				
				$file = $_FILES['file']['name'];
				$new_file = $_FILES['file']['name'];
				$old_file = $_POST['old_file'];
				if($new_file != "")
				{
					
					// $update_filename = $new_file;
					$image_ext = pathinfo($new_file,PATHINFO_EXTENSION);
					$update_filename = time().'.'.$image_ext;
				}
				else{
					$update_filename = $old_file;
				}
				$path = '../uploads';
                $q = $PDO->prepare("UPDATE category SET name=?, description=?, file=? WHERE id=?");
				$q->execute([$name, $description, $update_filename, $category_id]);
				$row_count = $q->rowCount();

				if($_FILES['file']['tmp_name'] !="")
				{
					move_uploaded_file($_FILES['file']['tmp_name'],$path.'/'.$update_filename);
					if(file_exists("../uploads/".$old_file))
					{
						unlink("../uploads/".$old_file);
					}
					else
					{
						echo "something went wrong";
					}
				}                               
			}
			else
			{
				echo "May complete the fields";
			}
		
	}


	if(isset($_POST['addProduct']))
{
	if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price']))
	{
    include '../database.php';
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $file = $_FILES['file']['name'];
    $path = "../uploads";
    $image_ext = pathinfo($file, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $q = $PDO->prepare("INSERT INTO products (category_id,name,description,price,file) VALUES(:category_id,:name,:description,:price,:file)");

    $q->execute([
        'category_id' => $category_id,
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'file' => $filename
    ]);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $path.'/'.$filename)) {
        header('location:showProduct.php');
        exit();
    } else {
        echo "Failed to upload the file";
    }
}
else
{
    echo "Please complete all the fields and select an image to upload";
}
}

elseif(isset($_POST['updateProduct']))
{
    if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price']))
    {
        include '../database.php';
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $product_id = $_POST['product_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $old_file = $_POST['old_file'];
        
        if ($_FILES['file']['tmp_name'] != "") {
            $file = $_FILES['file']['name'];
            $path = "../uploads";
            $image_ext = pathinfo($file, PATHINFO_EXTENSION);
            $update_filename = time().'.'.$image_ext;
            
            move_uploaded_file($_FILES['file']['tmp_name'], $path.'/'.$update_filename);
            
            if (file_exists($path.'/'.$old_file)) {
                unlink($path.'/'.$old_file);
            }
            
        } else {
            $update_filename = $old_file;
        }

        $q = $PDO->prepare("UPDATE products SET name=:name,description=:description,price=:price, file=:file WHERE id=:product_id");
        
        $q->execute([
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'file' => $update_filename,
            'product_id' => $product_id
        ]);

        header('location:showProduct.php');
        exit();

    } else {
        echo "Please complete all the fields";
    }                   
}

?>

// 	elseif(isset($_POST['deleteCategory'])){
// 			include '../../database.php';
// 			if(isset($_GET['id'])){    
// 				global $PDO;
// 				$req=$PDO->prepare("SELECT * FROM category WHERE id=:id");
// 				$req->execute(['id'=>$_GET['id']]);			
// 				$category=$req->fetchAll(PDO::FETCH_OBJ);
// 				$file = $category[0]->file;
// 				$req=$PDO->prepare("DELETE FROM category WHERE id=:id");
// 				$req->execute(['id'=>$_GET['id']]);
				
// 				if(file_exists("../../uploads/".$file))
// 				{
// 					unlink("../../uploads/".$file);
// 				}
// 				else
// 				{
// 					echo "something went wrong";
// 				}
// 			}

// 	}




// 	else(isset($_POST['deleteProduct'])){
// 		// include '../../database.php';
// 		if(isset($_GET['id'])){    
// 			global $PDO;
//             $req=$PDO->prepare("SELECT * FROM products WHERE id=:id");
//             $req->execute(['id'=>$_GET['id']]);			
// 			$product=$req->fetchAll(PDO::FETCH_OBJ);
//             $file = $product[0]->file;
//             $req=$PDO->prepare("DELETE FROM products WHERE id=:id");
//             $req->execute(['id'=>$_GET['id']]);
            
//             if(file_exists("../../uploads/".$file))
//             {
//                 unlink("../../uploads/".$file);
//             }
//             else
//             {
//                 echo "something went wrong";
//             }
//         }
			

// 	}
		
// ?>