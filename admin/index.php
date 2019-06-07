<?php
include '../control/allControl.php';
$ctrl = new allControl();
$conn = $ctrl->open();
include 'include/session.php';
$pendingcheckout = $ctrl->pendingcheckout($conn);
$completecheckout = $ctrl->completecheckout($conn);


?>
<!doctype html>
<html lang="en">
  <?php include 'include/head.php'; ?>
  <body>
    <?php include 'include/nav.php'; ?>

<main role="main">

  <div class="album py-5 bg-light my-4" id="buyercontent">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card border-warning">
            <div class="card-header">
              <h3 class="text-muted">Manage Order:</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-sm " id="myTablePending">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Customer name</th>
                      <th>Pin Num</th>
                      <th>Total Price</th>
                      <th>Receipt</th>
                      <th>Date</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $num = 1;
                    if ($pendingcheckout == false) { ?>
                      <tr>
                        <td colspan="7">No Record Found..</td>
                      </tr>
                    <?php } else {
                      foreach ($pendingcheckout as $pending) {  ?>
                        <tr>
                          <td><?php echo $num++; ?></td>
                          <td><a href="view.php?id=<?php echo $pending['user_id']; ?>"><?php echo $pending['user_fullname']; ?></a></td>
                          <td><?php echo $pending['cart_checkout']; ?></td>
                          <td>RM <?php echo $pending['record_price']; ?></td>
                          <td><a href="<?php echo $pending['record_receipt']; ?>"><?php echo $pending['cart_checkout']; ?></a></td>
                          <td><?php echo $pending['record_datecreated']; ?></td>
                          <td><a href="../control/allControl.php?mod=updatecomplete&id=<?php echo $pending['record_id']; ?>" class="btn btn-success">Completed</a></td>
                        </tr>
                    <?php } } ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer"></div>
          </div>
        </div>
      </div>

      <div class="row my-4">
        <div class="col-md-12">
          <div class="card border-success">
            <div class="card-header">
              <h3 class="text-muted">Manage Order::(Completed)</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-sm " id="myTableComplete">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Customer Name</th>
                      <th>Pin Num</th>
                      <th>Total Price</th>
                      <th>Receipt</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $numcomplete = 1;
                    if ($completecheckout == false) { ?>
                      <tr>
                        <td colspan="6">No Record Found..</td>
                      </tr>
                    <?php } else {
                      foreach ($completecheckout as $completed) {  ?>
                        <tr>
                          <td><?php echo $numcomplete++; ?></td>
                          <td><?php echo $completed['user_fullname']; ?></td>
                          <td><?php echo $completed['cart_checkout']; ?></td>
                          <td>RM <?php echo $completed['record_price']; ?></td>
                          <td><a href="<?php echo $completed['record_receipt']; ?>"><?php echo $completed['cart_checkout']; ?></a></td>
                          <td><?php echo $completed['record_datecreated']; ?></td>
                        </tr>
                    <?php } } ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer"></div>
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
    $('#myTablePending').DataTable();

    $('#myTableComplete').DataTable();
} );

</script>
</body>
</html>
