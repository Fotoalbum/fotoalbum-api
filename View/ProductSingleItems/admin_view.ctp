<div class="productSingleItems view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Product Single Item'), array('action' => 'edit', $productSingleItem['ProductSingleItem']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Product Single Item'), array('action' => 'delete', $productSingleItem['ProductSingleItem']['id']), null, __('Are you sure you want to delete # %s?', $productSingleItem['ProductSingleItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Single Items'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Single Item'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Singles'), array('controller' => 'product_singles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Single'), array('controller' => 'product_singles', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Product Single Item');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($productSingleItem['ProductSingleItem']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product Single'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productSingleItem['ProductSingle']['title'], array('controller' => 'product_singles', 'action' => 'view', $productSingleItem['ProductSingle']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($productSingleItem['ProductSingleItem']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('X'); ?></dt>
		<dd>
			<?php echo h($productSingleItem['ProductSingleItem']['x']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Y'); ?></dt>
		<dd>
			<?php echo h($productSingleItem['ProductSingleItem']['y']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Colors'); ?></dt>
		<dd>
			<?php echo h($productSingleItem['ProductSingleItem']['colors']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($productSingleItem['ProductSingleItem']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ZChangeable'); ?></dt>
		<dd>
			<?php echo h($productSingleItem['ProductSingleItem']['zChangeable']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Removeable'); ?></dt>
		<dd>
			<?php echo h($productSingleItem['ProductSingleItem']['removeable']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Draggable'); ?></dt>
		<dd>
			<?php echo h($productSingleItem['ProductSingleItem']['draggable']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rotatable'); ?></dt>
		<dd>
			<?php echo h($productSingleItem['ProductSingleItem']['rotatable']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Resizeable'); ?></dt>
		<dd>
			<?php echo h($productSingleItem['ProductSingleItem']['resizeable']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Default'); ?></dt>
		<dd>
			<?php echo h($productSingleItem['ProductSingleItem']['default']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($productSingleItem['ProductSingleItem']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($productSingleItem['ProductSingleItem']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($productSingleItem['ProductSingleItem']['status']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
