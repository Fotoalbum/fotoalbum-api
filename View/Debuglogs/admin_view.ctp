<div class="debuglogs view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Debuglog'), array('action' => 'edit', $debuglog['Debuglog']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Debuglog'), array('action' => 'delete', $debuglog['Debuglog']['id']), null, __('Are you sure you want to delete # %s?', $debuglog['Debuglog']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Debuglogs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Debuglog'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Products'), array('controller' => 'user_products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Product'), array('controller' => 'user_products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Debuglog');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($debuglog['Debuglog']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($debuglog['User']['id'], array('controller' => 'users', 'action' => 'view', $debuglog['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($debuglog['Product']['name'], array('controller' => 'products', 'action' => 'view', $debuglog['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($debuglog['UserProduct']['name'], array('controller' => 'user_products', 'action' => 'view', $debuglog['UserProduct']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Action'); ?></dt>
		<dd>
			<?php echo h($debuglog['Debuglog']['action']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pages Xml'); ?></dt>
		<dd>
			<?php echo h($debuglog['Debuglog']['pages_xml']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Photo Xml'); ?></dt>
		<dd>
			<?php echo h($debuglog['Debuglog']['photo_xml']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Created'); ?></dt>
		<dd>
			<?php echo h($debuglog['Debuglog']['date_created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($debuglog['Debuglog']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($debuglog['Debuglog']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
