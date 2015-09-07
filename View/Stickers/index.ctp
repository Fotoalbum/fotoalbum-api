<div class="stickers index">
	<h2><?php echo __('Stickers'); ?></h2>
	<table class="table" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('label'); ?></th>
			<th><?php echo $this->Paginator->sort('category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('lowres'); ?></th>
			<th><?php echo $this->Paginator->sort('hires'); ?></th>
			<th><?php echo $this->Paginator->sort('thumb'); ?></th>
			<th><?php echo $this->Paginator->sort('metatags'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($stickers as $sticker): ?>
	<tr>
		<td><?php echo h($sticker['Sticker']['id']); ?>&nbsp;</td>
		<td><?php echo h($sticker['Sticker']['label']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($sticker['Category']['name'], array('controller' => 'categories', 'action' => 'view', $sticker['Category']['id'])); ?>
		</td>
		<td><?php echo h($sticker['Sticker']['lowres']); ?>&nbsp;</td>
		<td><?php echo h($sticker['Sticker']['hires']); ?>&nbsp;</td>
		<td><?php echo h($sticker['Sticker']['thumb']); ?>&nbsp;</td>
		<td><?php echo h($sticker['Sticker']['metatags']); ?>&nbsp;</td>
		<td><?php echo h($sticker['Sticker']['created']); ?>&nbsp;</td>
		<td><?php echo h($sticker['Sticker']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $sticker['Sticker']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $sticker['Sticker']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $sticker['Sticker']['id']), null, __('Are you sure you want to delete # %s?', $sticker['Sticker']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Sticker'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
