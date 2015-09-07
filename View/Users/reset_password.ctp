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
								<h3><?php echo __d('fotoalbum','Choose a new password for');?> <span class="color"><?php echo $site_name;?></span></h3>                              
								<hr />
								<?php echo $this->Session->flash(); ?>
								<div class="form">					
									<?php
										echo $this->Form->create($model, array(
											'inputDefaults' => array(
												'label' => false,
												'div' => false
											),
											'url' => array(
												'action' => 'reset_password',
												$token
											),											
											'class' => 'form-horizontal'
										));	
										echo $this->Form->input('new_password', array('type' => 'password', 'class' => 'input-large', 'label'=> __d('fotoalbum','Password'), 'placeholder'=>__d('fotoalbum','New password'), 'prepend'=>'<i class="icon-asterisk"></i>')).' ';
										echo $this->Form->input('confirm_password', array('type' => 'password', 'class' => 'input-large', 'label'=> __d('fotoalbum','Confirm'), 'placeholder'=>__d('fotoalbum','Confrm password'), 'prepend'=>'<i class="icon-asterisk"></i>')).' ';
										$options = 	array
													(
														'label' => __d('fotoalbum','Submit'),
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
