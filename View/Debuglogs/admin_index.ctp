<div class="debuglogs index row">
<div class="actions col-md-2 span2">
	<ul class="nav nav-list">
        <li class="nav-header"><?php echo __('Actions'); ?></li>
		<li><?php echo $this->Html->link(__('New Debuglog'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Products'), array('controller' => 'user_products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Product'), array('controller' => 'user_products', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="col-md-10 span10">
	<h2><?php echo __('Debuglogs');?></h2>
	<table class="table table-condensed table-hover" style="white-space:nowrap;">
		<thead>
			<tr>
										<th><?php echo $this->Paginator->sort('id');?></th>
												<th><?php echo $this->Paginator->sort('user_id');?></th>
												<th><?php echo $this->Paginator->sort('created');?></th>
												<th><?php echo $this->Paginator->sort('modified');?></th>
										<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($debuglogs as $debuglog): ?>
	<tr>
		<td><?php echo h($debuglog['Debuglog']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($debuglog['User']['id'], array('controller' => 'users', 'action' => 'view', $debuglog['User']['id'])); ?>
		</td>
		<td><?php echo h($debuglog['Debuglog']['created']); ?>&nbsp;</td>
		<td><?php echo h($debuglog['Debuglog']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $debuglog['Debuglog']['id']), array('class' => 'btn btn-default')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $debuglog['Debuglog']['id']), array('class' => 'btn btn-default')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $debuglog['Debuglog']['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $debuglog['Debuglog']['id'])); ?>
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

