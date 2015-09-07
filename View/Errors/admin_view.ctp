<div class="errors view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Error'), array('action' => 'edit', $error['Error']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Error'), array('action' => 'delete', $error['Error']['id']), null, __('Are you sure you want to delete # %s?', $error['Error']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Errors'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Error'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Products'), array('controller' => 'user_products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Product'), array('controller' => 'user_products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Error');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($error['Error']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($error['User']['id'], array('controller' => 'users', 'action' => 'view', $error['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($error['Product']['name'], array('controller' => 'products', 'action' => 'view', $error['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($error['UserProduct']['name'], array('controller' => 'user_products', 'action' => 'view', $error['UserProduct']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($error['Error']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($error['Error']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($error['Error']['created']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
