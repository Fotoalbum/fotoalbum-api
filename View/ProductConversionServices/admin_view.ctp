<div class="productConversionServices view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Product Conversion Service'), array('action' => 'edit', $productConversionService['ProductConversionService']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Product Conversion Service'), array('action' => 'delete', $productConversionService['ProductConversionService']['id']), null, __('Are you sure you want to delete # %s?', $productConversionService['ProductConversionService']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Conversion Services'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Conversion Service'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Conversions'), array('controller' => 'product_conversions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Conversion'), array('controller' => 'product_conversions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Products'), array('controller' => 'user_products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Product'), array('controller' => 'user_products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Product Conversion Service');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($productConversionService['ProductConversionService']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productConversionService['User']['id'], array('controller' => 'users', 'action' => 'view', $productConversionService['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product Conversion'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productConversionService['ProductConversion']['name'], array('controller' => 'product_conversions', 'action' => 'view', $productConversionService['ProductConversion']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productConversionService['Product']['name'], array('controller' => 'products', 'action' => 'view', $productConversionService['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productConversionService['UserProduct']['name'], array('controller' => 'user_products', 'action' => 'view', $productConversionService['UserProduct']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mcf Content'); ?></dt>
		<dd>
			<?php echo h($productConversionService['ProductConversionService']['mcf_content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Photos'); ?></dt>
		<dd>
			<?php echo h($productConversionService['ProductConversionService']['photos']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($productConversionService['ProductConversionService']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lang'); ?></dt>
		<dd>
			<?php echo h($productConversionService['ProductConversionService']['lang']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($productConversionService['ProductConversionService']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($productConversionService['ProductConversionService']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
