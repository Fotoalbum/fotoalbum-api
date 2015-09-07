<div class="productShapes view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Product Shape'), array('action' => 'edit', $productShape['ProductShape']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Product Shape'), array('action' => 'delete', $productShape['ProductShape']['id']), null, __('Are you sure you want to delete # %s?', $productShape['ProductShape']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Shapes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Shape'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Printers'), array('controller' => 'printers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer'), array('controller' => 'printers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Product Shape');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($productShape['ProductShape']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Printer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productShape['Printer']['name'], array('controller' => 'printers', 'action' => 'view', $productShape['Printer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($productShape['ProductShape']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($productShape['ProductShape']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($productShape['ProductShape']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php echo h($productShape['ProductShape']['image']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($productShape['ProductShape']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($productShape['ProductShape']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($productShape['ProductShape']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
