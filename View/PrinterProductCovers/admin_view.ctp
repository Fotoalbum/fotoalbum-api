<div class="printerProductCovers view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Printer Product Cover'), array('action' => 'edit', $printerProductCover['PrinterProductCover']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Printer Product Cover'), array('action' => 'delete', $printerProductCover['PrinterProductCover']['id']), null, __('Are you sure you want to delete # %s?', $printerProductCover['PrinterProductCover']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Printer Product Covers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer Product Cover'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Printer Products'), array('controller' => 'printer_products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer Product'), array('controller' => 'printer_products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Printer Product Cover');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($printerProductCover['PrinterProductCover']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($printerProductCover['PrinterProductCover']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hardbound'); ?></dt>
		<dd>
			<?php echo h($printerProductCover['PrinterProductCover']['hardbound']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hardbound Type'); ?></dt>
		<dd>
			<?php echo h($printerProductCover['PrinterProductCover']['hardbound_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Headbandcolor'); ?></dt>
		<dd>
			<?php echo h($printerProductCover['PrinterProductCover']['headbandcolor']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Endpapercolor'); ?></dt>
		<dd>
			<?php echo h($printerProductCover['PrinterProductCover']['endpapercolor']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Spineform'); ?></dt>
		<dd>
			<?php echo h($printerProductCover['PrinterProductCover']['spineform']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Laminate'); ?></dt>
		<dd>
			<?php echo h($printerProductCover['PrinterProductCover']['laminate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($printerProductCover['PrinterProductCover']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($printerProductCover['PrinterProductCover']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
