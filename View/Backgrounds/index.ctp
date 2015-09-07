<div class="backgrounds index row">
<div class="actions col-md-2 span2">
	<ul class="nav nav-list">
        <li class="nav-header"><?php echo __('Actions'); ?></li>
		<li><?php echo $this->Html->link(__('New Background'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Background Styles'), array('controller' => 'background_styles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Background Style'), array('controller' => 'background_styles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Background Types'), array('controller' => 'background_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Background Type'), array('controller' => 'background_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="col-md-10 span10">
	<h2><?php echo __('Backgrounds');?></h2>
	<table class="table table-condensed table-hover" style="white-space:nowrap;">
		<thead>
			<tr>
										<th><?php echo $this->Paginator->sort('id');?></th>
												<th><?php echo $this->Paginator->sort('label');?></th>
												<th><?php echo $this->Paginator->sort('width');?></th>
												<th><?php echo $this->Paginator->sort('height');?></th>
												<th><?php echo $this->Paginator->sort('created');?></th>
												<th><?php echo $this->Paginator->sort('modified');?></th>
										<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($backgrounds as $background): ?>
	<tr>
		<td><?php echo h($background['Background']['id']); ?>&nbsp;</td>
		<td><?php echo h($background['Background']['label']); ?>&nbsp;</td>
		<td><?php echo h($background['Background']['width']); ?>&nbsp;</td>
		<td><?php echo h($background['Background']['height']); ?>&nbsp;</td>
		<td><?php echo h($background['Background']['created']); ?>&nbsp;</td>
		<td><?php echo h($background['Background']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $background['Background']['id']), array('class' => 'btn btn-default btn-xs')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $background['Background']['id']), array('class' => 'btn btn-default btn-xs')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $background['Background']['id']), array('class' => 'btn btn-danger btn-xs'), __('Are you sure you want to delete # %s?', $background['Background']['id'])); ?>
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

