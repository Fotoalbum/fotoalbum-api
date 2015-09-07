<div class="productSingleContainers view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Product Single Container'), array('action' => 'edit', $productSingleContainer['ProductSingleContainer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Product Single Container'), array('action' => 'delete', $productSingleContainer['ProductSingleContainer']['id']), null, __('Are you sure you want to delete # %s?', $productSingleContainer['ProductSingleContainer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Single Containers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Single Container'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Singles'), array('controller' => 'product_singles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Single'), array('controller' => 'product_singles', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Product Single Container');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($productSingleContainer['ProductSingleContainer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product Single'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productSingleContainer['ProductSingle']['title'], array('controller' => 'product_singles', 'action' => 'view', $productSingleContainer['ProductSingle']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('X'); ?></dt>
		<dd>
			<?php echo h($productSingleContainer['ProductSingleContainer']['x']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Y'); ?></dt>
		<dd>
			<?php echo h($productSingleContainer['ProductSingleContainer']['y']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Width'); ?></dt>
		<dd>
			<?php echo h($productSingleContainer['ProductSingleContainer']['width']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Height'); ?></dt>
		<dd>
			<?php echo h($productSingleContainer['ProductSingleContainer']['height']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($productSingleContainer['ProductSingleContainer']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($productSingleContainer['ProductSingleContainer']['created']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
