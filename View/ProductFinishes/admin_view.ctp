<div class="productFinishes view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Product Finish'), array('action' => 'edit', $productFinish['ProductFinish']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Product Finish'), array('action' => 'delete', $productFinish['ProductFinish']['id']), null, __('Are you sure you want to delete # %s?', $productFinish['ProductFinish']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Finishes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Finish'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Printers'), array('controller' => 'printers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer'), array('controller' => 'printers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Covers'), array('controller' => 'product_covers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Cover'), array('controller' => 'product_covers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Product Finish');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($productFinish['ProductFinish']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Printer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productFinish['Printer']['name'], array('controller' => 'printers', 'action' => 'view', $productFinish['Printer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($productFinish['ProductFinish']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($productFinish['ProductFinish']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($productFinish['ProductFinish']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php echo h($productFinish['ProductFinish']['image']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($productFinish['ProductFinish']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($productFinish['ProductFinish']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($productFinish['ProductFinish']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
	<div class="row">
		<div class="related col-md-10 col-md-offset-2">
			<hr>
			<h3><?php echo __('Related Product Covers');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New Product Cover'), array('controller' => 'product_covers', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($productFinish['ProductCover'])):?>
			<table class="table">
				<tr>
							<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Width'); ?></th>
		<th><?php echo __('Height'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
					<th class="actions"><?php echo __('Actions');?></th>
				</tr>
					<?php
		$i = 0;
		foreach ($productFinish['ProductCover'] as $productCover): ?>
		<tr>
			<td><?php echo $productCover['id'];?></td>
			<td><?php echo $productCover['name'];?></td>
			<td><?php echo $productCover['width'];?></td>
			<td><?php echo $productCover['height'];?></td>
			<td><?php echo $productCover['created'];?></td>
			<td><?php echo $productCover['modified'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'product_covers', 'action' => 'view', $productCover['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'product_covers', 'action' => 'edit', $productCover['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'product_covers', 'action' => 'delete', $productCover['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $productCover['id'])); ?>
				</div>
			</div>
			</td>
		</tr>
	<?php endforeach; ?>
			</table>
	<?php endif; ?>

		</div>
	</div>
