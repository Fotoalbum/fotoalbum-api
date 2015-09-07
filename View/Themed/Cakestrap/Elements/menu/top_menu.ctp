<nav class="navbar navbar-default" role="navigation">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button><!-- /.navbar-toggle -->
		<?php echo $this->Html->Link('XHIBIT API-II', 'http://api.xhibit.com/v2/', array('class' => 'text-danger navbar-brand')); ?>
	</div><!-- /.navbar-header -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav">
			<?php
			if ($sessionarray['id']>0)
			{
				?>
				<li><a href="/v2/users/dashboard">Dashboard</a></li>
				<li><a href="/v2/admin">Admin</a></li>				
				<li class="active"><a href="/v2/uitloggen">Uitloggen</a></li>
				<?php
			}
			else
			{
				?><li class="active"><a href="/v2/inloggen">Inloggen</a></li><?php
			}
			?>
		</ul><!-- /.nav navbar-nav -->
	</div><!-- /.navbar-collapse -->
</nav><!-- /.navbar navbar-default -->