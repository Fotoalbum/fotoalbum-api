            <br>
			<br>
			<!-- 404 starts -->
            
			<div class="error">
				<div class="row-fluid">
					<div class="col-md-3">&nbsp;</div>
					<div class="col-md-6">
						<div class="error-page">
							<?php
							if ($show_login)
							{
								?>
								<div class="col-md-12">
									<div class="logreg-page">
										<h3><?php echo __d('fotoalbum','Sign In to');?> <span class="color"><?php echo $site_name;?></span></h3>
										                             
										<hr />
										<div class="alert alert-error">
											<h4><?php echo $error;?></h4>
										</div>
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
												echo $this->Form->input('return_to',				array('type'=>'hidden',		'default' => $this->here));	 // for Invitation								
												echo $this->Form->input('email', array('class' => 'input-large', 'label'=> __d('fotoalbum','Username'), 'placeholder'=>__d('fotoalbum','Email or username'), 'prepend'=>'<i class="icon-envelope"></i>')).' ';
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
									</div>
								</div>
								<?php
							}
							else
							{
								?>
								<p class="error-med"><?php echo __d('fotoalbum','Access denied');?><span class="color">!!!</span></p>                        
								<p class="error-big"></p>
								<div class="alert alert-error">
									<h4><?php echo $error;?></h4>
								</div>
								<p></p> 
								<p class="error-small"><?php echo __d('fotoalbum','if you believe this is incorrect, please contact us thru the contactform');?> </p>
								<?php
							}
							?>
							<br clear="all">
						</div>
					</div>
					<div class="col-md-3">&nbsp;</div>
				</div>
			</div>
            
            <!-- 404 ends -->
			<br>
			<br>			
