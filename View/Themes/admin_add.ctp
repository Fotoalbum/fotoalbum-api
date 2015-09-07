<div class="themes row">
	<div class="actions col-md-3 span3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
	
				<li><?php echo $this->Html->link(__('List Themes'), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="themes col-md-6 span9">
												
	<?php echo $this->Form->create('Theme', array('inputDefaults' => array( 'class' => 'form-control', 'div' => 'control-group', 'label' => array('class' => 'control-label'), 'wrapInput' => 'controls'), 'class' => 'form-horizontal'));?>
		<fieldset>
			<legend><?php echo __('Admin Add Theme'); ?></legend>
		<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('product_id');
		echo $this->Form->input('name');
		echo $this->Form->input('pages_xml');
		echo $this->Form->input('textflow_xml');
		echo $this->Form->input('textlines_xml');
		echo $this->Form->input('photo_xml');
		echo $this->Form->input('color_xml');
		echo $this->Form->input('metadata_xml');
		echo $this->Form->input('single_product_xml');
		echo $this->Form->input('directory');
		echo $this->Form->input('file_name');
		echo $this->Form->input('numpages');
		echo $this->Form->input('active');
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