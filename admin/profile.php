<?php 
require '../control/allControl.php';
$ctrl = new allControl();
$conn = $ctrl->open();
include 'include/session.php';
$admindata = $ctrl->getAdminDetails($conn, $adminid);



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
              <h3 class="text-center">Your Profile</h3>
            </div>
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Name</label>
                  <input type="text" class="form-control" disabled value="<?php echo $admindata['admin_name']; ?>">
                  <!-- <small id="nameerror" class="text-danger">Required field</small> -->
                </div>
                <div class="form-group col-md-6">
                  <label>Notel</label>
                  <input type="text" class="form-control" disabled value="<?php echo $admindata['admin_notel']; ?>">
                  <!-- <small id="notelerror" class="text-danger">Required field</small> -->
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail4">Email</label>
                <input type="text" class="form-control" disabled value="<?php echo $admindata['admin_email']; ?>">
                
              </div>
              <div class="form-group">
                <label for="inputAddress2">Date Created</label>
                <input type="text" class="form-control" disabled value="<?php echo $admindata['admin_datecreated']; ?>">
              </div>
            </div>
            <div class="card-footer">
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
