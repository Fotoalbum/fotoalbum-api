<div class="printerProductPrices view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Printer Product Price'), array('action' => 'edit', $printerProductPrice['PrinterProductPrice']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Printer Product Price'), array('action' => 'delete', $printerProductPrice['PrinterProductPrice']['id']), null, __('Are you sure you want to delete # %s?', $printerProductPrice['PrinterProductPrice']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Printer Product Prices'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer Product Price'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Printer Products'), array('controller' => 'printer_products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer Product'), array('controller' => 'printer_products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Printer Product Price');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($printerProductPrice['PrinterProductPrice']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Printer Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($printerProductPrice['PrinterProduct']['name'], array('controller' => 'printer_products', 'action' => 'view', $printerProductPrice['PrinterProduct']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Min Page'); ?></dt>
		<dd>
			<?php echo h($printerProductPrice['PrinterProductPrice']['min_page']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Max Page'); ?></dt>
		<dd>
			<?php echo h($printerProductPrice['PrinterProductPrice']['max_page']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product Price'); ?></dt>
		<dd>
			<?php echo h($printerProductPrice['PrinterProductPrice']['product_price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Handling Price'); ?></dt>
		<dd>
			<?php echo h($printerProductPrice['PrinterProductPrice']['handling_price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Page Price'); ?></dt>
		<dd>
			<?php echo h($printerProductPrice['PrinterProductPrice']['page_price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Method'); ?></dt>
		<dd>
			<?php echo h($printerProductPrice['PrinterProductPrice']['method']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($printerProductPrice['PrinterProductPrice']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($printerProductPrice['PrinterProductPrice']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
