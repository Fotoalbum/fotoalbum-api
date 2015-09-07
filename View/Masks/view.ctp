<div class="masks view">
<h2><?php echo __('Mask'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($mask['Mask']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Label'); ?></dt>
		<dd>
			<?php echo h($mask['Mask']['label']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($mask['Category']['name'], array('controller' => 'categories', 'action' => 'view', $mask['Category']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Directory'); ?></dt>
		<dd>
			<?php echo h($mask['Mask']['directory']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hires'); ?></dt>
		<dd>
			<?php echo h($mask['Mask']['hires']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bytesize'); ?></dt>
		<dd>
			<?php echo h($mask['Mask']['bytesize']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Width'); ?></dt>
		<dd>
			<?php echo h($mask['Mask']['width']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Height'); ?></dt>
		<dd>
			<?php echo h($mask['Mask']['height']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Metatags'); ?></dt>
		<dd>
			<?php echo h($mask['Mask']['metatags']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($mask['Mask']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($mask['Mask']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Mask'), array('action' => 'edit', $mask['Mask']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Mask'), array('action' => 'delete', $mask['Mask']['id']), null, __('Are you sure you want to delete # %s?', $mask['Mask']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Masks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mask'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
