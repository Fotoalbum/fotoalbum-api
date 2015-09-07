<div class="stickers row">
	<div class="actions col-md-3 span3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
	
				<li><?php echo $this->Html->link(__('List Stickers'), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List Styles'), array('controller' => 'styles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Style'), array('controller' => 'styles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sticker Styles'), array('controller' => 'sticker_styles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sticker Style'), array('controller' => 'sticker_styles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sticker Types'), array('controller' => 'sticker_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sticker Type'), array('controller' => 'sticker_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="stickers col-md-6 span9">
												
	<?php echo $this->Form->create('Sticker', array('inputDefaults' => array( 'class' => 'form-control', 'div' => 'control-group', 'label' => array('class' => 'control-label'), 'wrapInput' => 'controls'), 'class' => 'form-horizontal'));?>
		<fieldset>
			<legend><?php echo __('Admin Add Sticker'); ?></legend>
		<?php
		echo $this->Form->input('name');
		echo $this->Form->input('category_id');
		echo $this->Form->input('style_id');
		echo $this->Form->input('type_id');
		echo $this->Form->input('directory');
		echo $this->Form->input('hires');
		echo $this->Form->input('bytesize');
		echo $this->Form->input('width');
		echo $this->Form->input('height');
		echo $this->Form->input('metatags');
		echo $this->Form->input('Category');
		echo $this->Form->input('Tag');
	?>
			<div class="form-actions">
	<?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary pull-right','div'=>false));?>
<?php echo $this->Html->link(__('Cancel'),array('controller' => 'tags', 'action' => 'index'),array('class'=>'btn btn-cancel'));?>
			</div>
			</fieldset>
	<?php echo $this->Form->end();?>
	</div>
	
	<div class="actions col-md-3 span3">
		&nbsp;
	</div>
</div>