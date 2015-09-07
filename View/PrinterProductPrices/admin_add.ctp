<div class="printerProductPrices row">
	<div class="actions col-md-3 span3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
	
				<li><?php echo $this->Html->link(__('List Printer Product Prices'), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List Printer Products'), array('controller' => 'printer_products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer Product'), array('controller' => 'printer_products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="printerProductPrices col-md-6 span9">
												
	<?php echo $this->Form->create('PrinterProductPrice', array('inputDefaults' => array( 'class' => 'form-control', 'div' => 'control-group', 'label' => array('class' => 'control-label'), 'wrapInput' => 'controls'), 'class' => 'form-horizontal'));?>
		<fieldset>
			<legend><?php echo __('Admin Add Printer Product Price'); ?></legend>
		<?php
		echo $this->Form->input('printer_product_id');
		echo $this->Form->input('min_page', array('label'=>array('text'=>'Minimaal aantal pagina\'s')));
		echo $this->Form->input('max_page', array('label'=>array('text'=>'Maximaal aantal pagina\'s')));
		echo $this->Form->input('product_price', array('label'=>array('text'=>'Verkoopprijs (excl. verzending, formaat: 00.00)')));
		echo $this->Form->input('handling_price', array('label'=>array('text'=>'Kosten voor verzending (en eventueel shipping en handling, formaat: 00.00)')));
		echo $this->Form->input('page_price', array('label'=>array('text'=>'Prijs per (extra) pagina')));
		echo $this->Form->input('method', array('label'=>array('text'=>'Methode van berekenen van de prijs'), 'options'=> array(1=>'Vaste prijs (ongeacht aantal pagina\'s)',2=>'Prijs berekend per page (zonder verkoopprijs)',3=>'Variable prijs (ongebruikt)', 4=>'Verkoopprijs + bedrag per pagina'), 'default'=>4));
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