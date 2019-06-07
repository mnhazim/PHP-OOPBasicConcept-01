<?php 
require '../control/allControl.php';
$ctrl = new allControl();
$conn = $ctrl->open();
include 'include/session.php';
$getcheckout = $ctrl->getCheckout($conn, $adminid);
$listbook = $ctrl->getlistbook($conn);
$getrequest = $ctrl->getrequestbook($conn);
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
                      <th>Owner Book</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>Book Department</th>
                      <th>Action</th>
                      <!-- <th></th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $num = 1;
                    $totalprice = 0;
                    if ($getrequest == false) { ?>
                      <tr>
                        <td colspan="8">No listbook..</td>
                      </tr>
                    <?php } else {
                      foreach ($getrequest as $bookrequest) {  ?>
                        <tr>
                          <td><?php echo $num++; ?></td>
                          <td><a href="view.php?id=<?php echo $bookrequest['user_id']; ?>"><?php echo $bookrequest['user_fullname']; ?></a></td>
                          <td><?php echo $bookrequest['book_name']; ?></td>
                          <td width="30%"><?php echo $bookrequest['book_desc']; ?></td>
                          <td>RM <?php echo $bookrequest['book_price']; ?></td>
                          <td><?php echo $bookrequest['book_quantity']; ?></td>
                          <td><?php echo $bookrequest['book_department']; ?></td>
                          <td>
                            <div class="form-group">
                              <select class="form-control" onchange="location = this.value;">
                                <option value="">Select</option>
                                <option value="../control/allControl.php?mod=acceptbook&val=1&id=<?php echo $bookrequest['book_id']; ?>">Accept</option>
                                <option  value="../control/allControl.php?mod=rejectbook&val=0&id=<?php echo $bookrequest['book_id']; ?>">Reject</option>
                              </select>
                            </div>
                          </td>
                          <!-- <td><a href="../control/allControl.php?mod=deletebook&id=<?php echo $book['book_id']; ?>" class="btn btn-danger">&times;</a></td> -->
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

      <div class="row">
        <div class="col-md-12 mx-auto">
          <div class="card mb-4 shadow-sm border-info">
            <div class="card-header">
              <h3 class="text-center text-muted">Manage Book</h3>
            </div>
            <form action="../control/allControl.php?mod=checkout" method="post">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-sm " id="myTable" align="center">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Owner Book</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>Book Department</th>
                      <th>Action</th>
                      <!-- <th></th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $num = 1;
                    $totalprice = 0;
                    if ($listbook == false) { ?>
                      <tr>
                        <td colspan="6">No listbook..</td>
                      </tr>
                    <?php } else {
                      foreach ($listbook as $book) {  ?>
                        <tr>
                          <td><?php echo $num++; ?></td>
                          <td><a href="view.php?id=<?php echo $book['user_id']; ?>"><?php echo $book['user_fullname']; ?></a></td>
                          <td><?php echo $book['book_name']; ?></td>
                          <td width="30%"><?php echo $book['book_desc']; ?></td>
                          <td>RM <?php echo $book['book_price']; ?></td>
                          <td><?php echo $book['book_quantity']; ?></td>
                          <td><?php echo $book['book_department']; ?></td>
                          <td>
                            <div class="form-group">
                              <select class="form-control" onchange="location = this.value;">
                                <option <?php if($book['book_publish'] == 1){echo "selected";} ?> value="../control/allControl.php?mod=chngepublsh&val=1&id=<?php echo $book['book_id']; ?>">Publish</option>
                                <option <?php if($book['book_publish'] == 0){echo "selected";} ?> value="../control/allControl.php?mod=chngepublsh&val=0&id=<?php echo $book['book_id']; ?>">Not Publish</option>
                              </select>
                            </div>
                          </td>
                          <!-- <td><a href="../control/allControl.php?mod=deletebook&id=<?php echo $book['book_id']; ?>" class="btn btn-danger">&times;</a></td> -->
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
