<div class="productSingleItemContainers view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Product Single Item Container'), array('action' => 'edit', $productSingleItemContainer['ProductSingleItemContainer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Product Single Item Container'), array('action' => 'delete', $productSingleItemContainer['ProductSingleItemContainer']['id']), null, __('Are you sure you want to delete # %s?', $productSingleItemContainer['ProductSingleItemContainer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Single Item Containers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Single Item Container'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Single Items'), array('controller' => 'product_single_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Single Item'), array('controller' => 'product_single_items', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Product Single Item Container');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($productSingleItemContainer['ProductSingleItemContainer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product Single Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productSingleItemContainer['ProductSingleItem']['title'], array('controller' => 'product_single_items', 'action' => 'view', $productSingleItemContainer['ProductSingleItem']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('X'); ?></dt>
		<dd>
			<?php echo h($productSingleItemContainer['ProductSingleItemContainer']['x']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Y'); ?></dt>
		<dd>
			<?php echo h($productSingleItemContainer['ProductSingleItemContainer']['y']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Width'); ?></dt>
		<dd>
			<?php echo h($productSingleItemContainer['ProductSingleItemContainer']['width']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Height'); ?></dt>
		<dd>
			<?php echo h($productSingleItemContainer['ProductSingleItemContainer']['height']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($productSingleItemContainer['ProductSingleItemContainer']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($productSingleItemContainer['ProductSingleItemContainer']['created']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
