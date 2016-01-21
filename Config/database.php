<?php
/**
 * This is core configuration file.
 *
 * Use it to configure core behaviour of Cake.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 *
 * Database configuration class.
 * You can specify multiple configurations for production, development and testing.
 *
 * datasource => The name of a supported datasource; valid options are as follows:
 *		Database/Mysql 		- MySQL 4 & 5,
 *		Database/Sqlite		- SQLite (PHP5 only),
 *		Database/Postgres	- PostgreSQL 7 and higher,
 *		Database/Sqlserver	- Microsoft SQL Server 2005 and higher
 *
 * You can add custom database datasources (or override existing datasources) by adding the
 * appropriate file to app/Model/Datasource/Database. Datasources should be named 'MyDatasource.php',
 *
 *
 * persistent => true / false
 * Determines whether or not the database should use a persistent connection
 *
 * host =>
 * the host you connect to the database. To add a socket or port number, use 'port' => #
 *
 * prefix =>
 * Uses the given prefix for all the tables in this database. This setting can be overridden
 * on a per-table basis with the Model::$tablePrefix property.
 *
 * schema =>
 * For Postgres/Sqlserver specifies which schema you would like to use the tables in. Postgres defaults to 'public'. For Sqlserver, it defaults to empty and use
 * the connected user's default schema (typically 'dbo').
 *
 * encoding =>
 * For MySQL, Postgres specifies the character encoding to use when connecting to the
 * database. Uses database default not specified.
 *
 * unix_socket =>
 * For MySQL to connect via socket specify the `unix_socket` parameter instead of `host` and `port`
 */
class DATABASE_CONFIG {

	public $user = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => '10.1.187.11',
		'login' => 'fotoalbum_write',
		'password' => 'JMYdhjAKyhHQ4DYJ',
		'database' => 'xhibit_2_0',
		'prefix' => 'xhibit_',
		//'encoding' => 'utf8',
	);

	public $admin = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => '10.1.187.11',
		'login' => 'fotoalbum_root',
		'password' => '3wnvfEX4psGrp7BU',
		'database' => 'xhibit_2_0',
		//'prefix' => 'xhibit_',
		//'encoding' => 'utf8',
	);


	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => '10.1.187.11',
		'login' => 'fotoalbum_root',
		'password' => '3wnvfEX4psGrp7BU',
		'database' => 'xhibit_2_0',
		'prefix' => 'xhibit_',
		'encoding' => 'utf8',
	);
	
	var $authake = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => '10.1.187.11',
		'login' => 'fotoalbum_root',
		'password' => '3wnvfEX4psGrp7BU',
		'database' => 'xhibit_2_0',
		'prefix' => '',
	);	
	
	
	var $albumviewer = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => '10.1.187.11',
		'login' => 'fotoalbum_root',
		'password' => '3wnvfEX4psGrp7BU',
		'database' => 'crm',// Pas dit aan als je uit de albumviewer database wilt werken! 'crm',
		'prefix' => 'crm_',
		//'encoding' => 'utf8',
	);
	
	var $albumviewer_crm = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => '10.1.187.11',
		'login' => 'fotoalbum_root',
		'password' => '3wnvfEX4psGrp7BU',
		'database' => 'crm',// Pas dit aan als je uit de albumviewer database wilt werken! 'crm',
		'prefix' => 'crm_',
		//'encoding' => 'utf8',
	);	
	
	public $cms_app = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => '10.1.187.11',
		'login' => 'fotoalbum_write',
		'password' => 'JMYdhjAKyhHQ4DYJ',
		'database' => 'xhibit_2_0',
		'prefix' => 'cms_app_',
		//'encoding' => 'utf8',
	);	
	
	var $cms_site = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => '10.1.187.11',
		'login' => 'fotoalbum_root',
		'password' => '3wnvfEX4psGrp7BU',
		'database' => 'xhibit_2_0',
		'prefix' => 'cms_site_',
		//'encoding' => 'utf8',
	);		
	
	
	public $pdfengine = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => '10.1.187.11',
		'login' => 'fotoalbum_root',
		'password' => '3wnvfEX4psGrp7BU',
		'database' => 'xhibit_2_0',
		'prefix' => 'pdfengine_',
		//'encoding' => 'utf8',
	);	
	
	
	
	public $provider_ftp_scanlaser = array(
		'datasource' => 'Ftp.FtpSource',
		'host' => 'ftp.scanlaser.nl',
		'username' => 'bonusboek',
		'password' => 'kvtv6fqx23pn',
		'type' => 'ftp',
	);		

	
}
