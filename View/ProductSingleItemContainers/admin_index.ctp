<div class="productSingleItemContainers index row">
<div class="actions col-md-2 span2">
	<ul class="nav nav-list">
        <li class="nav-header"><?php echo __('Actions'); ?></li>
		<li><?php echo $this->Html->link(__('New Product Single Item Container'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Product Single Items'), array('controller' => 'product_single_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Single Item'), array('controller' => 'product_single_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="col-md-10 span10">
	<h2><?php echo __('Product Single Item Containers');?></h2>
	<table class="table table-condensed table-hover" style="white-space:nowrap;">
		<thead>
			<tr>
										<th><?php echo $this->Paginator->sort('id');?></th>
												<th><?php echo $this->Paginator->sort('width');?></th>
												<th><?php echo $this->Paginator->sort('height');?></th>
												<th><?php echo $this->Paginator->sort('modified');?></th>
												<th><?php echo $this->Paginator->sort('created');?></th>
										<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($productSingleItemContainers as $productSingleItemContainer): ?>
	<tr>
		<td><?php echo h($productSingleItemContainer['ProductSingleItemContainer']['id']); ?>&nbsp;</td>
		<td><?php echo h($productSingleItemContainer['ProductSingleItemContainer']['width']); ?>&nbsp;</td>
		<td><?php echo h($productSingleItemContainer['ProductSingleItemContainer']['height']); ?>&nbsp;</td>
		<td><?php echo h($productSingleItemContainer['ProductSingleItemContainer']['modified']); ?>&nbsp;</td>
		<td><?php echo h($productSingleItemContainer['ProductSingleItemContainer']['created']); ?>&nbsp;</td>
		<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $productSingleItemContainer['ProductSingleItemContainer']['id']), array('class' => 'btn btn-default btn-xs')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $productSingleItemContainer['ProductSingleItemContainer']['id']), array('class' => 'btn btn-default btn-xs')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $productSingleItemContainer['ProductSingleItemContainer']['id']), array('class' => 'btn btn-danger btn-xs'), __('Are you sure you want to delete # %s?', $productSingleItemContainer['ProductSingleItemContainer']['id'])); ?>
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

