<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?></title>
		
		<?php echo $this->Html->meta('icon'); ?>
		
		<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Oswald:400,700' rel='stylesheet' type='text/css'>

		<?php
			echo $this->Html->meta('favicon.ico','/favicon.ico',array('type' => 'icon'));		
			echo $this->Html->meta(array('name' => 'X-UA-Compatible', 'content' => 'IE=edge,chrome=1'));
			//$this->Html->meta(array('name' => 'robots', 'content' => 'noindex'));
			//$this->Html->meta('description', '[description]');
			echo $this->Html->meta(array('name'=>'viewport', 'content'=>'width=device-width'));

			$this->Html->css('//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css', null, array('block'=>'css'));
			$this->Html->css('//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css', null, array('block'=>'css'));
			
			$this->Html->script('//cdn.jsdelivr.net/modernizr/2.6.2/modernizr.min.js', array('block' => 'script'));
			
			$this->Html->script('//cdn.jsdelivr.net/jquery/1.10.1/jquery.min.js', array('block' => 'scriptBottom'));
			$this->Html->script('//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js', array('block' => 'scriptBottom'));
			$this->Html->script('//cdn.jsdelivr.net/isotope/1.5.25/jquery.isotope.min.js', array('block' => 'scriptBottom'));
			
			if (is_file(WWW_ROOT . 'js' . DS . $this->params['controller'] . '.js')) {
				$this->Html->script($this->params['controller'], array('block' => 'scriptBottom'));
			}

			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');		
			
		?>
		
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
		<!-- Header starts -->
		<header>
		   <div class="container">
			  <div class="row">
				 <div class="span9">
					<!-- Logo and site link -->
					<div class="logo">
					   <h1>
							<?php
							echo $this->Html->link(
								$site_name,
								'/',
								array('escape'=>false)
							);
							?>					   
					   </h1>
					</div>
				 </div>
				 <div class="span3">
					<div class="list">
					</div>
				 </div>
			  </div>
		   </div>
		</header>
		
		<?php echo $this->element('menu'); ?>

		
		<div class="content">
			<div class="container">
				<div class="row-fluid">
					<div class="span12">
						
						<?php echo $this->Session->flash(); ?>
						<!-- Content starts -->
							
						<?php echo $this->fetch('content'); ?>
					</div>
				</div>
			</div>
        </div> <!-- /container -->

		<!-- Footer -->
		<footer>
		  <div class="container">
			<div class="row">
			  <div class="span12">
			  	<br />
				<p class="copy pull-right">

			  		<!-- Copyright information. You can remove my site link. -->
					Albumviewer is powered by <?php echo $this->Html->link(__d('fotoalbum','Fotoalbum.nl'), 'http://'.CakeRequest::host(), array('target'=>'_blank'));?>   |  &copy;  2009-<?php echo date('Y'); ?>                                                     
				</p>
			  </div>
			</div>
		  </div>
		</footer>		
		

		<?php echo $this->fetch('scriptBottom'); ?>
		<?php echo $this->fetch('scriptBottomVendors'); ?>

        <script>
            var _gaq=[['_setAccount','UA-XXXXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
		
		<?php //echo $this->element('sql_dump'); ?>		
    </body>
</html>



