<?php 
session_start();
?>
<!DOCTYPE html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/styles.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;1,300&display=swap" rel="stylesheet"> 
<html>
<head>
	<title>Our Shop</title>
</head>
<body class="container">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="#">shop</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="#">order</a>
      </li>
	  		<?php
			if(isset($_SESSION['auth']))
			{
			?>
				<li class="nav-item">
					<a class="nav-link" href="logout.php">logout</a>
				</li>
	  		<?php
			}
			else{
			?>
				<li class="nav-item">
					<a class="nav-link" href="user/register.php">register</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="user/login.php">login</a>
				</li>
	  		<?php
			}
			?>
    </ul>
	
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
		
	<div  class="row">