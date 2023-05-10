<?php $page = "Özgeçmiş"; ?> <!-- Sayfa başlığını belirlemek için değişken oluşturuluyor.-->

<?php include_once('../template/admin/header.php'); ?> <!--  Başlık dosyasını dahil et -->

<?php include_once('../template/admin/sidebar.php'); ?> <!-- Kenar çubuğu dosyasını dahil et -->

<?php include_once('../template/admin/navbar.php'); ?> <!-- Gezinme çubuğu dosyasını dahil et -->

<?php
// Silme işlemi için kullanıcının kimliğini kontrol eder ve gerekli işlemleri gerçekleştirir.
	if(isset($_GET['delete']) AND is_numeric($_GET['delete'])) { // "delete" parametresi varsa ve sayısal bir değer ise

	  $statement = $conn->prepare("SELECT * FROM portifolio WHERE portifolio_id=?"); // Veritabanından "portifolio_id" değerine göre veri seç
	  $statement->execute(array($_GET['delete'])); // Değeri sorguya ekle ve sorguyu çalıştır
	  $total = $statement->rowCount(); // Sorgunun döndürdüğü satır sayısını al
	  if( $total == 0  OR $_GET['delete'] == 1) { // Eğer satır sayısı 0 ise veya silme işlemi 1 (sabit bir değer) ise
	    header('location: portifolio.php'); // Sayfayı yönlendir
	    exit;
	  }else{

	  	$result = $statement->fetch(PDO::FETCH_ASSOC); // Sorgu sonucunu bir dizi olarak al
	  	if($result['portifolio_photo'] != '' AND $result['portifolio_photo'] != 'default.png') {
	      unlink('storage/portifolio/'.$result['portifolio_photo']); // Dosyayı sil (dosya yolu: storage/portifolio/)
	    }	
	   
	    $statement = $conn->prepare("DELETE FROM portifolio WHERE portifolio_id=?"); // Veritabanından "portifolio_id" değerine göre veriyi sil
	    $statement->execute(array($_GET['delete'])); // Değeri sorguya ekle ve sorguyu çalıştır
	    $_SESSION['success'] = 'Özgeçmiş Başarılı Bir Şekilde Silindi! '; // Başarılı mesajı oluştur
	    header('location: portifolio.php'); // Sayfayı yönlendir
	    exit(0);
	  }
	}
?>
<main class="content">
	<div class="container-fluid p-0">
		<div class="row">
			<div class="col-md-6">
				<h1 class="h3 mb-3"><strong>Çalışmalarım</strong> </h1>
			</div>
			<div class="col-md-6 text-md-end">
				<a href="add-portifolio.php" class="btn btn-pill btn-primary float-right"><i class="align-middle"
						data-feather="plus"></i> Çalışma Ekle</a>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<table class="table dataTable table-striped table-hover">
					<thead>
						<tr>
							<th>Kapak</th>
							<th>Çalışma Başlık</th>
							<th>Çalışma Hakkında</th>
							<th>Durumu</th>
							<th>Oluşturulma Tarihi</th>
							<th>İcraat</th>
						</tr>
					</thead>
					<tbody>
						<?php
			                $i=1;
			                $statement = $conn->prepare('SELECT * FROM portifolio ORDER BY portifolio_id DESC');
			                $statement->execute();
			                $portifolio = $statement->fetchAll(PDO::FETCH_ASSOC);
			                $sNo  = 1;
			                foreach ($portifolio as $portifolio) {
			                ?>
						<tr>
							<td>
								<img src="../storage/portifolio/<?php echo clean($portifolio['portifolio_photo']); ?>"
									width="100" height="100" class="rounded mx-auto d-block" alt="Avatar">
							</td>
							<td><?php echo clean($portifolio['portifolio_title']); ?></td>
							<td class="col-2 text-truncate" style="max-width: 150px;">
								<?php echo clean($portifolio['portifolio_desc']); ?></td>


							<td><?php echo ($portifolio['portifolio_status'] == 1) ? "<span class='badge bg-primary me-1 my-1'>Active</span>" : "<span class='badge bg-danger me-1 my-1'>Disabled <span>"; ?>
							</td>
							<td><?php echo date("M d, Y", strtotime($portifolio['p_created'])); ?></td>
							<td>
								<a href="edit-portifolio.php?edit=<?php echo clean($portifolio['portifolio_id']); ?>"><i
										class="align-middle" data-feather="edit-2"></i></a>
								<?php if($portifolio['portifolio_id'] != 1){ ?>
								<a href="#"
									data-href="portifolio.php?delete=<?php echo clean($portifolio['portifolio_id']); ?>"
									data-bs-toggle="modal" data-bs-target="#confirm-delete"><i class="align-middle"
										data-feather="trash"></i></a>
								<?php } ?>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			
			<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Çalışmayı Sil</h5>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						<div class="modal-body m-3">
							<p class="mb-0">Silmek İstediğine Eminmisin?</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapa</button>
							<a class="btn btn-primary">Sil</a>
						</div>
					</div>
				</div>
			</div>
			
		</div>
</main>
<?php include_once('../template/admin/footer.php'); ?>