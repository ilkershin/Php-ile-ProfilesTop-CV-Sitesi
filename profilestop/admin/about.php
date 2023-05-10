<?php $page = "Hakkımda"; ?>

<?php include_once('../template/admin/header.php'); ?>
<?php include_once('../template/admin/sidebar.php'); ?>
<?php include_once('../template/admin/navbar.php'); ?>

<?php 
	// about tablosundan verileri çekme
	$statement = $conn->prepare("SELECT * FROM about");
	$statement->execute();
	$result = $statement->fetch(PDO::FETCH_ASSOC);
	$a = extract($result,EXTR_PREFIX_ALL, "edit");

	// Form submit edildiğinde çalışacak olan kod bloğu
	if(isset($_POST['submit'])){
		$valid = 1; // Geçerli olduğunu belirtmek için bir değişken

		// POST verilerini alma
		$about_title = $_POST['about_title'];
		$about_desc = $_POST['about_desc'];
		$about_name = $_POST['about_name'];
		$about_email = $_POST['about_email'];
		$about_age = $_POST['about_age'];
		$about_address = $_POST['about_address'];
		$about_lang = $_POST['about_lang'];
		$about_exp = $_POST['about_exp'];
		$about_free = $_POST['about_free'];
		$about_skill = $_POST['about_skill'];
		$about_exp_yrs = $_POST['about_exp_yrs'];
		$about_happy = $_POST['about_happy'];
		$about_project = $_POST['about_project'];
		$about_awards = $_POST['about_awards'];
		$about_button = $_POST['about_button'];
		$about_hire = $_POST['about_hire'];
		
		// Alanların boş olup olmadığını kontrol etme
		if(empty($about_title)){
		    $valid = 0;
		    $errors[] = 'Lütfen Bilgilerinizi Giriniz';
		}

		// Her şey yolundaysa, veritabanında kişisel bilgileri güncelleme
		if($valid == 1) {
			$update = $conn->prepare("UPDATE about SET about_title = ?, about_desc = ?,	about_name = ?, about_email = ?, about_age = ?, about_address = ?, about_lang = ?, about_exp = ?, about_free = ?, about_skill = ?, about_exp_yrs = ?, about_happy = ?, about_project = ?, about_awards = ?, about_button = ?, about_hire = ?   WHERE about_id = ?");

			$update->execute(array($about_title, $about_desc, $about_name, $about_email, $about_age, $about_address, $about_lang, $about_exp, $about_free, $about_skill, $about_exp_yrs, $about_happy, $about_project, $about_awards, $about_button, $about_hire,1));

			$_SESSION['success'] = 'Kişisel Bilgiler başarıyla güncellendi!';
			header('location: about.php');
			exit(0);
		}
	}

	// Front Image'i yükleme
	if(isset($_POST['photo'])){
		$valid = 1;

		$about_file = $_FILES['about_file']['name'];
		$about_file_tmp = $_FILES['about_file']['tmp_name'];

	  	if($about_file!='') {
	    	$about_file_ext = pathinfo( $about_file, PATHINFO_EXTENSION );
	    	$file_name = basename( $about_file, '.' . 	$about_file_ext );
	    	if( $about_file_ext!='jpg' && $about_file_ext!='png' && $about_file_ext!='jpeg' && $about_file_ext!='gif' ) {
	      	$valid = 0;
	      	$errors[]= 'jpg, jpeg, gif veya png dosyası yüklemeniz gerekir<br>';
		   }
		}

		// Her şey yolundaysa, veritabanında profil fotoğrafını güncelleme
		if($valid == 1) {
			if($about_file!='') {
			    $about_final_file = 'about-file-'.time().'.'.$about_file_ext;
			    move_uploaded_file( $about_file_tmp, '../storage/home/'.$about_final_file );
			    unlink('../storage/home/'.$edit_about_photo);
			}else{
				$about_final_file = $edit_about_photo;
			}

			$update = $conn->prepare("UPDATE about SET about_photo = ? WHERE about_id = ?");

			$update->execute(array($about_final_file,1));

			$_SESSION['success'] = 'Ön Görüntü başarıyla güncellendi!';
			header('location: about.php');
			exit(0);
		}
	}
?>
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3"><strong>Hakkımda</strong></h1>
		<div class="row">
			<div class="col-md-3 col-xl-3">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0">Hakkımda</h5>
					</div>
					<div class="list-group list-group-flush" role="tablist">
						<a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#aboutinfo"
							role="tab" aria-selected="false">
							Hakkımda
						</a>

						<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#photo" role="tab"
							aria-selected="false">
							Fotoğraf
						</a>

					</div>
				</div>
			</div>
			<div class="col-md-9 col-xl-9">
				<div class="tab-content">
					<div class="tab-pane fade active show" id="aboutinfo" role="tabpanel">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title mb-0">Hakkımda</h5>
							</div>
							<div class="card-body">
								<form action="" method="POST">
									<div class="row">
										<div class="col-md-12">
											<div class="mb-3">
												<label class="form-label" for="inputabouttitle">Başlık</label>
												<input type="text" class="form-control" id="inputabouttitle"
													placeholder="Başlık Giriniz."
													value="<?php echo clean($edit_about_title); ?>" name="about_title">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputdescription">Açıklama</label>
												<input type="text" class="form-control" id="inputdescription"
													placeholder="Açıklama Giriniz"
													value="<?php echo clean($edit_about_desc); ?>" name="about_desc">
											</div>
										</div>
										<div class="col-6">
											<div class="mb-3">
												<label class="form-label" for="inputaboutname">İsmim</label>
												<input type="text" class="form-control" id="inputaboutname"
													placeholder="İsminizi Giriniz"
													value="<?php echo clean($edit_about_name); ?>" name="about_name">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputaddress">Adresim</label>
												<input type="text" class="form-control" id="inputaddress"
													placeholder="Adresinizi Giriniz."
													value="<?php echo clean($edit_about_address); ?>"
													name="about_address">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputage">Yaşım</label>
												<input type="text" class="form-control" id="inputage"
													placeholder="Yaşınızı Giriniz."
													value="<?php echo clean($edit_about_age); ?>" name="about_age">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputexp">Deneyimlerim</label>
												<input type="text" class="form-control" id="inputexp"
													placeholder="Deneyiminizi Giriniz."
													value="<?php echo clean($edit_about_exp); ?>" name="about_exp">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputaboutexp">Yıllık Ortalama Deneyimim</label>
												<input type="text" class="form-control" id="inputaboutexp"
													placeholder="Yıllık Ortalama Deneyiminizi Giriniz."
													value="<?php echo clean($edit_about_exp_yrs); ?>"
													name="about_exp_yrs">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputproject">Tamalanan Projelerim.</label>
												<input type="text" class="form-control" id="inputproject"
													placeholder="Tamamlanan Projelerim"
													value="<?php echo clean($edit_about_project); ?>"
													name="about_project">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputcv">CV PDF</label>
												<input type="text" class="form-control" id="inputcv"
													placeholder="CV PDF URL."
													value="<?php echo clean($edit_about_button); ?>"
													name="about_button">
											</div>
										</div>
										<div class="col-6">
											<div class="mb-3">
												<label class="form-label" for="inputemail">Email Adresim</label>
												<input type="email" class="form-control" id="inputemail"
													placeholder="Email Adresi Giriniz."
													value="<?php echo clean($edit_about_email); ?>" name="about_email">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputskill">Deneyimlerim</label>
												<input type="text" class="form-control" id="inputskill"
													placeholder="Deneyimlerinizi Giriniz."
													value="<?php echo clean($edit_about_skill); ?>" name="about_skill">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputfree">Çalışma Durumunuz.</label>
												<input type="text" class="form-control" id="inputfree"
													placeholder="Çalışma Durumunuzu Giriniz."
													value="<?php echo clean($edit_about_free); ?>" name="about_free">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputlang">Bildiğim Diller</label>
												<input type="text" class="form-control" id="inputlang"
													placeholder="Bildiğiniz Dilleri Giriniz."
													value="<?php echo clean($edit_about_lang); ?>" name="about_lang">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputabouhappy">Olumlu Projelerim</label>
												<input type="text" class="form-control" id="inputabouthappy"
													placeholder="Kaç Projeden Olumlu Dönüş Aldınız Giriniz."
													value="<?php echo clean($edit_about_happy); ?>" name="about_happy">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputawards">Kazandığım Ödüller.</label>
												<input type="text" class="form-control" id="inputawards"
													placeholder="Kazandığınız Ödül Sayısı Giriniz."
													value="<?php echo clean($edit_about_awards); ?>"
													name="about_awards">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputhire">Telefon Numaram</label>
												<input type="text" class="form-control" id="inputhire"
													placeholder="Telefon Numaranız"
													value="<?php echo clean($edit_about_hire); ?>" name="about_hire">
											</div>
										</div>
									</div>
									<button type="submit" name="submit" class="btn btn-primary">Değişiklikleri Kaydet</button>
								</form>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" id="photo" role="tabpanel">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title mb-0">Kapak Fotoğrafı</h5>
							</div>
							<div class="card-body">
								<h5 class="card-title">Kapak Fotoğrafınız</h5>
								<div class="col-md-12">
									<div class="text-center">
										<img alt="Front Image"
											src="../storage/home/<?php echo clean($edit_about_photo); ?>"
											class="rounded mx-auto d-block" width="200" height="200" id="aboutImg">
										<form action="" method="POST" enctype="multipart/form-data">
											<div class="mt-2">
												<button type="button" class="btn btn-success">Resim Seçin.
													<input type="file" class="file-upload" value="Upload"
														name="about_file" onchange="previewFile(this);"
														accept="image/*">
												</button>
												<br><br>
												<input type="submit" name="photo" class="btn btn-primary"
													value="Değişiklikleri Kaydet">
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</main>
<?php include_once('../template/admin/footer.php'); ?>