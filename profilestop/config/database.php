<?php
	
	$db_hostname = 'localhost'; // Veritabanı sunucusunun adı veya IP adresi
	
	$db_name = 'profilestop'; // Kullanılacak veritabanının adı
	
	$db_username = 'root'; // Veritabanı kullanıcı adı
	
	$db_password = ''; // Veritabanı parolası
	
	try {
		$conn = new PDO("mysql:host=$db_hostname;dbname=$db_name",$db_username,$db_password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
	    echo $e->getMessage();
	}
?>