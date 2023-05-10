<?php $page = "Eğitim"; ?>
<?php include_once('../template/admin/header.php'); ?>
<?php include_once('../template/admin/sidebar.php'); ?>
<?php include_once('../template/admin/navbar.php'); ?>
<?php
	if(isset($_GET['delete']) AND is_numeric($_GET['delete'])) {
		// Hizmetlerin kimliği geçerli mi kontrol edilir
	  $statement = $conn->prepare("SELECT * FROM education WHERE education_id=?");
	  $statement->execute(array($_GET['delete']));
	  $total = $statement->rowCount();
	  
	  // Toplam sonuç sayısı 0 ise veya id 1 ise (varsayılan eğitim), kullanıcıyı eğitim sayfasına yönlendirir ve çıkar
	  if( $total == 0  OR $_GET['delete'] == 1) {
	    header('location: education.php');
	    exit;
	  }
      else{
	  	$result = $statement->fetch(PDO::FETCH_ASSOC);
	  	
	  	// Eğitimin fotoğrafı mevcutsa ve varsayılan fotoğraf değilse, dosyayı siler
	  	if($result['education_photo'] != '' AND $result['education_photo'] != 'default.png') {
	      unlink('storage/portifolio/'.$result['education_photo']); 
	    }	
	    
	    // Eğitimi Eğitim Tablosundan Sil
	    $statement = $conn->prepare("DELETE FROM education WHERE education_id=?");
	    $statement->execute(array($_GET['delete']));
	    $_SESSION['success'] = 'education has been deleted';
	    header('location: education.php');
	    exit(0);
	  }
	}
?>
<main class="content">
	<div class="container-fluid p-0">
		<div class="row">
			<div class="col-md-6">
				<h1 class="h3 mb-3"><strong>Eğitimim</strong> </h1>
			</div>
			<div class="col-md-6 text-md-end">
				<a href="add-education.php" class="btn btn-pill btn-primary float-right"><i class="align-middle"
						data-feather="plus"></i> Eğitim EKle</a>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<table class="table dataTable table-striped table-hover">
					<thead>
						<tr>
							<th>Kaç Yıl Eğitim Gördüm</th>
							<th>Okul Adı</th>
							<th>Okul Hakkında</th>
							<th>Durumun</th>
							<th>İcraat</th>
						</tr>
					</thead>
					<tbody>
						<?php
			                $i=1;
			                $statement = $conn->prepare('SELECT * FROM education ORDER BY education_id DESC');
			                $statement->execute();
			                $education = $statement->fetchAll(PDO::FETCH_ASSOC);
			                $sNo  = 1;
			                foreach ($education as $education) {
			                ?>
						<tr>
							<td><?php echo clean($education['education_year']); ?></td>
							<td><?php echo clean($education['education_title']); ?></td>
							<td class="col-2 text-truncate" style="max-width: 150px;">
								<?php echo clean($education['education_desc']); ?></td>


							<td><?php echo ($education['education_status'] == 1) ? "<span class='badge bg-primary me-1 my-1'>Active</span>" : "<span class='badge bg-danger me-1 my-1'>Disabled <span>"; ?>
							</td>
							<td>
								<a href="edit-education.php?edit=<?php echo clean($education['education_id']); ?>"><i
										class="align-middle" data-feather="edit-2"></i></a>
								<?php if($education['education_id'] != 1){ ?>
								<a href="#"
									data-href="education.php?delete=<?php echo clean($education['education_id']); ?>"
									data-bs-toggle="modal" data-bs-target="#confirm-delete"><i class="align-middle"
										data-feather="trash"></i></a>
								<?php } ?>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<!-- BEGIN primary modal -->
			<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Sil</h5>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						<div class="modal-body m-3">
							<p class="mb-0">Sİlmek Konusunda Eminmisin?</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
							<a class="btn btn-primary">Sil</a>
						</div>
					</div>
				</div>
			</div>
			<!-- END primary modal -->
		</div>
</main>
<?php include_once('../template/admin/footer.php'); ?>