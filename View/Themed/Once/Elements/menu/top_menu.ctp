<?php

$current_plugin = $this->params['plugin'];
$current_page = $this->params['action'];
$current_controller = $this->params['controller'];

?>

<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container-fluid">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="brand" href="#">O.N.C.E.  (Online New Competition Editor)</a>
			<div class="nav-collapse collapse">
				<ul class="nav">
					<li class="dropdown  <?php if($current_plugin == 'survey'){ echo 'active';} ?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo __('Competitions');?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo $this->Html->url('/once/');?>"><?php echo __('Manage Competitions');?></a></li>
							<li><a href="<?php echo $this->Html->url('/once/add');?>"><?php echo __('New Competition');?></a></li>
						</ul>
					</li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
</div>