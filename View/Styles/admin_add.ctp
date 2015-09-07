<div class="styles row">
	<div class="actions col-md-3 span3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
	
				<li><?php echo $this->Html->link(__('List Styles'), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List Backgrounds'), array('controller' => 'backgrounds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Background'), array('controller' => 'backgrounds', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Masks'), array('controller' => 'masks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mask'), array('controller' => 'masks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stickers'), array('controller' => 'stickers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sticker'), array('controller' => 'stickers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="styles col-md-6 span9">
												
	<?php echo $this->Form->create('Style', array('inputDefaults' => array( 'class' => 'form-control', 'div' => 'control-group', 'label' => array('class' => 'control-label'), 'wrapInput' => 'controls'), 'class' => 'form-horizontal'));?>
		<fieldset>
			<legend><?php echo __('Admin Add Style'); ?></legend>
		<?php
		echo $this->Form->input('name');
	?>
			<div class="form-actions">
	<?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary pull-right','div'=>false));?>
<?php echo $this->Html->link(__('Cancel'),array('controller' => 'stickers', 'action' => 'index'),array('class'=>'btn btn-cancel'));?>
			</div>
			</fieldset>
	<?php echo $this->Form->end();?>
	</div>
	
	<div class="actions col-md-3 span3">
		&nbsp;
	</div>
</div>