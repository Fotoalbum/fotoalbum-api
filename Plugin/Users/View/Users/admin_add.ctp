<div class="users row">
	<div class="actions col-md-3 span3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
	
				<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List User Details'), array('controller' => 'user_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Detail'), array('controller' => 'user_details', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="users col-md-6 span9">
												
	<?php echo $this->Form->create('User', array('inputDefaults' => array( 'class' => 'form-control', 'div' => 'control-group', 'label' => array('class' => 'control-label'), 'wrapInput' => 'controls'), 'class' => 'form-horizontal'));?>
		<fieldset>
			<legend><?php echo __('Admin Add User'); ?></legend>
		<?php
		echo $this->Form->input('username');
		echo $this->Form->input('slug');
		echo $this->Form->input('url');
		echo $this->Form->input('password');
		echo $this->Form->input('password_token');
		echo $this->Form->input('email');
		echo $this->Form->input('email_verified');
		echo $this->Form->input('email_token');
		echo $this->Form->input('email_token_expires');
		echo $this->Form->input('sso_token');
		echo $this->Form->input('sso_token_expires');
		echo $this->Form->input('tos');
		echo $this->Form->input('active');
		echo $this->Form->input('status1');
		echo $this->Form->input('last_login');
		echo $this->Form->input('last_action');
		echo $this->Form->input('is_admin');
		echo $this->Form->input('role');
		echo $this->Form->input('picture');
		echo $this->Form->input('picture_dir');
		echo $this->Form->input('firstname');
		echo $this->Form->input('lastname');
		echo $this->Form->input('address');
		echo $this->Form->input('zip');
		echo $this->Form->input('city');
		echo $this->Form->input('country');
		echo $this->Form->input('telephone');
		echo $this->Form->input('account_number');
		echo $this->Form->input('account_city');
		echo $this->Form->input('account_bank');
		echo $this->Form->input('migrated_to_2');
	?>
			<div class="form-actions">
	<?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary pull-right','div'=>false));?>
<?php echo $this->Html->link(__('Cancel'),array('controller' => 'user_details', 'action' => 'index'),array('class'=>'btn btn-cancel'));?>
			</div>
			</fieldset>
	<?php echo $this->Form->end();?>
	</div>
	
	<div class="actions col-md-3 span3">
		&nbsp;
	</div>
</div>