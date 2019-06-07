<?php 
require '../control/allControl.php';
$ctrl = new allControl();
$conn = $ctrl->open();
include 'include/session.php';

$userdetails = "-1";
if (isset($_GET['id'])) {
  $userdetails = mysqli_escape_string($conn, $_GET['id']);
}

$userdata = $ctrl->getUserDetails($conn, $userdetails);
if (!$userdata) {
  echo "<script>window.location='index.php'</script>";
}


?>
<!doctype html>
<html lang="en">
  <?php include 'include/head.php'; ?>
  <body>
    <?php include 'include/nav.php'; ?>

<main role="main">


  <div class="album py-5 my-4 bg-light" id="buyercontent">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="card mb-4 shadow-sm border-info">
            <div class="card-header">
              <h3 class="text-center"><?php echo $userdata['user_fullname']; ?></h3>
            </div>
            <div class="card-body">
              <p class="card-text"><?php echo $userdata['book_desc']; ?></p>
              <div class="table-responsive">
                <table class="table table-striped table-sm " id="myTablePending">
                    <tr>
                      <th>Customer name</th>
                      <td><?php echo $userdata['user_fullname']; ?></td>
                    </tr>
                    <tr>
                      <th>Matric</th>
                      <td><?php echo $userdata['user_matric']; ?></td>
                    </tr>
                    <tr>
                      <th>Email</th>
                      <td><?php echo $userdata['user_email']; ?></td>
                    </tr>
                    <tr>
                      <th>Department</th>
                      <td><?php echo $userdata['user_department']; ?></td>
                    </tr>
                    <tr>
                      <th>No tel</th>
                      <td><?php echo $userdata['user_notel']; ?></td>
                    </tr>
                    <tr>
                      <th>Date Created</th>
                      <td><?php echo $userdata['user_datecreated']; ?></td>
                    </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include 'include/footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script>window.jQuery || document.write('<script src="vendor/jquery-slim.min.js"><\/script>')</script>
<script src="../dist/js/bootstrap.bundle.min.js"></script>
<script src="../dist/js/customjs.js"></script>
</body>
</html>
