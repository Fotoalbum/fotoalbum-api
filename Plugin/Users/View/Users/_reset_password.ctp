<div class="users form">
<h2><?php echo __d('fotoalbum', 'Reset your password'); ?></h2>
<?php
	echo $this->Form->create($model, array(
		'url' => array(
			'action' => 'reset_password',
			$token)));
	echo $this->Form->input('new_password', array(
		'label' => __d('fotoalbum', 'New Password'),
		'type' => 'password'));
	echo $this->Form->input('confirm_password', array(
		'label' => __d('fotoalbum', 'Confirm'),
		'type' => 'password'));
	echo $this->Form->submit(__d('fotoalbum', 'Submit'));
	echo $this->Form->end();
?>
</div>
<?php echo $this->element('Users/sidebar'); ?>