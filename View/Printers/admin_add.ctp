<div class="printers row">
	<div class="actions col-md-3 span3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
	
				<li><?php echo $this->Html->link(__('List Printers'), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List Memberships'), array('controller' => 'memberships', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Membership'), array('controller' => 'memberships', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Printer Products'), array('controller' => 'printer_products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer Product'), array('controller' => 'printer_products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Papertypes'), array('controller' => 'product_papertypes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Papertype'), array('controller' => 'product_papertypes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Paperweights'), array('controller' => 'product_paperweights', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Paperweight'), array('controller' => 'product_paperweights', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="printers col-md-6 span9">
												
	<?php echo $this->Form->create('Printer', array('inputDefaults' => array( 'class' => 'form-control', 'div' => 'control-group', 'label' => array('class' => 'control-label'), 'wrapInput' => 'controls'), 'class' => 'form-horizontal'));?>
		<fieldset>
			<legend><?php echo __('Admin Add Printer'); ?></legend>
		<?php
		echo $this->Form->input('name');
		echo $this->Form->input('name', array('label'=>array('text'=>'Naam van de printer')));
		echo $this->Form->input('payee_name', array('label'=>array('text'=>'Naam van de printer (voor facturatie)')));
		echo $this->Form->input('website', array('label'=>array('text'=>'URL van de site van de printer')));
		echo $this->Form->input('kvk_nr', array('label'=>array('text'=>'Nummer Kamer van Koophandel')));
		echo $this->Form->input('bank_nr', array('label'=>array('text'=>'Bankrekeningnummer van de printer')));
		echo $this->Form->input('bank', array('label'=>array('text'=>'Naam van de bank')));
		echo $this->Form->input('bic', array('label'=>array('text'=>'BIC nummer')));
		echo $this->Form->input('iban', array('label'=>array('text'=>'IBAN nummer')));
		echo $this->Form->input('vat_nr', array('label'=>array('text'=>'BTW nummer')));
		echo $this->Form->input('description', array('label'=>array('text'=>'Korte omschrijving over de printer')));
		//echo $this->Form->input('membership_id');
		//echo $this->Form->input('filename');
		//echo $this->Form->input('directory');
	?>
			<div class="form-actions">
	<?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary pull-right','div'=>false));?>
<?php echo $this->Html->link(__('Cancel'),array('controller' => 'product_paperweights', 'action' => 'index'),array('class'=>'btn btn-cancel'));?>
			</div>
			</fieldset>
	<?php echo $this->Form->end();?>
	</div>
	
	<div class="actions col-md-3 span3">
		&nbsp;
	</div>
</div>