<div class="printerProductSpines index row">
<div class="actions col-md-2 span2">
	<ul class="nav nav-list">
        <li class="nav-header"><?php echo __('Actions'); ?></li>
		<li><?php echo $this->Html->link(__('New Printer Product Spine'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Printer Products'), array('controller' => 'printer_products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer Product'), array('controller' => 'printer_products', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="col-md-10 span10">
	<h2><?php echo __('Printer Product Spines');?></h2>
	<table class="table table-condensed table-hover" style="white-space:nowrap;">
		<thead>
			<tr>
										<th><?php echo $this->Paginator->sort('id');?></th>
												<th><?php echo $this->Paginator->sort('printer_product_id');?></th>
												<th><?php echo $this->Paginator->sort('value');?></th>
												<th><?php echo $this->Paginator->sort('min_page');?></th>
												<th><?php echo $this->Paginator->sort('max_page');?></th>																								
												<th><?php echo $this->Paginator->sort('modified');?></th>
										<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($printerProductSpines as $printerProductSpine): ?>
	<tr>
		<td><?php echo h($printerProductSpine['PrinterProductSpine']['id']); ?>&nbsp;</td>
		<td><?php echo $printerProducts[$printerProductSpine['PrinterProductSpine']['printer_product_id']]; ?>&nbsp;</td>
		<td><?php echo h($printerProductSpine['PrinterProductSpine']['value']); ?>&nbsp;</td>
		<td><?php echo h($printerProductSpine['PrinterProductSpine']['min_page']); ?>&nbsp;</td>
		<td><?php echo h($printerProductSpine['PrinterProductSpine']['max_page']); ?>&nbsp;</td>				
		<td><?php echo h($printerProductSpine['PrinterProductSpine']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $printerProductSpine['PrinterProductSpine']['id']), array('class' => 'btn btn-default btn-xs')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $printerProductSpine['PrinterProductSpine']['id']), array('class' => 'btn btn-default btn-xs')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $printerProductSpine['PrinterProductSpine']['id']), array('class' => 'btn btn-danger btn-xs'), __('Are you sure you want to delete # %s?', $printerProductSpine['PrinterProductSpine']['id'])); ?>
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

