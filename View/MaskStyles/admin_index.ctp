<div class="maskStyles index row">
<div class="actions col-md-2 span2">
	<ul class="nav nav-list">
        <li class="nav-header"><?php echo __('Actions'); ?></li>
		<li><?php echo $this->Html->link(__('New Mask Style'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Masks'), array('controller' => 'masks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mask'), array('controller' => 'masks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Styles'), array('controller' => 'styles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Style'), array('controller' => 'styles', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="col-md-10 span10">
	<h2><?php echo __('Mask Styles');?></h2>
	<table class="table table-condensed table-hover" style="white-space:nowrap;">
		<thead>
			<tr>
										<th><?php echo $this->Paginator->sort('id');?></th>
												<th><?php echo $this->Paginator->sort('mask_id');?></th>
												<th><?php echo $this->Paginator->sort('style_id');?></th>
												<th><?php echo $this->Paginator->sort('created');?></th>
												<th><?php echo $this->Paginator->sort('modified');?></th>
										<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($maskStyles as $maskStyle): ?>
	<tr>
		<td><?php echo h($maskStyle['MaskStyle']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($maskStyle['Mask']['name'], array('controller' => 'masks', 'action' => 'view', $maskStyle['Mask']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($maskStyle['Style']['name'], array('controller' => 'styles', 'action' => 'view', $maskStyle['Style']['id'])); ?>
		</td>
		<td><?php echo h($maskStyle['MaskStyle']['created']); ?>&nbsp;</td>
		<td><?php echo h($maskStyle['MaskStyle']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $maskStyle['MaskStyle']['id']), array('class' => 'btn btn-default btn-xs')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $maskStyle['MaskStyle']['id']), array('class' => 'btn btn-default btn-xs')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $maskStyle['MaskStyle']['id']), array('class' => 'btn btn-danger btn-xs'), __('Are you sure you want to delete # %s?', $maskStyle['MaskStyle']['id'])); ?>
				</div>
			</div>
		</td>
	</tr>
<?php endforeach; ?>
		</tbody>
	</table>
    <div class="well">
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</div>

	<div class="paging pager btn-group">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array('class' => 'prev btn'), null, array('class' => 'prev disabled btn'));
		echo $this->Paginator->numbers(array('separator' => '', 'class' => 'btn', 'currentClass' => 'active'));
		echo $this->Paginator->next(__('next') . ' >', array('class' => 'next btn'), null, array('class' => 'next disabled btn'));
	?>
	</div>
</div>
</div>

