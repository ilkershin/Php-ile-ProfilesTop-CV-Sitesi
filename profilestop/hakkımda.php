<?php 
    ob_start(); // Çıktının önbelleğe alınmasını sağlar.

    if(!session_start()){ // Oturum başlatılırken hata oluşmaması için oturum başlatma kontrolü yapılır.
      session_start(); // Oturumu başlatır.
    }

    include("template/front/header.php"); // Başlık şablonunu dahil eder.
    include("template/front/navbar.php"); // Gezinme çubuğu şablonunu dahil eder.
    include("config/database.php"); // Veritabanı yapılandırma dosyasını dahil eder.
?>

<?php
    $i=1;
    $statement = $conn->prepare('SELECT * FROM about ORDER BY about_id DESC');
    $statement->execute();
    $about = $statement->fetchAll(PDO::FETCH_ASSOC);
    $sNo  = 1;
    foreach ($about as $about); // "about" tablosundan verileri alır ve her birini döngü ile işler.
?>

<section class="about">

    <h1 class="heading"> Benim <span>Hakkımda</span> </h1>

    <div class="row">

        <div class="info-container">

            <h1>Profotolyom</h1>

            <div class="box-container">

                <div class="box">
                    <h3> <span>İsim : </span> <?php echo $about['about_name']; ?> </h3>
                    <h3> <span>Yaş : </span> <?php echo $about['about_age']; ?> </h3>
                    <h3> <span>email : </span> <?php echo $about['about_email']; ?> </h3>
                    <h3> <span>Adresim : </span><?php echo $about['about_address']; ?> </h3>
                </div>

                <div class="box">
                    <h3> <span>Çalışmam : </span> <?php echo $about['about_free']; ?> </h3>
                    <h3> <span>Becerilerim : </span> <?php echo $about['about_skill']; ?> </h3>
                    <h3> <span>Deneyimim : </span> <?php echo $about['about_exp']; ?> </h3>
                    <h3> <span>Dil Bilgim : </span> <?php echo $about['about_lang']; ?></h3>
                </div>
            </div>

            
        </div>
        <div class="count-container">
            <div class="box">
                <h3><?php echo $about['about_exp_yrs'];?>+</h3>
                <p>Yıllık Deneyimim</p>
            </div>

            <div class="box">
                <h3><?php echo $about['about_happy']; ?>+</h3>
                <p>Güzel Değerlendirilenler</p>
            </div>

            <div class="box">
                <h3><?php echo $about['about_project']; ?>+</h3>
                <p>Tamamladığım Proje Sayısı</p>
            </div>

            <div class="box">
                <h3><?php echo $about['about_awards']; ?>+</h3>
                <p>Kazandığım Ödüller</p>
            </div>
        </div>
    </div>
</section>

<section class="skills">
    <h1 class="heading"> <span></span> Deneyimlerim </h1>
    <div class="box-container">
        <div class="box">
            <img src="storage/skills/icon-1.png">
            <h3>html</h3>
        </div>
        <div class="box">
            <img src="storage/skills/icon-2.png">
            <h3>css</h3>
        </div>
        <div class="box">
            <img src="storage/skills/icon-3.png">
            <h3>javascript</h3>
        </div>
        <div class="box">
            <img src="storage/skills/icon-4.png">
            <h3>sass</h3>
        </div>
        <div class="box">
            <img src="storage/skills/icon-5.png">
            <h3>jquery</h3>
        </div>
        <div class="box">
            <img src="storage/skills/icon-6.png">
            <h3>react.js</h3>
        </div>
    </div>

</section>

<section class="education">
    <h1 class="heading"> <span> </span> Eğitimim </h1>
    <div class="box-container">
        <?php
        $a=1;
        // Veritabanından tüm eğitim kayıtlarını seçen SQL sorgusu hazırlanır
        $stmt = $conn->prepare("SELECT * FROM education");
        $stmt->execute();
        $education = $stmt->fetchAll();
        
        // Her bir eğitim kaydı için döngü oluşturulur
        foreach($education as $row) {  	    
        ?>
        <div class="box">
            <i class="fas fa-graduation-cap"></i>
            <span><?php echo $row['education_year']; ?></span>
            <h3><?php echo $row['education_title']; ?></h3>
            <p><?php echo $row['education_desc']; ?></p>
        </div>
        <?php } ?>
    </div>
</section>

<?php include("template/front/navbar.php"); ?>