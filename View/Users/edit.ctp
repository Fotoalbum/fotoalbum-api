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
$this->Html->script('vendor/datepicker/js/bootstrap-datepicker', array('block' => 'scriptBottomVendors'));
$this->Html->script('users', array('block' => 'scriptBottomVendors'));
$this->Html->css('/js/vendor/datepicker/css/datepicker', null, array('block'=>'css'));
?>

      <div class="row-fluid">
         <div class="col-md-12">
            
			<?php echo $this->Session->flash(); ?>

            <!-- Resume starts -->
			<?php
				echo $this->Form->create($model, array(
					'inputDefaults' => array(
						'div' => false,
						'class' => 'input-xxlarge',
					),
					'type' => 'file',
					'class' => 'form-horizontal'
				));	            
			?>
            <div class="resume">
               <div class="row-fluid">
                  <div class="col-md-12">
                     <h2><?php echo $this->data['UserDetail']['first_name'];?> <?php echo $this->data['UserDetail']['last_name'];?> <span class="rsmall"><span class="color">@</span><?php echo $user['User']['username'];?></span></h2>
                     <p><?php echo __d('fotoalbum','Edit your profile');?></p>
                     <hr />
                     <!-- Resume -->
                     
                     <div class="row-fluid">
                        <div class="col-md-12">
                        
                           <!-- About -->
                           <div class="rblock">
                              <div class="row-fluid">
                                 <div class="col-md-3">
                                    <h4><?php echo __d('fotoalbum','Name');?></h4>                            
                                 </div>
                                 <div class="col-md-9">
                                    <div class="rinfo">
                                       <h5>&nbsp;</h5>
                                       <div class="rmeta">&nbsp;</div>									
                                       <fieldset>
										<?php
											if (!empty($this->data['User']['username']))
											{
												echo $this->Form->input('User.username', array('class' => 'input-large', 'disabled' => true, 'label' => __d('fotoalbum','Username'), 'value' => $user['User']['username'], 'after'=>'<a href="javascript:;;" rel="tooltip" title="'. __('You can not change you username.'). '">&nbsp;<i class="icon-question-sign"></i></a>'));
											}
											echo $this->Form->input('UserDetail.first_name', array('label'=>__d('fotoalbum','First name')));
											echo $this->Form->input('UserDetail.last_name', array('label'=>__d('fotoalbum','Last name')));
											echo $this->Form->input('UserDetail.language', array('type'=>'select','options'=>$languageList,'label'=>__d('fotoalbum','Language')));										
											echo $this->Form->input('UserDetail.biography', array('type'=>'textarea','label'=>__d('fotoalbum','Biography')));
											
											$div_data = array(
															'data-date-viewmode' => 'years',
															'data-date-format'=>'dd-mm-yyyy',
															'data-date'=>'',
															'id'=>'dpYears', 
															'class'=>'input-append date'
														);
											
										?>
										<div class="control-group">
											<?php echo $this->Form->label('UserDetail.birthday',__d('fotoalbum','Birthday'), array('class'=>'control-label')); ?>
											<div class="controls">
												<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="12-02-2012" id="dpYears" class="input-append date datepicker">
													<?php echo $this->Form->input('UserDetail.birthday', array('label'=>false, 'class'=>'input-large', 'div'=>false)); ?>
													<span class="add-on"><i class="icon-calendar"></i></span>
												</div>
											</div>
										</div>
										<div class="control-group">
												<div class="col-md-2 thumbnail" style="margin-left:40px">
													<?php
													if (!empty($this->data)) {
														echo $this->Form->hidden('User.picture', array('value'=>$this->data['User']['picture'], 'readonly'=>true));
														echo $this->Form->hidden('User.picture_dir', array('value'=>$this->data['User']['picture_dir'], 'readonly'=>true));		
														if (!empty($this->data['User']['picture']))
														{						
															echo $this->Html->image('/files/users/'.$this->data['User']['picture_dir'].'/'.$this->data['User']['picture']);
														}												
													}
													?>
												</div>
											</label>
											<div class="controls">
												<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="12-02-2012" id="dpYears" class="input-append date datepicker">
													<?php echo $this->Form->input('User.picture', array('type'=>'file','label'=>false, 'class'=>'input-large', 'div'=>false)); ?>
												</div>
											</div>
										</div>										
										<br clear="all">
										
										</fieldset>
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
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <!-- About -->
                           <div class="rblock">
                              <div class="row-fluid">
                                 <div class="col-md-3">
                                    <h4><?php echo __d('fotoalbum','Address');?></h4>                            
                                 </div>
                                 <div class="col-md-9">
                                    <div class="rinfo">
                                       <h5>&nbsp;</h5>
                                       <div class="rmeta">&nbsp;</div>
									
										<fieldset>
										<?php
											echo $this->Form->input('UserDetail.address', array('label'=>__d('fotoalbum','Street')));
											echo $this->Form->input('UserDetail.zip', array('class'=>'span3', 'label'=>__d('fotoalbum','Zipcode')));
											echo $this->Form->input('UserDetail.city', array('class'=>'span5', 'label'=>__d('fotoalbum','City')));
											echo $this->Form->input('UserDetail.country', array('type'=>'select','options'=>$countryList,'label'=>__d('fotoalbum','Country')));
										?>												   
									   </fieldset>
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
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <!-- Social -->
                           <div class="rblock">
                              <div class="row-fluid">
                                 <div class="col-md-3">
                                    <h4><?php echo __d('fotoalbum','Social');?></h4>                            
                                 </div>
                                 <div class="col-md-9">
                                    <div class="rinfo">
                                       <h5>&nbsp;</h5>
                                       <div class="rmeta">&nbsp;</div>
									
										<fieldset>
										<?php
											echo $this->Form->input('UserDetail.facebook', array('label'=>__d('fotoalbum','Facebook'), 'placeholder'=>'http://www.facebook.com/naam', 'prepend'=>'<i class="icon-facebook"></i>'));
											echo $this->Form->input('UserDetail.twitter', array('label'=>__d('fotoalbum','Twitter'), 'placeholder'=>'http://www.twitter.com/naam', 'prepend'=>'<i class="icon-twitter"></i>'));
											echo $this->Form->input('UserDetail.linkedin', array('label'=>__d('fotoalbum','LinkedIn'), 'placeholder'=>'http://www.linkedin.com/naam', 'prepend'=>'<i class="icon-linkedin"></i>'));
											echo $this->Form->input('UserDetail.google-plus', array('label'=>__d('fotoalbum','Google+'), 'placeholder'=>'http://www.google+.com/naam', 'prepend'=>'<i class="icon-google-plus"></i>'));
											echo $this->Form->input('UserDetail.pinterest', array('label'=>__d('fotoalbum','Pinterest+'), 'placeholder'=>'http://www.pinterest.com/naam', 'prepend'=>'<i class="icon-pinterest"></i>'));

										?>												   
									   </fieldset>
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
	
	<div class="row-fluid">
	
		<div class='form-actions offset8'>
			<button class="btn" onClick="history.go(-1);">Cancel</button>
			<?php
				$options = 	array
							(
								'label' => __d('fotoalbum','Save'),
								'type' => 'submit',
								'class' => 'btn btn-primary',
								'div' => false
							);				
				echo $this->Form->end($options);            
			?>
		</div>
		
	</div>
