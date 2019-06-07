<?php 
require '../control/allControl.php';
$ctrl = new allControl();
$conn = $ctrl->open();
include 'include/session.php';

$bookid = "-1";
if (isset($_GET['id'])) {
  $bookid = mysqli_escape_string($conn, $_GET['id']);
}

$bookdata = $ctrl->showbookid($conn, $bookid);
if (!$bookdata) {
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
        <?php
        if ($bookdata == false) { ?>
          <div class="col-md-6 mx-auto">
            <div class="card mb-4 shadow-sm">
              <div class="card-body">
                <h5 class="text-muted">No book found..</h5>
              </div>
            </div>
          </div>
        <?php } else { ?>
            <div class="col-md-6 mx-auto">
              <div class="card mb-4 shadow-sm border-info">
                <div class="card-header">
                  <h3 class="text-center"><?php echo $bookdata['book_name']; ?></h3>
                </div>
                <div class="card-body">
                  <p class="card-text"><?php echo $bookdata['book_desc']; ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-danger" onclick="window.location.href='index.php'">Back</button>
                      <a href="../control/allControl.php?mod=addCart&id=<?php echo $bookdata['book_id']; ?>" class="btn btn-sm btn-outline-secondary">Add to Cart</a>
                    </div>
                    <small class="text-muted">Dept: <?php echo $bookdata['book_department']; ?>,Qnty: <?php echo $bookdata['book_quantity']; ?>(RM <?php echo $bookdata['book_price']; ?>)</small>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
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
