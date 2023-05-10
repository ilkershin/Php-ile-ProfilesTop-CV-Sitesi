<?php $page = "İletişim"; ?>
<?php include_once('../template/admin/header.php'); ?>
<?php include_once('../template/admin/sidebar.php'); ?>
<?php include_once('../template/admin/navbar.php'); ?>

<?php 
	// İletişim bilgilerini veritabanından al
	$statement = $conn->prepare("SELECT * FROM contact");
	$statement->execute();
	$result = $statement->fetch(PDO::FETCH_ASSOC);
	// Veritabanı sonuçlarını değişkenlere aktar
	$a = extract($result,EXTR_PREFIX_ALL, "edit");

	// İletişim bilgileri güncelleme formu gönderildiyse
	if(isset($_POST['submit'])){
		$valid = 1;
		$contact_info = $_POST['contact_info'];
		$contact_address = $_POST['contact_address'];
		
		if(empty($contact_info)){
		    $valid    = 0;
		    $errors[] = 'Lütfen Bilgilerinizi Giriniz';
		}

		if($valid == 1) {
			// İletişim bilgilerini güncelle
			$update = $conn->prepare("UPDATE contact SET contact_info = ?, contact_address = ?  WHERE contact_id = ?");
			$update->execute(array($contact_info, $contact_address, 1));

			$_SESSION['success'] = 'İletişim Bilgileri başarıyla güncellendi!';
			header('location: contact.php');
			exit(0);
		}
	}

	// E-posta ve telefon numarası ayarlarını güncelleme formu gönderildiyse
	if(isset($_POST['email'])){
		$valid = 1;
		$contact_email = $_POST['contact_email'];
		$contact_phone = $_POST['contact_phone'];
		
		if(empty($contact_email)){
		    $valid    = 0;
		    $errors[] = 'Lütfen Kimden E-posta Girin';
		}
		if(empty($contact_phone)){
		    $valid    = 0;
		    $errors[] = 'Lütfen Telefon Numarası Giriniz';
		}

		if($valid == 1) {
			// E-posta ve telefon numarasını güncelle
			$update = $conn->prepare("UPDATE contact SET contact_email = ?, contact_phone = ?  WHERE contact_id = ?");
			$update->execute(array($contact_email, $contact_phone, 1));

			$_SESSION['success'] = 'E-posta ve Telefon Ayarları başarıyla güncellendi!';
			header('location: contact.php');
			exit(0);
		}
	}

	// Sosyal medya bağlantılarını güncelleme formu gönderildiyse
	if(isset($_POST['social'])){
		$valid = 1;
		$contact_fb = $_POST['contact_fb'];
		$contact_tw = $_POST['contact_tw'];
		$contact_insta = $_POST['contact_insta'];
		$contact_wts = $_POST['contact_wts'];
		
		if($valid == 1) {
			// Sosyal medya bağlantılarını güncelle
			$update = $conn->prepare("UPDATE contact SET contact_fb = ?, contact_tw = ?, contact_insta = ?, contact_wts = ? WHERE contact_id = ?");
			$update->execute(array($contact_fb, $contact_tw, $contact_insta, $contact_wts, 1));

			$_SESSION['success'] = 'Sosyal Bağlantılar başarıyla güncellendi!';
			header('location: contact.php');
			exit(0);
		}
	}
?>
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3"><strong>İletişim</strong> </h1>
		<div class="row">
			<div class="col-md-3 col-xl-3">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0">İletişim</h5>
					</div>
					<div class="list-group list-group-flush" role="tablist">
						<a class="list-group-item list-group-item-action active" data-bs-toggle="list"
							href="#contactinfo" role="tab" aria-selected="false">
							İletişim
						</a>

						<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#email" role="tab"
							aria-selected="false">
							Email Ve Telefon
						</a>

						<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#social"
							role="tab" aria-selected="false">
							Sosyal Medya
						</a>

					</div>
				</div>
			</div>
			<div class="col-md-9 col-xl-9">
				<div class="tab-content">
					<div class="tab-pane fade active show" id="contactinfo" role="tabpanel">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title mb-0">İletişim</h5>
							</div>
							<div class="card-body">
								<form action="" method="POST">
									<div class="row">
										<div class="col-md-12">
											<div class="mb-3">
												<label class="form-label" for="inputcontactinfo">İletişim Hakkında</label>
												<input type="text" class="form-control" id="inputcontactinfo"
													placeholder="İletişim Hakkında Giriniz."
													value="<?php echo clean($edit_contact_info); ?>"
													name="contact_info">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputaddress">Adresim</label>
												<input type="text" class="form-control" id="inputcontactaddress"
													placeholder="Adres Giriniz."
													value="<?php echo clean($edit_contact_address); ?>"
													name="contact_address">
											</div>
										</div>
									</div>
									<button type="submit" name="submit" class="btn btn-primary">Kaydet</button>
								</form>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" id="email" role="tabpanel">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title mb-0">Email Ve Telefon</h5>
							</div>
							<div class="card-body">
								<form action="" method="POST">
									<div class="row">
										<div class="col-md-12">
											<div class="mb-3">
												<label class="form-label" for="contact_email">Email</label>
												<input type="email" class="form-control" id="contact_email"
													placeholder="Email Giriniz"
													value="<?php echo clean($edit_contact_email); ?>"
													name="contact_email">
											</div>
											<div class="mb-3">
												<label class="form-label" for="contact_phone">Telefon Numaram</label>
												<input type="text" class="form-control" id="contact_phone"
													placeholder="Telefon Numarası Giriniz."
													value="<?php echo clean($edit_contact_phone); ?>"
													name="contact_phone">
											</div>
										</div>
									</div>
									<button type="submit" name="email" class="btn btn-primary">Kaydet</button>
								</form>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" id="social" role="tabpanel">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title mb-0">Sosyal Medya</h5>
							</div>
							<div class="card-body">
								<form action="" method="POST">
									<div class="row">
										<div class="col-6">
											<div class="mb-3">
												<label class="form-label" for="contact_fb">Facebook </label>
												<input type="text" class="form-control" id="contact_fb"
													placeholder=" Facebook Kullanıcı Adı"
													value="<?php echo clean($edit_contact_fb); ?>" name="contact_fb">
											</div>
											<div class="mb-3">
												<label class="form-label" for="contact_tw">Twitter </label>
												<input type="text" class="form-control" id="contact_tw"
													placeholder="Twitter Kullanıcı Adı"
													value="<?php echo clean($edit_contact_tw); ?>" name="contact_tw">
											</div>
										</div>

										<div class="col-6">
											<div class="mb-3">
												<label class="form-label" for="contact_insta">Instagram </label>
												<input type="text" class="form-control" id="contact_insta"
													placeholder="Instagram Kullanıcı Adı"
													value="<?php echo clean($edit_contact_insta); ?>"
													name="contact_insta">
											</div>
											<div class="mb-3">
												<label class="form-label" for="contact_wts">Whatsapp </label>
												<input type="text" class="form-control" id="contact_wts"
													placeholder=" Whatsapp Numarası "
													value="<?php echo clean($edit_contact_wts); ?>" name="contact_wts">
											</div>
										</div>
									</div>
									<button type="submit" name="social" class="btn btn-primary">Kaydet.</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</main>
<?php include_once('../template/admin/footer.php'); ?>