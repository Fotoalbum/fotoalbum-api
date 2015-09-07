<div class="masks index">
	<h2><?php echo __('Masks'); ?></h2>
	<table class="table" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('label'); ?></th>
			<th><?php echo $this->Paginator->sort('category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('directory'); ?></th>
			<th><?php echo $this->Paginator->sort('hires'); ?></th>
			<th><?php echo $this->Paginator->sort('bytesize'); ?></th>
			<th><?php echo $this->Paginator->sort('width'); ?></th>
			<th><?php echo $this->Paginator->sort('height'); ?></th>
			<th><?php echo $this->Paginator->sort('metatags'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($masks as $mask): ?>
	<tr>
		<td><?php echo h($mask['Mask']['id']); ?>&nbsp;</td>
		<td><?php echo h($mask['Mask']['label']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($mask['Category']['name'], array('controller' => 'categories', 'action' => 'view', $mask['Category']['id'])); ?>
		</td>
		<td><?php echo h($mask['Mask']['directory']); ?>&nbsp;</td>
		<td><?php echo h($mask['Mask']['hires']); ?>&nbsp;</td>
		<td><?php echo h($mask['Mask']['bytesize']); ?>&nbsp;</td>
		<td><?php echo h($mask['Mask']['width']); ?>&nbsp;</td>
		<td><?php echo h($mask['Mask']['height']); ?>&nbsp;</td>
		<td><?php echo h($mask['Mask']['metatags']); ?>&nbsp;</td>
		<td><?php echo h($mask['Mask']['created']); ?>&nbsp;</td>
		<td><?php echo h($mask['Mask']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $mask['Mask']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $mask['Mask']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $mask['Mask']['id']), null, __('Are you sure you want to delete # %s?', $mask['Mask']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="pager paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Mask'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
