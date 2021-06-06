<?php
?>
<div class="nav-wrapper">
	<ul class="nav flex-column">
		<li class="nav-item">
			<a class="<?php echo ($current_menu == 'admin')?'nav-link active':'nav-link' ?>" href="http://192.168.43.254/idjobfinder/admin">
				<i class="material-icons">admin_panel_settings</i>
				<span>Admin</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="<?php echo ($current_menu == 'user')?'nav-link active':'nav-link' ?>" href="http://192.168.43.254/idjobfinder/user">
				<i class="material-icons">person</i>
				<span>Pengguna</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="<?php echo ($current_menu == 'job')?'nav-link active':'nav-link' ?>" href="http://192.168.43.254/idjobfinder/job">
				<i class="material-icons">work</i>
				<span>Pekerjaan</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="<?php echo ($current_menu == 'application')?'nav-link active':'nav-link' ?>" href="http://192.168.43.254/idjobfinder/applicant">
				<i class="material-icons">cloud_done</i>
				<span>Lamaran</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="<?php echo ($current_menu == 'logout')?'nav-link active':'nav-link' ?>" href="http://192.168.43.254/idjobfinder/logout">
				<i class="material-icons">logout</i>
				<span>Keluar</span>
			</a>
		</li>
	</ul>
</div>
