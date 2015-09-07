<div class="backgrounds view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Background'), array('action' => 'edit', $background['Background']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Background'), array('action' => 'delete', $background['Background']['id']), null, __('Are you sure you want to delete # %s?', $background['Background']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Backgrounds'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Background'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Background Styles'), array('controller' => 'background_styles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Background Style'), array('controller' => 'background_styles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Background Types'), array('controller' => 'background_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Background Type'), array('controller' => 'background_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Background');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($background['Background']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Label'); ?></dt>
		<dd>
			<?php echo h($background['Background']['label']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category Id'); ?></dt>
		<dd>
			<?php echo h($background['Background']['category_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Directory'); ?></dt>
		<dd>
			<?php echo h($background['Background']['directory']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hires'); ?></dt>
		<dd>
			<?php echo h($background['Background']['hires']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bytesize'); ?></dt>
		<dd>
			<?php echo h($background['Background']['bytesize']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Width'); ?></dt>
		<dd>
			<?php echo h($background['Background']['width']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Height'); ?></dt>
		<dd>
			<?php echo h($background['Background']['height']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Metatags'); ?></dt>
		<dd>
			<?php echo h($background['Background']['metatags']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($background['Background']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($background['Background']['modified']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
	<div class="row">
		<div class="related col-md-10 col-md-offset-2">
			<hr>
			<h3><?php echo __('Related Background Styles');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New Background Style'), array('controller' => 'background_styles', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($background['BackgroundStyle'])):?>
			<table class="table">
				<tr>
							<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Background Id'); ?></th>
		<th><?php echo __('Style Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
					<th class="actions"><?php echo __('Actions');?></th>
				</tr>
					<?php
		$i = 0;
		foreach ($background['BackgroundStyle'] as $backgroundStyle): ?>
		<tr>
			<td><?php echo $backgroundStyle['id'];?></td>
			<td><?php echo $backgroundStyle['background_id'];?></td>
			<td><?php echo $backgroundStyle['style_id'];?></td>
			<td><?php echo $backgroundStyle['created'];?></td>
			<td><?php echo $backgroundStyle['modified'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'background_styles', 'action' => 'view', $backgroundStyle['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'background_styles', 'action' => 'edit', $backgroundStyle['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'background_styles', 'action' => 'delete', $backgroundStyle['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $backgroundStyle['id'])); ?>
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
			<h3><?php echo __('Related Background Types');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New Background Type'), array('controller' => 'background_types', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($background['BackgroundType'])):?>
			<table class="table">
				<tr>
							<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Background Id'); ?></th>
		<th><?php echo __('Type Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
					<th class="actions"><?php echo __('Actions');?></th>
				</tr>
					<?php
		$i = 0;
		foreach ($background['BackgroundType'] as $backgroundType): ?>
		<tr>
			<td><?php echo $backgroundType['id'];?></td>
			<td><?php echo $backgroundType['background_id'];?></td>
			<td><?php echo $backgroundType['type_id'];?></td>
			<td><?php echo $backgroundType['created'];?></td>
			<td><?php echo $backgroundType['modified'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'background_types', 'action' => 'view', $backgroundType['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'background_types', 'action' => 'edit', $backgroundType['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'background_types', 'action' => 'delete', $backgroundType['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $backgroundType['id'])); ?>
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
	<?php if (!empty($background['Category'])):?>
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
		foreach ($background['Category'] as $category): ?>
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
	<?php if (!empty($background['Tag'])):?>
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
		foreach ($background['Tag'] as $tag): ?>
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