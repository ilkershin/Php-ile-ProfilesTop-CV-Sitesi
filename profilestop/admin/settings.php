<?php $page = "Ayarlar"; ?> <!-- Sayfa başlığını belirlemek için değişken oluşturuluyor. -->

<?php include_once('../template/admin/header.php'); ?> <!-- Başlık dosyasını dahil et -->

<?php include_once('../template/admin/sidebar.php'); ?> <!-- Kenar çubuğu dosyasını dahil et -->

<?php include_once('../template/admin/navbar.php'); ?> <!-- Gezinme çubuğu dosyasını dahil et -->

<?php 
	$statement = $conn->prepare("SELECT * FROM site_settings"); // site_settings tablosundaki tüm verileri seç
	$statement->execute(); // Sorguyu çalıştır
	$result = $statement->fetch(PDO::FETCH_ASSOC); // Sorgu sonucunu bir dizi olarak al
	$a = extract($result,EXTR_PREFIX_ALL, "edit"); // Diziyi değişkenlere çıkar

	if(isset($_POST['submit'])){ // Form gönderildiğinde

		$valid	= 1;
		$site_name = $_POST['site_name']; // Formdan site adını al
		$site_desc = $_POST['site_description']; // Formdan site açıklamasını al
		
		if(empty($site_name)){
		    $valid    = 0;
		    $errors[] = 'Lütfen Site Adını Giriniz'; // Site adı boş ise geçerli değil olarak işaretle
		}

		if($valid == 1) {

			$update = $conn->prepare("UPDATE site_settings SET site_name = ?, site_description = ?  WHERE settings_id = ?"); // site_settings tablosunda site adı ve açıklamasını güncelle

			$update->execute(array($site_name, $site_desc,1)); // Değerleri sorguya ekle ve sorguyu çalıştır

			$_SESSION['success'] = 'Site Ayarları başarıyla güncellendi!'; // Başarılı mesajı oluştur
			header('location: settings.php'); // Sayfayı yönlendir
			exit(0);
		}
	}

	//Upload logo
	if(isset($_POST['logo'])){ // Logo formu gönderildiğinde

		$valid	= 1;
		
		$logo_file     = $_FILES['logo_file']['name']; // Logo dosyasının adını al
		$logo_file_tmp = $_FILES['logo_file']['tmp_name']; // Logo dosyasının geçici yolunu al

	  	if($logo_file!='') {
	    	$logo_file_ext = pathinfo( $logo_file, PATHINFO_EXTENSION ); // Logo dosyasının uzantısını al
	    	$file_name = basename( $logo_file, '.' . $logo_file_ext ); // Dosya adını al (uzantısız)
	    	if( $logo_file_ext!='jpg' && $logo_file_ext!='png' && $logo_file_ext!='jpeg' && $logo_file_ext!='gif' ) {
	      	$valid = 0;
	      	$errors[]= 'jpg, jpeg, gif veya png dosyası yüklemeniz gerekir<br>'; // Geçerli bir logo dosyası yüklemesi gerektiği hata mesajı
		   }
		}

		if($valid == 1) {

			if($logo_file!='')  {
				$logo_final_file = 'logo-file-'.time().'.'.$logo_file_ext; // Yeni logo dosyasının adını oluştur
			    move_uploaded_file( $logo_file_tmp, '../storage/logo/'.$logo_final_file ); // Logo dosyasını hedef klasöre taşı
			    unlink('../storage/logo/'.$edit_site_logo); // Eski logo dosyasını sil
			}else{
				$logo_final_file = $edit_site_logo; // Eski logo dosyasını kullan
			}

			$update = $conn->prepare("UPDATE site_settings SET site_logo = ? WHERE settings_id = ?"); // site_settings tablosunda site logosunu güncelle

			$update->execute(array($logo_final_file,1)); // Değerleri sorguya ekle ve sorguyu çalıştır

			$_SESSION['success'] = 'Site Logosu başarıyla güncellendi!'; // Başarılı mesajı oluştur
			header('location: settings.php'); // Sayfayı yönlendir
			exit(0);
		}
	}

	if(isset($_POST['email'])){ // E-posta formu gönderildiğinde

		$valid	= 1;
		$email_from 		= $_POST['email_from']; // Formdan gönderen e-posta adresini al
		$email_from_title 	= $_POST['email_from_title']; // Formdan gönderen e-posta başlığını al
		
		if(empty($email_from)){
		    $valid    = 0;
		    $errors[] = 'Please Enter Email From'; // Gönderen e-posta adresi boş ise geçerli değil olarak işaretle
		 }
		if(empty($email_from_title)){
		    $valid    = 0;
		    $errors[] = 'Lütfen Başlıktan Gelen E-postayı Girin'; // Gönderen e-posta başlığı boş ise geçerli değil olarak işaretle
		}

		if($valid == 1) {

			$update = $conn->prepare("UPDATE site_settings SET email_from = ?, email_from_title = ?  WHERE settings_id = ?"); // site_settings tablosunda e-posta ayarlarını güncelle

			$update->execute(array($email_from, $email_from_title,1)); // Değerleri sorguya ekle ve sorguyu çalıştır

			$_SESSION['success'] = 'E-posta Ayarları başarıyla güncellendi!'; // Başarılı mesajı oluştur
			header('location: settings.php'); // Sayfayı yönlendir
			exit(0);
		}
	}

	if(isset($_POST['seo'])){ // SEO formu gönderildiğinde

		$valid	= 1;
		$seo_meta_title 		= $_POST['seo_meta_title']; // Formdan SEO Meta başlığını al
		$seo_meta_tags 			= $_POST['seo_meta_tags']; // Formdan SEO Meta etiketlerini al
		$seo_meta_description 	= $_POST['seo_meta_description']; // Formdan SEO Meta açıklamasını al
		
		if(empty($seo_meta_title)){
		    $valid    = 0;
		    $errors[] = 'Lütfen SEO Meta Başlığını Girin'; // SEO Meta başlığı boş ise geçerli değil olarak işaretle
		}
		if(empty($seo_meta_tags)){
		    $valid    = 0;
			$errors[] = 'Lütfen SEO Meta Etiketlerini Girin'; // SEO Meta etiketleri boş ise geçerli değil olarak işaretle
		}
		if(empty($seo_meta_description)){
		    $valid    = 0;
		    $errors[] = 'Lütfen SEO Meta Açıklamalarını Girin'; // SEO Meta açıklaması boş ise geçerli değil olarak işaretle
		}

		if($valid == 1) {

			$update = $conn->prepare("UPDATE site_settings SET seo_meta_title = ?, seo_meta_tags = ?, seo_meta_description = ?  WHERE settings_id = ?"); // site_settings tablosunda SEO ayarlarını güncelle

			$update->execute(array($seo_meta_title, $seo_meta_tags, $seo_meta_description,1)); // Değerleri sorguya ekle ve sorguyu çalıştır

			$_SESSION['success'] = 'SEO Ayarları başarıyla güncellendi!'; // Başarılı mesajı oluştur
			header('location: settings.php'); // Sayfayı yönlendir
			exit(0);
		}
	}
?>
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3"><strong>Site</strong> Ayarlar</h1>
		<div class="row">
			<div class="col-md-3 col-xl-3">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0">Site Ayarları</h5>
					</div>
					<div class="list-group list-group-flush" role="tablist">
						<a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#site"
							role="tab" aria-selected="false">
							Site İsmi
						<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#logo" role="tab"
							aria-selected="false">
							Logo
						</a>
						
					</div>
				</div>
			</div>
			<div class="col-md-9 col-xl-9">
				<div class="tab-content">
					<div class="tab-pane fade active show" id="site" role="tabpanel">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title mb-0">Hakkında</h5>
							</div>
							<div class="card-body">
								<form action="" method="POST">
									<div class="row">
										<div class="col-md-12">
											<div class="mb-3">
												<label class="form-label" for="inputSitename">Site İsmi</label>
												<input type="text" class="form-control" id="inputSitename"
													placeholder="Enter Site Name"
													value="<?php echo clean($edit_site_name); ?>" name="site_name">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputSiteDesc">Site Hakkında</label>
												<textarea name="site_description" rows="2" class="form-control"
													id="inputSiteDesc"
													placeholder="Write something about website"><?php echo clean($edit_site_description); ?></textarea>
											</div>
										</div>
									</div>
									<button type="submit" name="submit" class="btn btn-primary">Kaydet</button>
								</form>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="logo" role="tabpanel">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Logo</h5>
								<div class="col-md-12">
									<div class="text-center">
										<img alt="Profile Image"
											src="../storage/logo/<?php echo clean($edit_site_logo); ?>"
											class="rounded-circle img-responsive mt-2" width="128" height="128"
											id="profileImg">
										<form action="" method="POST" enctype="multipart/form-data">
											<div class="mt-2">
												<button type="button" class="btn btn-success">Logo Seçin
													<input type="file" class="file-upload" value="Upload"
														name="logo_file" onchange="previewFile(this);" accept="image/*">
												</button>
												<br><br>
												<input type="submit" name="logo" class="btn btn-primary"
													value="Kaydet">
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
				</div>
			</div>
		</div>
	</div>
</main>
<?php include_once('../template/admin/footer.php'); ?>