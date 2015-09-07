<div class="fonts view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Font'), array('action' => 'edit', $font['Font']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Font'), array('action' => 'delete', $font['Font']['id']), null, __('Are you sure you want to delete # %s?', $font['Font']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fonts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Font'), array('action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Font');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($font['Font']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($font['Font']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('SwfName'); ?></dt>
		<dd>
			<?php echo h($font['Font']['swfName']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Extension'); ?></dt>
		<dd>
			<?php echo h($font['Font']['extension']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('FullPathSwf'); ?></dt>
		<dd>
			<?php echo h($font['Font']['fullPathSwf']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('FullPathOriginal'); ?></dt>
		<dd>
			<?php echo h($font['Font']['fullPathOriginal']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($font['Font']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($font['Font']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
