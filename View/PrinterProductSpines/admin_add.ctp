<div class="printerProductSpines row">
	<div class="actions col-md-3 span3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
	
				<li><?php echo $this->Html->link(__('List Printer Product Spines'), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List Printer Products'), array('controller' => 'printer_products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer Product'), array('controller' => 'printer_products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="printerProductSpines col-md-6 span9">
												
	<?php echo $this->Form->create('PrinterProductSpine', array('inputDefaults' => array( 'class' => 'form-control', 'div' => 'control-group', 'label' => array('class' => 'control-label'), 'wrapInput' => 'controls'), 'class' => 'form-horizontal'));?>
		<fieldset>
			<legend><?php echo __('Admin Add Printer Product Spine'); ?></legend>
		<?php
		echo $this->Form->input('printer_product_id');
		echo $this->Form->input('min_page', array('label'=>array('text'=>'Minimaal aantal pagina\'s (voor deze berekening)')));
		echo $this->Form->input('max_page', array('label'=>array('text'=>'Maximaal aantal pagina\'s')));
		echo $this->Form->input('value', array('label'=>array('text'=>'Spinedikte (dikte van de rug, in mm)')));
		echo $this->Form->input('base_value', array('label'=>array('text'=>'Basiswaarde van de spine (in mm, indien noodzakelijk)')));
		echo $this->Form->input('method', array('label'=>array('text'=>'Methode van berekenen van de spine'), 'options'=> array(
																															1 => 'Vaste waarde (waarde van \'Spinedikte\')',
																															2 => 'Variabel (Aantal pagina\'s * \'Spinedikte\')',
																															3 => '\'Basiswaarde\' + \'Spinedikte\'',
																															4 => '\'Basiswaarde\' + Variabel (Aantal pagina\'s * \'Spinedikte\')',
																															5 => '\'Basiswaarde\' + Variabel + 10% ( (Aantal pagina\'s * \'Spinedikte\') * 1.1)',
																															6 => '(((num_pages / 2) / 100) / 80) * paper_weight)'
																														), 'default'=>2));

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