<?php $page = "Eğitim Ekle"; ?>

<?php include_once('../template/admin/header.php'); ?>
<?php include_once('../template/admin/sidebar.php'); ?>
<?php include_once('../template/admin/navbar.php'); ?>

<?php 
	// Form submit edildiğinde çalışacak olan kod bloğu
	if(isset($_POST['submit'])){
		$valid = 1; // Geçerli olduğunu belirtmek için bir değişken

		// POST verilerini temizleme
		$education_title = clean($_POST['education_title']);
		$education_desc = clean($_POST['education_desc']);
		$education_year = clean($_POST['education_year']);

		// Eğitim durumunu kontrol etme
		if(isset($_POST['education_status'])){
			$education_status = clean($_POST['education_status']);

			if($education_status == 'on'){
				$education_status = 1;
			}else{
				$education_status = 0;
			}
		}else{
			$education_status = 0;
		}

		// Eğitim başlığının veritabanında benzersiz olup olmadığını kontrol etme
		$statement = $conn->prepare('SELECT * FROM education WHERE education_title = ?');
	  	$statement->execute(array($education_title));
	  	$total = $statement->rowCount();
	  	if($total > 0) {
	    	$valid = 0;
	    	$errors[] = 'Bu Eğitim başlığı zaten kayıtlı.';
	  	}

		// Alanların boş olup olmadığını kontrol etme
		if(empty($education_title)){
		    $valid = 0;
		    $errors[] = 'Lütfen Eğitim Adını Giriniz';
		}
		if(empty($education_desc)){
		    $valid = 0;
		    $errors[] = 'Lütfen Eğitim Tanımını Giriniz';
		}
        if(empty($education_year)){
		    $valid = 0;
		    $errors[] = 'Lütfen Eğitim Yılını Giriniz';
		}

		// Her şey yolundaysa, veritabanına veriyi ekleyin
		if($valid == 1) {
			$insert = $conn->prepare("INSERT INTO education (education_title, education_year, education_status, education_desc) VALUES (?,?,?,?)");
			$insert->execute(array($education_title, $education_year, $education_status, $education_desc));
			
			$_SESSION['success'] = 'eğitim başarıyla eklendi!';
		    header('location: education.php');
		    exit(0);
		}
	}
?>
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3"><strong>Eğitim</strong> Ekle</h1>
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Eğitimim Hakkında</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="mb-3">
										<label class="form-label" for="inputTitle">Eğitim Yerimin İsmi</label>
										<input type="text" class="form-control" id="inputTitle"
											placeholder="Eğitim Yeri İsmi" name="education_title">
									</div>
									<div class="mb-3">
										<label class="form-label" for="education_desc">Eğitim Yeri Hakkında</label>
										<textarea type="text" rows="4" class="form-control" id="education_desc"
											placeholder="Eğitim Yeri Hakkında Bilgi." name="education_desc"></textarea>
									</div>
									<div class="mb-3">
										<label class="form-label" for="inputurl">Eğitim Gördüğüm Veya Göreceğim Yıl Aralığı</label>
										<input type="text" class="form-control" id="inputurl"
											placeholder="Eğitim Gördüğüm Veya Göreceğim Yıl Aralığı" name="education_year">
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
										<label for="flexSwitchCheckChecked">Açık / Kapalı</label>
										<div class="form-check form-switch mt-2">
											<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
												checked="" name="education_status">
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
									<button type="submit" name="submit" class="btn btn-primary">Değişiklikler Kaydet</button>
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