<div class="fontfamilies view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Fontfamily'), array('action' => 'edit', $fontfamily['Fontfamily']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Fontfamily'), array('action' => 'delete', $fontfamily['Fontfamily']['id']), null, __('Are you sure you want to delete # %s?', $fontfamily['Fontfamily']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fontfamilies'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fontfamily'), array('action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Fontfamily');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($fontfamily['Fontfamily']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($fontfamily['Fontfamily']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fonts Xml'); ?></dt>
		<dd>
			<?php echo h($fontfamily['Fontfamily']['fonts_xml']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($fontfamily['Fontfamily']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($fontfamily['Fontfamily']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($fontfamily['Fontfamily']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
