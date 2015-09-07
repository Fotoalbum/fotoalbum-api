<?php
	$this->Html->css('/js/multiple-select/css/bootstrap-multiselect.css', null, array('block'=>'css'));
	$this->Html->script('/js/multiple-select/js/bootstrap-multiselect.js', array('block' => 'script'));
	$this->Html->script('/js/common.js', array('block' => 'script'));	
	
?>


	<div class="productSupplements row">
		<div class="actions col-md-3 span3">
			<ul class="nav nav-list">
				<li class="nav-header"><?php echo __('Actions'); ?></li>
				<li><?php echo $this->Html->link(__('List Product Supplements'), array('action' => 'index'));?></li>
				<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List Supplements'), array('controller' => 'supplements', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Supplement'), array('controller' => 'supplements', 'action' => 'add')); ?> </li>
			</ul>
		</div>
		<div class="productSupplements col-md-6 span9">
									
			<?php echo $this->Form->create('ProductSupplement', array('inputDefaults' => array( 'class' => 'form-control', 'div' => 'control-group', 'label' => array('class' => 'control-label'), 'wrapInput' => 'controls'), 'class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Admin Add Product Supplement'); ?></legend>
				<div class="col-md-5">
					<?php
						echo $this->Form->input('supplement_id', array('class'=>'col-md-10'));
					?>
				</div>
				<div class="col-md-5 col-md-offset-1">
					<?php
						echo $this->Form->input('product_id', array('class'=>'col-md-10','type'=>'select', 'multiple'=>'true'));						
					?>
				</div>	
				<br clear="all" class="clearfix">			
				<div class="form-actions col-md-12">
					<?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary pull-right','div'=>false));?>
					<?php echo $this->Html->link(__('Cancel'),array('controller' => 'supplements', 'action' => 'index'),array('class'=>'btn btn-cancel'));?>
				</div>
			</fieldset>
			<?php echo $this->Form->end();?>
		</div>
		
		<div class="actions col-md-3 span3">&nbsp;</div>
	</div>