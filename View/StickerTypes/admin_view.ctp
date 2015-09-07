<div class="stickerTypes view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Sticker Type'), array('action' => 'edit', $stickerType['StickerType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sticker Type'), array('action' => 'delete', $stickerType['StickerType']['id']), null, __('Are you sure you want to delete # %s?', $stickerType['StickerType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sticker Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sticker Type'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stickers'), array('controller' => 'stickers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sticker'), array('controller' => 'stickers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Sticker Type');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($stickerType['StickerType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sticker'); ?></dt>
		<dd>
			<?php echo $this->Html->link($stickerType['Sticker']['name'], array('controller' => 'stickers', 'action' => 'view', $stickerType['Sticker']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($stickerType['Type']['name'], array('controller' => 'types', 'action' => 'view', $stickerType['Type']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($stickerType['StickerType']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($stickerType['StickerType']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
