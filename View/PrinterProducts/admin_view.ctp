<div class="printerProducts view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Printer Product'), array('action' => 'edit', $printerProduct['PrinterProduct']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Printer Product'), array('action' => 'delete', $printerProduct['PrinterProduct']['id']), null, __('Are you sure you want to delete # %s?', $printerProduct['PrinterProduct']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Printer Products'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer Product'), array('action' => 'add')); ?> </li>
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
	<div class="col-md-9">
		<h2><?php  echo __('Printer Product');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($printerProduct['PrinterProduct']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($printerProduct['PrinterProduct']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('XML Name'); ?></dt>
		<dd>
			<?php echo h($printerProduct['PrinterProduct']['xml_name']); ?>
			&nbsp;
		</dd>		
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($printerProduct['Product']['name'], array('controller' => 'products', 'action' => 'view', $printerProduct['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Printer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($printerProduct['Printer']['name'], array('controller' => 'printers', 'action' => 'view', $printerProduct['Printer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product Cover'); ?></dt>
		<dd>
			<?php echo $this->Html->link($printerProduct['ProductCover']['name'], array('controller' => 'product_covers', 'action' => 'view', $printerProduct['ProductCover']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Custom XML: Size'); ?></dt>
		<dd>
			<?php echo h($printerProduct['PrinterProduct']['custom_xml_size']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($printerProduct['PrinterProduct']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($printerProduct['PrinterProduct']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($printerProduct['PrinterProduct']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
	<div class="row">
		<div class="related col-md-10 col-md-offset-2">
			<hr>
			<h3><?php echo __('Related Printer Product Prices');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New Printer Product Price'), array('controller' => 'printer_product_prices', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($printerProduct['PrinterProductPrice'])):?>
			<table class="table">
				<tr>
							<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
					<th class="actions"><?php echo __('Actions');?></th>
				</tr>
					<?php
		$i = 0;
		foreach ($printerProduct['PrinterProductPrice'] as $printerProductPrice): ?>
		<tr>
			<td><?php echo $printerProductPrice['id'];?></td>
			<td><?php echo $printerProductPrice['created'];?></td>
			<td><?php echo $printerProductPrice['modified'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'printer_product_prices', 'action' => 'view', $printerProductPrice['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'printer_product_prices', 'action' => 'edit', $printerProductPrice['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'printer_product_prices', 'action' => 'delete', $printerProductPrice['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $printerProductPrice['id'])); ?>
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
			<h3><?php echo __('Related Printer Product Spines');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New Printer Product Spine'), array('controller' => 'printer_product_spines', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($printerProduct['PrinterProductSpine'])):?>
			<table class="table">
				<tr>
							<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Value'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
					<th class="actions"><?php echo __('Actions');?></th>
				</tr>
					<?php
		$i = 0;
		foreach ($printerProduct['PrinterProductSpine'] as $printerProductSpine): ?>
		<tr>
			<td><?php echo $printerProductSpine['id'];?></td>
			<td><?php echo $printerProductSpine['value'];?></td>
			<td><?php echo $printerProductSpine['created'];?></td>
			<td><?php echo $printerProductSpine['modified'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'printer_product_spines', 'action' => 'view', $printerProductSpine['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'printer_product_spines', 'action' => 'edit', $printerProductSpine['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'printer_product_spines', 'action' => 'delete', $printerProductSpine['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $printerProductSpine['id'])); ?>
				</div>
			</div>
			</td>
		</tr>
	<?php endforeach; ?>
			</table>
	<?php endif; ?>

		</div>
	</div>
