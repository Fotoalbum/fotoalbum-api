<p class="atitle">Geachte meneer, mevrouw,</p>
<p class="adesc">
	<?php
		echo __d('fotoalbum', 'Your password has been reset');
		echo __d('fotoalbum', 'Please login using this password and change your password');
	?>
	<br>
	<?php
		echo 	__d('fotoalbum', 'Your new password is: %s', $userData[$model]['new_password']);
	?>
</p>
<br>
<p class="atitle">
	Met vriendelijke groet,<br>
	Het Fotoalbum.nl Team
</p>
