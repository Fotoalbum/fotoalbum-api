<div class="productConversionServices index row">
	<div class="actions col-md-2 span2">&nbsp;</div>
	<div class="col-md-10 span10">
		<?php
		foreach ($items as $item)
		{
			?>
			<h2><?php echo $item;?></h2>
			<table class="table table-condensed table-hover" style="white-space:nowrap;">
				<thead>
					<tr>
						<th>ID</th>
						<th>Count</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($retdata[$item] as $_results)
					{
						if ($_results > 10)
						{
							?>
							<tr>
								<td><?php echo $_results['count'];?></td>
								<td><?php echo $this->Text->truncate($_results['id'], 50);?></td>
							</tr>
							<?php
						}
					}
					?>
				</tbody>
			</table>
			<?php
		}
		?>
	</div>
</div>

