<div class="pagelayouts view">
<h2><?php echo __('Pagelayout'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($pagelayout['Pagelayout']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Label'); ?></dt>
		<dd>
			<?php echo h($pagelayout['Pagelayout']['label']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pagetype'); ?></dt>
		<dd>
			<?php echo h($pagelayout['Pagelayout']['pagetype']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pageshape'); ?></dt>
		<dd>
			<?php echo h($pagelayout['Pagelayout']['pageshape']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('PhotoNum'); ?></dt>
		<dd>
			<?php echo h($pagelayout['Pagelayout']['photoNum']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('StickerNum'); ?></dt>
		<dd>
			<?php echo h($pagelayout['Pagelayout']['stickerNum']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('TextNum'); ?></dt>
		<dd>
			<?php echo h($pagelayout['Pagelayout']['textNum']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Layout'); ?></dt>
		<dd>
			<?php echo h($pagelayout['Pagelayout']['layout']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($pagelayout['Pagelayout']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($pagelayout['Pagelayout']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Pagelayout'), array('action' => 'edit', $pagelayout['Pagelayout']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Pagelayout'), array('action' => 'delete', $pagelayout['Pagelayout']['id']), null, __('Are you sure you want to delete # %s?', $pagelayout['Pagelayout']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Pagelayouts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pagelayout'), array('action' => 'add')); ?> </li>
	</ul>
</div>
