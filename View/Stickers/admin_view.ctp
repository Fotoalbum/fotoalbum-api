<div class="stickers view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Sticker'), array('action' => 'edit', $sticker['Sticker']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sticker'), array('action' => 'delete', $sticker['Sticker']['id']), null, __('Are you sure you want to delete # %s?', $sticker['Sticker']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Stickers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sticker'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Styles'), array('controller' => 'styles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Style'), array('controller' => 'styles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sticker Styles'), array('controller' => 'sticker_styles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sticker Style'), array('controller' => 'sticker_styles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sticker Types'), array('controller' => 'sticker_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sticker Type'), array('controller' => 'sticker_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Sticker');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sticker['Sticker']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($sticker['Sticker']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category Id'); ?></dt>
		<dd>
			<?php echo h($sticker['Sticker']['category_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Style'); ?></dt>
		<dd>
			<?php echo $this->Html->link($sticker['Style']['name'], array('controller' => 'styles', 'action' => 'view', $sticker['Style']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($sticker['Type']['name'], array('controller' => 'types', 'action' => 'view', $sticker['Type']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Directory'); ?></dt>
		<dd>
			<?php echo h($sticker['Sticker']['directory']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hires'); ?></dt>
		<dd>
			<?php echo h($sticker['Sticker']['hires']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bytesize'); ?></dt>
		<dd>
			<?php echo h($sticker['Sticker']['bytesize']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Width'); ?></dt>
		<dd>
			<?php echo h($sticker['Sticker']['width']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Height'); ?></dt>
		<dd>
			<?php echo h($sticker['Sticker']['height']); ?>
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
</div>
	<div class="row">
		<div class="related col-md-10 col-md-offset-2">
			<hr>
			<h3><?php echo __('Related Sticker Styles');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New Sticker Style'), array('controller' => 'sticker_styles', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($sticker['StickerStyle'])):?>
			<table class="table">
				<tr>
							<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Sticker Id'); ?></th>
		<th><?php echo __('Style Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
					<th class="actions"><?php echo __('Actions');?></th>
				</tr>
					<?php
		$i = 0;
		foreach ($sticker['StickerStyle'] as $stickerStyle): ?>
		<tr>
			<td><?php echo $stickerStyle['id'];?></td>
			<td><?php echo $stickerStyle['sticker_id'];?></td>
			<td><?php echo $stickerStyle['style_id'];?></td>
			<td><?php echo $stickerStyle['created'];?></td>
			<td><?php echo $stickerStyle['modified'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'sticker_styles', 'action' => 'view', $stickerStyle['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'sticker_styles', 'action' => 'edit', $stickerStyle['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'sticker_styles', 'action' => 'delete', $stickerStyle['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $stickerStyle['id'])); ?>
				</div>
			</div>
			</td>
		</tr>
	<?php endforeach; ?>
			</table>
	<?php endif; ?>

		</div>
	</div>
	<div class="row">
		<div class="related col-md-10 col-md-offset-2">
			<hr>
			<h3><?php echo __('Related Sticker Types');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New Sticker Type'), array('controller' => 'sticker_types', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($sticker['StickerType'])):?>
			<table class="table">
				<tr>
							<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Sticker Id'); ?></th>
		<th><?php echo __('Type Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
					<th class="actions"><?php echo __('Actions');?></th>
				</tr>
					<?php
		$i = 0;
		foreach ($sticker['StickerType'] as $stickerType): ?>
		<tr>
			<td><?php echo $stickerType['id'];?></td>
			<td><?php echo $stickerType['sticker_id'];?></td>
			<td><?php echo $stickerType['type_id'];?></td>
			<td><?php echo $stickerType['created'];?></td>
			<td><?php echo $stickerType['modified'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'sticker_types', 'action' => 'view', $stickerType['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'sticker_types', 'action' => 'edit', $stickerType['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'sticker_types', 'action' => 'delete', $stickerType['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $stickerType['id'])); ?>
				</div>
			</div>
			</td>
		</tr>
	<?php endforeach; ?>
			</table>
	<?php endif; ?>

		</div>
	</div>
	<div class="row">
		<div class="related col-md-10 col-md-offset-2">
			<hr>
			<h3><?php echo __('Related Categories');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($sticker['Category'])):?>
			<table class="table">
				<tr>
							<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
					<th class="actions"><?php echo __('Actions');?></th>
				</tr>
					<?php
		$i = 0;
		foreach ($sticker['Category'] as $category): ?>
		<tr>
			<td><?php echo $category['id'];?></td>
			<td><?php echo $category['user_id'];?></td>
			<td><?php echo $category['name'];?></td>
			<td><?php echo $category['created'];?></td>
			<td><?php echo $category['modified'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'categories', 'action' => 'view', $category['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'categories', 'action' => 'edit', $category['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'categories', 'action' => 'delete', $category['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $category['id'])); ?>
				</div>
			</div>
			</td>
		</tr>
	<?php endforeach; ?>
			</table>
	<?php endif; ?>

		</div>
	</div>
	<div class="row">
		<div class="related col-md-10 col-md-offset-2">
			<hr>
			<h3><?php echo __('Related Tags');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($sticker['Tag'])):?>
			<table class="table">
				<tr>
							<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
					<th class="actions"><?php echo __('Actions');?></th>
				</tr>
					<?php
		$i = 0;
		foreach ($sticker['Tag'] as $tag): ?>
		<tr>
			<td><?php echo $tag['id'];?></td>
			<td><?php echo $tag['name'];?></td>
			<td><?php echo $tag['created'];?></td>
			<td><?php echo $tag['modified'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'tags', 'action' => 'view', $tag['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'tags', 'action' => 'edit', $tag['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'tags', 'action' => 'delete', $tag['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $tag['id'])); ?>
				</div>
			</div>
			</td>
		</tr>
	<?php endforeach; ?>
			</table>
	<?php endif; ?>

		</div>
	</div>
