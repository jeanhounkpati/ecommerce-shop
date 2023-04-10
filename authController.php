<?php 
	// session_start();
	if(isset($_SESSION['auth']))
	{
		$_SESSION['message'] = "you are already logged in";
		header('location:profil.php');
		exit();

	}
?>


<?php
	if(isset($_SESSION['message']))
	{

	?>
	<strong>hey</strong><?=$_SESSION['message'];?>
	<?php
	unset($_SESSION['message']);
	}
	?>

<?php 
		if(isset($_POST['login']))
		{
			extract($_POST);
			if (!empty($email) && !empty($password))
			{
				include 'database.php';
				global $PDO;
				$q=$PDO->prepare("SELECT * FROM users WHERE email=:email");
				$q->execute(['email'=>$email]);
				$result=$q->fetch();
				if ($result==true)
				{					
					if (password_verify($password, $result['password']))
					{

						 $id =$result['id'];
						 $email =$result['email'];
						 $role_as =$result['role_as'];


						 $_SESSION['auth_user']=[
							'id'=>$id,
							'role_as'=>$role_as,
							'email'=>$email
						 ];
						$_SESSION['auth'] = true;
						$_SESSION['role_as']=$role_as;
						if($role_as==1)
						{
							$_SESSION['message'] = "Welcome to dashboard";
							header('location:/admin/dashboard.php');
	
						}
						else{
							$_SESSION['message'] = "Login succesfully";
						header('location:/admin/showProduct.php');
						}
						
					}
					else
					{
						$_SESSION['message'] = "invalid credentials";
					}					
				}
				else
				{
					$_SESSION['message'] = "A user  with this email already exists";

				}
			}
			else
			{
				$_SESSION['message'] = "Complete all the fields";
			}
		}

		elseif(isset($_POST['register'])) 
		{
			extract($_POST);
			if (!empty($password) && !empty($cpassword) && !empty($email))
				{
					if ($password==$cpassword)
						{
							$option=['cost'=>12,];
							$hashpass=password_hash($password, PASSWORD_BCRYPT,$option); 
							include 'database.php';
							global $PDO;
								$q=$PDO->prepare("INSERT INTO users(email,password) VALUES(:email,:password)");
								$q->execute([
									'email'=>$email,
									'password'=>$hashpass
								]);
								$_SESSION['message'] = "Register succesfully";
								header('location:login.php');
						}
					else
					{
						$_SESSION['message'] = "Passwords are not the same";
					}	
				}
			else
			{
				$_SESSION['message'] = "Complete all the fields";
			}
		}
	 ?>







<?php 
	session_start();
	if(isset($_SESSION['auth']))
	{
		$_SESSION['message'] = "you are already logged in";
		header('location:profil.php');
		exit();

	}
?>


<?php
	if(isset($_SESSION['message']))
	{

	?>
	<strong>hey</strong><?=$_SESSION['message'];?>
	<?php
	unset($_SESSION['message']);
	}
	?>

<?php 
		if(isset($_POST['submit']))
		{
			extract($_POST);
			if (!empty($email) && !empty($password))
			{
				include '../database.php';
				global $PDO;
				$q=$PDO->prepare("SELECT * FROM users WHERE email=:email");
				$q->execute(['email'=>$email]);
				$result=$q->fetch();
				if ($result==true)
				{
					
					
					if (password_verify($password, $result['password']))
					{

						 $id =$result['id'];
						 $email =$result['email'];
						 $role_as =$result['role_as'];


						 $_SESSION['auth_user']=[
							'id'=>$id,
							'role_as'=>$role_as,
							'email'=>$email
						 ];
						$_SESSION['auth'] = true;
						$_SESSION['role_as']=$role_as;
						if($role_as==1)
						{
							$_SESSION['message'] = "Welcome to dashboard";
							header('location:../admin/index.php');
	
						}
						else{
							$_SESSION['message'] = "Login succesfully";
						header('location:../admin/product/showProduct.php');
						}
						
					}
					else
					{
						$_SESSION['message'] = "invalid credentials";
					}

					
				}
				else
				{
					$_SESSION['message'] = "A user  with this email already exists";

				}
			}
			else
			{
				$_SESSION['message'] = "Complete all the fields";
			}
		}
	 ?>	

