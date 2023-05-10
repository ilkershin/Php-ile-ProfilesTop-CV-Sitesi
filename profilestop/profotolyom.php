<?php $page = "Öz Geçmiş"; ?> <!-- Sayfa değişkenine "Portifolio" değerini atıyoruz. -->

<?php include_once('template/front/header.php'); ?> <!-- Ön yüzde kullanılan başlık şablonunu dahil ediyoruz. -->
<?php include_once('config/database.php'); ?> <!-- Veritabanı bağlantı ayarlarını içeren dosyayı dahil ediyoruz. -->
<?php include_once('template/front/navbar.php'); ?> <!-- Ön yüzde kullanılan gezinme çubuğu şablonunu dahil ediyoruz. -->

<section class="portfolio">
    <h1 class="heading"> <span>Yaptığım</span> İşler </h1> <!-- Başlık alanını görüntülüyoruz -->

    <div class="box-container">
        <?php
        $a = 1;
        $stmt = $conn->prepare("SELECT * FROM portifolio"); // portifolio tablosundan tüm verileri seçiyoruz
        $stmt->execute();
        $portifolio = $stmt->fetchAll(); // Veritabanından alınan sonuçları bir dizi olarak elde ediyoruz.
        foreach ($portifolio as $row) { // portifolio dizisi üzerinde döngü oluşturuyoruz
        ?>
        <div class="box">
            <img src="storage/portifolio/<?php echo $row['portifolio_photo']; ?>" alt=""> <!-- portifolio dizisinden alınan resim yolunu görüntülüyoruz -->
            <div class="content">
                <h3><?php echo $row['portifolio_title']; ?></h3> <!-- portifolio dizisinden alınan başlığı görüntülüyoruz -->
                <p><?php echo $row['portifolio_desc']; ?></p> <!-- portifolio dizisinden alınan açıklamayı görüntülüyoruz -->
                <a href="https://<?php echo $row['portifolio_url']; ?>" class="btn"> Proje Linki <i class="fas fa-link"></i> <!-- profotolio dizisinden alınan linke yönlendirme -->
               
                </a>
            </div>
        </div>
        <?php } ?>
    </div>
</section>

<?php include("template/front/navbar.php"); ?> <!-- Ön yüzde kullanılan gezinme çubuğu şablonunu dahil ediyoruz. -->