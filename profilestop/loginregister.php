<?php
    // Veritabanı bağlantısı ve diğer gerekliliklerin sağlandığından emin olun
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Form gönderildiğinde
        
        // Kullanıcının girdiği verileri al
        $username = $_POST['user_full_name'];
        $email = $_POST['email'];
        $password = $_POST['user_password'];
        
        // İşlem yapılacak veritabanı tablosuna göre değiştirin
        $tableName = 'profilestop';
        
        // Kullanıcının profil resmini yükleyin (gerekirse)
        if(isset($_FILES['user_photo']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $avatar = $_FILES['user_photo']['name'];
            $avatarTmp = $_FILES['user_photo']['tmp_name'];
            
            // Profil resmini belirli bir klasöre kaydedin
            move_uploaded_file($avatarTmp, 'path/to/upload/directory/' . $avatar);
        } else {
            // Varsayılan profil resmi (isteğe bağlı)
            $avatar = 'default.png';
        }
        
        // Veritabanına kullanıcıyı ekle
        $statement = $conn->prepare("INSERT INTO $tableName (username, email, password, avatar) VALUES (?, ?, ?, ?)");
        $statement->execute([$username, $email, $password, $avatar]);
        
        // Başarılı kayıt mesajı (isteğe bağlı)
        echo "Kayıt başarıyla tamamlandı.";
        
        // İstenirse, kullanıcıyı otomatik olarak yönlendirin
        // header('Location: users.php');
        // exit;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Register</title>
    <link rel="stylesheet" href="assets/css/profilelog.css">
</head>

<body>
    <header>
        <h2 class="baslik">Profiles Top</h2>
        <nav class="navigation">
            <a href="#">Ana Sayfa</a>
            <a href="#">Sayfa Hakkında</a>
            <a href="#">Profiller</a>
            <?php if(isset($_SESSION['userid'])) { ?>
                <button id="button_signout" class="header-btn">Çıkış Yap</button>
            <?php } else { ?>
                <button class="giris-popup">Giriş Yap</button>
            <?php } ?>
        </nav>
    </header>
    <div class="wrapper">
        <div class="kapama">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="kutu giris">
            <h2>Giriş Yap</h2>
            <div class="res-login"></div>
            <form id="form_signin" name="form_signin" method="POST">
                <div class="elemanlar">
                    <span class="ikon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input type="email" name="email" required>
                    <label>E-Mail</label>
                </div>
                <div class="elemanlar">
                    <span class="ikon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input type="password" name="password" required>
                    <label>Şifre</label>
                </div>
                <div class="beniHatirla">
                    <label><input type="checkbox"> Beni Hatırla</label>
                    <a href="#">Şifrenimi Unuttun?</a>
                </div>
                <button type="button" id="button_signin" name="button_signin" class="btn">Giriş Yap</button>
                <div class="giris-kayit">
                    <p>Hesabın Yokmu?<a href="#" class="kayit-link">Kayıt Ol</a></p>
                </div>
            </form>
        </div>
        <div class="kutu kayit">
            <h2>Kayıt Ol</h2>
            <div class="res-register"></div>
            <form id="form_signup" method="POST">
                <div class="elemanlar">
                    <span class="ikon">
                        <ion-icon name="document"></ion-icon>
                    </span>
                    <input type="file" id="avatar" name="avatar" class="chosen">
                </div>
                <div class="elemanlar">
                    <span class="ikon">
                        <ion-icon name="person"></ion-icon>
                    </span>
                    <input type="text" name="username" required>
                    <label>Kullanıcı Adınız</label>
                </div>
                <div class="elemanlar">
                    <span class="ikon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input type="email" name="email" required>
                    <label>E-Mail</label>
                </div>
                <div class="elemanlar">
                    <span class="ikon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input type="password" name="password" required>
                    <label>Şifre</label>
                </div>
                <div class="beniHatirla">
                    <label><input type="checkbox">Metni Okudum Ve Anladım</label>
                </div>
                <button type="button" id="button_signup" name="button_signup" class="btn">Kayıt Ol</button>
                <div class="giris-kayit">
                    <p>Hesabınız Varmı? <a href="#" class="giris-link"> Giriş Yap</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
   </html>