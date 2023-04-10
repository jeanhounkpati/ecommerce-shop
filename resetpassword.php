
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
	<title>Our Shop</title>
</head>
<body class="container">
<div class="row justify-content-center">

	<div class='col-md-6 border border-solid border-2 p-3'>
		<h2 class='text-center'>Reset Pawwword</h2>

		<form method="POST" id="loginform" >
		<div class="form-group">
			<label for="InputEmail">Email address</label>
			<input type="email" name="email" class="form-control" id="InputEmail" aria-describedby="emailHelp" placeholder="Enter email">
			<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
		</div>
		<button type="submit" name="submit" class="btn btn-primary">Submit</button>
		</form>			
	</div>
</div>

<?php

// Assuming the database connection has been established
// using PDO and stored in the $db variable

// Validate the input
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'database.php';
	global $PDO;
    $email = $_POST['email'];

    // Check if email exists in the database
    $stmt = $PDO->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        // Generate a unique token
        $token = md5(uniqid(rand(), true));

        // Save the token and email in the database
        $stmt = $PDO->prepare('INSERT INTO password_reset_tokens (email, token) VALUES (:email, :token)');
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        // Send an email with a reset link
        $reset_link = "https://example.com/reset-password.php?token=$token";
        $subject = "Reset Your Password";
        $message = "Click the link below to reset your password:\n\n$reset_link";
        mail($email, $subject, $message);

        echo "An email has been sent to your email address with instructions on how to reset your password.";
    } else {
        echo "Email not found in the database.";
    }
}

// Reset password
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if token exists in the database
    $stmt = $PDO->prepare('SELECT * FROM password_reset_tokens WHERE token = :token');
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        // Show the password reset form
        echo "<form method='post'>";
        echo "<input type='password' name='password' placeholder='New Password'>";
        echo "<input type='password' name='confirm_password' placeholder='Confirm New Password'>";
        echo "<input type='submit' value='Reset Password'>";
        echo "</form>";

        // Update the password
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ($password == $confirm_password) {
                $email = $stmt->fetch(PDO::FETCH_ASSOC)['email'];
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $PDO->prepare('UPDATE users SET password = :password WHERE email = :email');
                $stmt->bindParam(':password', $hashed_password);
                $stmt->bindParam(':email', $email);
                $stmt->execute();

                echo "Password reset successful!";
            } else {
                echo "Passwords do not match.";
            }
        }
    } else {
        echo "Invalid token.";
    }
}
?>

</body>
</html>

