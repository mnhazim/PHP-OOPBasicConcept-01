<?php 
require '../control/allControl.php';
$ctrl = new allControl();
$conn = $ctrl->open();
include 'include/session.php';
$userdata = $ctrl->getUserDetails($conn, $customerid);



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
        <div class="col-md-6">
          <div class="card mb-4 shadow-sm border-info">
            <div class="card-header">
              <h3 class="text-center">Your Profile</h3>
            </div>
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Name</label>
                  <input type="text" class="form-control" disabled value="<?php echo $userdata['user_fullname']; ?>">
                  <!-- <small id="nameerror" class="text-danger">Required field</small> -->
                </div>
                <div class="form-group col-md-6">
                  <label>Notel</label>
                  <input type="text" class="form-control" disabled value="<?php echo $userdata['user_notel']; ?>">
                  <!-- <small id="notelerror" class="text-danger">Required field</small> -->
                </div>
              </div>
              <div class="form-group">
                <label for="inputAddress2">Matric Number</label>
                <input type="text" class="form-control" disabled value="<?php echo $userdata['user_matric']; ?>">
                <!-- <small id="matricerror" class="text-danger">Required field</small> -->
              </div>
              <div class="form-group">
                <label for="inputEmail4">Email</label>
                <input type="text" class="form-control" disabled value="<?php echo $userdata['user_email']; ?>">
                
              </div>
              <div class="form-group">
                <label for="inputAddress2">Department</label>
                <input type="text" class="form-control" disabled value="<?php echo $userdata['user_department']; ?>">
              </div>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card mb-4 shadow-sm border-danger">
            <div class="card-header">
              <h3 class="text-center">Update Profile</h3>
            </div>
            <form action="../control/allControl.php?mod=updateProfile" method="post">
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Name</label>
                  <input id="inputname" type="text" class="form-control" name="name" placeholder="Enter your name" autocomplete="off" required value="<?php echo $userdata['user_fullname']; ?>">
                  <!-- <small id="nameerror" class="text-danger">Required field</small> -->
                </div>
                <div class="form-group col-md-6">
                  <label>Notel</label>
                  <input id="inputnotel" type="text" class="form-control" name="notel" placeholder="Enter No Tel" autocomplete="off" required value="<?php echo $userdata['user_notel']; ?>">
                  <!-- <small id="notelerror" class="text-danger">Required field</small> -->
                </div>
              </div>
              <div class="form-group">
                <label for="inputAddress2">Matric Number</label>
                <input id="inputmatric" type="text" class="form-control" id="inputAddress2" name="matric" placeholder="Enter your matric number" autocomplete="off" required value="<?php echo $userdata['user_matric']; ?>">
                <!-- <small id="matricerror" class="text-danger">Required field</small> -->
              </div>
              <div class="form-group">
                <label for="inputEmail4">Email</label>
                <input id="inputemail" type="email" class="form-control" id="inputEmail4" value="<?php echo $userdata['user_email']; ?>" disabled>
                
              </div>
              <div class="form-group">
                <label for="inputAddress2">Department</label>
                <select class="form-control" name="department">
                  <option <?php if($userdata['user_department'] == "JP"){ echo "selected";} ?> value="JP">Jabatan Perdagangan (JP)</option>
                  <option <?php if($userdata['user_department'] == "JKE"){ echo "selected";} ?> value="JKE">Jabatan Kejuruteraan Elektrik (JKE)</option>
                </select>
              </div>
              <input type="hidden" name="userid" value="<?php echo $customerid; ?>">
            </div>
            <div class="card-footer m-2 ">
              <input type="submit" name="submit" value="Submit" class="btn btn-danger float-right m-2">
            </div>
          </form>
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
