<div class="products view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Product'), array('action' => 'edit', $product['Product']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Product'), array('action' => 'delete', $product['Product']['id']), null, __('Are you sure you want to delete # %s?', $product['Product']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Paperweights'), array('controller' => 'product_paperweights', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Paperweight'), array('controller' => 'product_paperweights', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Papertypes'), array('controller' => 'product_papertypes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Papertype'), array('controller' => 'product_papertypes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Covers'), array('controller' => 'product_covers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Cover'), array('controller' => 'product_covers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Singles'), array('controller' => 'product_singles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Single'), array('controller' => 'product_singles', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Product');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($product['Product']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($product['ParentProduct']['name'], array('controller' => 'products', 'action' => 'view', $product['ParentProduct']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($product['Product']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Preview'); ?></dt>
		<dd>
			<?php echo h($product['Product']['preview']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cover'); ?></dt>
		<dd>
			<?php echo h($product['Product']['cover']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bblock'); ?></dt>
		<dd>
			<?php echo h($product['Product']['bblock']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start With'); ?></dt>
		<dd>
			<?php echo h($product['Product']['start_with']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Use Spread'); ?></dt>
		<dd>
			<?php echo h($product['Product']['use_spread']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Min Page'); ?></dt>
		<dd>
			<?php echo h($product['Product']['min_page']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Max Page'); ?></dt>
		<dd>
			<?php echo h($product['Product']['max_page']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stepsize'); ?></dt>
		<dd>
			<?php echo h($product['Product']['stepsize']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Weight'); ?></dt>
		<dd>
			<?php echo h($product['Product']['weight']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Page Width'); ?></dt>
		<dd>
			<?php echo h($product['Product']['page_width']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Page Height'); ?></dt>
		<dd>
			<?php echo h($product['Product']['page_height']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Page Bleed'); ?></dt>
		<dd>
			<?php echo h($product['Product']['page_bleed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Paper Name'); ?></dt>
		<dd>
			<?php echo h($product['Product']['paper_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product Paperweight'); ?></dt>
		<dd>
			<?php echo $this->Html->link($product['ProductPaperweight']['title'], array('controller' => 'product_paperweights', 'action' => 'view', $product['ProductPaperweight']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product Papertype'); ?></dt>
		<dd>
			<?php echo $this->Html->link($product['ProductPapertype']['title'], array('controller' => 'product_papertypes', 'action' => 'view', $product['ProductPapertype']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product Cover'); ?></dt>
		<dd>
			<?php echo $this->Html->link($product['ProductCover']['name'], array('controller' => 'product_covers', 'action' => 'view', $product['ProductCover']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($product['Product']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($product['Product']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($product['Product']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
	<div class="row">
		<div class="related col-md-10 col-md-offset-2">
			<hr>
			<h3><?php echo __('Related Product Singles');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New Product Single'), array('controller' => 'product_singles', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($product['ProductSingle'])):?>
			<table class="table">
				<tr>
							<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Created'); ?></th>
					<th class="actions"><?php echo __('Actions');?></th>
				</tr>
					<?php
		$i = 0;
		foreach ($product['ProductSingle'] as $productSingle): ?>
		<tr>
			<td><?php echo $productSingle['id'];?></td>
			<td><?php echo $productSingle['modified'];?></td>
			<td><?php echo $productSingle['created'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'product_singles', 'action' => 'view', $productSingle['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'product_singles', 'action' => 'edit', $productSingle['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'product_singles', 'action' => 'delete', $productSingle['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $productSingle['id'])); ?>
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
			<?php echo $this->Html->link(__('New Child Product'), array('controller' => 'products', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($product['ChildProduct'])):?>
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
		foreach ($product['ChildProduct'] as $childProduct): ?>
		<tr>
			<td><?php echo $childProduct['id'];?></td>
			<td><?php echo $childProduct['name'];?></td>
			<td><?php echo $childProduct['status'];?></td>
			<td><?php echo $childProduct['created'];?></td>
			<td><?php echo $childProduct['modified'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'products', 'action' => 'view', $childProduct['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'products', 'action' => 'edit', $childProduct['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'products', 'action' => 'delete', $childProduct['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $childProduct['id'])); ?>
				</div>
			</div>
			</td>
		</tr>
	<?php endforeach; ?>
			</table>
	<?php endif; ?>

		</div>
	</div>
