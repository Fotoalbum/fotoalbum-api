<table class="table" width="100%" cellspacing="0" cellpadding="10" class="container">
	<tr>
		<td>
			<p class="atitle">Geachte meneer, mevrouw,</p>
			<p class="adesc">
				Er is een verzoek gedaan om het wachtwoord voor de Fotoalbum.nl - Albumviewer te wijzigen. Klik op onderstaand link om het wachtwoord opnieuw in te stellen.<br>
				<br>
				<a href="<?php echo Router::url(array('admin' => false, 'plugin' => 'users', 'controller' => 'users', 'action' => 'reset_password', $token), true); ?>"><?php echo Router::url(array('admin' => false, 'plugin' => 'users', 'controller' => 'users', 'action' => 'reset_password', $token), true); ?></a>
				<br/>
				<br>
				Heeft u het wachtwoord niet opgevraagd, negeer dan deze e-mail.
			</p>
			<br>
			<p class="atitle">
				Met vriendelijke groet,<br>
				Het Fotoalbum.nl Team
			</p>
		</td>
	</tr>
</table>
