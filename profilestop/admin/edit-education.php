<?php include_once('../template/admin/header.php'); ?>
<?php include_once('../template/admin/sidebar.php'); ?>
<?php include_once('../template/admin/navbar.php'); ?>

<?php 
  // 'edit' parametresinin geçerli olup olmadığını kontrol et
  if(!isset($_GET['edit']) OR !is_numeric($_GET['edit'])) {
    // 'edit-education.php' sayfasına yönlendir
    header('location: edit-education.php');
    exit;
  } else {
    // Belirtilen ID'ye sahip eğitim verisini almak için bir SELECT sorgusu hazırla ve çalıştır
    $statement = $conn->prepare("SELECT * FROM education WHERE education_id=?");
    $statement->execute(array($_GET['edit']));
    $total  = $statement->rowCount();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    if( $total == 0 ) {
      // Verilen ID'ye sahip eğitim verisi bulunamazsa 'edit-education.php' sayfasına yönlendir
      header('location: edit-education.php');
      exit;
    } else {
      // Alınan sonucu değişkenlere 'edit' öneki ile çıkar
      $a = extract($result, EXTR_PREFIX_ALL, "edit");
    }
  }
?>

<?php 
  if(isset($_POST['submit'])){
    $valid             = 1;
    $education_title   = clean($_POST['education_title']);
    $education_desc    = clean($_POST['education_desc']);
    $education_year    = clean($_POST['education_year']);
    
    if(isset($_POST['education_status'])){
      $education_status = clean($_POST['education_status']);
      
      // 'education_status' değeri 'on' ise 1 olarak ayarla, değilse 0 olarak ayarla
      if($education_status == 'on'){
        $education_status = 1;
      } else {
        $education_status = 0;
      }
    } else {
      $education_status = 0;
    }

    // Eğer gerekli alanlar boş ise hata mesajları ekle
    if(empty($education_title)){
      $valid    = 0;
      $errors[] = 'Please Enter education Title';
    }
    if(empty($education_desc)){
      $valid    = 0;
      $errors[] = 'Please Enter education Description';
    }

    // Her şey yolunda ise
    if($valid == 1) {
      // Veriyi güncelle

      $insert = $conn->prepare("UPDATE education SET education_title = ?, education_desc = ?, education_status = ?, education_year = ? WHERE education_id = ?");
      
      $insert->execute(array($education_title, $education_desc, $education_status, $education_year, $edit_education_id));

      $_SESSION['success'] = 'education has been updated successfully!';
      // 'education.php' sayfasına yönlendir
      header('location: education.php');
      exit(0);
    }
  }
?>
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3"><strong></strong> Eğitimin</h1>
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Eğitimin Hakkında</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="mb-3">
										<label class="form-label" for="inputTitle">Okul İsmi</label>
										<input type="text" class="form-control" id="inputTitle"
											placeholder="Okulunuzun İsmini Giriniz." name="education_title"
											value="<?php echo clean($edit_education_title); ?>">
									</div>
									<div class="mb-3">
										<label class="form-label" for="education_desc">Okul Hakkında</label>
										<input type="text" rows="4" class="form-control" id="education_desc"
											placeholder="Okulunuz Hakkında?" name="education_desc"
											value="<?php echo clean($edit_education_desc); ?>">

									</div>
									<div class="mb-3">
										<label class="form-label" for="inputurl"> Eğitim Gördüğüm Veya Göreceğim Yıl Aralığı</label>
										<input type="text" class="form-control" id="inputurl"
											placeholder="Eğitim Gördüğüm Veya Göreceğim Yıl Aralığı." name="education_year"
											value="<?php echo clean($edit_education_year); ?>">
									</div>
								</div>

							</div>

						</div>
					</div>
				</div>
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Eğitim Durumum</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="mt-4">
										<label for="flexSwitchCheckChecked">Aktif / Kapalu</label>
										<div class="form-check form-switch mt-2">
											<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
												<?php if($edit_education_status == 1){echo 'checked=""';} ?>
												name="education_status">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<button type="submit" name="submit" class="btn btn-primary">Değişiklikleri Kaydet</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</main>
<?php include_once('../template/admin/footer.php'); ?>