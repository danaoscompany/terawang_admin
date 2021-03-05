<?php
?>
<div class="nav-wrapper">
	<ul class="nav flex-column">
		<li class="nav-item">
			<a class="<?php echo ($current_menu == 'admin')?'nav-link active':'nav-link' ?>" href="http://terawang.co/admin/admin">
				<i class="material-icons">admin_panel_settings</i>
				<span>Admin</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="<?php echo ($current_menu == 'user')?'nav-link active':'nav-link' ?>" href="http://terawang.co/admin/user">
				<i class="material-icons">person</i>
				<span>Pengguna</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="<?php echo ($current_menu == 'notification')?'nav-link active':'nav-link' ?>" href="http://terawang.co/admin/notification">
				<i class="material-icons">notifications</i>
				<span>Notifikasi</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="<?php echo ($current_menu == 'question')?'nav-link active':'nav-link' ?>" href="http://terawang.co/admin/question">
				<i class="material-icons">help</i>
				<span>Pertanyaan</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="<?php echo ($current_menu == 'city')?'nav-link active':'nav-link' ?>" href="http://terawang.co/admin/city">
				<i class="material-icons">apartment</i>
				<span>Kota</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="<?php echo ($current_menu == 'credit')?'nav-link active':'nav-link' ?>" href="http://terawang.co/admin/credit">
				<i class="material-icons">monetization_on</i>
				<span>Harga Kredit <Kredit></Kredit></span>
			</a>
		</li>
		<li class="nav-item">
			<a class="<?php echo ($current_menu == 'premium')?'nav-link active':'nav-link' ?>" href="http://terawang.co/admin/premium">
				<i class="material-icons">local_offer</i>
				<span>Harga Premium <Kredit></Kredit></span>
			</a>
		</li>
		<li class="nav-item">
			<a class="<?php echo ($current_menu == 'quote')?'nav-link active':'nav-link' ?>" href="http://terawang.co/admin/quote">
				<i class="material-icons">format_quote</i>
				<span>Quote <Kredit></Kredit></span>
			</a>
		</li>
		<li class="nav-item">
			<a class="<?php echo ($current_menu == 'settings')?'nav-link active':'nav-link' ?>" href="http://terawang.co/admin/settings">
				<i class="material-icons">settings</i>
				<span>Pengaturan <Kredit></Kredit></span>
			</a>
		</li>
		<li class="nav-item">
			<a class="<?php echo ($current_menu == 'howto')?'nav-link active':'nav-link' ?>" href="http://terawang.co/admin/howto">
				<i class="material-icons">help</i>
				<span>Cara Kerja <Kredit></Kredit></span>
			</a>
		</li>
		<li class="nav-item">
			<a class="<?php echo ($current_menu == 'terms')?'nav-link active':'nav-link' ?>" href="http://terawang.co/admin/terms">
				<i class="material-icons">error</i>
				<span>Kebijakan Penggunaan <Kredit></Kredit></span>
			</a>
		</li>
		<li class="nav-item">
			<a class="<?php echo ($current_menu == 'privacy_policy')?'nav-link active':'nav-link' ?>" href="http://terawang.co/admin/privacypolicy">
				<i class="material-icons">privacy_tip</i>
				<span>Kebijakan Privasi <Kredit></Kredit></span>
			</a>
		</li>
		<li class="nav-item">
			<a class="<?php echo ($current_menu == 'logout')?'nav-link active':'nav-link' ?>" href="http://terawang.co/admin/logout">
				<i class="material-icons">logout</i>
				<span>Keluar</span>
			</a>
		</li>
	</ul>
</div>
