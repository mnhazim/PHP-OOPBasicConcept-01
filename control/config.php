<?php
	class config{
		public function open(){
			define(localhost, localhost);
			define(db_nama, ebundle);
			define(db_username, root);
			define(db_password, '');

			$conn = mysqli_connect(localhost,db_username,db_password,db_nama);

			if (!$conn) {
				echo "Connection Failed: " . mysqli_connect_error();
			} else {
				return $conn;
			}
		}
	}
?>

