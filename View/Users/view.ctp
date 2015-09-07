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
?>

      <div class="row-fluid">
         <div class="col-md-12">
            
            <!-- Resume starts -->
            
            <div class="resume">
			<div class="row-fluid">
				<?php
				if (!empty($user['User']['picture']))
				{		
					?>
					<div class="col-md-2">
						<div class="thumbnail"><?php echo $this->Html->image('/files/users/'.$user['User']['picture_dir'].'/'.$user['User']['picture']); ?></div>
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
                        
                           <!-- About -->
                           <div class="rblock">
                              <div class="row-fluid">
                                 <div class="col-md-3">
                                    <h4><?php echo __d('fotoalbum','Name');?></h4>                            
                                 </div>
                                 <div class="col-md-9">
                                    <div class="rinfo">
                                       <h5><?php echo $user['UserDetail']['User']['first_name'];?> <?php echo $user['UserDetail']['User']['last_name'];?></h5>
                                       <div class="rmeta"><?php echo $user['User']['username'];?></div>
									   <!--
                                       <p>
									   <address>
											<?php echo $user['UserDetail']['User']['address'];?><br>
											<?php echo $user['UserDetail']['User']['zip'];?> <?php echo $user['UserDetail']['User']['city'];?><br>
											<?php echo $user['UserDetail']['User']['country'];?>
										</address>
									   </p>
									   -->
                                          <!-- Social media icons -->
										  <!--
											 <div class="social">
												  <a href="#"><i class="icon-facebook"></i></a>
												  <a href="#"><i class="icon-twitter"></i></a>
												  <a href="#"><i class="icon-linkedin"></i></a>
												  <a href="#"><i class="icon-google-plus"></i></a>
												  <a href="#"><i class="icon-pinterest"></i></a>
											 </div>  
										  -->
										 <hr>
										 <p><?php 
										 if (isset($user['UserDetail']['User']['biography']))
										 {
											 echo $user['UserDetail']['User']['biography'];
										 }
										 else
										 {
											?>
											<br>
											<br>
											<br>
											<?php 
										 }
										 ?></p>	
										 									  
                                    </div>
                                 </div>
                              </div>
                           </div>
                           
						   <a name="public-books"></a>
						   <div class="rblock">
							  <div class="row-fluid">
								 <div class="col-md-3">
									<h4><?php echo __d('fotoalbum','Public books');?></h4>                          
								 </div>
								 <div class="col-md-9">
									<div class="rinfo">
										<div class="row-fluid">
											<div class="col-md-12">
												<?php
												if ( (isset($orders)) && (count($orders)>0) )
												{
													echo $this->element('library_rows', array('items'=>$albums, 'row_count'=>4, 'edit'=>false, 'description'=>false));
												}
												else
												{
													?>
													<p style="margin-top:10px"><?php echo __d('fotoalbum','You don\'t have any public albums yet!'); ?></p>
													<?php
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
            </div>
            
            
            <!-- Resume ends -->
            
         </div>
      </div>
