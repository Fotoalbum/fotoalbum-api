<div class="printerProductCovers row">
	<div class="actions col-md-3 span3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
	
				<li><?php echo $this->Html->link(__('List Printer Product Covers'), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List Printer Products'), array('controller' => 'printer_products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer Product'), array('controller' => 'printer_products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="printerProductCovers col-md-6 span9">
												
	<?php echo $this->Form->create('PrinterProductCover', array('inputDefaults' => array( 'class' => 'form-control', 'div' => 'control-group', 'label' => array('class' => 'control-label'), 'wrapInput' => 'controls'), 'class' => 'form-horizontal'));?>
		<fieldset>
			<legend><?php echo __('Admin Add Printer Product Cover'); ?></legend>
		<?php
		echo $this->Form->input('name');
		echo $this->Form->input('hardbound');
		echo $this->Form->input('hardbound_type');
		echo $this->Form->input('headbandcolor');
		echo $this->Form->input('endpapercolor');
		echo $this->Form->input('spineform');
		echo $this->Form->input('laminate');
	?>
			<div class="form-actions">
	<?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary pull-right','div'=>false));?>
<?php echo $this->Html->link(__('Cancel'),array('controller' => 'printer_products', 'action' => 'index'),array('class'=>'btn btn-cancel'));?>
			</div>
			</fieldset>
	<?php echo $this->Form->end();?>
	</div>
	
	<div class="actions col-md-3 span3">
		&nbsp;
	</div>
</div>