<?php
session_start();
$config = new allControl();
	class allControl{
		function __construct(){
			if (isset($_GET['mod'])) {
				$conn = $this::open();
				$action = mysqli_escape_string($conn, $_GET['mod']);

				switch ($action) {

					case 'updatecomplete':
						$this->updatecomplete($conn);
						break;

					case 'deletebook':
						$this->deletebook($conn);
						break;

					case 'chngepublsh':
						$this->changepublish($conn);
						break;

					case 'updateProfile':
						$this->updateProfile($conn);
						break;

					case 'checkout':
						$this->checkout($conn);
						break;

					case 'deletecart':
						$this->deleteCart($conn);
						break;

					case 'reqsellbook':
						$this->reqsellbook($conn);
						break;

					case 'addq':
						$this->addQuantity($conn);
						break;

					case 'login':
						$this->login($conn);
						break;
					
					case 'logout':
						$this->logout();
						break;

					case 'register':
						$this->register($conn);
						break;

					case 'showbookid':
						$this->showbookid($conn, $id);
						break;

					case 'addCart':
						$this->addCart($conn);
						break;

					case 'rejectbook':
						$this->rejectbook($conn);
						break;

					case 'acceptbook':
						$this->acceptbook($conn);
						break;
				}
			}
		}
		public function getuser($conn){
			$sql = mysqli_query($conn, "SELECT * FROM eb_user");
			if (mysqli_num_rows($sql)>0) {
				while ($row = mysqli_fetch_array($sql)) {
					$rows[] = $row;
				}
			} else {
				$rows = false;
			}
			return $rows;
		}

		public function getrequestbook($conn){
			$sql = mysqli_query($conn, "SELECT * FROM eb_book a LEFT JOIN eb_user b ON (a.user_id = b.user_id) WHERE a.book_status IN ('pending')");
			if (mysqli_num_rows($sql)>0) {
				while ($row = mysqli_fetch_array($sql)) {
					$rows[] = $row;
				}
			} else {
				$rows = false;
			}
			return $rows;
		}

		public function rejectbook($conn){
			$bookid = mysqli_escape_string($conn, $_GET['id']);
			$sql = mysqli_query($conn, "UPDATE eb_book SET book_status = 'rejected', book_publish = 0 WHERE book_id = '$bookid'");
			if ($sql) {
				echo "<script>window.location='../admin/book.php'</script>";
			} else {
				echo "error acceptbook function";
			}
		}

		public function acceptbook($conn){
			$bookid = mysqli_escape_string($conn, $_GET['id']);
			$sql = mysqli_query($conn, "UPDATE eb_book SET book_status = 'accept', book_publish = 1 WHERE book_id = '$bookid'");
			if ($sql) {
				echo "<script>window.location='../admin/book.php'</script>";
			} else {
				echo "error acceptbook function";
			}
		}

		public function updatecomplete($conn){
			$recordid = mysqli_escape_string($conn, $_GET['id']);
			$sql = mysqli_query($conn, "UPDATE eb_record SET record_status = 'completed' WHERE record_id = '$recordid'");
			if ($sql) {
				echo "<script>window.location='../admin/'</script>";
			}
		}

		public function getAdminDetails($conn, $id){
			$sql = mysqli_query($conn, "SELECT * FROM eb_admin WHERE admin_id = '$id'");
			if (mysqli_num_rows($sql)>0) {
				if ($row = mysqli_fetch_array($sql)) {
					return $row;
				}
			} else {
				return 0;
			}
		}

		public function getdataforemail($conn,$idcheckout){
			$sql = mysqli_query($conn, "SELECT * FROM eb_cart a LEFT JOIN eb_user b ON (a.user_id = b.user_id) WHERE a.cart_checkout = '$idcheckout'") or die (mysqli_error($conn));
			if (mysqli_num_rows($sql)>0) {
				if ($row = mysqli_fetch_array($sql)) {
					return $row;
				}
			} else {
				return false;
			}
		}

		public function deletebook($conn){
			$bookid = -1;
			if (isset($_GET['id'])) {
				$bookid = mysqli_escape_string($conn, $_GET['id']);
			}
			$sql = mysqli_query($conn, "DELETE FROM eb_book WHERE book_id = '$bookid'");
			if ($sql) {
				echo "<script>window.location='../admin/book.php'</script>";
			}
		}

		public function changepublish($conn){
			$bookid = -1;
			$valpublish = -1;
			if (isset($_GET['id'])) {
				$bookid = mysqli_escape_string($conn, $_GET['id']);
				$valpublish = mysqli_escape_string($conn, $_GET['val']);
			}
			$sql = mysqli_query($conn, "UPDATE eb_book SET book_publish = '$valpublish' WHERE book_id = '$bookid'") or die (mysqli_error($conn));
			if ($sql) {
				echo "<script>window.location='../admin/book.php'</script>";
			}

		}

		public function getlistbook($conn){
			$sql = mysqli_query($conn, "SELECT * FROM eb_book a LEFT JOIN eb_user b ON (a.user_id = b.user_id) WHERE a.book_status NOT IN ('pending') AND a.book_quantity > 0") or die (mysqli_error($conn));
			if (mysqli_num_rows($sql)>0) {
				while ($row = mysqli_fetch_array($sql)) {
					$rows[] = $row;
				}
			} else {
				$rows = false;
			}
			return $rows;
		}

		public function completecheckout($conn){
			$sql = mysqli_query($conn, "SELECT * FROM eb_record a LEFT JOIN eb_user b ON (a.buyer_id = b.user_id) WHERE a.record_status IN ('completed')");
			if (mysqli_num_rows($sql)>0) {
				while ($row = mysqli_fetch_array($sql)) {
					$rows[] = $row;
				}
			} else {
				$rows = false;
			}
			return $rows;
		}

		public function pendingcheckout($conn){
			$sql = mysqli_query($conn, "SELECT * FROM eb_record a LEFT JOIN eb_user b ON (a.buyer_id = b.user_id) WHERE a.record_status IN ('pending')");
			if (mysqli_num_rows($sql)>0) {
				while ($row = mysqli_fetch_array($sql)) {
					$rows[] = $row;
				}
			} else {
				$rows = false;
			}
			return $rows;
		}

		public function getCheckout($conn, $id){
			$sql = mysqli_query($conn, "SELECT * FROM eb_record WHERE buyer_id = '$id'");
			if (mysqli_num_rows($sql)>0) {
				while ($row = mysqli_fetch_array($sql)) {
					$rows[] = $row;
				}
			} else {
				$rows = false;
			}
			return $rows;
		}

		public function getCheckoutByCode($conn, $code){
			$sql = mysqli_query($conn, "SELECT * FROM eb_record a LEFT JOIN eb_cart b ON (a.cart_checkout = b.cart_checkout) LEFT JOIN eb_book c ON (b.book_id = c.book_id) WHERE a.cart_checkout = '$code'") or die (mysqli_error($conn));
			if (mysqli_num_rows($sql)>0) {
				while ($row = mysqli_fetch_array($sql)) {
					$rows[] = $row;
				}
			} else {
				$rows = false;
			}
			return $rows;
		}

		public function checkout($conn){

			$userid = mysqli_escape_string($conn, $_POST['userid']);
			$totalprice = mysqli_escape_string($conn, $_POST['totalprice']);
			$pin = rand(0,99) . "EB" . rand(0,9999) . "$userid";

			$cartlist = $this->getCart($conn, $userid);
			if ($cartlist > 0) {
				foreach ($cartlist as $cartdata) {
					$cartid = $cartdata['cart_id'];
					$bookid = $cartdata['book_id'];
					$quantity = $cartdata['cart_quantity'];
					$sqlupdate = mysqli_query($conn, "UPDATE eb_cart SET cart_checkout = '$pin' , cart_status = 2 WHERE cart_id = '$cartid'");
					$sqltolakquantity = mysqli_query($conn, "UPDATE eb_book SET book_quantity = book_quantity - '$quantity' WHERE book_id = '$bookid'");
				}


				//insert record;
				$sqlinsert = mysqli_query($conn, "INSERT INTO eb_record (cart_checkout, buyer_id, record_price, record_status, record_info, record_datecreated) VALUES ('$pin', '$userid', '$totalprice', 'pending', '' , NOW())");
				if ($sqlinsert) {
					$pinencode = base64_encode($pin);

					//echo "<script>window.alert('Successful. Please wait for admin response.')</script>";
					echo "<script>window.location='../tcpdf/process/generator.php?id=". $pinencode ."'</script>";
				} else {
					echo "error record insert";
				}
			} else {
				echo "tiada";
			}
		}

		public function updateProfile($conn){
			$name = mysqli_escape_string($conn, $_POST['name']);
			$notel = mysqli_escape_string($conn, $_POST['notel']);
			$matric = mysqli_escape_string($conn, $_POST['matric']);
			$email = mysqli_escape_string($conn, $_POST['email']);
			$department = mysqli_escape_string($conn, $_POST['department']);
			$userid = mysqli_escape_string($conn, $_POST['userid']);

			$sql = mysqli_query($conn, "UPDATE eb_user SET user_fullname = '$name', user_notel = '$notel', user_matric = '$matric', user_department = '$department' WHERE user_id = '$userid'");
			if ($sql) {
				echo "<script>window.alert('Your details Successful updated.')</script>";
				echo "<script>window.location='../user/profile.php'</script>";
			} else {
				echo "error update profile";
			}
		}

		public function getUserDetails($conn, $id){
			$sql = mysqli_query($conn, "SELECT * FROM eb_user WHERE user_id = '$id'");
			if (mysqli_num_rows($sql)>0) {
				if ($row = mysqli_fetch_array($sql)) {
					return $row;
				}
			} else {
				return 0;
			}
		}

		public function getSumCart($conn, $id){
			$sql = mysqli_query($conn, "SELECT COUNT(cart_id) as totalcart FROM eb_cart WHERE user_id = '$id' AND cart_status IN (1)");
			if (mysqli_num_rows($sql)>0) {
				if ($row = mysqli_fetch_array($sql)) {
					return $row;
				}
			} else {
				return 0;
			}

		}

		public function addQuantity($conn){
			$cartid = -1;
			$val = -1;
			if (isset($_GET['id']) && isset($_GET['val'])) {
				$cartid = mysqli_escape_string($conn, $_GET['id']);
				$val = mysqli_escape_string($conn, $_GET['val']);
			}

			$sql = mysqli_query($conn, "UPDATE eb_cart SET cart_quantity = '$val' WHERE cart_id = '$cartid'");
			if ($sql) {
				echo "<script>window.location='../user/cart.php'</script>";
			}
		}

		public function deleteCart($conn){
			$cartid = -1;
			if (isset($_GET['id'])) {
				$cartid = mysqli_escape_string($conn, $_GET['id']);
			}

			$sql = mysqli_query($conn, "DELETE FROM eb_cart WHERE cart_id = '$cartid'");
			if ($sql) {
				echo "<script>window.location='../user/cart.php'</script>";
			}
		}

		public function getCart($conn, $id){
			$sql = mysqli_query($conn, "SELECT * FROM eb_cart a LEFT JOIN eb_book b ON (a.book_id = b.book_id) WHERE a.user_id = '$id' AND a.cart_status IN (1)") or die (mysqli_query($conn));
			if (mysqli_num_rows($sql)>0) {
				while ($row = mysqli_fetch_array($sql)) {
					$rows[] = $row;
				}
			} else {
				$rows = false;
			}
			return $rows;
		}

		public function reqsellbook($conn){
			$title = mysqli_escape_string($conn, $_POST['title']);
			$description = mysqli_escape_string($conn, $_POST['description']);
			$department = mysqli_escape_string($conn, $_POST['department']);
			$quantity = mysqli_escape_string($conn, $_POST['quantity']);
			$price = mysqli_escape_string($conn, $_POST['price']);
			$userid = mysqli_escape_string($conn, $_POST['userid']);
			$published = mysqli_escape_string($conn, $_POST['published']);
			$status = mysqli_escape_string($conn, $_POST['status']);
			

			$sql = mysqli_query($conn, "INSERT INTO eb_book (book_name, book_status, book_price, book_desc, book_department, book_quantity, book_publish, book_level, user_id, admin_info) VALUES ('$title', 'pending', '$price', '$description', '$department', '$quantity', '0', '0', '$userid', '')");
			if ($sql) {
				echo "<script>window.location='../user/'</script>";
			} else {
				echo "ERROR insert reqsellbook";
			}
		}

		public function sellbook($conn, $id){
			$rows = array();
			$sql = mysqli_query($conn, "SELECT * FROM eb_book WHERE user_id = '$id'") or die (mysqli_error($conn));
			if (mysqli_num_rows($sql)>0) {
				while ($row = mysqli_fetch_array($sql)) {
					$rows[] = $row;
				}
			} else {
				$rows = false;
			}
			return $rows;
		}

		public function logout(){
			
			session_destroy();
			echo "<script>window.location='../'</script>";
		}

		public function open(){			
			// define(localhost, localhost);
			// define(db_nama, ebundle);
			// define(db_username, root);
			// define(db_password, '');

			define(localhost, localhost);
			define(db_nama, 'ebundleb_book');
			define(db_username, 'ebundleb_book');
			define(db_password, 'ebundleb_book');

			

			$conn = mysqli_connect(localhost,db_username,db_password,db_nama);

			if (!$conn) {
				echo "Connection Failed: " . mysqli_connect_error();
			} else {
				return $conn;
			}
		}

		public function addCart($conn){
			$bookid = mysqli_escape_string($conn, $_GET['id']);
			$userid = $_SESSION['user_id'];
			$checkcart = mysqli_query($conn, "SELECT * FROM eb_cart WHERE user_id = '$userid' AND book_id = '$bookid' AND cart_status IN (1)") or die (mysqli_error($conn));
			if (mysqli_num_rows($checkcart)>0) {
				echo "<script>window.alert('If you want to add same book, please add the quantity only.')</script>";
				echo "<script>window.location='../user/cart.php'</script>";
			} else {
				$booksql = mysqli_query($conn,"SELECT * FROM eb_book WHERE book_id = '$bookid'");
				if ($bookid) {
					$rowbook = mysqli_fetch_array($booksql);
					$bookprice = $rowbook['book_price'];
					$sql = mysqli_query($conn, "INSERT INTO eb_cart (book_id, user_id, cart_quantity, cart_price, cart_checkout, cart_status, cart_datecreated) VALUES ('$bookid', '$userid', '1', '$bookprice', '', '1', NOW())");
					if ($sql) {
						echo "<script>window.location='../user/'</script>";
					} else {
						echo "error add cart";
					}
				}
			}
			
		}

		public function showbookid($conn, $id){
			$sql = mysqli_query($conn, "SELECT * FROM eb_book WHERE book_id = '$id'");
			if ($row = mysqli_fetch_array($sql)) {
				return $row;
			} else {
				return false;
			}
		}

		public function showallbook($conn){
			$rows = array();
			$sql = mysqli_query($conn, "SELECT * FROM eb_book WHERE book_status IN ('accept') AND book_quantity > 0 AND book_publish IN (1) ORDER BY RAND()");
			if (mysqli_num_rows($sql)>0) {
				while ($row = mysqli_fetch_array($sql)) {
					$rows[] = $row;
				}
			} else {
				$rows = false;
			}
			return $rows;
		}

		public function listbook($conn){
			$rows = array();
			$sql = mysqli_query($conn, "SELECT * FROM eb_book WHERE book_status IN ('accept') AND book_quantity > 0 AND book_publish IN (1) ORDER BY RAND() LIMIT 9;");
			if (mysqli_num_rows($sql)>0) {
				while ($row = mysqli_fetch_array($sql)) {
					$rows[] = $row;
				}
			} else {
				$rows = false;
			}
			return $rows;
		}

		//start authcontrol
		public function login($conn){
			$email = mysqli_escape_string($conn, $_POST['email']);
			$pass =  mysqli_escape_string($conn, $_POST['password']);
			$encrypted = md5($pass);

			$rslogin = mysqli_query($conn, "SELECT user_id,user_email,user_pass FROM eb_user WHERE user_email = '$email' AND user_pass = '$encrypted'") or die (mysqli_error($conn));
			if (mysqli_num_rows($rslogin) > 0) {
				$rsrow = mysqli_fetch_array($rslogin);
				//echo $rsrow['user_id'];
				$_SESSION['user_id'] = $rsrow['user_id'];
				
				echo "<script>window.location = '../user/'</script>";
			} else {
				$admin = mysqli_query($conn, "SELECT admin_id, admin_email, admin_pass FROM eb_admin WHERE admin_email = '$email' AND admin_pass = '$encrypted'") or die (mysqli_error($conn));
				if (mysqli_num_rows($admin) > 0) {
					$rsrow = mysqli_fetch_array($admin);
					$_SESSION['admin_id'] = $rsrow['admin_id'];
					echo "<script>window.location = '../admin/'</script>";
				} else {
					echo "<script>window.alert('BATAL: email atau kata laluan anda salah. Sila cuba lagi')</script>";
					echo "<script>window.location = '../'</script>";
				}
			}
		}

		public function register($conn){
			$name = mysqli_escape_string($conn, $_POST['name']);
			$notel = mysqli_escape_string($conn, $_POST['notel']);
			$matric = mysqli_escape_string($conn, $_POST['matric']);
			$email = mysqli_escape_string($conn, $_POST['email']);
			$department = mysqli_escape_string($conn, $_POST['department']);
			$password = mysqli_escape_string($conn, $_POST['password']);
			$confirmpass = mysqli_escape_string($conn, $_POST['confirmpass']);

			if ($password == $confirmpass) {
				$password = md5($password);
				$rscheckemail = mysqli_query($conn,"SELECT * FROM eb_user WHERE user_email = '$email'");
				if (mysqli_num_rows($rscheckemail) > 0) {
					echo "<script>window.alert('Unsuccessful: Email already used, please use another email.')</script>";
					echo "<script>window.location = '../index.php'</script>";
				} else {
					$sql = mysqli_query($conn, "INSERT INTO eb_user (user_fullname, user_email, user_pass, user_department, user_notel, user_matric, user_datecreated) VALUES ('$name', '$email', '$password', '$department', '$notel', '$matric', NOW())");
					if ($sql) {
						echo "<script>window.alert('Successful: Please Sign in first.')</script>";
						echo "<script>window.location = '../index.php'</script>";
					}
				}
			} else {
				echo "<script>window.alert('Your password not match, please try again.')</script>";
				echo "<script>window.location = '../index.php'</script>";
			}
		}
	}
?>