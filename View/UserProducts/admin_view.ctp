<div class="userProducts view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit User Product'), array('action' => 'edit', $userProduct['UserProduct']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Product'), array('action' => 'delete', $userProduct['UserProduct']['id']), null, __('Are you sure you want to delete # %s?', $userProduct['UserProduct']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Products'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Product'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('User Product');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userProduct['UserProduct']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userProduct['User']['id'], array('controller' => 'users', 'action' => 'view', $userProduct['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userProduct['Product']['name'], array('controller' => 'products', 'action' => 'view', $userProduct['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($userProduct['UserProduct']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pages Xml'); ?></dt>
		<dd>
			<?php echo h($userProduct['UserProduct']['pages_xml']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Textflow Xml'); ?></dt>
		<dd>
			<?php echo h($userProduct['UserProduct']['textflow_xml']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Textlines Xml'); ?></dt>
		<dd>
			<?php echo h($userProduct['UserProduct']['textlines_xml']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Photo Xml'); ?></dt>
		<dd>
			<?php echo h($userProduct['UserProduct']['photo_xml']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('File Name'); ?></dt>
		<dd>
			<?php echo h($userProduct['UserProduct']['file_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($userProduct['UserProduct']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($userProduct['UserProduct']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($userProduct['UserProduct']['status']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
