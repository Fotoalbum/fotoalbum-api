<div class="fonts index">
	<h2><?php echo __('Fonts'); ?></h2>
	<table class="table" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('fontName'); ?></th>
			<th><?php echo $this->Paginator->sort('fontOrig'); ?></th>
			<th><?php echo $this->Paginator->sort('fontSwf'); ?></th>
			<th><?php echo $this->Paginator->sort('fontExtension'); ?></th>
			<th><?php echo $this->Paginator->sort('fontPath'); ?></th>
			<th><?php echo $this->Paginator->sort('metatags'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($fonts as $font): ?>
	<tr>
		<td><?php echo h($font['Font']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($font['Category']['name'], array('controller' => 'categories', 'action' => 'view', $font['Category']['id'])); ?>
		</td>
		<td><?php echo h($font['Font']['fontName']); ?>&nbsp;</td>
		<td><?php echo h($font['Font']['fontOrig']); ?>&nbsp;</td>
		<td><?php echo h($font['Font']['fontSwf']); ?>&nbsp;</td>
		<td><?php echo h($font['Font']['fontExtension']); ?>&nbsp;</td>
		<td><?php echo h($font['Font']['fontPath']); ?>&nbsp;</td>
		<td><?php echo h($font['Font']['metatags']); ?>&nbsp;</td>
		<td><?php echo h($font['Font']['created']); ?>&nbsp;</td>
		<td><?php echo h($font['Font']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $font['Font']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $font['Font']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $font['Font']['id']), null, __('Are you sure you want to delete # %s?', $font['Font']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Font'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
