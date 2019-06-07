<?php
include '../control/allControl.php';
$ctrl = new allControl();
$conn = $ctrl->open();
$listbook = $ctrl->showallbook($conn);
include 'include/session.php';
$sellbook = $ctrl->sellbook($conn, $customerid);


?>
<!doctype html>
<html lang="en">
  <?php include 'include/head.php'; ?>
  <body>
    <?php include 'include/nav.php'; ?>

<main role="main">
  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading text-white">'E-bundle book'</h1>
      <p class="lead text-white font-weight-bold">is a system based on selling of secondhand book through online. This platform is especially created for students who face difficulties to find their reference book and also to help poor students who not able to find their reference books</p>
      <p>
        <a href="#" class="btn btn-outline-danger my-2 px-4 active" id="buyerbtn">BUYER</a>
        <a href="#" class="btn btn-outline-info my-2 px-4" id="sellerbtn">SELLER</a>
      </p>
    </div>
  </section>

  <div class="album py-5 bg-light" id="buyercontent">
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
                      <th>Status</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $num = 1;
                    if ($listbook == false) {
                      
                    } else {
                    foreach ($listbook as $recordbook) { ?>
                      <tr>
                        <td><?php echo $num++; ?></td>
                        <td><?php echo $recordbook['book_name']; ?></td>
                        <td><?php echo $recordbook['book_desc']; ?></td>
                        <td><?php echo $recordbook['book_status']; ?></td>
                        <td>RM <?php echo $recordbook['book_price']; ?></td>
                        <td><?php echo $recordbook['book_quantity']; ?></td>
                        <td><a href="view.php?id=<?php echo $recordbook['book_id']; ?>" class="btn btn-info">View</a>&nbsp;<a href="../control/allControl.php?mod=addCart&id=<?php echo $recordbook['book_id']; ?>" class="btn btn-outline-secondary">Add to Cart</a></td>
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

  <div class="album py-5 bg-light" id="sellercontent">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card mb-4 shadow-sm border-danger">
            <div class="card-header">
              <h4 class="text-muted"></h4>
            </div>
            <div class="card-body">
               <h2>Your Book <button class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Sell Book</button></h2>
              <div class="table-responsive">
                <table class="table table-striped table-sm ">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th width="35%">Description</th>
                      <th>Status</th>
                      <th>Price</th>
                      <th>Quantity</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $num = 1;
                    if ($sellbook == false) {
                      ?>
                        <tr>
                        <td colspan="7">No Record Found..</td>
                      </tr>
                      <?php      
                    } else {
                    foreach ($sellbook as $recordbook) { ?>
                      <tr>
                        <td><?php echo $num++; ?></td>
                        <td><?php echo $recordbook['book_name']; ?></td>
                        <td><?php echo $recordbook['book_desc']; ?></td>
                        <td><?php echo $recordbook['book_status']; ?></td>
                        <td>RM <?php echo $recordbook['book_price']; ?></td>
                        <td><?php echo $recordbook['book_quantity']; ?></td>
                      </tr>
                    <?php } }?>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                  <form action="../control/allControl.php?mod=reqsellbook" method="post">
                    <div class="col-md-6">
                      <strong><h5>Book Details</h5></strong>
                      <hr>
                    </div>
                    <div class="form-group">
                      <label>Title</label>
                      <input id="inputname" type="text" class="form-control" name="title" placeholder="Enter book  title" autocomplete="off" required >
                    </div>
                    <div class="form-group">
                      <label for="inputAddress2">Description</label>
                      <textarea class="form-control" rows="2" name="description"></textarea>
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
                        <label for="inputCity">Quantity</label>
                        <select name="quantity" class="form-control">
                          <?php for($a = 1; $a < 10; $a++){ ?>
                                <option value="<?php echo $a; ?>"><?php echo $a; ?></option>
                            <?php } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Price (RM)</label>
                        <input id="inputnotel" type="text" class="form-control" name="price" placeholder="5.90" autocomplete="off" required>
                      </div>
                      <!-- hidden area -->
                      <input type="hidden" name="userid" value="<?php echo $customerid; ?>">
                      <input type="hidden" name="published" value="0">
                      <input type="hidden" name="status" value="pending">
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <button type="submit" class="btn btn-success btn-block">Submit</button>
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
