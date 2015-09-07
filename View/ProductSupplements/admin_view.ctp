<div class="productSupplements view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Product Supplement'), array('action' => 'edit', $productSupplement['ProductSupplement']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Product Supplement'), array('action' => 'delete', $productSupplement['ProductSupplement']['id']), null, __('Are you sure you want to delete # %s?', $productSupplement['ProductSupplement']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Supplements'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Supplement'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Supplements'), array('controller' => 'supplements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplement'), array('controller' => 'supplements', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Product Supplement');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($productSupplement['ProductSupplement']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productSupplement['Product']['name'], array('controller' => 'products', 'action' => 'view', $productSupplement['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Supplement'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productSupplement['Supplement']['name'], array('controller' => 'supplements', 'action' => 'view', $productSupplement['Supplement']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($productSupplement['ProductSupplement']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($productSupplement['ProductSupplement']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
