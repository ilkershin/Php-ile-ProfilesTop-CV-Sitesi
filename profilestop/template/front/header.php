<?php include_once('config/database.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    // Veritabanı bağlantısını içe aktarıyoruz
    include_once('config/database.php');

    // Veritabanından site ayarlarını seçiyoruz
    $stmt = $conn->prepare("SELECT * FROM site_settings");
    $stmt->execute();
    $site_settings = $stmt->fetchAll();

    // Site ayarlarındaki her bir satır için döngü oluşturuyoruz
    foreach($site_settings as $row) {  	    
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Site logomuza referans veriyoruz -->
    <link rel="shortcut icon" href="storage/logo/<?php echo $row['site_logo']; ?>" />

    <!-- Site başlığını ve açıklamasını gösteriyoruz -->
    <title><?php echo $row['site_name']; ?> | <?php echo $row['site_description']; ?></title>
    
    <?php } ?>
    
    <!-- Font Awesome kütüphanesini dahil ediyoruz -->
    <link rel="stylesheet" href="assets/fonts/css/all.min.css">
    
    <!-- Özel stil dosyamızı dahil ediyoruz -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
