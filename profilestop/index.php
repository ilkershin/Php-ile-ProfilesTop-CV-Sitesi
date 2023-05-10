<?php 
    include("template/front/header.php"); // Ön yüzde kullanılan başlık şablonunu dahil ediyoruz.
    include("template/front/navbar.php"); // Ön yüzde kullanılan gezinme çubuğu şablonunu dahil ediyoruz.
    include("config/database.php"); // Veritabanı bağlantı ayarlarını içeren dosyayı dahil ediyoruz.
?>

<?php
    $i = 1;
    $statement = $conn->prepare('SELECT * FROM about ORDER BY about_id DESC'); // about tablosundan en son eklenen veriyi seçiyoruz ve sıralıyoruz.
    $statement->execute();
    $about = $statement->fetchAll(PDO::FETCH_ASSOC); // Veritabanından alınan sonuçları bir dizi olarak elde ediyoruz.
    $sNo  = 1;
    foreach ($about as $about); // about dizisi üzerinde döngü oluşturuyoruz.
?>

<section class="home">
    <div class="image">
        <img src="storage/home/<?php echo $about['about_photo']; ?>" alt=""> <!-- about dizisinden alınan resim yolunu görüntülüyoruz -->
    </div>
    <div class="content">
        <h3> Merhaba Ben <?php echo $about['about_name']; ?> </h3> <!-- about dizisinden alınan ismi görüntülüyoruz -->
        <span> <?php echo $about['about_title']; ?></span> <!-- about dizisinden alınan başlığı görüntülüyoruz -->
        <p><?php echo $about['about_desc']; ?></p> <!-- about dizisinden alınan açıklamayı görüntülüyoruz -->
        <a href="tel:<?php echo $about['about_hire']; ?>" class="btn"> Numaram <i class="fas fa-phone"></i> </a> <!-- about dizisinden alınan numarayı bir linke yerleştirerek görüntülüyoruz -->
    </div>
</section>

<?php include("template/front/navbar.php"); ?> <!-- Ön yüzde kullanılan gezinme çubuğu şablonunu dahil ediyoruz. -->