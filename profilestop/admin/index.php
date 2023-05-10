<?php $page = "Giriş Yap"; ?> <!-- Sayfa başlığını belirlemek için değişken oluşturuluyor. -->

<?php
  if(!session_start()){ // Oturum başlatılıyor.
      session_start();
  }
  session_regenerate_id(true); // Oturum kimliği yeniden oluşturuluyor.
  include("../config/database.php"); // Veritabanı yapılandırma dosyası dahil ediliyor.
  include("../config/functions.php"); // Fonksiyonlar dosyası dahil ediliyor.

  if(isset($_SESSION['user'])) { // Eğer kullanıcı oturumu zaten varsa, kullanıcıyı yönlendir ve çık.
    header('location: dashboard.php');
    exit;
  } 
?>

<?php
if ( isset($_REQUEST['email']) && isset($_REQUEST['token']) ) // Eğer "email" ve "token" değerleri gönderilmişse
{
    $valid = 1;
    
    $statement = $conn->prepare("SELECT * FROM users WHERE email=? AND reg_token=?"); // Kullanıcıyı "email" ve "reg_token" değerlerine göre veritabanından sorgula
    $statement->execute(array($_REQUEST['email'],$_REQUEST['token'])); // Değerleri sorguya ekle ve sorguyu çalıştır
    if($statement->rowCount() != '1'){ // Eğer sorgunun sonucunda 1 satır dönmezse
        $valid = 0;
        $error = "Detaylar Eşleşmiyor!"; // Hata mesajı oluştur
    } 

    if($valid == 1) // Eğer geçerli bir durum varsa
    {
        $statement = $conn->prepare("UPDATE users SET reg_token=?, token_time=?, user_status = ? WHERE email=?"); // Kullanıcının "reg_token", "token_time" ve "user_status" değerlerini güncelle
        $run = $statement->execute(array('','','1',$_GET['email'])); // Değerleri sorguya ekle ve sorguyu çalıştır
        if($run){
          $success = "Email adresin onaylandı! şimdi giriş yapabilirsiniz"; // Başarılı mesajı oluştur
        }else{
          $error = "Bazı hatalar var!"; // Hata mesajı oluştur
        }   
    }
}
?>

<?php 
      $statement = $conn->prepare("SELECT * FROM site_settings"); // Site ayarlarını veritabanından al
      $statement->execute(); // Sorguyu çalıştır
      $result = $statement->fetch(PDO::FETCH_ASSOC); // Sorgu sonucunu al ve bir diziye aktar
      extract($result); // Dizideki değerleri değişkenlere aktar
?>

<?php
    if(isset($_POST['login'])) { // Eğer "login" butonuna tıklanmışsa
        $valid = 1;

        if(empty($_POST['username'])) {
          $errors[] = 'Kullanıcı adı boş olamaz</br>'; // Kullanıcı adı boşsa hata mesajı oluştur
          $valid = 0;
        }
        if(empty($_POST['password'])) {
          $errors[] = 'Şifre boş olamaz'; // Şifre boşsa hata mesajı oluştur
          $valid = 0;
        }
        if($valid == 1){

          $username         = clean($_POST['username']); // Kullanıcı adını temizle
          $password         = clean($_POST['password']); // Şifreyi temizle
         
          $stmt = $conn->prepare("SELECT * FROM users WHERE BINARY user_name =? AND user_status=? LIMIT 1"); // Kullanıcı adı ve kullanıcı durumuna göre kullanıcıyı veritabanından sorgula
          $stmt->execute(array($username,1)); // Değerleri sorguya ekle ve sorguyu çalıştır
          $rows = $stmt->fetch(PDO::FETCH_ASSOC); // Sorgu sonucunu bir dizi olarak al
          if($stmt->rowCount() == '1'){ // Eğer sorgunun sonucunda 1 satır dönüyorsa
            if(password_verify($password, $rows["user_password"])){ // Girilen şifre, veritabanındaki şifre ile eşleşiyorsa

                $date = date('Y-m-d H:i:s');
                $stmt = $conn->prepare("UPDATE `users` SET `user_last_login`='$date' WHERE user_name =? LIMIT 1"); // Kullanıcının "user_last_login" değerini güncelle
                $stmt->execute(array($username)); // Değeri sorguya ekle ve sorguyu çalıştır
                unset($rows['user_password']); // Diziden şifreyi kaldır
                $_SESSION['success'] = "Hoş geldin! - Başarıyla giriş yaptınız"; // Başarılı mesajı oluştur
                $_SESSION['user'] = $rows; // Kullanıcı bilgilerini oturum değişkenine ekle
                header('location: dashboard.php'); // Kullanıcıyı yönlendir
                exit(0);

            }else{
              $errors[] = "<strong>Error!</strong> Geçersiz kullanıcı/şifre!"; // Hatalı kullanıcı/şifre mesajı oluştur
            }
          }else{
            $errors[] = "<strong>Error!</strong> Geçersiz kullanıcı/şifre!"; // Hatalı kullanıcı/şifre mesajı oluştur
          }  
      }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Ready to use PHP Admin Panel for projects">
  <meta name="author" content="amiriqbalmcs">
  <meta name="keywords" content="bootstrap, bootstrap 5, admin, dashboard, php">

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

  <title><?php if(isset($page)){echo clean($page) . " | Admin | Dashboard";}else{echo "Admin | Dashboard";} ?></title>

  <link href="../assets/css/app.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="../assets/plugins/toastr/toastr.min.css" rel="stylesheet">
</head>
<body>
  <main class="d-flex w-100">
    <div class="container d-flex flex-column">
      <div class="row vh-100">
        <div class="col-sm-10 col-md-8 col-lg-4 mx-auto d-table h-100">
          <div class="d-table-cell align-middle">
            <div class="text-center mt-4">
              <h1 class="h2">Hoşgeldiniz</h1>
              <p class="lead">
               Hesabınıza Giriş Yapın Ve Devam Edin!
              </p>
            </div>
            <div class="card">
              <div class="card-body">
                <?php if(isset($error)): ?>
                  <div class="alert alert-primary alert-dismissible" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                      <?php echo $error; ?>
                    </div>
                  </div>
                <?php endif; ?>
                    
                <?php if(isset($success)): ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      <div class="alert-message">
                          <?php echo $success; ?>
                       </div>
                    </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['success'])): ?>
                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                        <?php echo $_SESSION['success']; ?>
                     </div>
                  </div>
                <?php unset($_SESSION["success"]); ?>
                <?php endif; ?>
                <div class="m-sm-4">
                  <div class="text-center">
                    <img src="../storage/logo/<?php echo clean($site_logo); ?>" alt="Site Logo" class="img-fluid rounded-circle" width="132" height="132" />
                  </div>
                  <form action="" method="POST">
                    <div class="mb-3">
                      <label class="form-label">Kullanıcı Adı</label>
                      <input class="form-control form-control-lg" type="text" name="username" placeholder="Kullanıcı Adı Giriniz" value="<?php if(isset($username)){echo clean($username);} ?>"/>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Şifre</label>
                      <input class="form-control form-control-lg" type="password" name="password" placeholder="Şifre Giriniz" />
                    </div>
                    <div>
                    </div>
                    <div class="text-center mt-3">
                      <button type="submit" name="login" class="btn btn-lg btn-primary">Giriş Yap</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/app.js"></script>
  <script src="../assets/plugins/toastr/toastr.min.js"></script>
  <?php include_once('../config/notifications.php'); ?>
</body>
</html>