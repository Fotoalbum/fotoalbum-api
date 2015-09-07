<div class="fonts row">
	<div class="actions col-md-3 span3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
	
				<li><?php echo $this->Html->link(__('List Fonts'), array('action' => 'index'));?></li>
			</ul>
	</div>
	<div class="fonts col-md-6 span9">
												
	<?php echo $this->Form->create('Font', array('inputDefaults' => array( 'class' => 'form-control', 'div' => 'control-group', 'label' => array('class' => 'control-label'), 'wrapInput' => 'controls'), 'class' => 'form-horizontal'));?>
		<fieldset>
			<legend><?php echo __('Admin Add Font'); ?></legend>
		<?php
		echo $this->Form->input('name');
		echo $this->Form->input('swfName');
		echo $this->Form->input('extension');
		echo $this->Form->input('fullPathSwf');
		echo $this->Form->input('fullPathOriginal');
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