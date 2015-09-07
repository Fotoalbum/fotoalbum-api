<div class="backgroundTypes row">
	<div class="actions col-md-3 span3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
	
				<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('BackgroundType.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('BackgroundType.id'))); ?></li>
				<li><?php echo $this->Html->link(__('List Background Types'), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List Backgrounds'), array('controller' => 'backgrounds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Background'), array('controller' => 'backgrounds', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="backgroundTypes col-md-6 span9">
												
	<?php echo $this->Form->create('BackgroundType', array('inputDefaults' => array( 'class' => 'form-control', 'div' => 'control-group', 'label' => array('class' => 'control-label'), 'wrapInput' => 'controls'), 'class' => 'form-horizontal'));?>
		<fieldset>
			<legend><?php echo __('Admin Edit Background Type'); ?></legend>
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('background_id');
		echo $this->Form->input('type_id');
	?>
			<div class="form-actions">
	<?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary pull-right','div'=>false));?>
<?php echo $this->Html->link(__('Cancel'),array('controller' => 'types', 'action' => 'index'),array('class'=>'btn btn-cancel'));?>
			</div>
			</fieldset>
	<?php echo $this->Form->end();?>
	</div>
	
	<div class="actions col-md-3 span3">
		&nbsp;
	</div>
</div>