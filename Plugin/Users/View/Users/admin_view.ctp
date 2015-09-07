<div class="users view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Details'), array('controller' => 'user_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Detail'), array('controller' => 'user_details', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('User');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Slug'); ?></dt>
		<dd>
			<?php echo h($user['User']['slug']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($user['User']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password Token'); ?></dt>
		<dd>
			<?php echo h($user['User']['password_token']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email Verified'); ?></dt>
		<dd>
			<?php echo h($user['User']['email_verified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email Token'); ?></dt>
		<dd>
			<?php echo h($user['User']['email_token']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email Token Expires'); ?></dt>
		<dd>
			<?php echo h($user['User']['email_token_expires']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sso Token'); ?></dt>
		<dd>
			<?php echo h($user['User']['sso_token']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sso Token Expires'); ?></dt>
		<dd>
			<?php echo h($user['User']['sso_token_expires']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tos'); ?></dt>
		<dd>
			<?php echo h($user['User']['tos']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($user['User']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status1'); ?></dt>
		<dd>
			<?php echo h($user['User']['status1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Login'); ?></dt>
		<dd>
			<?php echo h($user['User']['last_login']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Action'); ?></dt>
		<dd>
			<?php echo h($user['User']['last_action']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Admin'); ?></dt>
		<dd>
			<?php echo h($user['User']['is_admin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo h($user['User']['role']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Picture'); ?></dt>
		<dd>
			<?php echo h($user['User']['picture']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Picture Dir'); ?></dt>
		<dd>
			<?php echo h($user['User']['picture_dir']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Firstname'); ?></dt>
		<dd>
			<?php echo h($user['User']['firstname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lastname'); ?></dt>
		<dd>
			<?php echo h($user['User']['lastname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($user['User']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip'); ?></dt>
		<dd>
			<?php echo h($user['User']['zip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($user['User']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo h($user['User']['country']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telephone'); ?></dt>
		<dd>
			<?php echo h($user['User']['telephone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Account Number'); ?></dt>
		<dd>
			<?php echo h($user['User']['account_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Account City'); ?></dt>
		<dd>
			<?php echo h($user['User']['account_city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Account Bank'); ?></dt>
		<dd>
			<?php echo h($user['User']['account_bank']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Migrated To 2'); ?></dt>
		<dd>
			<?php echo h($user['User']['migrated_to_2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
	<div class="row">
		<div class="related col-md-10 col-md-offset-2">
			<hr>
			<h3><?php echo __('Related User Details');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New User Detail'), array('controller' => 'user_details', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($user['UserDetail'])):?>
			<table class="table">
				<tr>
							<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Value'); ?></th>
		<th><?php echo __('Label'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
					<th class="actions"><?php echo __('Actions');?></th>
				</tr>
					<?php
		$i = 0;
		foreach ($user['UserDetail'] as $userDetail): ?>
		<tr>
			<td><?php echo $userDetail['id'];?></td>
			<td><?php echo $userDetail['user_id'];?></td>
			<td><?php echo $userDetail['value'];?></td>
			<td><?php echo $userDetail['label'];?></td>
			<td><?php echo $userDetail['created'];?></td>
			<td><?php echo $userDetail['modified'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_details', 'action' => 'view', $userDetail['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_details', 'action' => 'edit', $userDetail['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'user_details', 'action' => 'delete', $userDetail['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $userDetail['id'])); ?>
				</div>
			</div>
			</td>
		</tr>
	<?php endforeach; ?>
			</table>
	<?php endif; ?>

		</div>
	</div>
