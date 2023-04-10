<?php
if (isset($_SESSION['cart_count'])) {
    $cart_count = $_SESSION['cart_count'];
} else {
    $cart_count = 0;
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">

<a class="navbar-brand" href="#">Urcadelima</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="about_us.php">About us</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <?php if(isset($_SESSION['auth'])): ?>
            <a class="dropdown-item" href="profil.php">Profil</a>
            <a class="dropdown-item" href="logout.php">Logout</a>

          <?php else: ?>
            <a class="dropdown-item" href="login.php">Login</a>
          <?php endif; ?>
        </div>
      </li>
    </ul>
      <form action="">
        <div class="input-group no-border">
          <!-- <input type="text" id="keyword" name="keyword" value="" class="form-control" placeholder="Search..."> -->
          <input class="form-control" type="text" name="" id="live_search" autocomplete="off" placeholder="Search..">

          <div class="input-group-append">
            <div class="input-group-text">
            <i class="fa fa-search" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </form>
            <button class="m-3" onclick="toggleTheme()">
				<i id="theme-icon" class="fas fa-moon"></i>
		    </button> 
        <ul class="navbar-nav ml-auto mr-4">
          <li class="nav-item">
            <a class="nav-link" href="cart.php">
              <i class="fas fa-shopping-cart position-relative">
              <span class="badge badge-danger"><?=$cart_count;?></span>
              </i>
            </a>
          </li>
        </ul>        
    </div>     
</nav>

<div id="searchresult"></div>








