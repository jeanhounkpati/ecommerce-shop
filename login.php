
<?php 
session_start();
?>
<!DOCTYPE html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../admin/assets/css/index.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&family=Roboto:wght@300;500&display=swap" rel="stylesheet">
<html>
<head>
	<title>fastfood</title>
</head>
<body class="container">
<div class="row justify-content-center">

	<div class='col-md-6 border border-solid border-2 p-3'>
		<h2 class='text-center'>Login</h2>

		<form method="post" id="loginform" >
		<div class="form-group">
			<label for="InputEmail">Email address</label>
			<input type="email" name="email" class="form-control" id="InputEmail" aria-describedby="emailHelp" placeholder="Enter email">
			<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
		</div>
		<div class="form-group">
			<label for="InputPassword">Password</label>
			<input type="password" name="password" class="form-control" id="InputPassword" placeholder="Password">
		</div>
		
		<button type="submit" name="submit" class="btn btn-primary">Submit</button>
		</form>	
		<div class="d-flex justify-content-between align-items-center">
			<p class="text-center">Have no account?<a href="register.php">Register</a></p>
			<p><a href="forgot.php">Forgot Password</a></p>

		</div>
		<h6 class='text-center'>OR</h6>
		<hr>
		<button class="form-control btn btn-danger g-signin2" data-onsuccess="onSignIn">Sign in with Google</button>

	</div>

</div>

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
		if(isset($_POST['submit']))
		{
			extract($_POST);
			if (!empty($email) && !empty($password))
			{
				include 'database.php';
				global $PDO;
				$q=$PDO->prepare("SELECT * FROM users WHERE email=:email");
				$q->execute(['email'=>$email]);
				$result=$q->fetch();
				var_dump($result);
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
							$_SESSION['message'] = "Welcome to the dashboard";
							header('location:admin/dashboard.php');
	
						}
						else{
							$_SESSION['message'] = "Login succesfully";
							header('location:index.php');
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
</body>
</html>


