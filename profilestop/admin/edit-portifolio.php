<?php include_once('../template/admin/header.php'); ?>
<?php include_once('../template/admin/sidebar.php'); ?>
<?php include_once('../template/admin/navbar.php'); ?>

<?php 
  // 'düzenle' parametresinin ayarlanıp ayarlanmadığını veya sayısal bir değer olup olmadığını kontrol edin
  if(!isset($_GET['edit']) OR !is_numeric($_GET['edit'])) {
    // Redirect to 'edit-portifolio.php' page
    header('location: edit-portifolio.php');
    exit;
  } else {
    // Belirtilen kimliğe sahip portföy birimini almak için bir SELECT ifadesini bitirecek ve yürütecek
    $statement = $conn->prepare("SELECT * FROM portifolio WHERE portifolio_id=?");
    $statement->execute(array($_GET['edit']));
    $total  = $statement->rowCount();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    if( $total == 0 ) {
      // Verilen ID'ye sahip herhangi bir portföy öğesi bulunamazsa, 'edit-portifolio.php' sayfasına yönlendirin
      header('location: edit-portifolio.php');
      exit;
    } else {
      // Getirilen sonucu 'düzenle' öneki ile değişkenlere çıkarın
      $a = extract($result, EXTR_PREFIX_ALL, "edit");
    }
  }
?>

<?php 
  if(isset($_POST['submit'])){
    $valid                = 1;
    $portifolio_title     = clean($_POST['portifolio_title']);
    $portifolio_desc      = clean($_POST['portifolio_desc']);
    $portifolio_url       = clean($_POST['portifolio_url']);
    
    if(isset($_POST['portifolio_status'])){
      $portifolio_status = clean($_POST['portifolio_status']);
      
      // 'portifolio_status' değerini 'açık' ise 1'e dönüştür, aksi halde 0'a ayarla
      if($portifolio_status == 'on'){
        $portifolio_status = 1;
      } else {
        $portifolio_status = 0;
      }
    } else {
      $portifolio_status = 0;
    }

    if(empty($portifolio_title)){
      $valid    = 0;
      $errors[] = 'Lütfen Portföy Başlığını Girin';
    }
    if(empty($portifolio_desc)){
      $valid    = 0;
      $errors[] = 'Lütfen Portföy Tanımını Giriniz';
    }
  
    $portifolio_photo     = $_FILES['portifolio_image']['name'];
    $portifolio_photo_tmp = $_FILES['portifolio_image']['tmp_name'];
    if($portifolio_photo != '') {
      $portifolio_photo_ext = pathinfo($portifolio_photo, PATHINFO_EXTENSION);
      $file_name = basename($portifolio_photo, '.' . $portifolio_photo_ext);
      if($portifolio_photo_ext != 'jpg' && $portifolio_photo_ext != 'png' && $portifolio_photo_ext != 'jpeg' && $portifolio_photo_ext != 'gif') {
        $valid = 0;
        $errors[] = 'jpg, jpeg, gif veya png dosyası yüklemeniz gerekir<br>';
      }
    }

    if($valid == 1) {
      if($portifolio_photo != '') {
        $portifolio_photo_file = '../portifolio-photo-'.time().'.'.$portifolio_photo_ext;
        move_uploaded_file($portifolio_photo_tmp, '../storage/portifolio/'.$portifolio_photo_file);
      } else {
        $portifolio_photo_file = $edit_portifolio_photo;
			}

			$insert = $conn->prepare("UPDATE portifolio SET portifolio_title = ?, portifolio_desc = ?, portifolio_url = ?, portifolio_photo = ?, portifolio_status = ?, p_updated = ? WHERE portifolio_id = ?");
  
			// Portföy öğesini yeni değerlerle güncellemek için UPDATE deyimini yürütün
			$insert->execute(array($portifolio_title, $portifolio_desc, $portifolio_url, $portifolio_photo_file, $portifolio_status, $p_updated, $edit_portifolio_id));
		  
			$_SESSION['success'] = 'Portföy başarıyla güncellendi!';
			// 'portifolio.php' sayfasına yönlendir
			header('location: portifolio.php');
			exit(0);
		  }
	}
?>
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3"><strong>Çalışmalarımı</strong> Düzenle</h1>
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="row">
				<div class="col-12 col-lg-4 d-flex">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Çalışma Bilgisi</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="mb-3">
                                    <label class="form-label" for="inputTitle">Çalışmanın İsmi</label>
										<input type="text" class="form-control" id="inputTitle" placeholder="Çalışmanın İsmini Giriniz" name="portifolio_title" value="<?php echo clean($edit_portifolio_title); ?>">
									</div>
									<div class="mb-3">
                                    <label class="form-label" for="portifolio_desc">Hakkında</label>
                                        <input type="text" rows="4" class="form-control" id="portifolio_desc" placeholder="Çalışma Hakkında"name="portifolio_desc" value="<?php echo clean($edit_portifolio_desc); ?>">

									</div>
									<div class="mb-3">
                                    <label class="form-label" for="inputurl"> Demo</label>
										<input type="text" class="form-control" id="inputurl" placeholder="Demosu" name="portifolio_url" value="<?php echo clean($edit_portifolio_url); ?>">
									</div>
							</div>							
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-4 d-flex">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Durumu</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="mt-4">
										<label for="flexSwitchCheckChecked">Aktif / Kapalı</label>
										<div class="form-check form-switch mt-2">
											<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" <?php if($edit_portifolio_status == 1){echo 'checked=""';} ?> name="portifolio_status">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-4 d-flex">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Resmi</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="text-center">
										<img alt="Portifolio Image" src="../storage/portifolio/<?php echo clean($edit_portifolio_photo); ?>" class="rounded mx-auto d-block" width="100" height="100" id="portifolioImg">
										<div class="mt-2">
											<button type="button" class="btn btn-primary">Resim Seçiniz
												<input type="file" class="file-upload edit-file" value="Upload" name="portifolio_image" onchange="previewFile(this);" accept="image/*">
											</button>
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
									<button type="submit" name="submit" class="btn btn-primary">Kaydet</button>
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