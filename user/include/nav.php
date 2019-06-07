<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="index.php">E-bundle Book</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="profile.php">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php">Your Cart <span class="badge badge-warning"><?php echo $totalcart['totalcart']; ?></span></a>
        </li>
      </ul>
      <div class=" mt-2 mt-md-0">
        <a href="../control/allControl.php?mod=logout" class="btn btn-outline-success my-2 my-sm-0" onclick="return confirm('Are you sure ?')">Logout</a>
      </div>
    </div>
  </nav>
</header>