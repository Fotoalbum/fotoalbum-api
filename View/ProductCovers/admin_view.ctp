<div class="productCovers view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Product Cover'), array('action' => 'edit', $productCover['ProductCover']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Product Cover'), array('action' => 'delete', $productCover['ProductCover']['id']), null, __('Are you sure you want to delete # %s?', $productCover['ProductCover']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Covers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Cover'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Printer Products'), array('controller' => 'printer_products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer Product'), array('controller' => 'printer_products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Product Cover');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($productCover['ProductCover']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Printer Id'); ?></dt>
		<dd>
			<?php echo h($productCover['ProductCover']['printer_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($productCover['ProductCover']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Width'); ?></dt>
		<dd>
			<?php echo h($productCover['ProductCover']['width']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Height'); ?></dt>
		<dd>
			<?php echo h($productCover['ProductCover']['height']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bleed'); ?></dt>
		<dd>
			<?php echo h($productCover['ProductCover']['bleed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Wrap'); ?></dt>
		<dd>
			<?php echo h($productCover['ProductCover']['wrap']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product Paperweight'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productCover['ProductPaperweight']['title'], array('controller' => 'product_paperweights', 'action' => 'view', $productCover['ProductPaperweight']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product Papertype'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productCover['ProductPapertype']['title'], array('controller' => 'product_papertypes', 'action' => 'view', $productCover['ProductPapertype']['id'])); ?>
			&nbsp;
		</dd>
	
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($productCover['ProductCover']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($productCover['ProductCover']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
	<div class="row">
		<div class="related col-md-10 col-md-offset-2">
			<hr>
			<h3><?php echo __('Related Printer Products');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New Printer Product'), array('controller' => 'printer_products', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($productCover['PrinterProduct'])):?>
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
		foreach ($productCover['PrinterProduct'] as $printerProduct): ?>
		<tr>
			<td><?php echo $printerProduct['id'];?></td>
			<td><?php echo $printerProduct['name'];?></td>
			<td><?php echo $printerProduct['status'];?></td>
			<td><?php echo $printerProduct['created'];?></td>
			<td><?php echo $printerProduct['modified'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'printer_products', 'action' => 'view', $printerProduct['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'printer_products', 'action' => 'edit', $printerProduct['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'printer_products', 'action' => 'delete', $printerProduct['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $printerProduct['id'])); ?>
				</div>
			</div>
			</td>
		</tr>
	<?php endforeach; ?>
			</table>
	<?php endif; ?>

		</div>
	</div>
	<div class="row">
		<div class="related col-md-10 col-md-offset-2">
			<hr>
			<h3><?php echo __('Related Products');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($productCover['Product'])):?>
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
		foreach ($productCover['Product'] as $product): ?>
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
