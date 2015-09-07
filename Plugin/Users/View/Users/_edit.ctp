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
	<?php echo $this->Form->create($model); ?>
		<fieldset>
			<legend><?php echo __d('fotoalbum', 'Edit User'); ?></legend>
			<?php
				echo $this->Form->input('UserDetail.first_name');
				echo $this->Form->input('UserDetail.last_name');
				echo $this->Form->input('UserDetail.biography');
				echo $this->Form->input('UserDetail.birthday');
			?>
			<legend><?php echo __d('fotoalbum', 'Edit Address'); ?></legend>
			<?php
				echo $this->Form->input('UserDetail.address');
				echo $this->Form->input('UserDetail.zip');
				echo $this->Form->input('UserDetail.city');
				echo $this->Form->input('UserDetail.country');
			?>			
			<p>
				<?php echo $this->Html->link(__d('fotoalbum', 'Change your password'), array('action' => 'change_password')); ?>
			</p>
		</fieldset>
	<?php echo $this->Form->end(__d('fotoalbum', 'Submit')); ?>
</div>
<?php echo $this->element('Users/sidebar'); ?>