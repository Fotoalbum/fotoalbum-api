<div class="printerProducts index row">
<div class="actions col-md-2 col-md-2">
	<ul class="nav nav-list">
        <li class="nav-header"><?php echo __('Actions'); ?></li>
		<li><?php echo $this->Html->link(__('New Printer Product'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Printers'), array('controller' => 'printers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer'), array('controller' => 'printers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Covers'), array('controller' => 'product_covers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Cover'), array('controller' => 'product_covers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Printer Product Prices'), array('controller' => 'printer_product_prices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer Product Price'), array('controller' => 'printer_product_prices', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Printer Product Spines'), array('controller' => 'printer_product_spines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer Product Spine'), array('controller' => 'printer_product_spines', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="col-md-10 col-md-10">
	<h2><?php echo __('Printer Products');?></h2>
	<table class="table table-condensed table-hover" style="white-space:nowrap;">
		<thead>
			<tr>
										<th><?php echo $this->Paginator->sort('id');?></th>
												<th><?php echo $this->Paginator->sort('name');?></th>
												<th><?php echo $this->Paginator->sort('status');?></th>
												<th><?php echo $this->Paginator->sort('printer_id');?></th>
												<th><?php echo $this->Paginator->sort('modified');?></th>
										<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($printerProducts as $printerProduct): ?>
	<tr>
		<td><?php echo h($printerProduct['PrinterProduct']['id']); ?>&nbsp;</td>
		<td><?php echo h($printerProduct['PrinterProduct']['name']); ?>&nbsp;</td>
		<td><?php echo h($printerProduct['PrinterProduct']['status']); ?>&nbsp;</td>
		<td><?php echo h($printerProduct['PrinterProduct']['printer_id']); ?>&nbsp;</td>
		<td><?php echo h($printerProduct['PrinterProduct']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
					<?php //echo $this->Html->link(__('View'), array('action' => 'view', $printerProduct['PrinterProduct']['id']), array('class' => 'btn btn-xs  btn-mini')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $printerProduct['PrinterProduct']['id']), array('class' => 'btn btn-xs  btn-mini')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $printerProduct['PrinterProduct']['id']), array('class' => 'btn btn-danger btn-xs  btn-mini'), __('Are you sure you want to delete # %s?', $printerProduct['PrinterProduct']['id'])); ?>
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

	<div class="pager paging btn-group">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array('class' => 'prev btn'), null, array('class' => 'prev disabled btn'));
		echo $this->Paginator->numbers(array('separator' => '', 'class' => 'btn', 'currentClass' => 'active'));
		echo $this->Paginator->next(__('next') . ' >', array('class' => 'next btn'), null, array('class' => 'next disabled btn'));
	?>
	</div>
</div>
</div>

