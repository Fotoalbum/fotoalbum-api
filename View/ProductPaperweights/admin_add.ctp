<div class="productPaperweights row">
	<div class="actions col-md-3 span3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
	
				<li><?php echo $this->Html->link(__('List Product Paperweights'), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List Printers'), array('controller' => 'printers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer'), array('controller' => 'printers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="productPaperweights col-md-6 span9">
												
	<?php echo $this->Form->create('ProductPaperweight', array('inputDefaults' => array( 'class' => 'form-control', 'div' => 'control-group', 'label' => array('class' => 'control-label'), 'wrapInput' => 'controls'), 'class' => 'form-horizontal'));?>
		<fieldset>
			<legend><?php echo __('Admin Add Product Paperweight'); ?></legend>
		<?php
		echo $this->Form->input('printer_id');
		echo $this->Form->input('name', array('label'=>array('text'=>'Naam van de papierdikte')));
		echo $this->Form->input('title', array('label'=>array('text'=>'Naam voor op website')));
		echo $this->Form->input('description', array('label'=>array('text'=>'Omschrijving voor op website')));
		echo $this->Form->input('image', array('label'=>array('text'=>'Afbeelding voor op website')));
		echo $this->Form->input('code', array('label'=>array('text'=>'Korte code voor factuur/inventarisatie')));
		echo $this->Form->input('api_code', array('label'=>array('text'=>'Korte code voor api (integer!)')));		
	?>
			<div class="form-actions">
	<?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary pull-right','div'=>false));?>
<?php echo $this->Html->link(__('Cancel'),array('controller' => 'products', 'action' => 'index'),array('class'=>'btn btn-cancel'));?>
			</div>
			</fieldset>
	<?php echo $this->Form->end();?>
	</div>
	
	<div class="actions col-md-3 span3">
		&nbsp;
	</div>
</div>