<?php 
    include("template/front/header.php"); // Ön yüzde kullanılan başlık şablonunu dahil ediyoruz.
    include("template/front/navbar.php"); // Ön yüzde kullanılan gezinme çubuğu şablonunu dahil ediyoruz.
    include("config/database.php"); // Veritabanı bağlantı ayarlarını içeren dosyayı dahil ediyoruz.
?>
<?php
    $i = 1;
    $statement = $conn->prepare('SELECT * FROM contact ORDER BY contact_id DESC'); // contact tablosundan en son eklenen veriyi seçiyoruz ve sıralıyoruz.
    $statement->execute();
    $contact = $statement->fetchAll(PDO::FETCH_ASSOC); // Veritabanından alınan sonuçları bir dizi olarak elde ediyoruz.
    $sNo  = 1;
    foreach ($contact as $contact); // contact dizisi üzerinde döngü oluşturuyoruz.
?>
<section class="contact">
    <h1 class="heading"> İLETİŞİM <span></span> </h1>
    <div class="row">
        <div class="info-container">
            <h1>Sosyal Medya</h1>
            <p><?php echo $contact['contact_info']; ?></p> <!-- contact dizisinden alınan iletişim bilgilerini görüntülüyoruz -->
            <div class="share">
                <a target="_blank" href="https://facebook.com/<?php echo $contact['contact_fb']; ?>"
                    class="fab fa-facebook-f"></a> <!-- contact dizisinden alınan Facebook bağlantısını görüntülüyoruz -->
                <a target="_blank" href="https://twitter.com/<?php echo $contact['contact_tw']; ?>"
                    class="fab fa-twitter"></a> <!-- contact dizisinden alınan Twitter bağlantısını görüntülüyoruz -->
                <a target="_blank" href="https://instagram.com/<?php echo $contact['contact_insta']; ?>"
                    class="fab fa-instagram"></a> <!-- contact dizisinden alınan Instagram bağlantısını görüntülüyoruz -->
                <a target="_blank" href="https://wa.me/<?php echo $contact['contact_wts']; ?>"
                    class="fab fa-whatsapp"></a> <!-- contact dizisinden alınan WhatsApp bağlantısını görüntülüyoruz -->
            </div>
        </div>
        <div class="row">
            <div class="info-container">
                <div class="box-container">
                    <h1> İletişime Geç </h1>
                    <div class="box">
                        <i class="fas fa-map"></i>
                        <div class="info">
                            <h3>Adresim :</h3>
                            <p><?php echo $contact['contact_address']; ?></p> <!-- contact dizisinden alınan adresi görüntülüyoruz -->
                        </div>
                    </div>
                    <div class="box">
                        <i class="fas fa-envelope"></i>
                        <div class="info">
                            <h3>Email :</h3>
                            <p><?php echo $contact['contact_email']; ?></p><!-- contact dizisinden alınan mail adresini görüntülüyoruz -->
                        </div>
                    </div>
                    <div class="box">
                        <i class="fas fa-phone"></i>
                        <div class="info">
                            <h3>Numara :</h3>
                            <p><?php echo $contact['contact_phone']; ?></p><!-- contact dizisinden alınan telefon adresini görüntülüyoruz -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<?php include("template/front/footer.php"); ?> <!-- Ön yüzde kullanılan footer şablonunu dahil ediyoruz. -->