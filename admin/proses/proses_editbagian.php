<?php
	session_start();
	include '../../koneksi/koneksi.php';
    $id				            = mysqli_real_escape_string($db,$_POST['id_bagian']);
    $nama_bagian	            = mysqli_real_escape_string($db,$_POST['nama_bagian']);
	$username_admin_bagian		= mysqli_real_escape_string($db,$_POST['username_admin_bagian']);
	$password_bagian 	        = mysqli_real_escape_string($db,sha1($_POST['password_bagian']));
	
	$sql  		= "SELECT * FROM tb_bagian where id_bagian='".$id."'";                        
	$query  	= mysqli_query($db, $sql);
	$data 		= mysqli_fetch_array($query);
	
	$sql = "UPDATE tb_bagian set 
						nama_bagian		            = '$nama_bagian',
						username_admin_bagian		= '$username_admin_bagian',
						password_bagian 			= '$password_bagian'
				where id_bagian = $id";
				
		$execute = mysqli_query($db, $sql);			
						
		echo "<Center><h2><br>Data Bagian telah terubah</h2></center>
		<meta http-equiv='refresh' content='2;url=../detail-bagian.php?id_bagian=".$id."'>";
	?>
	