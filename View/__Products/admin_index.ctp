<div class="products index row">
<div class="actions col-md-2 span2">
	<ul class="nav nav-list">
        <li class="nav-header"><?php echo __('Actions'); ?></li>
		<li><?php echo $this->Html->link(__('New Product'), array('action' => 'add')); ?></li>
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
<div class="col-md-10 span10">
	<h2><?php echo __('Products');?></h2>
	<table class="table table-condensed table-hover" style="white-space:nowrap;">
		<thead>
			<tr>
										<th><?php echo $this->Paginator->sort('id');?></th>
												<th><?php echo $this->Paginator->sort('name');?></th>
												<th><?php echo $this->Paginator->sort('status');?></th>
												<th><?php echo $this->Paginator->sort('created');?></th>
												<th><?php echo $this->Paginator->sort('modified');?></th>
										<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($products as $product): ?>
	<tr>
		<td><?php echo h($product['Product']['id']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['name']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['status']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['created']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $product['Product']['id']), array('class' => 'btn btn-default btn-xs')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $product['Product']['id']), array('class' => 'btn btn-default btn-xs')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $product['Product']['id']), array('class' => 'btn btn-danger btn-xs'), __('Are you sure you want to delete # %s?', $product['Product']['id'])); ?>
				</div>
			</div>
		</td>
	</tr>
<?php endforeach; ?>
		</tbody>
	</table>
    <div class="well">
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</div>

	<div class="paging pager btn-group">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array('class' => 'prev btn'), null, array('class' => 'prev disabled btn'));
		echo $this->Paginator->numbers(array('separator' => '', 'class' => 'btn', 'currentClass' => 'active'));
		echo $this->Paginator->next(__('next') . ' >', array('class' => 'next btn'), null, array('class' => 'next disabled btn'));
	?>
	</div>
</div>
</div>

