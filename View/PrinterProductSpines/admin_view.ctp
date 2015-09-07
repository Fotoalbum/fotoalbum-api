<div class="printerProductSpines view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Printer Product Spine'), array('action' => 'edit', $printerProductSpine['PrinterProductSpine']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Printer Product Spine'), array('action' => 'delete', $printerProductSpine['PrinterProductSpine']['id']), null, __('Are you sure you want to delete # %s?', $printerProductSpine['PrinterProductSpine']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Printer Product Spines'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer Product Spine'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Printer Products'), array('controller' => 'printer_products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer Product'), array('controller' => 'printer_products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Printer Product Spine');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($printerProductSpine['PrinterProductSpine']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Printer Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($printerProductSpine['PrinterProduct']['name'], array('controller' => 'printer_products', 'action' => 'view', $printerProductSpine['PrinterProduct']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Min Page'); ?></dt>
		<dd>
			<?php echo h($printerProductSpine['PrinterProductSpine']['min_page']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Max Page'); ?></dt>
		<dd>
			<?php echo h($printerProductSpine['PrinterProductSpine']['max_page']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($printerProductSpine['PrinterProductSpine']['value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Base Value'); ?></dt>
		<dd>
			<?php echo h($printerProductSpine['PrinterProductSpine']['base_value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Method'); ?></dt>
		<dd>
			<?php echo h($printerProductSpine['PrinterProductSpine']['method']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($printerProductSpine['PrinterProductSpine']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($printerProductSpine['PrinterProductSpine']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
