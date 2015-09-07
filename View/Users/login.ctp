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
								?>
								<div class="navbar-form pull-right">
									Hallo <?php echo $sessionarray['firstname'];?> <?php echo $sessionarray['lastname'];?>
								</div>
								<?php
							}
							else
							{
								?>
								<h3><?php echo __d('fotoalbum','Sign In to');?> <span class="color"><?php echo $site_name;?></span></h3>                              
								<hr />
								<?php echo $this->Session->flash(); ?>
								<?php echo $this->Session->flash('auth', array(
									'element' => 'alert',
									'params' => array('plugin' => 'BoostCake','class' => 'alert-error'),
								)); ?>
								<div class="form">					
									<?php
										echo $this->Form->create('Users.User', array(
											'inputDefaults' => array(
												'label' => false,
												'div' => false
											),
											'class' => 'form-horizontal',
											'action' => 'login'
										));		
										echo $this->Form->input('email', array('class' => 'input-large', 'label'=> __d('fotoalbum','Username'), 'placeholder'=>__d('fotoalbum','Email or Username'), 'prepend'=>'<i class="icon-envelope"></i>')).' ';
										echo $this->Form->input('password', array('class' => 'input-large', 'label'=> __d('fotoalbum','Password'), 'placeholder'=>__d('fotoalbum','Password'), 'prepend'=>'<i class="icon-asterisk"></i>')).' ';
										$options = 	array
													(
														'label' => __d('fotoalbum','Login'),
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
										echo __d('fotoalbum','Forgot password?').' ';
										echo $this->Html->link(
											__d('fotoalbum','Get a new one here!'),
											array('plugin' => 'users', 'controller' => 'users', 'action' => 'reset_password')
										);
									?>
								</div>

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
