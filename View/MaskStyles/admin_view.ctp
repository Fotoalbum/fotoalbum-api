<div class="maskStyles view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Mask Style'), array('action' => 'edit', $maskStyle['MaskStyle']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Mask Style'), array('action' => 'delete', $maskStyle['MaskStyle']['id']), null, __('Are you sure you want to delete # %s?', $maskStyle['MaskStyle']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Mask Styles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mask Style'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Masks'), array('controller' => 'masks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mask'), array('controller' => 'masks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Styles'), array('controller' => 'styles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Style'), array('controller' => 'styles', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Mask Style');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($maskStyle['MaskStyle']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mask'); ?></dt>
		<dd>
			<?php echo $this->Html->link($maskStyle['Mask']['name'], array('controller' => 'masks', 'action' => 'view', $maskStyle['Mask']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Style'); ?></dt>
		<dd>
			<?php echo $this->Html->link($maskStyle['Style']['name'], array('controller' => 'styles', 'action' => 'view', $maskStyle['Style']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($maskStyle['MaskStyle']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($maskStyle['MaskStyle']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
