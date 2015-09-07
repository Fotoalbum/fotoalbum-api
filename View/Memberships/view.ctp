<div class="memberships view">
<h2><?php echo __('Membership'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($membership['Membership']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($membership['Membership']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($membership['Membership']['code']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Membership'), array('action' => 'edit', $membership['Membership']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Membership'), array('action' => 'delete', $membership['Membership']['id']), null, __('Are you sure you want to delete # %s?', $membership['Membership']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Memberships'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Membership'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Printers'), array('controller' => 'printers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer'), array('controller' => 'printers', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Printers'); ?></h3>
	<?php if (!empty($membership['Printer'])): ?>
	<table class="table" cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Payee Name'); ?></th>
		<th><?php echo __('Website'); ?></th>
		<th><?php echo __('Kvk Nr'); ?></th>
		<th><?php echo __('Bank Nr'); ?></th>
		<th><?php echo __('Bank'); ?></th>
		<th><?php echo __('Bic'); ?></th>
		<th><?php echo __('Iban'); ?></th>
		<th><?php echo __('Vat Nr'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Task'); ?></th>
		<th><?php echo __('Membership Id'); ?></th>
		<th><?php echo __('Membership Status'); ?></th>
		<th><?php echo __('Share Public'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Lnk Picture'); ?></th>
		<th><?php echo __('Lnk Picture Normal'); ?></th>
		<th><?php echo __('Lnk Picture Thumb'); ?></th>
		<th><?php echo __('Lnk Picture Large'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($membership['Printer'] as $printer): ?>
		<tr>
			<td><?php echo $printer['id']; ?></td>
			<td><?php echo $printer['name']; ?></td>
			<td><?php echo $printer['payee_name']; ?></td>
			<td><?php echo $printer['website']; ?></td>
			<td><?php echo $printer['kvk_nr']; ?></td>
			<td><?php echo $printer['bank_nr']; ?></td>
			<td><?php echo $printer['bank']; ?></td>
			<td><?php echo $printer['bic']; ?></td>
			<td><?php echo $printer['iban']; ?></td>
			<td><?php echo $printer['vat_nr']; ?></td>
			<td><?php echo $printer['description']; ?></td>
			<td><?php echo $printer['task']; ?></td>
			<td><?php echo $printer['membership_id']; ?></td>
			<td><?php echo $printer['membership_status']; ?></td>
			<td><?php echo $printer['share_public']; ?></td>
			<td><?php echo $printer['created']; ?></td>
			<td><?php echo $printer['modified']; ?></td>
			<td><?php echo $printer['lnk_picture']; ?></td>
			<td><?php echo $printer['lnk_picture_normal']; ?></td>
			<td><?php echo $printer['lnk_picture_thumb']; ?></td>
			<td><?php echo $printer['lnk_picture_large']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'printers', 'action' => 'view', $printer['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'printers', 'action' => 'edit', $printer['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'printers', 'action' => 'delete', $printer['id']), null, __('Are you sure you want to delete # %s?', $printer['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Printer'), array('controller' => 'printers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
