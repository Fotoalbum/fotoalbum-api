<div class="maskTypes view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Mask Type'), array('action' => 'edit', $maskType['MaskType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Mask Type'), array('action' => 'delete', $maskType['MaskType']['id']), null, __('Are you sure you want to delete # %s?', $maskType['MaskType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Mask Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mask Type'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Masks'), array('controller' => 'masks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mask'), array('controller' => 'masks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Mask Type');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($maskType['MaskType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mask'); ?></dt>
		<dd>
			<?php echo $this->Html->link($maskType['Mask']['name'], array('controller' => 'masks', 'action' => 'view', $maskType['Mask']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($maskType['Type']['name'], array('controller' => 'types', 'action' => 'view', $maskType['Type']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($maskType['MaskType']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($maskType['MaskType']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
