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
						<h3><?php echo __d('fotoalbum','Change your password for');?> <span class="color"><?php echo $site_name;?></span></h3>                        
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
								'class' => 'form-horizontal col-md-11',
								'action' => 'change_password'
							));	
							echo $this->Form->input('old_password', array(
								'label' => __d('fotoalbum', 'Old Password'),
								'placeholder'=>__d('fotoalbum','Please, type your current password here!'),
								'type' => 'password',
								'prepend'=>'<i class="icon-asterisk"></i>')
							);
							echo $this->Form->input('new_password', array(
								'label' => __d('fotoalbum', 'New Password'),
								'placeholder'=>__d('fotoalbum','Please, type your new password here!'),
								'type' => 'password',
								'prepend'=>'<i class="icon-asterisk"></i>'));
							echo $this->Form->input('confirm_password', array(
								'label' => __d('fotoalbum', 'Confirm'),
								'placeholder'=>__d('fotoalbum','Please, again type your password here!'),
								'type' => 'password',
								'prepend'=>'<i class="icon-asterisk"></i>'));							
							$options = 	array
										(
											'label' => __d('fotoalbum','Change'),
											'type' => 'submit',
											'class' => 'btn btn-primary pull-right',
											'div' => array('class' => 'form-actions')
										);				
							echo $this->Form->end($options);
	
						?>
						<br clear="all" />	
					</div>                           
				</div>
			</div>
		</div>
			
		<!-- Login ends -->
	</div>
</div>
