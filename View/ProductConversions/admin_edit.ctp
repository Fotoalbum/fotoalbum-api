<div class="productConversions row">
	<div class="actions col-md-3 span3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
	
				<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ProductConversion.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ProductConversion.id'))); ?></li>
				<li><?php echo $this->Html->link(__('List Product Conversions'), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Conversion Services'), array('controller' => 'product_conversion_services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Conversion Service'), array('controller' => 'product_conversion_services', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="productConversions col-md-6 span9">
												
	<?php echo $this->Form->create('ProductConversion', array('inputDefaults' => array( 'class' => 'form-control', 'div' => 'control-group', 'label' => array('class' => 'control-label'), 'wrapInput' => 'controls'), 'class' => 'form-horizontal'));?>
		<fieldset>
			<legend><?php echo __('Admin Edit Product Conversion'); ?></legend>
				<?php
		echo $this->Form->input('id');
		echo $this->Form->input('product_id');
		echo $this->Form->input('name');
		echo $this->Form->input('exact');
	?>
			<div class="form-actions">
			<?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary pull-right','div'=>false));?>
<?php echo $this->Html->link(__('Cancel'),array('controller' => 'product_conversion_services', 'action' => 'index'),array('class'=>'btn btn-cancel'));?>
			</div>
			</fieldset>
	<?php echo $this->Form->end();?>
	</div>
	
	<div class="actions col-md-3 span3">
		&nbsp;
	</div>
</div>