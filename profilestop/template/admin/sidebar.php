<nav id="sidebar" class="sidebar js-sidebar">
	<div class="sidebar-content js-simplebar">
		<!-- Site logo -->
		<a class="sidebar-brand" href="dashboard.php">
			<span class="align-middle"><?php echo clean($site_name); ?></span>
		</a>
		<?php $page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); ?>
		<ul class="sidebar-nav">
			<li class="sidebar-header">
				
			</li>
			<!-- Dashboard link -->
			<li class="sidebar-item <?php if($page=="dashboard.php"){echo "active";} ?>">
				<a class="sidebar-link" href="dashboard.php">
					<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
				</a>
			</li>
			
			<!-- Hakkımda link -->
			<li class="sidebar-item <?php if($page=="aboutme.php"){echo "active";} ?>">
				<a class="sidebar-link" href="about.php">
					<i class="align-middle" data-feather="user"></i> <span class="align-middle">Hakkımda</span>
				</a>
			</li>

			<!-- Eğitim link -->
			<li class="sidebar-item <?php if($page=="education.php"){echo "active";} ?>">
				<a class="sidebar-link" href="education.php">
					<i class="align-middle" data-feather="book"></i> <span class="align-middle">Eğitim</span>
				</a>
			</li>

			<!-- Özgeçmişim link -->
			<li class="sidebar-item <?php if($page=="portifolio.php"){echo "active";} ?>">
				<a class="sidebar-link" href="portifolio.php">
					<i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Özgeçmişim</span>
				</a>
			</li>

			<!-- İletişim link -->
			<li class="sidebar-item <?php if($page=="contact.php"){echo "active";} ?>">
				<a class="sidebar-link" href="contact.php">
					<i class="align-middle" data-feather="message-square"></i> <span class="align-middle">İletişim</span>
				</a>
			</li>
		
			<!-- Kullanıcılar link -->
			<li class="sidebar-item <?php if($page=="users.php"){echo "active";} ?>">
				<a class="sidebar-link" href="users.php">
					<i class="align-middle" data-feather="users"></i> <span class="align-middle">Kullanıcılar</span>
				</a>
			</li>
			
			<!-- Ayarlar link -->
			<li class="sidebar-item <?php if($page=="settings.php"){echo "active";} ?>">
				<a class="sidebar-link" href="settings.php">
					<i class="align-middle" data-feather="settings"></i> <span class="align-middle">Ayarlar</span>
				</a>

				</li>
			</ul>
		</div>
	</nav>