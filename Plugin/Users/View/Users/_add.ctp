<?php
/**
 * Copyright 2010 - 2013, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2013, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<div class="users form">
	<h2><?php echo __d('fotoalbum', 'Add User'); ?></h2>
	<fieldset>
		<?php
			echo $this->Form->create($model);
			echo $this->Form->input('username', array(
				'label' => __d('fotoalbum', 'Username')));
			echo $this->Form->input('email', array(
				'label' => __d('fotoalbum', 'E-mail (used as login)'),
				'error' => array('isValid' => __d('fotoalbum', 'Must be a valid email address'),
				'isUnique' => __d('fotoalbum', 'An account with that email already exists'))));
			echo $this->Form->input('password', array(
				'label' => __d('fotoalbum', 'Password'),
				'type' => 'password'));
			echo $this->Form->input('temppassword', array(
				'label' => __d('fotoalbum', 'Password (confirm)'),
				'type' => 'password'));
			$tosLink = $this->Html->link(__d('fotoalbum', 'Terms of Service'), array('controller' => 'pages', 'action' => 'tos', 'plugin' => null));
			echo $this->Form->input('tos', array(
				'label' => __d('fotoalbum', 'I have read and agreed to ') . $tosLink));
			echo $this->Form->end(__d('fotoalbum', 'Submit'));
		?>
	</fieldset>
</div>
<?php echo $this->element('Users/sidebar'); ?>
