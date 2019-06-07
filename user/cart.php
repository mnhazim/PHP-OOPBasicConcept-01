<?php 
require '../control/allControl.php';
$ctrl = new allControl();
$conn = $ctrl->open();
include 'include/session.php';
$getcheckout = $ctrl->getCheckout($conn, $customerid);
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
        <div class="col-md-10 mx-auto">
          <div class="card mb-4 shadow-sm border-info">
            <div class="card-header">
              <h3 class="text-center text-muted">Your Cart</h3>
            </div>
            <form action="../control/allControl.php?mod=checkout" method="post">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-sm ">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>Total Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $num = 1;
                    $totalprice = 0;
                    if ($cart == false) { ?>
                      <tr>
                        <td colspan="6">No Cart..</td>
                      </tr>
                    <?php } else {
                      foreach ($cart as $listcart) {  ?>
                        <tr>
                          <td><?php echo $num++; ?></td>
                          <td><?php echo $listcart['book_name']; ?></td>
                          <td>RM <?php echo $listcart['book_price']; ?></td>
                          <td>
                            <div class="form-group">
                              <select class="form-control" onchange="location = this.value;">
                                <?php for ($a = 1; $a <= $listcart['book_quantity']; $a++) { ?>
                                  <option <?php if($a == $listcart['cart_quantity']){ echo "selected";} ?> value="../control/allControl.php?mod=addq&val=<?php echo $a; ?>&id=<?php echo $listcart['cart_id']; ?>"><?php echo $a; ?></option>
                                <?php } ?>
                              </select>
                              <input id="inputquantity" type="hidden" name="cardquantity" value="<?php echo $listcart['book_quantity'] ?>">
                            </div>
                          </td>
                          <?php $total = $listcart['cart_quantity'] * $listcart['book_price']; 
                            $totalprice += $total;
                          ?>
                          <td>RM <?php echo $total; ?></td>
                          <td><a href="../control/allControl.php?mod=deletecart&id=<?php echo $listcart['cart_id'] ?>" class="btn btn-danger">&times;</a></td>
                        </tr>
                    <?php } } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="4" align="right">Total:</td>
                      <td>RM <?php echo $totalprice; ?></td>
                      <input type="hidden" name="totalprice" value="<?php echo $totalprice; ?>">
                      <input type="hidden" name="userid" value="<?php echo $customerid; ?>">
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <div class="card-footer">
              <?php
              if ($cart !== false) { ?>
               <button type="submit" id="btncheckout" onclick="return confirm('You want to checkout ?')" class="btn btn-success float-right m-2">Checkout</button>
              <small class="text-danger" id="errorquantity">***Opps, Some book are sold out. Please remove before proceed to checkout.</small>
              <?php }  ?>
            </div>
          </form>
          </div>
        </div>
      </div>
      <div class="border-top my-2"></div>
      <div class="row">
        <div class="col-md-10 mx-auto">
          <div class="card mb-4 shadow-sm border-success">
            <div class="card-header">
              <h3 class="text-muted">Record Checkout</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-sm " id="myTable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Pin Num</th>
                      <th>Status</th>
                      <th>Total Price</th>
                      <th>Receipt</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    if ($getcheckout == false) { ?>
                      <tr>
                        <td colspan="6">No Cart..</td>
                      </tr>
                    <?php } else {
                      foreach ($getcheckout as $listcheckout) {  ?>
                        <tr>
                          <td><?php echo $num++; ?></td>
                          <td><?php echo $listcheckout['cart_checkout']; ?></td>
                          <td><?php echo $listcheckout['record_status']; ?></td>
                          <td>RM <?php echo $listcheckout['record_price']; ?></td>
                          <td><a href="<?php echo $listcheckout['record_receipt']; ?>"><?php echo $listcheckout['cart_checkout']; ?></a></td>
                          <td><?php echo $listcheckout['record_datecreated']; ?></td>
                        </tr>
                    <?php } } ?>
                  </tbody>
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
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="../dist/js/customjs.js"></script>
<script>
  $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
</body>
</html>
