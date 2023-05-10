<?php 
    // Ob başlatılıyor
    ob_start();
    
    // Oturum kontrolü ve oturum yenileme
    if(!session_start()){
      session_start();
    }
    session_regenerate_id(true);
    
    // Veritabanı ve fonksiyonlar dosyalarını dahil etme
    include("../config/database.php");
    include("../config/functions.php");
?>

<?php 
    // Kullanıcı oturumu kontrolü
    if(!isset($_SESSION['user'])) {
      // Oturum açmamış kullanıcıyı giriş sayfasına yönlendirme
      header('location: index.php');
      exit;
    } 
?>

<?php 
    // Site ayarlarını veritabanından alarak değişkenlere atama
    $statement = $conn->prepare("SELECT * FROM site_settings");
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    extract($result); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Ready to use PHP Admin Panel for projects">
	<meta name="author" content="amiriqbalmcs">
	<meta name="keywords" content="bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, php">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="../assets/img/icons/tanzahost.png" />
	
	<title>
		<?php 
			// Sayfa başlığını oluşturma
			if(isset($page)){
				echo clean($page) . " | Admin | Dashboard";
			}else{
				echo "Admin | Dashboard";
			}
		?>
	</title>
	
	<!-- CSS dosyalarını dahil etme -->
	<link href="../assets/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link href="../assets/plugins/toastr/toastr.min.css" rel="stylesheet">
	<link href="../assets/css/custom.css" rel="stylesheet">
</head>
<body>
	<div class="wrapper">
		<!-- Sayfa içeriği burada yer alır -->
