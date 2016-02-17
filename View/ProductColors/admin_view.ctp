<div class="productColors view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Product Color'), array('action' => 'edit', $productColor['ProductColor']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Product Color'), array('action' => 'delete', $productColor['ProductColor']['id']), null, __('Are you sure you want to delete # %s?', $productColor['ProductColor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Colors'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Color'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Printers'), array('controller' => 'printers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer'), array('controller' => 'printers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Product Color');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($productColor['ProductColor']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Printer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productColor['Printer']['name'], array('controller' => 'printers', 'action' => 'view', $productColor['Printer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($productColor['ProductColor']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($productColor['ProductColor']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($productColor['ProductColor']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php echo h($productColor['ProductColor']['image']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($productColor['ProductColor']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hex'); ?></dt>
		<dd>
			<?php echo h($productColor['ProductColor']['hex']); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($productColor['ProductColor']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($productColor['ProductColor']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
	<div class="row">
		<div class="related col-md-10 col-md-offset-2">
			<hr>
			<h3><?php echo __('Related Products');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($productColor['Product'])):?>
			<table class="table">
				<tr>
							<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
					<th class="actions"><?php echo __('Actions');?></th>
				</tr>
					<?php
		$i = 0;
		foreach ($productColor['Product'] as $product): ?>
		<tr>
			<td><?php echo $product['id'];?></td>
			<td><?php echo $product['name'];?></td>
			<td><?php echo $product['status'];?></td>
			<td><?php echo $product['created'];?></td>
			<td><?php echo $product['modified'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'products', 'action' => 'view', $product['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'products', 'action' => 'edit', $product['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'products', 'action' => 'delete', $product['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $product['id'])); ?>
				</div>
			</div>
			</td>
		</tr>
	<?php endforeach; ?>
			</table>
	<?php endif; ?>

		</div>
	</div>
