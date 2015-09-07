<div class="printers view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Printer'), array('action' => 'edit', $printer['Printer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Printer'), array('action' => 'delete', $printer['Printer']['id']), null, __('Are you sure you want to delete # %s?', $printer['Printer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Printers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Memberships'), array('controller' => 'memberships', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Membership'), array('controller' => 'memberships', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Printer Products'), array('controller' => 'printer_products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer Product'), array('controller' => 'printer_products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Papertypes'), array('controller' => 'product_papertypes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Papertype'), array('controller' => 'product_papertypes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Paperweights'), array('controller' => 'product_paperweights', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Paperweight'), array('controller' => 'product_paperweights', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Printer');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($printer['Printer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($printer['Printer']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Payee Name'); ?></dt>
		<dd>
			<?php echo h($printer['Printer']['payee_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Website'); ?></dt>
		<dd>
			<?php echo h($printer['Printer']['website']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kvk Nr'); ?></dt>
		<dd>
			<?php echo h($printer['Printer']['kvk_nr']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bank Nr'); ?></dt>
		<dd>
			<?php echo h($printer['Printer']['bank_nr']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bank'); ?></dt>
		<dd>
			<?php echo h($printer['Printer']['bank']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bic'); ?></dt>
		<dd>
			<?php echo h($printer['Printer']['bic']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Iban'); ?></dt>
		<dd>
			<?php echo h($printer['Printer']['iban']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vat Nr'); ?></dt>
		<dd>
			<?php echo h($printer['Printer']['vat_nr']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($printer['Printer']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Membership'); ?></dt>
		<dd>
			<?php echo $this->Html->link($printer['Membership']['name'], array('controller' => 'memberships', 'action' => 'view', $printer['Membership']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($printer['Printer']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($printer['Printer']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filename'); ?></dt>
		<dd>
			<?php echo h($printer['Printer']['filename']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Directory'); ?></dt>
		<dd>
			<?php echo h($printer['Printer']['directory']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
	<div class="row">
		<div class="related col-md-10 col-md-offset-2">
			<hr>
			<h3><?php echo __('Related Printer Products');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New Printer Product'), array('controller' => 'printer_products', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($printer['PrinterProduct'])):?>
			<table class="table">
				<tr>
							<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
					<th class="actions"><?php echo __('Actions');?></th>
				</tr>
					<?php
		$i = 0;
		foreach ($printer['PrinterProduct'] as $printerProduct): ?>
		<tr>
			<td><?php echo $printerProduct['id'];?></td>
			<td><?php echo $printerProduct['name'];?></td>
			<td><?php echo $printerProduct['status'];?></td>
			<td><?php echo $printerProduct['created'];?></td>
			<td><?php echo $printerProduct['modified'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'printer_products', 'action' => 'view', $printerProduct['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'printer_products', 'action' => 'edit', $printerProduct['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'printer_products', 'action' => 'delete', $printerProduct['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $printerProduct['id'])); ?>
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
			<h3><?php echo __('Related Product Papertypes');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New Product Papertype'), array('controller' => 'product_papertypes', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($printer['ProductPapertype'])):?>
			<table class="table">
				<tr>
							<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
					<th class="actions"><?php echo __('Actions');?></th>
				</tr>
					<?php
		$i = 0;
		foreach ($printer['ProductPapertype'] as $productPapertype): ?>
		<tr>
			<td><?php echo $productPapertype['id'];?></td>
			<td><?php echo $productPapertype['name'];?></td>
			<td><?php echo $productPapertype['created'];?></td>
			<td><?php echo $productPapertype['modified'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'product_papertypes', 'action' => 'view', $productPapertype['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'product_papertypes', 'action' => 'edit', $productPapertype['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'product_papertypes', 'action' => 'delete', $productPapertype['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $productPapertype['id'])); ?>
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
			<h3><?php echo __('Related Product Paperweights');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New Product Paperweight'), array('controller' => 'product_paperweights', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($printer['ProductPaperweight'])):?>
			<table class="table">
				<tr>
							<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
					<th class="actions"><?php echo __('Actions');?></th>
				</tr>
					<?php
		$i = 0;
		foreach ($printer['ProductPaperweight'] as $productPaperweight): ?>
		<tr>
			<td><?php echo $productPaperweight['id'];?></td>
			<td><?php echo $productPaperweight['name'];?></td>
			<td><?php echo $productPaperweight['created'];?></td>
			<td><?php echo $productPaperweight['modified'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'product_paperweights', 'action' => 'view', $productPaperweight['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'product_paperweights', 'action' => 'edit', $productPaperweight['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'product_paperweights', 'action' => 'delete', $productPaperweight['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $productPaperweight['id'])); ?>
				</div>
			</div>
			</td>
		</tr>
	<?php endforeach; ?>
			</table>
	<?php endif; ?>

		</div>
	</div>
