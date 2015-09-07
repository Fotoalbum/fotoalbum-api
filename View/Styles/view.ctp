<div class="styles view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Style'), array('action' => 'edit', $style['Style']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Style'), array('action' => 'delete', $style['Style']['id']), null, __('Are you sure you want to delete # %s?', $style['Style']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Styles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Style'), array('action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Style');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($style['Style']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Label'); ?></dt>
		<dd>
			<?php echo h($style['Style']['label']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($style['Style']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($style['Style']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
