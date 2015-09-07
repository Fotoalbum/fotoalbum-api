<div class="fonts view">
<h2><?php echo __('Font'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($font['Font']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($font['Category']['name'], array('controller' => 'categories', 'action' => 'view', $font['Category']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('FontName'); ?></dt>
		<dd>
			<?php echo h($font['Font']['fontName']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('FontOrig'); ?></dt>
		<dd>
			<?php echo h($font['Font']['fontOrig']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('FontSwf'); ?></dt>
		<dd>
			<?php echo h($font['Font']['fontSwf']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('FontExtension'); ?></dt>
		<dd>
			<?php echo h($font['Font']['fontExtension']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('FontPath'); ?></dt>
		<dd>
			<?php echo h($font['Font']['fontPath']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Metatags'); ?></dt>
		<dd>
			<?php echo h($font['Font']['metatags']); ?>
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Font'), array('action' => 'edit', $font['Font']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Font'), array('action' => 'delete', $font['Font']['id']), null, __('Are you sure you want to delete # %s?', $font['Font']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fonts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Font'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
