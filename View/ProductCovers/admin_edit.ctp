<div class="productCovers row">
	<div class="actions col-md-3 span3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
	
				<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ProductCover.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ProductCover.id'))); ?></li>
				<li><?php echo $this->Html->link(__('List Product Covers'), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List Printer Products'), array('controller' => 'printer_products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer Product'), array('controller' => 'printer_products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="productCovers col-md-6 span9">
												
	<?php echo $this->Form->create('ProductCover', array('inputDefaults' => array( 'class' => 'form-control', 'div' => 'control-group', 'label' => array('class' => 'control-label'), 'wrapInput' => 'controls'), 'class' => 'form-horizontal'));?>
		<fieldset>
			<legend><?php echo __('Admin Edit Product Cover'); ?></legend>
		<?php
		echo $this->Form->input('id');
		//echo $this->Form->input('printer_id');
		echo $this->Form->input('name', array('label'=>array('text'=>'Naam van de cover (xml)')));
		echo $this->Form->input('title', array('label'=>array('text'=>'Naam van de cover (website)')));
		echo $this->Form->input('width', array('label'=>array('text'=>'Breedte in mm')));
		echo $this->Form->input('height', array('label'=>array('text'=>'Hoogte in mm')));
		echo $this->Form->input('bleed', array('label'=>array('text'=>'Bleed in mm'), 'default'=>'3'));
		echo $this->Form->input('wrap', array('label'=>array('text'=>'Wrap in mm'), 'default'=>'30'));
		echo $this->Form->input('product_paperweight_id', array('label'=>array('text'=>'Papierdikte')));
		echo $this->Form->input('product_papertype_id', array('label'=>array('text'=>'Papiersoort')));
		echo $this->Form->input('product_finish_id', array('label'=>array('text'=>'Afwerking')));
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