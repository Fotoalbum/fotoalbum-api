<div class="productFinishes row">
	<div class="actions col-md-3 span3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
	
				<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ProductFinish.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ProductFinish.id'))); ?></li>
				<li><?php echo $this->Html->link(__('List Product Finishes'), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List Printers'), array('controller' => 'printers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer'), array('controller' => 'printers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Covers'), array('controller' => 'product_covers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Cover'), array('controller' => 'product_covers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="productFinishes col-md-6 span9">
												
	<?php echo $this->Form->create('ProductFinish', array('inputDefaults' => array( 'class' => 'form-control', 'div' => 'control-group', 'label' => array('class' => 'control-label'), 'wrapInput' => 'controls'), 'class' => 'form-horizontal'));?>
		<fieldset>
			<legend><?php echo __('Admin Edit Product Finish'); ?></legend>
				<?php
		echo $this->Form->input('id');
		echo $this->Form->input('printer_id');
		echo $this->Form->input('name');
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('image');
		echo $this->Form->input('code');
	?>
			<div class="form-actions">
			<?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary pull-right','div'=>false));?>
<?php echo $this->Html->link(__('Cancel'),array('controller' => 'product_covers', 'action' => 'index'),array('class'=>'btn btn-cancel'));?>
			</div>
			</fieldset>
	<?php echo $this->Form->end();?>
	</div>
	
	<div class="actions col-md-3 span3">
		&nbsp;
	</div>
</div>