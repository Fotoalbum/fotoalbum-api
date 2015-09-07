<div class="productSingleContainers row">
	<div class="actions col-md-3 span3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
	
				<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ProductSingleContainer.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ProductSingleContainer.id'))); ?></li>
				<li><?php echo $this->Html->link(__('List Product Single Containers'), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List Product Singles'), array('controller' => 'product_singles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Single'), array('controller' => 'product_singles', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="productSingleContainers col-md-6 span9">
												
	<?php echo $this->Form->create('ProductSingleContainer', array('inputDefaults' => array( 'class' => 'form-control', 'div' => 'control-group', 'label' => array('class' => 'control-label'), 'wrapInput' => 'controls'), 'class' => 'form-horizontal'));?>
		<fieldset>
			<legend><?php echo __('Admin Edit Product Single Container'); ?></legend>
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('product_single_id', array('options'=>$productSingles));
		echo $this->Form->input('x', array('label'=>'(nulpunt ligt op 250! Maximale hoogte = 875px )'));
		echo $this->Form->input('y', array('label'=>'(nulpunt ligt op 225! Maxiamale hoogte = 500px)'));
		echo $this->Form->input('width');
		echo $this->Form->input('height');
	?>
			<div class="form-actions">
	<?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary pull-right','div'=>false));?>
<?php echo $this->Html->link(__('Cancel'),array('controller' => 'product_singles', 'action' => 'index'),array('class'=>'btn btn-cancel'));?>
			</div>
			</fieldset>
	<?php echo $this->Form->end();?>
	</div>
	
	<div class="actions col-md-3 span3">
		&nbsp;
	</div>
</div>