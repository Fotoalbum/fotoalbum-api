<div class="supplements view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Supplement'), array('action' => 'edit', $supplement['Supplement']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Supplement'), array('action' => 'delete', $supplement['Supplement']['id']), null, __('Are you sure you want to delete # %s?', $supplement['Supplement']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Supplements'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplement'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Supplements'), array('controller' => 'supplements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Supplement'), array('controller' => 'supplements', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Printers'), array('controller' => 'printers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer'), array('controller' => 'printers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Supplement');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($supplement['Supplement']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Supplement'); ?></dt>
		<dd>
			<?php echo $this->Html->link($supplement['ParentSupplement']['name'], array('controller' => 'supplements', 'action' => 'view', $supplement['ParentSupplement']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($supplement['Category']['name'], array('controller' => 'categories', 'action' => 'view', $supplement['Category']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($supplement['Supplement']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Preview'); ?></dt>
		<dd>
			<?php echo h($supplement['Supplement']['preview']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Xml Name'); ?></dt>
		<dd>
			<?php echo h($supplement['Supplement']['xml_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($supplement['Supplement']['price']); ?>
			&nbsp;
		</dd>		
		<dt><?php echo __('Printer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($supplement['Printer']['name'], array('controller' => 'printers', 'action' => 'view', $supplement['Printer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($supplement['Supplement']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($supplement['Supplement']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($supplement['Supplement']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
	<div class="row">
		<div class="related col-md-10 col-md-offset-2">
			<hr>
			<h3><?php echo __('Related Supplements');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New Child Supplement'), array('controller' => 'supplements', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($supplement['ChildSupplement'])):?>
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
		foreach ($supplement['ChildSupplement'] as $childSupplement): ?>
		<tr>
			<td><?php echo $childSupplement['id'];?></td>
			<td><?php echo $childSupplement['name'];?></td>
			<td><?php echo $childSupplement['status'];?></td>
			<td><?php echo $childSupplement['created'];?></td>
			<td><?php echo $childSupplement['modified'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'supplements', 'action' => 'view', $childSupplement['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'supplements', 'action' => 'edit', $childSupplement['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'supplements', 'action' => 'delete', $childSupplement['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $childSupplement['id'])); ?>
				</div>
			</div>
			</td>
		</tr>
	<?php endforeach; ?>
			</table>
	<?php endif; ?>

		</div>
	</div>
