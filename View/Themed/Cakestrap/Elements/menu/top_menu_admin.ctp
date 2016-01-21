<nav class="navbar navbar-default" role="navigation">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button><!-- /.navbar-toggle -->
		<?php echo $this->Html->Link('XHIBIT API-II', 'http://api.xhibit.com/v2/', array('class' => 'navbar-brand')); ?>
	</div><!-- /.navbar-header -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav">
			<li><a href="/v2/users/dashboard">Dashboard</a></li>
			<li><a href="/v2/uitloggen">Uitloggen</a></li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Products <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li role="presentation" class="dropdown-header">Products</li>
					<li><a href="/v2/admin/products">Overview</a></li>
					<li><a href="/v2/admin/products/add">Add Product</a></li>
					<li role="presentation" class="divider"></li>	
					<li role="presentation" class="dropdown-header">Paperweights</li>			
					<li><a href="/v2/admin/product_paperweights">List</a></li>
					<li><a href="/v2/admin/product_paperweights/add">Add</a></li>					
					<li role="presentation" class="divider"></li>	
					<li role="presentation" class="dropdown-header">Papertypes</li>			
					<li><a href="/v2/admin/product_papertypes">List</a></li>
					<li><a href="/v2/admin/product_papertypes/add">Add</a></li>					
					<li role="presentation" class="divider"></li>	
					<li role="presentation" class="dropdown-header">Covers</li>			
					<li><a href="/v2/admin/product_covers">List</a></li>					
					<li><a href="/v2/admin/product_covers/add">Add</a></li>	
					<li role="presentation" class="divider"></li>	
					<li role="presentation" class="dropdown-header">Colors</li>			
					<li><a href="/v2/admin/product_colors">List</a></li>					
					<li><a href="/v2/admin/product_colors/add">Add</a></li>	
					<li role="presentation" class="divider"></li>	
					<li role="presentation" class="dropdown-header">Shapes</li>			
					<li><a href="/v2/admin/product_shapes">List</a></li>					
					<li><a href="/v2/admin/product_shapes/add">Add</a></li>	
					<li role="presentation" class="divider"></li>	
					<li role="presentation" class="dropdown-header">Sizes</li>			
					<li><a href="/v2/admin/product_sizes">List</a></li>					
					<li><a href="/v2/admin/product_sizes/add">Add</a></li>	
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Products (Singles)<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li role="presentation" class="dropdown-header">Singles</li>			
					<li><a href="/v2/admin/product_singles">List</a></li>					
					<li><a href="/v2/admin/product_singles/add">Add</a></li>
					<li role="presentation" class="dropdown-header">&nbsp;&nbsp;-- Containers</li>															
					<li><a href="/v2/admin/product_single_containers">List</a></li>					
					<li><a href="/v2/admin/product_single_containers/add">Add</a></li>	
					<li role="presentation" class="divider"></li>											
					<li role="presentation" class="dropdown-header">Single Items</li>															
					<li><a href="/v2/admin/product_single_items">List</a></li>					
					<li><a href="/v2/admin/product_single_items/add">Add</a></li>	
					<li role="presentation" class="dropdown-header">&nbsp;&nbsp;-- Containers</li>															
					<li><a href="/v2/admin/product_single_item_containers">List</a></li>					
					<li><a href="/v2/admin/product_single_item_containers/add">Add</a></li>						
																								
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Supplements <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li role="presentation" class="dropdown-header">Supplements</li>
					<li><a href="/v2/admin/supplements">Overview</a></li>
					<li><a href="/v2/admin/supplements/add">Add Supplement</a></li>
					<li role="presentation" class="divider"></li>	
					<li role="presentation" class="dropdown-header">Add Product/Supplement</li>			
					<li><a href="/v2/admin/product_supplements">List</a></li>
					<li><a href="/v2/admin/product_supplements/add">Add</a></li>					
					<li role="presentation" class="divider"></li>	
					<li role="presentation" class="dropdown-header">Papertypes</li>			
				</ul>
			</li>			
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Printers <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li role="presentation" class="dropdown-header">Printers</li>
					<li><a href="/v2/admin/printers">Overview</a></li>
					<li><a href="/v2/admin/printers/add">Add</a></li>	
					<li role="presentation" class="divider"></li>	
					<li role="presentation" class="dropdown-header">Printer Products</li>			
					<li><a href="/v2/admin/printer_products">List products</a></li>
					<li><a href="/v2/admin/printer_products/add">Add</a></li>
					<li role="presentation" class="divider"></li>	
					<li role="presentation" class="dropdown-header">Printer Products Prices</li>					
					<li><a href="/v2/admin/printer_product_prices">List</a></li>
					<li><a href="/v2/admin/printer_product_prices/add">Add</a></li>					
					<li role="presentation" class="divider"></li>	
					<li role="presentation" class="dropdown-header">Printer Products spines</li>
					<li><a href="/v2/admin/printer_product_spines">List</a></li>
					<li><a href="/v2/admin/printer_product_spines/add">Add</a></li>	
					<li role="presentation" class="divider"></li>	
					<li role="presentation" class="dropdown-header">Printer Products covers</li>
					<li><a href="/v2/admin/printer_product_covers">List</a></li>
					<li><a href="/v2/admin/printer_product_covers/add">Add</a></li>										
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Other <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li role="presentation" class="dropdown-header">Basic Elements</li>				
					<li><a href="/v2/admin/backgrounds">Backgrounds</a></li>
					<li><a href="/v2/admin/colors">Colors</a></li>
					<li><a href="/v2/admin/fonts">Fonts</a></li>
					<li><a href="/v2/admin/masks">Masks</a></li>
					<li><a href="/v2/admin/pagelayouts">Pagelayouts</a></li>
					<li><a href="/v2/admin/stickers">Stickers</a></li>
					<li role="presentation" class="divider"></li>	
					<li role="presentation" class="dropdown-header">Users</li>	
					<li><a href="/v2/admin/users">List</a></li>	
					<li><a href="/v2/admin/user_products">Products</a></li>				
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Migration <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li role="presentation" class="dropdown-header">CEWE migration</li>		
                    <li><a href="/v2/admin/product_conversions">ALB to SKU</a></li>		
					<li><a href="/v2/admin/product_conversion_services">Migration requests</a></li>
				</ul>
			</li>            
		</ul><!-- /.nav navbar-nav -->
	</div><!-- /.navbar-collapse -->
</nav><!-- /.navbar navbar-default -->