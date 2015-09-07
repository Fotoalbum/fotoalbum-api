<div class="productSingleItemContainers row">
	<div class="actions col-md-3 span3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
	
				<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ProductSingleItemContainer.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ProductSingleItemContainer.id'))); ?></li>
				<li><?php echo $this->Html->link(__('List Product Single Item Containers'), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List Product Single Items'), array('controller' => 'product_single_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Single Item'), array('controller' => 'product_single_items', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="productSingleItemContainers col-md-6 span9">
												
	<?php echo $this->Form->create('ProductSingleItemContainer', array('inputDefaults' => array( 'class' => 'form-control', 'div' => 'control-group', 'label' => array('class' => 'control-label'), 'wrapInput' => 'controls'), 'class' => 'form-horizontal'));?>
		<fieldset>
			<legend><?php echo __('Admin Edit Product Single Item Container'); ?></legend>
				<?php
		echo $this->Form->input('id');
		echo $this->Form->input('product_single_item_id');
		echo $this->Form->input('x');
		echo $this->Form->input('y');
		echo $this->Form->input('width');
		echo $this->Form->input('height');
	?>
			<div class="form-actions">
			<?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary pull-right','div'=>false));?>
<?php echo $this->Html->link(__('Cancel'),array('controller' => 'product_single_items', 'action' => 'index'),array('class'=>'btn btn-cancel'));?>
			</div>
			</fieldset>
	<?php echo $this->Form->end();?>
	</div>
	
	<div class="actions col-md-3 span3">
		&nbsp;
	</div>
</div>