<?php $this->Html->css('DocumentManager.style', null, array('block' => 'css')); ?>
<?php $this->Html->script(array(
	'DocumentManager.script',
	'DocumentManager.jquery.zclip.min'
) , array('block' => 'script')); ?>

		<h1><?php echo __d("document_manager", "Gestion des documents");?></h1>

		<p class="breadcrumb">

			<?php 
				echo $this->Html->link("Home",array('action' => 'index'));
				foreach ($pathFolderNames as $i => $pathFolderName)
				{
					echo ' » ';
					echo $this->Html->link( $pathFolderName, array_slice($pathFolderNames, 0, $i + 1) );
				}
			?>
		</p>

		<div class="section">
			<div class="section-header">
				<h3>Folder
					<small>
						List of all your folders
					</small>
				</h3>
				<div class="section-actions">
					<div class="btn-group">
						<a href="#add_folder" class="btn btn-primary">
							New Folder
						</a>
					</div>
				</div>
			</div>
			<div class="section-body">
				<table class="table table-outer-bordered">
				    <thead>
				        <tr>
				        <th>Description</th>
				    	<th>Group</th>
				        <th>&nbsp;</th>
				    	<th>Action</th>
				    	<th class="actions">Actions</th>
				        <th>Order</th>
				        </tr>
				    </thead>
					<tbody>
						<?php
						$i = 0;
						foreach ($folders as $folder)
						{
							?>
							<tr>
								<td>
									<?php echo $this->element('folder', compact('pathFolderNames', 'folder')); ?>
								</td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="section">
			<div class="section-header">
				<h3>Files
					<small>
						List of all your files
					</small>
				</h3>
				<div class="section-actions">
					<div class="btn-group">
						<a href="#add_file" class="btn btn-primary">
							New File
						</a>
					</div>
				</div>
			</div>
			<div class="section-body">
				<table class="table table-outer-bordered">
				    <thead>
				        <tr>
				        <th>Description</th>
				    	<th>Owner</th>
				    	<th class="actions">Actions</th>
				        </tr>
				    </thead>
					<tbody>
						<?php
						$i = 0;
						foreach ($files as $file)
						{
							?>
							<tr>
								<?php echo $this->element('file', compact('pathFolderNames', 'file')); ?>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<br>
		<br>
		<br>
		<br>
		<a name="add_folder">&nbsp;</a>
		<br>
		<div class="section">
			<div class="section-header">
				<h3><?php echo __d("document_manager", "Créer un nouveau dossier"); ?></h3>
			</div>
			<div class="section-body">		
				<?php echo $this->Form->create(false, array(
					'url' => array_merge(
						$pathFolderNames,
						array('action' => 'create_subfolder')
					)
				)); ?>
				<fieldset>
					<?php echo $this->Form->input('folderName', array(
						'div'=>'input text',
						'label' => array( 'text' => __d("document_manager", "Nom du dossier"), 'class' => 'control-label'),
						'title' => __d("document_manager", "Chosissez un nom de dossier puis appuyez sur le bouton créer."),
						)); ?>
					<?php echo $this->Form->submit(__d("document_manager", "Créer"), array('div' => false, 'class' => 'btn')); ?>
					<div class="clear"></div>
				</fieldset>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
		<a name="add_file">&nbsp;</a>
		<hr>
		<div class="section">
			<div class="section-header">
				<h3><?php echo __d("document_manager", "Ajouter un fichier"); ?></h3>
			</div>
			<div class="section-body">
			<?php if (!(empty($pathFolderNames) && Configure::read('DocumentManager.excludeRootFiles'))): ?>
				<?php echo $this->Form->create(false, array(
					'url' => array_merge(
						$pathFolderNames,
						array('action' => 'upload_file')
					),
					'enctype' => 'multipart/form-data'
				)); ?>
				<fieldset>
					<div class="control-group">
						<label class="control-label"><?php echo __d("document_manager", "Ajouter un fichier"); ?></label>
						<div class="controls">
	
							<?php echo $this->Form->file('file'); ?>
						</div>
					</div>
					<?php echo $this->Form->input('comments', array('type' => 'textarea', 'label' => array( 'text' => __d("document_manager", "Description du fichier"), 'class' => 'control-label'))); ?>
					<?php echo $this->Form->submit(__d("document_manager", "Mettre en ligne"), array('div' => false, 'class' => 'btn')); ?>
					<div class="clear"></div>
				</fieldset>
				<?php echo $this->Form->end(); ?>
			<?php endif; ?>
		</div>

