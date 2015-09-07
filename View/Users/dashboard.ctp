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
 
$this->Html->script('dashboard', array('block' => 'scriptBottomVendors'));
 
$check_items = array('first_name','last_name','username','biography','birthday','address','zip','city','country');
foreach($check_items as $check_item)
{
	if (!isset($user['UserDetail']['User'][$check_item]))
	{
		$user['UserDetail']['User'][$check_item] = '';
	}
}

if (!isset($albums))
{
	$albums = array();
}

$invitationsHolder = $invitations;

?>
<div class="row-fluid">
	<div class="col-md-12">
	
		<?php echo $this->Session->flash(); ?>

		<!-- Resume starts -->
	
		<div class="resume">
			<div class="row-fluid">
				<?php
				if (!empty($user['User']['picture']))
				{		
					?>
					<div class="col-md-2">
						<div class="thumbnail">
							<?php
								echo $this->Html->link(
												$this->Html->image('/files/users/'.$user['User']['picture_dir'].'/'.$user['User']['picture']),
												array('plugin' => 'users', 'controller' => 'users', 'action' => 'edit'),
												array('escape' => FALSE)
								);
							?>
						</div>
					</div>
				<?php
				}												
				else
				{
					?>
					<div class="col-md-1">
						<div><?php echo $this->Html->image('tmp/no_gravatar_available.jpg'); ?></div>
					</div>
					<?php
				}
				?>
				<div class="col-md-10">
					<h2><?php echo $user['UserDetail']['User']['first_name'];?> <?php echo $user['UserDetail']['User']['last_name'];?> <span class="rsmall"><span class="color">@</span><?php echo $user['User']['username'];?></span></h2>
					<p><?php echo $user['UserDetail']['User']['biography'];?></p>
				</div>
			</div>
			<br clear="all">
			<div class="row-fluid">			
				<div class="col-md-12">
					<hr />
					<!-- Resume -->
					
					<div class="row-fluid">
						<div class="col-md-12">
						
						   <!-- About -->
						   <div class="rblock">
							  <div class="row-fluid">
								 <div class="col-md-3">
									<h4><?php echo __d('fotoalbum','Name');?>/<?php echo __d('fotoalbum','Address');?></h4>                            
								 </div>
								 <div class="col-md-9">
									<div class="rinfo">
									   <div class="pull-right">
											<?php
												echo $this->Html->link(
													'<i class="icon-edit"></i> '.__d('fotoalbum','edit'),
													array('plugin' => 'users', 'controller' => 'users', 'action' => 'edit'),
													array('escape' => FALSE)
												);
											?>
									   </div>
									   <h5><?php echo $user['UserDetail']['User']['first_name'];?> <?php echo $user['UserDetail']['User']['last_name'];?></h5>
									   <div class="rmeta">
											@<?php echo $user['User']['username'];?> 
											<?php
											if (!empty($user['UserDetail']['User']['birthday']))
											{
												echo '('.$user['UserDetail']['User']['birthday'].')';
											}
											?>
										</div>
									   <p>
									   <address>
											<?php echo $user['UserDetail']['User']['address'];?><br>
											<?php echo $user['UserDetail']['User']['zip'];?> <?php echo $user['UserDetail']['User']['city'];?><br>
											<?php 
											if (isset($countryList[$user['UserDetail']['User']['country']]))
											{
												echo $countryList[$user['UserDetail']['User']['country']];
											}
											?>
										</address>
									   </p>
										  <!-- Social media icons -->
											 <div class="social">
												<?php
												$social_array = array('facebook','twitter','linkedin','google-plus','pinterest');
												foreach ($social_array as $social_item)
												{
													if (!empty($user['UserDetail']['User'][$social_item]))
													{
														echo $this->Html->link(
															'<i class="icon-'.$social_item.'"></i>',
															$user['UserDetail']['User'][$social_item],
															array(
																'escape' => false,
																'target' => '_blank'
															)
														);
														echo '&nbsp;';
													}
												}
												?> 
											 </div>  
									</div>
								 </div>
							  </div>
						   </div>
						</div>
					</div>
						
				</div>
			</div>
		</div>
						<!-- Resume ends -->
						
	</div>
</div>
