<div class="types view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Type'), array('action' => 'edit', $type['Type']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Type'), array('action' => 'delete', $type['Type']['id']), null, __('Are you sure you want to delete # %s?', $type['Type']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Backgrounds'), array('controller' => 'backgrounds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Background'), array('controller' => 'backgrounds', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Masks'), array('controller' => 'masks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mask'), array('controller' => 'masks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stickers'), array('controller' => 'stickers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sticker'), array('controller' => 'stickers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Type');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($type['Type']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($type['Type']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Foreign Model'); ?></dt>
		<dd>
			<?php echo h($type['Type']['foreign_model']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($type['Type']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($type['Type']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
	<div class="row">
		<div class="related col-md-10 col-md-offset-2">
			<hr>
			<h3><?php echo __('Related Backgrounds');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New Background'), array('controller' => 'backgrounds', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($type['Background'])):?>
			<table class="table">
				<tr>
							<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Width'); ?></th>
		<th><?php echo __('Height'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
					<th class="actions"><?php echo __('Actions');?></th>
				</tr>
					<?php
		$i = 0;
		foreach ($type['Background'] as $background): ?>
		<tr>
			<td><?php echo $background['id'];?></td>
			<td><?php echo $background['name'];?></td>
			<td><?php echo $background['width'];?></td>
			<td><?php echo $background['height'];?></td>
			<td><?php echo $background['created'];?></td>
			<td><?php echo $background['modified'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'backgrounds', 'action' => 'view', $background['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'backgrounds', 'action' => 'edit', $background['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'backgrounds', 'action' => 'delete', $background['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $background['id'])); ?>
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
			<h3><?php echo __('Related Masks');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New Mask'), array('controller' => 'masks', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($type['Mask'])):?>
			<table class="table">
				<tr>
							<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Width'); ?></th>
		<th><?php echo __('Height'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
					<th class="actions"><?php echo __('Actions');?></th>
				</tr>
					<?php
		$i = 0;
		foreach ($type['Mask'] as $mask): ?>
		<tr>
			<td><?php echo $mask['id'];?></td>
			<td><?php echo $mask['name'];?></td>
			<td><?php echo $mask['width'];?></td>
			<td><?php echo $mask['height'];?></td>
			<td><?php echo $mask['created'];?></td>
			<td><?php echo $mask['modified'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'masks', 'action' => 'view', $mask['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'masks', 'action' => 'edit', $mask['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'masks', 'action' => 'delete', $mask['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $mask['id'])); ?>
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
			<h3><?php echo __('Related Stickers');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New Sticker'), array('controller' => 'stickers', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($type['Sticker'])):?>
			<table class="table">
				<tr>
							<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Width'); ?></th>
		<th><?php echo __('Height'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
					<th class="actions"><?php echo __('Actions');?></th>
				</tr>
					<?php
		$i = 0;
		foreach ($type['Sticker'] as $sticker): ?>
		<tr>
			<td><?php echo $sticker['id'];?></td>
			<td><?php echo $sticker['name'];?></td>
			<td><?php echo $sticker['width'];?></td>
			<td><?php echo $sticker['height'];?></td>
			<td><?php echo $sticker['created'];?></td>
			<td><?php echo $sticker['modified'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'stickers', 'action' => 'view', $sticker['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'stickers', 'action' => 'edit', $sticker['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'stickers', 'action' => 'delete', $sticker['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $sticker['id'])); ?>
				</div>
			</div>
			</td>
		</tr>
	<?php endforeach; ?>
			</table>
	<?php endif; ?>

		</div>
	</div>
