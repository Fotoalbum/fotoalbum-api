<div class="stickers view">
<h2><?php echo __('Sticker'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sticker['Sticker']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Label'); ?></dt>
		<dd>
			<?php echo h($sticker['Sticker']['label']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($sticker['Category']['name'], array('controller' => 'categories', 'action' => 'view', $sticker['Category']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lowres'); ?></dt>
		<dd>
			<?php echo h($sticker['Sticker']['lowres']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hires'); ?></dt>
		<dd>
			<?php echo h($sticker['Sticker']['hires']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Thumb'); ?></dt>
		<dd>
			<?php echo h($sticker['Sticker']['thumb']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Metatags'); ?></dt>
		<dd>
			<?php echo h($sticker['Sticker']['metatags']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($sticker['Sticker']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($sticker['Sticker']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sticker'), array('action' => 'edit', $sticker['Sticker']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sticker'), array('action' => 'delete', $sticker['Sticker']['id']), null, __('Are you sure you want to delete # %s?', $sticker['Sticker']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Stickers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sticker'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
