<div class="responses form">
<?php echo $this->Form->create('Response'); ?>
	<fieldset>
		<legend><?php echo __('Edit Response'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('report_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Response.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Response.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Responses'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Reports'), array('controller' => 'reports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Report'), array('controller' => 'reports', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Answers'), array('controller' => 'answers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Answer'), array('controller' => 'answers', 'action' => 'add')); ?> </li>
	</ul>
</div>