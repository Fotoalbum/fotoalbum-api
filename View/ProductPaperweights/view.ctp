<div class="productPaperweights view row">
	<div class="actions span2">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Product Paperweight'), array('action' => 'edit', $productPaperweight['ProductPaperweight']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Product Paperweight'), array('action' => 'delete', $productPaperweight['ProductPaperweight']['id']), null, __('Are you sure you want to delete # %s?', $productPaperweight['ProductPaperweight']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Paperweights'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Paperweight'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Printers'), array('controller' => 'printers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer'), array('controller' => 'printers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="span10">
		<h2><?php  echo __('Product Paperweight');?></h2>
		<dl>
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($productPaperweight['ProductPaperweight']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Printer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productPaperweight['Printer']['name'], array('controller' => 'printers', 'action' => 'view', $productPaperweight['Printer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($productPaperweight['ProductPaperweight']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($productPaperweight['ProductPaperweight']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($productPaperweight['ProductPaperweight']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php echo h($productPaperweight['ProductPaperweight']['image']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($productPaperweight['ProductPaperweight']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($productPaperweight['ProductPaperweight']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($productPaperweight['ProductPaperweight']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
	<div class="row">
		<div class="related span10 offset2">
			<hr>
			<h3><?php echo __('Related Products');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($productPaperweight['Product'])):?>
			<table class="table">
				<tr>
							<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Cover'); ?></th>
		<th><?php echo __('Bblock'); ?></th>
		<th><?php echo __('Start With'); ?></th>
		<th><?php echo __('Use Spread'); ?></th>
		<th><?php echo __('Min Page'); ?></th>
		<th><?php echo __('Max Page'); ?></th>
		<th><?php echo __('Stepsize'); ?></th>
		<th><?php echo __('Page Width'); ?></th>
		<th><?php echo __('Page Height'); ?></th>
		<th><?php echo __('Page Bleed'); ?></th>
		<th><?php echo __('Paper Name'); ?></th>
		<th><?php echo __('Product Paperweight Id'); ?></th>
		<th><?php echo __('Product Papertype Id'); ?></th>
		<th><?php echo __('Product Cover Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
					<th class="actions"><?php echo __('Actions');?></th>
				</tr>
					<?php
		$i = 0;
		foreach ($productPaperweight['Product'] as $product): ?>
		<tr>
			<td><?php echo $product['id'];?></td>
			<td><?php echo $product['name'];?></td>
			<td><?php echo $product['cover'];?></td>
			<td><?php echo $product['bblock'];?></td>
			<td><?php echo $product['start_with'];?></td>
			<td><?php echo $product['use_spread'];?></td>
			<td><?php echo $product['min_page'];?></td>
			<td><?php echo $product['max_page'];?></td>
			<td><?php echo $product['stepsize'];?></td>
			<td><?php echo $product['page_width'];?></td>
			<td><?php echo $product['page_height'];?></td>
			<td><?php echo $product['page_bleed'];?></td>
			<td><?php echo $product['paper_name'];?></td>
			<td><?php echo $product['product_paperweight_id'];?></td>
			<td><?php echo $product['product_papertype_id'];?></td>
			<td><?php echo $product['product_cover_id'];?></td>
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
