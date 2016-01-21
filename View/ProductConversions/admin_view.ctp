<div class="productConversions view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Product Conversion'), array('action' => 'edit', $productConversion['ProductConversion']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Product Conversion'), array('action' => 'delete', $productConversion['ProductConversion']['id']), null, __('Are you sure you want to delete # %s?', $productConversion['ProductConversion']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Conversions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Conversion'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Conversion Services'), array('controller' => 'product_conversion_services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Conversion Service'), array('controller' => 'product_conversion_services', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Product Conversion');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($productConversion['ProductConversion']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productConversion['Product']['name'], array('controller' => 'products', 'action' => 'view', $productConversion['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($productConversion['ProductConversion']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Exact'); ?></dt>
		<dd>
			<?php echo h($productConversion['ProductConversion']['exact']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
	<div class="row">
		<div class="related col-md-10 col-md-offset-2">
			<hr>
			<h3><?php echo __('Related Product Conversion Services');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New Product Conversion Service'), array('controller' => 'product_conversion_services', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($productConversion['ProductConversionService'])):?>
			<table class="table">
				<tr>
							<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
					<th class="actions"><?php echo __('Actions');?></th>
				</tr>
					<?php
		$i = 0;
		foreach ($productConversion['ProductConversionService'] as $productConversionService): ?>
		<tr>
			<td><?php echo $productConversionService['id'];?></td>
			<td><?php echo $productConversionService['user_id'];?></td>
			<td><?php echo $productConversionService['status'];?></td>
			<td><?php echo $productConversionService['created'];?></td>
			<td><?php echo $productConversionService['modified'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'product_conversion_services', 'action' => 'view', $productConversionService['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'product_conversion_services', 'action' => 'edit', $productConversionService['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'product_conversion_services', 'action' => 'delete', $productConversionService['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $productConversionService['id'])); ?>
				</div>
			</div>
			</td>
		</tr>
	<?php endforeach; ?>
			</table>
	<?php endif; ?>

		</div>
	</div>
