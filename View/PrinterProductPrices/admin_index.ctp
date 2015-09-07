<div class="printerProductPrices index row">
<div class="actions col-md-2 span2">
	<ul class="nav nav-list">
        <li class="nav-header"><?php echo __('Actions'); ?></li>
		<li><?php echo $this->Html->link(__('New Printer Product Price'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Printer Products'), array('controller' => 'printer_products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer Product'), array('controller' => 'printer_products', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="col-md-10 span10">
	<h2><?php echo __('Printer Product Prices');?></h2>
	<table class="table table-condensed table-hover" style="white-space:nowrap;">
		<thead>
			<tr>
										<th><?php echo $this->Paginator->sort('id');?></th>
										<th><?php echo $this->Paginator->sort('printer_product_id');?></th>
										<th><?php echo $this->Paginator->sort('printer_product_id');?></th>
										<th><?php echo $this->Paginator->sort('product_price');?></th>
										<th><?php echo $this->Paginator->sort('created');?></th>
										<th><?php echo $this->Paginator->sort('modified');?></th>
										<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($printerProductPrices as $printerProductPrice): ?>
	<tr>
		<td><?php echo h($printerProductPrice['PrinterProductPrice']['id']); ?>&nbsp;</td>
		<td><?php echo $printerProductPrice['PrinterProductPrice']['printer_product_id']; ?>&nbsp;</td>
		<td><?php echo $printerProducts[$printerProductPrice['PrinterProductPrice']['printer_product_id']]; ?>&nbsp;</td>
		<td><?php echo h($printerProductPrice['PrinterProductPrice']['product_price']); ?>&nbsp;</td>
		<td><?php echo h($printerProductPrice['PrinterProductPrice']['created']); ?>&nbsp;</td>
		<td><?php echo h($printerProductPrice['PrinterProductPrice']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $printerProductPrice['PrinterProductPrice']['id']), array('class' => 'btn btn-default btn-xs')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $printerProductPrice['PrinterProductPrice']['id']), array('class' => 'btn btn-default btn-xs')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $printerProductPrice['PrinterProductPrice']['id']), array('class' => 'btn btn-danger btn-xs'), __('Are you sure you want to delete # %s?', $printerProductPrice['PrinterProductPrice']['id'])); ?>
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

