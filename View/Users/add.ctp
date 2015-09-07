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
<div class="row-fluid">
	<div class="col-md-12">
	
	<!-- Login starts -->
	
		<div class="logreg">
			<div class="row-fluid">
				<div class="col-md-12">
					<div class="logreg-page">
						<h3><?php echo __d('fotoalbum','Register with');?> <span class="color"><?php echo $site_name;?></span></h3>                        
						<hr />
						<?php echo $this->Session->flash(); ?>
						<div class="form">
						<?php
							echo $this->Form->create($model, array(
								'inputDefaults' => array(
									'label' => false,
									'div' => false,
									'class' => 'input-xlarge',
								),
								'class' => 'form-horizontal'
							));	
							echo $this->Form->input('username', array(
								'label' => __d('fotoalbum', 'Username'),
								'prepend' => '<i class="icon-user"></i>',
								'placeholder'=>__d('fotoalbum','Enter your name here')));
							echo $this->Form->input('email', array(
								'prepend' => '<i class="icon-envelope"></i>',
								'label'=> __d('fotoalbum','Email'),
								'placeholder'=>__d('fotoalbum','Email (used as login)'),
								'error' => array('isValid' => __d('fotoalbum', 'Must be a valid email address'),
								'isUnique' => __d('fotoalbum', 'An account with that email already exists'))));
							echo $this->Form->input('password', array(
								'label' => __d('fotoalbum', 'Password'),
								'prepend' => '<i class="icon-asterisk"></i>',
								'type' => 'password'));
							echo $this->Form->input('temppassword', array(
								'label' => __d('fotoalbum', 'Confirm'),
								'placeholder'=>__d('fotoalbum','Please, again type your password here!'),
								'prepend' => '<i class="icon-asterisk"></i>',
								'type' => 'password'));
							$tosLink = $this->Html->link(__d('fotoalbum', 'Terms of Service'), 'http://www.fotoalbum.nl/voorwaarden.html');
							echo $this->Form->input('tos', array(
								'label' => false,
								'after' => sprintf(__d('fotoalbum', 'I have read and agreed to the %s'), $tosLink)));
							$options = 	array
										(
											'label' => __d('fotoalbum','Register'),
											'type' => 'submit',
											'class' => 'btn btn-primary',
											'div' => array('class' => 'form-actions')
										);				
							echo $this->Form->end($options);
	
						?>
	
	
						<hr />
						<div class="lregister">
							<?php
								echo __d('fotoalbum','Already have account with us?').' ';
								echo $this->Html->link(
									__d('fotoalbum','Login'),
									array('controller' => 'users', 'action' => 'login')
								);
							?>
						</div>
						<br clear="all" />	
					</div>                           
				</div>
			</div>
		</div>
			
		<!-- Login ends -->
	</div>
</div>

<?php //echo $this->element('Users/sidebar'); ?>
