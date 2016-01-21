<div class="productConversionServices index row">
<div class="actions col-md-2 span2">
	<ul class="nav nav-list">
        <li class="nav-header"><?php echo __('Actions'); ?></li>
		<li><?php echo $this->Html->link(__('New Product Conversion Service'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Conversions'), array('controller' => 'product_conversions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Conversion'), array('controller' => 'product_conversions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="col-md-10 span10">
	<h2><?php echo __('Product Conversion Services');?></h2>
	<table class="table table-condensed table-hover" style="white-space:nowrap;">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id');?></th>
                <th><?php echo $this->Paginator->sort('user_id');?></th>
                <th><?php echo $this->Paginator->sort('product_conversion_id');?></th>
                <th><?php echo $this->Paginator->sort('product_id');?></th>
                <th><?php echo $this->Paginator->sort('user_product_id');?></th>
                <th><?php echo $this->Paginator->sort('status');?></th>
                <th><?php echo $this->Paginator->sort('created');?></th>
                <th><?php echo $this->Paginator->sort('modified');?></th>
                <th class="actions"><?php echo __('Actions');?></th>
            </tr>
        </thead>
		<tbody>
			<?php
			foreach ($productConversionServices as $productConversionService): ?>
	<tr>
		<td><?php echo h($productConversionService['ProductConversionService']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($productConversionService['User']['id'], array('controller' => 'users', 'action' => 'view', $productConversionService['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($productConversionService['ProductConversion']['name'], array('controller' => 'product_conversion', 'action' => 'view', $productConversionService['ProductConversion']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($productConversionService['Product']['name'], array('controller' => 'users', 'product' => 'view', $productConversionService['Product']['id'])); ?>
		</td>                
		<td><?php echo h($productConversionService['ProductConversionService']['user_product_id']); ?>&nbsp;</td>
		<td><?php echo h($productConversionService['ProductConversionService']['status']); ?>&nbsp;</td>
		<td><?php echo h($productConversionService['ProductConversionService']['created']); ?>&nbsp;</td>
		<td><?php echo h($productConversionService['ProductConversionService']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
					<?php //echo $this->Html->link(__('View'), array('action' => 'view', $productConversionService['ProductConversionService']['id']), array('class' => 'btn btn-default')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $productConversionService['ProductConversionService']['id']), array('class' => 'btn btn-default')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $productConversionService['ProductConversionService']['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $productConversionService['ProductConversionService']['id'])); ?>
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

