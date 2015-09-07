<?php
App::uses('User', 'Users.Model');
class SoftwaresUser extends User {
	var $name 			= 'SoftwaresUser';
	var $useDbConfig 	= 'albumviewer';
	var $useTable 		= 'users';
}
?>