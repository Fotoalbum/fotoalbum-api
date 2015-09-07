<div class="masks form">
<?php echo $this->Form->create('Mask'); ?>
	<fieldset>
		<legend><?php echo __('Add Mask'); ?></legend>
	<?php
		echo $this->Form->input('label');
		echo $this->Form->input('category_id');
		echo $this->Form->input('directory');
		echo $this->Form->input('hires');
		echo $this->Form->input('bytesize');
		echo $this->Form->input('width');
		echo $this->Form->input('height');
		echo $this->Form->input('metatags');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Masks'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
