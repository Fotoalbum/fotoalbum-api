<div class="printerProducts row">
	<div class="actions col-md-3 span3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
	
				<li><?php echo $this->Html->link(__('List Printer Products'), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Printers'), array('controller' => 'printers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer'), array('controller' => 'printers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Covers'), array('controller' => 'product_covers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Cover'), array('controller' => 'product_covers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Printer Product Prices'), array('controller' => 'printer_product_prices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer Product Price'), array('controller' => 'printer_product_prices', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Printer Product Spines'), array('controller' => 'printer_product_spines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer Product Spine'), array('controller' => 'printer_product_spines', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="printerProducts col-md-6 span9">
												
	<?php echo $this->Form->create('PrinterProduct', array('inputDefaults' => array( 'class' => 'form-control', 'div' => 'control-group', 'label' => array('class' => 'control-label'), 'wrapInput' => 'controls'), 'class' => 'form-horizontal'));?>
		<fieldset>
			<legend><?php echo __('Admin Add Printer Product'); ?></legend>
		<?php
		echo $this->Form->input('name', array('label'=>array('text'=>'Naam van het printer product (intern)')));
		echo $this->Form->input('xml_name', array('label'=>array('text'=>'XML Naam van het printer product (extern)')));		
		echo $this->Form->input('product_id');
		echo $this->Form->input('printer_id');
		echo $this->Form->input('product_cover_id');
		echo $this->Form->input('printer_product_cover_id');
		echo $this->Form->input('status', array('label'=>array('text'=>'Status van het product (eventueel wel/niet tonen op site, niet meerleverbaar enz enz enz)'),'options'=>array('A'=> 'Actief','T'=>'Verwijderd','D'=>'Niet meer leverbaar')));
	?>
			<div class="form-actions">
	<?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary pull-right','div'=>false));?>
<?php echo $this->Html->link(__('Cancel'),array('controller' => 'printer_product_spines', 'action' => 'index'),array('class'=>'btn btn-cancel'));?>
			</div>
			</fieldset>
	<?php echo $this->Form->end();?>
	</div>
	
	<div class="actions col-md-3 span3">
		&nbsp;
	</div>
</div>