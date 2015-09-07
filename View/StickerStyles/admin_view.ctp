<div class="stickerStyles view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Sticker Style'), array('action' => 'edit', $stickerStyle['StickerStyle']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sticker Style'), array('action' => 'delete', $stickerStyle['StickerStyle']['id']), null, __('Are you sure you want to delete # %s?', $stickerStyle['StickerStyle']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sticker Styles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sticker Style'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stickers'), array('controller' => 'stickers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sticker'), array('controller' => 'stickers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Styles'), array('controller' => 'styles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Style'), array('controller' => 'styles', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Sticker Style');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($stickerStyle['StickerStyle']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sticker'); ?></dt>
		<dd>
			<?php echo $this->Html->link($stickerStyle['Sticker']['name'], array('controller' => 'stickers', 'action' => 'view', $stickerStyle['Sticker']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Style'); ?></dt>
		<dd>
			<?php echo $this->Html->link($stickerStyle['Style']['name'], array('controller' => 'styles', 'action' => 'view', $stickerStyle['Style']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($stickerStyle['StickerStyle']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($stickerStyle['StickerStyle']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
