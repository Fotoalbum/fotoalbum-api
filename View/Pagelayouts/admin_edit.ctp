<div class="pagelayouts row">
	<div class="actions col-md-3 span3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
	
				<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Pagelayout.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Pagelayout.id'))); ?></li>
				<li><?php echo $this->Html->link(__('List Pagelayouts'), array('action' => 'index'));?></li>
			</ul>
	</div>
	<div class="pagelayouts col-md-6 span9">
												
	<?php echo $this->Form->create('Pagelayout', array('inputDefaults' => array( 'class' => 'form-control', 'div' => 'control-group', 'label' => array('class' => 'control-label'), 'wrapInput' => 'controls'), 'class' => 'form-horizontal'));?>
		<fieldset>
			<legend><?php echo __('Admin Edit Pagelayout'); ?></legend>
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('pagetype');
		echo $this->Form->input('pageshape');
		echo $this->Form->input('photoNum');
		echo $this->Form->input('stickerNum');
		echo $this->Form->input('textNum');
		echo $this->Form->input('layout');
	?>
			<div class="form-actions">
	<?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary pull-right','div'=>false));?>
<?php echo $this->Html->link(__('Cancel'),array('controller' => '', 'action' => 'index'),array('class'=>'btn btn-cancel'));?>
			</div>
			</fieldset>
	<?php echo $this->Form->end();?>
	</div>
	
	<div class="actions col-md-3 span3">
		&nbsp;
	</div>
</div>