<div class="backgroundTypes view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Background Type'), array('action' => 'edit', $backgroundType['BackgroundType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Background Type'), array('action' => 'delete', $backgroundType['BackgroundType']['id']), null, __('Are you sure you want to delete # %s?', $backgroundType['BackgroundType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Background Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Background Type'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Backgrounds'), array('controller' => 'backgrounds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Background'), array('controller' => 'backgrounds', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Background Type');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($backgroundType['BackgroundType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Background'); ?></dt>
		<dd>
			<?php echo $this->Html->link($backgroundType['Background']['name'], array('controller' => 'backgrounds', 'action' => 'view', $backgroundType['Background']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($backgroundType['Type']['name'], array('controller' => 'types', 'action' => 'view', $backgroundType['Type']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($backgroundType['BackgroundType']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($backgroundType['BackgroundType']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
