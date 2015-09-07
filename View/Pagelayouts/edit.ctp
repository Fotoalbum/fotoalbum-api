<div class="pagelayouts form">
<?php echo $this->Form->create('Pagelayout'); ?>
	<fieldset>
		<legend><?php echo __('Edit Pagelayout'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('label');
		echo $this->Form->input('pagetype');
		echo $this->Form->input('pageshape');
		echo $this->Form->input('photoNum');
		echo $this->Form->input('stickerNum');
		echo $this->Form->input('textNum');
		echo $this->Form->input('layout');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Pagelayout.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Pagelayout.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Pagelayouts'), array('action' => 'index')); ?></li>
	</ul>
</div>
