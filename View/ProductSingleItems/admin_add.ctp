<div class="productSingleItems row">
	<div class="actions col-md-3 span3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
	
				<li><?php echo $this->Html->link(__('List Product Single Items'), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List Product Singles'), array('controller' => 'product_singles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Single'), array('controller' => 'product_singles', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="productSingleItems col-md-6 span9">
												
	<?php echo $this->Form->create('ProductSingleItem', array('inputDefaults' => array( 'class' => 'form-control', 'div' => 'control-group', 'label' => array('class' => 'control-label'), 'wrapInput' => 'controls'), 'class' => 'form-horizontal'));?>
		<fieldset>
			<legend><?php echo __('Admin Add Product Single Item'); ?></legend>
		<?php
		echo $this->Form->input('product_single_id', array('options'=>$productSingles));
		echo $this->Form->input('title');
		echo $this->Form->input('x', array('label'=>'(nulpunt ligt op 250! Maximale hoogte = 875px )'));
		echo $this->Form->input('y', array('label'=>'(nulpunt ligt op 225! Maxiamale hoogte = 500px)'));
		echo $this->Form->input('colors', array('label'=>'Kommagescheiden lijst van HTML-kleuren'));
		echo $this->Form->input('price', array('label'=>'Formaat: 00.00'));
		echo $this->Form->input('zChangeable');
		echo $this->Form->input('removeable');
		echo $this->Form->input('draggable');
		echo $this->Form->input('rotatable');
		echo $this->Form->input('resizeable');
		echo $this->Form->input('default');
		//echo $this->Form->input('status');
	?>
			<div class="form-actions">
	<?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary pull-right','div'=>false));?>
<?php echo $this->Html->link(__('Cancel'),array('controller' => 'product_singles', 'action' => 'index'),array('class'=>'btn btn-cancel'));?>
			</div>
			</fieldset>
	<?php echo $this->Form->end();?>
	</div>
	
	<div class="actions col-md-3 span3">
		&nbsp;
	</div>
</div>