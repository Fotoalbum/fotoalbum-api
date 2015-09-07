<div class="backgroundStyles view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Background Style'), array('action' => 'edit', $backgroundStyle['BackgroundStyle']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Background Style'), array('action' => 'delete', $backgroundStyle['BackgroundStyle']['id']), null, __('Are you sure you want to delete # %s?', $backgroundStyle['BackgroundStyle']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Background Styles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Background Style'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Backgrounds'), array('controller' => 'backgrounds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Background'), array('controller' => 'backgrounds', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Styles'), array('controller' => 'styles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Style'), array('controller' => 'styles', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Background Style');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($backgroundStyle['BackgroundStyle']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Background'); ?></dt>
		<dd>
			<?php echo $this->Html->link($backgroundStyle['Background']['name'], array('controller' => 'backgrounds', 'action' => 'view', $backgroundStyle['Background']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Style'); ?></dt>
		<dd>
			<?php echo $this->Html->link($backgroundStyle['Style']['name'], array('controller' => 'styles', 'action' => 'view', $backgroundStyle['Style']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($backgroundStyle['BackgroundStyle']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($backgroundStyle['BackgroundStyle']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
