<div class="productSingles view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Product Single'), array('action' => 'edit', $productSingle['ProductSingle']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Product Single'), array('action' => 'delete', $productSingle['ProductSingle']['id']), null, __('Are you sure you want to delete # %s?', $productSingle['ProductSingle']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Singles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Single'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Product Single');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($productSingle['ProductSingle']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productSingle['Product']['name'], array('controller' => 'products', 'action' => 'view', $productSingle['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($productSingle['ProductSingle']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Preview'); ?></dt>
		<dd>
			<?php echo h($productSingle['ProductSingle']['preview']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('X'); ?></dt>
		<dd>
			<?php echo h($productSingle['ProductSingle']['x']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Y'); ?></dt>
		<dd>
			<?php echo h($productSingle['ProductSingle']['y']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Colors'); ?></dt>
		<dd>
			<?php echo h($productSingle['ProductSingle']['colors']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($productSingle['ProductSingle']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($productSingle['ProductSingle']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($productSingle['ProductSingle']['created']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
