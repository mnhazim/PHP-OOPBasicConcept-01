<?php 
require '../control/allControl.php';
$ctrl = new allControl();
$conn = $ctrl->open();
include 'include/session.php';
$getuser = $ctrl->getuser($conn);
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
        <div class="col-md-12 mx-auto">
          <div class="card mb-4 shadow-sm border-info">
            <div class="card-header">
              <h3 class="text-center text-muted">Request for Sell</h3>
            </div>
            <form action="../control/allControl.php?mod=checkout" method="post">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-sm " id="myTable" align="center">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>No Tel</th>
                      <th>Matric Number</th>
                      <th>Department</th>
                      <th>Date Created</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $num = 1;
                    $totalprice = 0;
                    if ($getuser == false) { ?>
                      <tr>
                        <td colspan="8">No User Record..</td>
                      </tr>
                    <?php } else {
                      foreach ($getuser as $userdetails) {  ?>
                        <tr>
                          <td><?php echo $num++; ?></td>
                          <td><a href="view.php?id=<?php echo $userdetails['user_id']; ?>"><?php echo $userdetails['user_fullname']; ?></a></td>
                          <td><?php echo $userdetails['user_email']; ?></td>
                          <td><?php echo $userdetails['user_notel']; ?></td>
                          <td><?php echo $userdetails['user_matric']; ?></td>
                          <td><?php echo $userdetails['user_department']; ?></td>
                          <td><?php echo $userdetails['user_datecreated']; ?></td>
                        </tr>
                    <?php } } ?>
                  </tbody>
                </table>
              </div>
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
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="../dist/js/customjs.js"></script>
<script>
  $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
</body>
</html>
