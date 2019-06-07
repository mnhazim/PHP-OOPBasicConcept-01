<?php
include 'control/allControl.php';
$ctrl = new allControl();
$conn = $ctrl->open();
$listbook = $ctrl->listbook($conn);

if (isset($_SESSION['user_id'])) {
  echo "<script>window.location='user/'</script>";
} else if(isset($_SESSION['admin_id'])) {
  echo "<script>window.location='admin/'</script>";
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="e-bundle pmj">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>E-bundle PMJ</title>

    <!-- Bootstrap core CSS -->
<link href="dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">


    <style>
      .jumbotron{
          background: url("store/bg22.jpg") no-repeat center center; 
          background-image: rgb(0,0,0,.4);
          -webkit-background-size: 100% 100%;
          -moz-background-size: 100% 100%;
          -o-background-size: 100% 100%;
          background-size: 100% 100%;
      }
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  </head>
  <body>
    <header>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">About</h4>
          <p class="text-muted">Welcome to e-bundle book Politeknik Mersing, Johor.</p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">Contact</h4>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white">Follow on Twitter</a></li>
            <li><a href="#" class="text-white">Like on Facebook</a></li>
            <li><a href="#" class="text-white">Email me</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between">
      <a href="#" class="navbar-brand d-flex align-items-center">
        <strong>E-Bundle Book</strong>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

    </div>
  </div>
</header>

<main role="main">

  <section class="jumbotron text-center bg-book">
    <div class="container">
      <h1 class="jumbotron-heading text-white">'E-bundle book'</h1>
      <p class="lead text-white font-weight-bold">is a system based on selling of secondhand book through online. This platform is especially created for students who face difficulties to find their reference book and also to help poor students who not able to find their reference books</p>
      <p>
        <a href="#" class="btn btn-danger my-2" data-toggle="modal" data-target="#register">REGISTER NOW</a>
        <a href="#" class="btn btn-info my-2" data-toggle="modal" data-target="#exampleModal">SIGN IN</a>
      </p>
    </div>
  </section>

  <!-- Open Modal Signup-->
  <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row mb-2 mt-3">
            <div class="col-md-12 mx-auto">
              <div class="card mb-2 shadow border-info">
                <div class="card-header">
                  <h5>Please fill this form</h5>
                </div>
                <div class="card-body">
                  <form action="control/allControl.php?mod=register" method="post">
                    <div class="col-md-4">
                      <strong><h5>User Details</h5></strong>
                      <hr>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Name</label>
                        <input id="inputname" type="text" class="form-control" name="name" placeholder="Enter your name" autocomplete="off" required >
                        <!-- <small id="nameerror" class="text-danger">Required field</small> -->
                      </div>
                      <div class="form-group col-md-6">
                        <label>Notel</label>
                        <input id="inputnotel" type="text" class="form-control" name="notel" placeholder="Enter No Tel" autocomplete="off" required>
                        <!-- <small id="notelerror" class="text-danger">Required field</small> -->
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputAddress2">Matric Number</label>
                      <input id="inputmatric" type="text" class="form-control" id="inputAddress2" name="matric" placeholder="Enter your matric number" autocomplete="off" required>
                      <!-- <small id="matricerror" class="text-danger">Required field</small> -->
                    </div>
                    <div class="form-group">
                      <label for="inputEmail4">Email</label>
                      <input id="inputemail" type="email" class="form-control" id="inputEmail4"  name="email" placeholder="Enter Your Email" autocomplete="off" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                      <small id="emailerror" class="text-danger">Invalid Email</small>
                      <small class="text-muted">**All the information/notification will send through your email</small>
                      
                    </div>
                    <div class="form-group">
                      <label for="inputAddress2">Department</label>
                      <select class="form-control" name="department">
                        <option value="JP">Jabatan Perdagangan (JP)</option>
                        <option value="JKE">Jabatan Kejuruteraan Elektrik (JKE)</option>
                      </select>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="inputCity">Password</label>
                        <input id="inputpassword" type="password" class="form-control" name="password" placeholder="pasword..." autocomplete="off" required>
                        <!-- <small id="passworderror" class="text-danger">Required field</small> -->
                      </div>

                      <div class="form-group col-md-6">
                        <label for="inputCity">Confirm Password</label>
                        <input id="inputconfirm" type="password" class="form-control" name="confirmpass" placeholder="pasword..." autocomplete="off" required>
                      </div>
                    </div>
                    <!-- <small class="text-danger">***Password wll automatically generate and send to your email<br>***You need to login and change the new password.</small> -->
                    <div class="row">
                      <div class="col-md-12">
                        <button type="submit" class="btn btn-success btn-block" id="btnregister">Register</button>
                        <button type="button" class="btn btn-outline-danger btn-block" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Closed Modal Signup-->

  <!-- Open Modal Signin-->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row mb-2 mt-3">
            <div class="col-md-12 mx-auto">
              <div class="card mb-2 shadow border-info">
                <div class="card-header">
                  <h5>Please Sign In</h5>
                </div>
                <div class="card-body">
                  <form action="control/allControl.php?mod=login" method="post">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter your email" required autocomplete="off" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="****" required autocomplete="off">
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <button class="btn btn-success btn-block">Submit</button>
                      <button type="button" class="btn btn-outline-danger btn-block" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Closed Modal Signin-->

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row">
        <div class="col-md-12">
          <div class="card border-info">
            <div class="card-header"></div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-sm " id="myTable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th width="35%">Description</th>
                      <th>Price</th>
                      <th>Quantity</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $num = 1;
                    if ($listbook == false) {
                      ?>
                        <tr>
                        <td colspan="7">No Record Found..</td>
                      </tr>
                      <?php 
                    } else {
                      foreach ($listbook as $recordbook) { ?>
                        <tr>
                          <td><?php echo $num++; ?></td>
                          <td><?php echo $recordbook['book_name']; ?></td>
                          <td><?php echo $recordbook['book_desc']; ?></td>
                          <td>RM <?php echo $recordbook['book_price']; ?></td>
                          <td><?php echo $recordbook['book_quantity']; ?></td>
                        </tr>
                    <?php } }?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="footer"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>

<footer class="text-muted">
  <div class="container">
    <p class="float-right">
      <a href="#">Back to top</a>
    </p>
    <p>E-Bundle</p>
    <p>Politeknik Mersing, Johor.</p>
  </div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script>window.jQuery || document.write('<script src="vendor/jquery-slim.min.js"><\/script>')</script>
<script src="dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="dist/js/customjs.js"></script>
<script>
  $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
</body>
</html>
