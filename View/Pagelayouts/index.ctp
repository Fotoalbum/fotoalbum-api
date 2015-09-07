<div class="pagelayouts index">
	<h2><?php echo __('Pagelayouts'); ?></h2>
	<table class="table" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('label'); ?></th>
			<th><?php echo $this->Paginator->sort('pagetype'); ?></th>
			<th><?php echo $this->Paginator->sort('pageshape'); ?></th>
			<th><?php echo $this->Paginator->sort('photoNum'); ?></th>
			<th><?php echo $this->Paginator->sort('stickerNum'); ?></th>
			<th><?php echo $this->Paginator->sort('textNum'); ?></th>
			<th><?php echo $this->Paginator->sort('layout'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($pagelayouts as $pagelayout): ?>
	<tr>
		<td><?php echo h($pagelayout['Pagelayout']['id']); ?>&nbsp;</td>
		<td><?php echo h($pagelayout['Pagelayout']['label']); ?>&nbsp;</td>
		<td><?php echo h($pagelayout['Pagelayout']['pagetype']); ?>&nbsp;</td>
		<td><?php echo h($pagelayout['Pagelayout']['pageshape']); ?>&nbsp;</td>
		<td><?php echo h($pagelayout['Pagelayout']['photoNum']); ?>&nbsp;</td>
		<td><?php echo h($pagelayout['Pagelayout']['stickerNum']); ?>&nbsp;</td>
		<td><?php echo h($pagelayout['Pagelayout']['textNum']); ?>&nbsp;</td>
		<td><?php echo h($pagelayout['Pagelayout']['layout']); ?>&nbsp;</td>
		<td><?php echo h($pagelayout['Pagelayout']['created']); ?>&nbsp;</td>
		<td><?php echo h($pagelayout['Pagelayout']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $pagelayout['Pagelayout']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $pagelayout['Pagelayout']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $pagelayout['Pagelayout']['id']), null, __('Are you sure you want to delete # %s?', $pagelayout['Pagelayout']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Pagelayout'), array('action' => 'add')); ?></li>
	</ul>
</div>
