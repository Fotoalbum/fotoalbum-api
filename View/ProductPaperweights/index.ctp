<div class="productPaperweights index row">
<div class="actions col-md-2 span2">
	<ul class="nav nav-list">
        <li class="nav-header"><?php echo __('Actions'); ?></li>
		<li><?php echo $this->Html->link(__('New Product Paperweight'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Printers'), array('controller' => 'printers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer'), array('controller' => 'printers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="col-md-10 span10">
	<h2><?php echo __('Product Paperweights');?></h2>
	<table class="table table-condensed table-hover" style="white-space:nowrap;">
		<thead>
			<tr>
										<th><?php echo $this->Paginator->sort('id');?></th>
												<th><?php echo $this->Paginator->sort('name');?></th>
												<th><?php echo $this->Paginator->sort('created');?></th>
												<th><?php echo $this->Paginator->sort('modified');?></th>
										<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($productPaperweights as $productPaperweight): ?>
	<tr>
		<td><?php echo h($productPaperweight['ProductPaperweight']['id']); ?>&nbsp;</td>
		<td><?php echo h($productPaperweight['ProductPaperweight']['name']); ?>&nbsp;</td>
		<td><?php echo h($productPaperweight['ProductPaperweight']['created']); ?>&nbsp;</td>
		<td><?php echo h($productPaperweight['ProductPaperweight']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $productPaperweight['ProductPaperweight']['id']), array('class' => 'btn btn-xs  btn-mini')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $productPaperweight['ProductPaperweight']['id']), array('class' => 'btn btn-xs  btn-mini')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $productPaperweight['ProductPaperweight']['id']), array('class' => 'btn btn-danger btn-xs  btn-mini'), __('Are you sure you want to delete # %s?', $productPaperweight['ProductPaperweight']['id'])); ?>
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

	<div class="paging btn-group">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array('class' => 'prev btn'), null, array('class' => 'prev disabled btn'));
		echo $this->Paginator->numbers(array('separator' => '', 'class' => 'btn', 'currentClass' => 'active'));
		echo $this->Paginator->next(__('next') . ' >', array('class' => 'next btn'), null, array('class' => 'next disabled btn'));
	?>
	</div>
</div>
</div>
