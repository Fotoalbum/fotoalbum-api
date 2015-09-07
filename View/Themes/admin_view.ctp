<div class="themes view row">
	<div class="actions col-md-3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Theme'), array('action' => 'edit', $theme['Theme']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Theme'), array('action' => 'delete', $theme['Theme']['id']), null, __('Are you sure you want to delete # %s?', $theme['Theme']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Themes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Theme'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="col-md-9">
		<h2><?php  echo __('Theme');?></h2>
		<dl class="dl-horizontal">
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($theme['Theme']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($theme['User']['id'], array('controller' => 'users', 'action' => 'view', $theme['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($theme['Product']['name'], array('controller' => 'products', 'action' => 'view', $theme['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($theme['Theme']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pages Xml'); ?></dt>
		<dd>
			<?php echo h($theme['Theme']['pages_xml']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Textflow Xml'); ?></dt>
		<dd>
			<?php echo h($theme['Theme']['textflow_xml']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Textlines Xml'); ?></dt>
		<dd>
			<?php echo h($theme['Theme']['textlines_xml']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Photo Xml'); ?></dt>
		<dd>
			<?php echo h($theme['Theme']['photo_xml']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Color Xml'); ?></dt>
		<dd>
			<?php echo h($theme['Theme']['color_xml']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Metadata Xml'); ?></dt>
		<dd>
			<?php echo h($theme['Theme']['metadata_xml']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Single Product Xml'); ?></dt>
		<dd>
			<?php echo h($theme['Theme']['single_product_xml']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Directory'); ?></dt>
		<dd>
			<?php echo h($theme['Theme']['directory']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('File Name'); ?></dt>
		<dd>
			<?php echo h($theme['Theme']['file_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Numpages'); ?></dt>
		<dd>
			<?php echo h($theme['Theme']['numpages']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($theme['Theme']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($theme['Theme']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($theme['Theme']['active']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
