<div class="productSingles row">
	<div class="actions col-md-3 span3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
	
				<li><?php echo $this->Html->link(__('List Product Singles'), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="productSingles col-md-6 span9">
												
	<?php echo $this->Form->create('ProductSingle', array('inputDefaults' => array( 'class' => 'form-control', 'div' => 'control-group', 'label' => array('class' => 'control-label'), 'wrapInput' => 'controls'), 'class' => 'form-horizontal'));?>
		<fieldset>
			<legend><?php echo __('Admin Add Product Single'); ?></legend>
		<?php
		echo $this->Form->input('product_id', array('options'=>$products));
		echo $this->Form->input('title');
		echo $this->Form->input('preview');
		echo $this->Form->input('x', array('label'=>'X-as (nulpunt ligt op 130! Maximaal = 700px )'));
		echo $this->Form->input('y', array('label'=>'Y-as (nulpunt ligt op 185! Maximale = 700px)'));
		echo $this->Form->input('colors', array('label'=>'Kommagescheiden lijst van HTML-kleuren'));
		echo $this->Form->input('price', array('label'=>'Prijs (formaat: 00.00)'));
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