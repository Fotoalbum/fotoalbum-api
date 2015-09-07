<div class="products row">
	<div class="actions col-md-3 span3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
	
				<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Product.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Product.id'))); ?></li>
				<li><?php echo $this->Html->link(__('List Products'), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List Product Paperweights'), array('controller' => 'product_paperweights', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Paperweight'), array('controller' => 'product_paperweights', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Papertypes'), array('controller' => 'product_papertypes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Papertype'), array('controller' => 'product_papertypes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Covers'), array('controller' => 'product_covers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Cover'), array('controller' => 'product_covers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="products col-md-6 span9">
												
	<?php echo $this->Form->create('Product', array('inputDefaults' => array( 'class' => 'form-control', 'div' => 'control-group', 'label' => array('class' => 'control-label'), 'wrapInput' => 'controls'), 'class' => 'form-horizontal'));?>
		<fieldset>
			<legend><?php echo __('Admin Edit Product'); ?></legend>
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label'=>array('text'=>'Naam van het product op de website')));
		echo $this->Form->input('cover', array('label'=>array('text'=>'Heeft het product een cover? Aangevinkt: Ja')));
		echo $this->Form->input('bblock', array('label'=>array('text'=>'Heeft het product een binnenwerk? Aangevinkt: Ja')));
		echo $this->Form->input('start_with', array('label'=>array('text'=>'Opties zijn: spread|page'),'options'=>array('spread'=>'spread','page'=>'page')));
		echo $this->Form->input('use_spread', array('label'=>array('text'=>'Aangevinkt: Het product heeft spreads.<br/>Niet aangevinkt: Product heeft alleen single pages')));
		echo $this->Form->input('min_page', array('label'=>array('text'=>'Het minimale aantal pagina\'s')));
		echo $this->Form->input('max_page', array('label'=>array('text'=>'Het maximale aantal pagina\'s')));
		echo $this->Form->input('stepsize', array('label'=>array('text'=>'Aantal pagina\'s die je per keer kunt toevoegen'), 'default'=>4));
		echo $this->Form->input('page_width', array('label'=>array('text'=>'De breedte van het product (in mm)')));
		echo $this->Form->input('page_height', array('label'=>array('text'=>'De hoogte van het product (in mm)')));
		echo $this->Form->input('page_bleed', array('label'=>array('text'=>'Bleed in mm'), 'default'=>'3'));
		echo $this->Form->input('paper_name', array('label'=>array('text'=>'Naam van het papier voor op website')));
		echo $this->Form->input('weight', array('label'=>array('text'=>'Hoe zwaar is dit boek (voor de berekening van de verzendkosten)')));
		echo $this->Form->input('product_paperweight_id', array('label'=>array('text'=>'Papierdikte')));
		echo $this->Form->input('product_papertype_id', array('label'=>array('text'=>'Papiersoort')));
		echo $this->Form->input('product_cover_id', array('label'=>array('text'=>'Indien nodig, kies hier de cover')));
		echo $this->Form->input('status', array('label'=>array('text'=>'Status van het product (eventueel wel/niet tonen op site, niet meerleverbaar enz enz enz)'),'options'=>array('A'=> 'Actief','T'=>'Verwijderd','D'=>'Niet meer leverbaar')));
	?>
			<div class="form-actions">
	<?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary pull-right','div'=>false));?>
<?php echo $this->Html->link(__('Cancel'),array('controller' => 'product_covers', 'action' => 'index'),array('class'=>'btn btn-cancel'));?>
			</div>
			</fieldset>
	<?php echo $this->Form->end();?>
	</div>
	
	<div class="actions col-md-3 span3">
		&nbsp;
	</div>
</div>