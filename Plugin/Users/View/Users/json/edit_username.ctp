<script src="/js/vendor/jquery-1.9.1.min.js"></script>
<?php

	echo $this->Form->create('User', array(
		'inputDefaults' => array(
			'div' => false,
			'class' => 'input-xlarge',
		),
		'class' => 'form-horizontal',
		'action' => 'edit_username',
		'default' => false
	));	   
	echo $this->Form->input('User.username', array('label'=>__('Username')));         
	$options = 	array
				(
					'label' => __('Save'),
					'type' => 'submit',
					'class' => 'btn btn-primary',
					'div' => false,
					'id' => 'btn_save'
				);				
	echo $this->Form->end($options);   
?>	