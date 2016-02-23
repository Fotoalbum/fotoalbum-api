
<div class="productConversionServices row">
	<div class="actions col-md-2 span3">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
	
				<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ProductConversionService.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ProductConversionService.id'))); ?></li>
				<li><?php echo $this->Html->link(__('List Product Conversion Services'), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Conversions'), array('controller' => 'product_conversions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Conversion'), array('controller' => 'product_conversions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="productConversionServices col-md-6 span9">
        
        <div class="row">    

            <?php echo $this->Form->create('ProductConversionService', array('inputDefaults' => array( 'class' => 'form-control', 'div' => 'control-group', 'label' => array('class' => 'control-label'), 'wrapInput' => 'controls'), 'class' => 'form-horizontal'));?>
                <fieldset>
                    <legend><?php echo __('Admin Edit Product Conversion Service'); ?></legend>
                    <?php
                        echo $this->Form->input('id');
                        echo $this->Form->input('user_id', array('type'=>'text'));
                        echo $this->Form->input('product_conversion_id');
                        echo $this->Form->input('product_id');
						echo $this->Form->input('user_product_id', array('type'=>'text'));
                        echo $this->Form->input('mcf_content');
						echo $this->Form->input('notitions');
						echo $this->Form->input('error');
                        echo $this->Form->input('photos');
                        echo $this->Form->input('status');
                        echo $this->Form->input('lang');
                    ?>
                    <div class="form-actions">
                        <?php 
							echo $this->Html->link(__('Cancel'),array('controller' => 'products', 'action' => 'index'),array('class'=>'btn btn-cancel'));
						?>
                    </div>
                </fieldset>
            <?php echo $this->Form->end();?>
            
            <h3>Standaard tekstjes / Texte Standard</h3>
            <p><strong>Fotoalbum</strong></p>
			<ul>
				<li>Achtergronden, stickers en fotokaders moet u naar eigen smaak opnieuw toevoegen.</li>
				<li>Unieke lettertypes zijn gezet naar "Arial", u kan zelf nog de lettertypes aanpassen naar eigen smaak.</li>
			</ul>
        	<p><strong>Albumphoto</strong></p>
        	<ul>
				<li>Vous devez ajouter à nouveau les arrière-plans, stickers et cadres photo de votre choix (parmi ceux disponibles dans notre nouveau logiciel).</li>
				<li>Les polices d'écriture spéciales ont été converties en "Arial". Vous pouvez les modifier, et choisir la police d'écriture de votre choix (existante dans notre nouveau logiciel).</li>
			</ul>

        </div>
    </div>
    <div class="actions col-md-3 col-md-offset-1 span3">
    	<small>
            <div class="row">
                <h3 class="text-danger">Errors:</h3>
                <?php
                if ($this->request->data['ProductConversionService']['designElementID']['pagenumbering']['active'] > 0)
                {
                    ?>
                    <p class="text-danger">LET OP: Book heeft paginanummering!!</p>
                    <?php
                }
                if (!empty($this->request->data['ProductConversionService']['designElementID']['fonts']['errors']))
                {
                    ?>
                    <div class="well well-lg">
                    	<div class="lead">
                            Boek heeft fonts die we niet hebben:
                            <ul>
                                <?php 
                                foreach($this->request->data['ProductConversionService']['designElementID']['fonts']['errors'] as $_error)
                                {
                                    ?>
                                    <li><mark><?php echo $_error;?></mark></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <?php
                }
                if (!empty($this->request->data['ProductConversionService']['designElementID']['cliparts']['errors']))
                {
                    ?>
                    <div class="well well-lg">
                    	<div class="lead">
                            Boek heeft cliparts die we niet hebben:
                            <ul>
                                <?php 
                                foreach($this->request->data['ProductConversionService']['designElementID']['cliparts']['errors'] as $_error)
                                {
                                    ?>
                                    <li><mark><?php echo $_error;?></mark></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <?php
                }
                if (!empty($this->request->data['ProductConversionService']['errors']))
                {
					$errors = json_decode($this->request->data['ProductConversionService']['errors']);
                    ?>
                    <div class="well well-lg">
                    	<div class="lead">
                            Boek heeft de volgende fouten:
                            <ul>
                                <?php 
                                foreach($errors as $_error)
                                {
                                    ?>
                                    <li><mark><?php echo $_error;?></mark></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <br/>                    
            </div>	
        
            <div class="row">
                <h3 class="text-success">Details:</h3>
                <dl class="dl-horizontal">
                    <?php 
                    foreach ($this->request->data['ProductConversionService']['designElementID']['details'] as $key=>$val)
                    {
                        if (!empty($val))
                        {
							echo '<dt>'.$key.'</dt>';
							echo '<dd>'.$val.'</dd>';
						}
                    }
                    ?>
                </dl>            
            </div>	
    
            <div class="row">
                <h3 class="text-success">Resources:</h3>
                <dl class="dl-horizontal">

                    <dt>backgrounds</dt>
                    <dd><?php echo $this->request->data['ProductConversionService']['designElementID']['backgrounds']['counter'];?>
                        <ul style="margin-left:-40px; list-style:none">
                            <?php 
                            foreach ($this->request->data['ProductConversionService']['designElementID']['backgrounds']['items'] as $key=>$val)
                            {
                                if (!empty($val))
                                {
                                    echo '<li>'.$key.' ('.$val.'x)</li>';
                                }
                            }
                            ?>
                        </ul>    
                    </dd>

                    <!--
                    <dt>layouts</dt>
                    <dd><?php echo $this->request->data['ProductConversionService']['designElementID']['layouts']['counter'];?>
                        <ul style="margin-left:-40px; list-style:none">
                            <?php 
                            foreach ($this->request->data['ProductConversionService']['designElementID']['layouts']['items'] as $key=>$val)
                            {
                                if (!empty($val))
                                {
                                    echo '<li>'.$key.' ('.$val.'x)</li>';
                                }
                            }
                            ?>
                        </ul>    
                    </dd>
                    -->

                    <dt>passepartouts</dt>
                    <dd><?php echo $this->request->data['ProductConversionService']['designElementID']['passepartouts']['counter'];?>
                        <ul style="margin-left:-40px; list-style:none">
                            <?php 
                            foreach ($this->request->data['ProductConversionService']['designElementID']['passepartouts']['items'] as $key=>$val)
                            {
                                if (!empty($val))
                                {
                                    echo '<li>'.$key.' ('.$val.'x)</li>';
                                }
                            }
                            ?>
                        </ul>    
                    </dd>

                    <dt>fonts</dt>
                    <dd><?php echo $this->request->data['ProductConversionService']['designElementID']['fonts']['counter'];?>
                        <ul style="margin-left:-40px; list-style:none">
                            <?php 
                            foreach ($this->request->data['ProductConversionService']['designElementID']['fonts']['items'] as $key=>$val)
                            {
                                if (!empty($val))
                                {
                                    echo '<li>'.$key.' ('.$val.'x)</li>';
                                }
                            }
                            ?>
                        </ul>    
                    </dd>
    
                    <dt>cliparts</dt>
                    <dd><?php echo $this->request->data['ProductConversionService']['designElementID']['cliparts']['counter'];?>
                        <ul style="margin-left:-40px; list-style:none">
                            <?php 
                            foreach ($this->request->data['ProductConversionService']['designElementID']['cliparts']['items'] as $key=>$val)
                            {
                                if (!empty($val))
                                {
                                    echo '<li>'.$key.' ('.$val.'x)</li>';
                                }
                            }
                            ?>
                        </ul>    
                    </dd>
    
                </dl> 
            </div>	
        </small>
    </div>
</div>