<?php
	session_start();
	include '../../koneksi/koneksi.php';
	
	$nama_bagian	            = mysqli_real_escape_string($db,$_POST['nama_bagian']);
	$username_admin_bagian		= mysqli_real_escape_string($db,$_POST['username_admin_bagian']);
	$password_bagian 	        = mysqli_real_escape_string($db,sha1($_POST['password_bagian']));
	
	if (!($nama_bagian=='') and !($username_admin_bagian=='') and !($password_bagian =='')){		
		$sql = "INSERT INTO tb_bagian(nama_bagian, username_admin_bagian, password_bagian)
				values ('$nama_bagian', '$username_admin_bagian', '$password_bagian')";
		$execute = mysqli_query($db, $sql);
		
		echo "<Center><h2><br>Terima Kasih<br>Bagian Telah Didaftarkan ke Sistem</h2></center>
			<meta http-equiv='refresh' content='2;url=../databagian.php'>";
	}
	else{
		echo "<Center><h2>Silahkan isi semua kolom lalu tekan submit<br>Terima Kasih</h2></center>
			<meta http-equiv='refresh' content='2;url=../inputbagian.php'>";
	}
	
?>
	