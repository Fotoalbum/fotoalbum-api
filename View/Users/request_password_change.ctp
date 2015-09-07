<div class="row-fluid">
	<div class="col-md-12">
	
	<!-- Login starts -->
	
		<div class="logreg">
			<div class="row-fluid">
				<div class="col-md-12">
					<div class="logreg-page">
						<?php 
							if (isset($sessionarray['id']))
							{
								echo $this->Session->flash();
								echo $this->Html->link(
									__d('fotoalbum','Goto your dashboard'),
									array('plugin' => 'users', 'controller' => 'users', 'action' => 'dashboard')
								);
							}
							else
							{
								?>
								<h3><?php echo __d('fotoalbum','Forgot your');?> <span class="color"><?php echo __d('fotoalbum','password');?>?</span></h3>                              
								<hr />
								<p><?php echo __d('fotoalbum', 'Please enter the email you used for registration and you\'ll get an email with further instructions.'); ?></p>
								<?php echo $this->Session->flash(); ?>
								<div class="form">					
									<?php
										echo $this->Form->create($model, array(
											'inputDefaults' => array(
												'label' => false,
												'div' => false
											),
											'url' => array(
												'admin' => false,
												'action' => 'reset_password'
											),											
											'class' => 'form-horizontal'
										));	
										echo $this->Form->input('email', array('class' => 'input-large', 'label'=> __d('fotoalbum','Email'), 'placeholder'=>__d('fotoalbum','Email'), 'prepend'=>'<i class="icon-envelope"></i>')).' ';
										$options = 	array
													(
														'label' => __d('fotoalbum','Send a new password'),
														'type' => 'submit',
														'class' => 'btn btn-primary',
														'div' => array('class' => 'form-actions')
													);				
										echo $this->Form->end($options);
									?>
								</div>
								<hr />
								<div class="lregister">
									<?php
										echo __d('fotoalbum','Don\'t have account?').' ';
										echo $this->Html->link(
											__d('fotoalbum','Register'),
											array('plugin' => 'users', 'controller' => 'users', 'action' => 'add')
										);
									?>
								</div>
								<br clear="all" />
								<?php
							}
						?>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Login ends -->
	</div>	
</div>
