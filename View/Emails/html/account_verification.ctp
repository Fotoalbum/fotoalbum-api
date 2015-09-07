<p class="atitle">Geachte meneer, mevrouw,</p>
<p class="adesc">
	U heeft een account aangemaakt op de Fotoalbum.nl - Albumviewer. Met de Albumviewer kunt u fotoalbums online bekijken en delen. <br>
	<br>
	Uw inloggegevens:<br>
	Gebruikersnaam: <?php echo $user[$model]['username'];?><br>
	Wachtwoord: <em>(reeds bij u bekend)</em><br />
	<br>
<pre style="width:75%; margin-left:10px; margin-right:10px;"><span style="color:#333; padding:0px; line-height:10px;">Bevestig uw registratie binnen 24 uur:</span>
<a href="<?php echo Router::url(array('admin' => false, 'plugin' => 'users', 'controller' => 'users', 'action' => 'verify', 'email', $user[$model]['email_token']), true);?>"><?php echo Router::url(array('admin' => false, 'plugin' => 'users', 'controller' => 'users', 'action' => 'verify', 'email', $user[$model]['email_token']), true);?></a>
</pre>	
	<br>
	Heeft u nog nooit een fotoalbum gemaakt? Kies dat uit ons grote assortiment van fotoalbums, kaften en papiersoorten. Ga naar de website van <a href="http://www.fotoalbum.nl">Fotoalbum.nl</a>.<br>
	<br>
	Veel plezier met het maken, bekijken en delen van fotoalbums!
</p>
<br>
<p class="atitle">
	Met vriendelijke groet,<br>
	Het Fotoalbum.nl Team
</p>
