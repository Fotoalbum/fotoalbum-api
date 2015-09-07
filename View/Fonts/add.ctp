<div class="fonts form">
<?php echo $this->Form->create('Font'); ?>
	<fieldset>
		<legend><?php echo __('Add Font'); ?></legend>
	<?php
		echo $this->Form->input('category_id');
		echo $this->Form->input('fontName');
		echo $this->Form->input('fontOrig');
		echo $this->Form->input('fontSwf');
		echo $this->Form->input('fontExtension');
		echo $this->Form->input('fontPath');
		echo $this->Form->input('metatags');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Fonts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
