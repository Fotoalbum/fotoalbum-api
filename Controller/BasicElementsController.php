<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('AppController', 'Controller');

/**
*       SoftwaresController
*
*       Interfaces Controller is the interface between the database and the software. This controller handles all requests to the database.
*
*       @author      Frank van der Stad <frank@vanderstad.nl>
*       @package     XHIBIT_SITE
**/

class BasicElementsController extends AppController {

	var $name = 'BasicElement';
	
	var $_isConnected = false;

	var $uses = array(
		'Background',
		'Color',	
		'Font',	
		'Pagelayout',		
		'Sticker',
		'Type',
		'Styles',
		'Font',
		'Categories.Category'		
	);

 	var $components = array('RequestHandler','Auth', 'Session');
	
	var $ModelName = false;

	// -------------------------------------------------------------------

	/**
	*       beforeFilter
	*
	*       Add all allow
	*	*       @return         ArrayCollection
	**/
	function beforeFilter() 
	{
		parent::beforeFilter();

		$this->autoRender = false;
		
		$this->Auth->Allow();
    }
	
	/***********************************************************************************************************/
	/*                                                  CMS                                                    */
	/***********************************************************************************************************/
	/**
	*       api_getConfig()
	*
	*       Returns all items based on given model
	*
	*       @return         ArrayCollection
	**/	
	public function api_getConfig()
	{
		$data = array();
		$dataCollection = new ArrayCollection($data);		
		return $dataCollection;		
	}

	
	/**
	*       api_get_by_submodel
	*
	*       Returns all items based on given type_id
	*
	*       @return         ArrayCollection
	*		api_get_by_submodel('Mask','Type',23,false)
	**/		
	public function api_get_by_submodel($model,$id_model,$id=0,$html=false)
	{
		
		$check_key = 'type_id';
		if ($id_model == 'Type')
		{
			$check_key = 'type_id';
		}
		if ($id_model == 'Style')
		{
			$check_key = 'style_id';
		}		
		$other_model = $model.$id_model;
		$this->LoadModel($other_model);
		$this->ModelName = $this->{$other_model};
		
		if (empty($this->ModelName->displayField))
		{
			 $this->ModelName->displayField = 'id';
		}

		$options = array('order' => $this->ModelName->alias . '.' . $this->ModelName->displayField . ' ASC');
		
		if ($id > 0)
		{
			$this->ModelName->recursive = 0;
			$options['conditions'] = array($this->ModelName->alias . '.' . $check_key => $id);				
		}	
		
		$_data = $this->ModelName->find('all', $options);
		
		$data = Hash::extract($_data, '{n}.'.$model);
		
		if ($html)
		{
			debug(Hash::extract($_data, '{n}.'.$model));
			debug(Hash::filter(Hash::extract($_data, '{n}.'.$model)));
			debug($options);
			debug($_data);				
			debug($data);	
		}
		else
		{
			$dataCollection = new ArrayCollection($data);		
			return $dataCollection;		
		}
	}

	/**
	*       api_get
	*
	*       Returns all items based on given model
	*
	*       @return         ArrayCollection
	**/		
	public function api_get($model,$id=0,$id_model=false,$html=false)
	{
		
		if ($model == 'Category')
		{
			$this->ModelName = ClassRegistry::init('Categories.Category');
		}
		elseif ($model == 'Tag')
		{
			$this->ModelName = ClassRegistry::init('Tags.Tag');
		}
		else
		{
			$this->LoadModel($model);
			$this->ModelName = $this->{$model};
		}
		
		if (empty($this->ModelName->displayField))
		{
			 $this->ModelName->displayField = 'name';
		}


		$options = array('order' => $this->ModelName->alias . '.' . $this->ModelName->displayField . ' ASC');
		if ( $model == 'Style')
		{
			$this->ModelName->recursive = -1;
		}
		if ( $model == 'Type' )
		{
			$this->ModelName->recursive = -1;
			$options = array('order' => $this->ModelName->alias . '.foreign_model ASC, '.$this->ModelName->alias . '.' . $this->ModelName->displayField . ' ASC');
		}			
		if ($id > 0)
		{
			if (isset($id_model))
			{
				$this->ModelName->recursive = -1;
				$options['conditions'] = array($id_model . '.id' => $id);
			}
			else
			{
				$options['conditions'] = array($this->ModelName->alias . '.' . $this->ModelName->primaryKey => $id);				
			}
		}	
		
		$data = $this->ModelName->find('all', $options);
		
		if ($html)
		{
			debug($options);
			debug($data);	
		}
		else
		{
			$dataCollection = new ArrayCollection($data);		
			return $dataCollection;		
		}
	}
	
	/***********************************************************************************************************/	/**
	*       api_tree
	*
	*       Returns all items based on given model, id in a tree
	*
	*       @return         ArrayCollection
	**/	
	public function api_tree($model,$id = false, $html=false)
	{
		
		if ($model == 'Category')
		{
			$this->ModelName = ClassRegistry::init('Categories.Category');
		}
		elseif ($model == 'Tag')
		{
			$this->ModelName = ClassRegistry::init('Tags.Tag');
		}
		else
		{
			$this->LoadModel($model);
			$this->ModelName = $this->{$model};
		}

		if (empty($this->ModelName->displayField))
		{
			 $this->ModelName->displayField = 'name';
		}

		$options = array('parent' => 'category_id','order' => array($this->ModelName->alias . '.' . $this->ModelName->displayField . ' ASC'));
		if ($id)
		{
			$options['conditions'] = array($this->ModelName->alias .'.' . $this->ModelName->primaryKey => $id);
		}
		$data = $this->ModelName->find('threaded', $options);
		
		if ($html)
		{
			debug($data);	
		}
		else
		{
			$dataCollection = new ArrayCollection($data);		
			return $dataCollection;		
		}
	}		
	
	/***********************************************************************************************************/	/**
	*       api_categorized
	*
	*       Returns all categorized items based on given model and category
	*
	*       @return         ArrayCollection
	**/	
	public function api_categorized($model, $category_id = false, $html=false)
	{
		
		$this->LoadModel('Categories.Categorized');
		
		$options = array();
		$options['conditions']['Categorized.model'] = $model;
		if ( ($category_id) && ($category_id != 'false') )
		{
			$options['conditions']['Categorized.category_id'] = $category_id;
		}

		$data = $this->Categorized->find('all', $options);
		
		$model_ids = Set::extract('{n}.Categorized.foreign_key', $data);

		$this->LoadModel($model);
		$this->ModelName = $this->{$model};
		
		if (empty($this->ModelName->displayField))
		{
			 $this->ModelName->displayField = 'name';
		}
		
		$data = $this->ModelName->find('all', array(
												'conditions' => array(
													$this->ModelName->alias . '.' .'id' => $model_ids
												),
												'order' => $this->ModelName->alias . '.' . $this->ModelName->displayField . ' ASC'
											)
										);
		
		if ($html)
		{
			debug($model_ids);
			debug($data);	
		}
		else
		{
			$dataCollection = new ArrayCollection($data);		
			return $dataCollection;		
		}

	}	

	/***********************************************************************************************************/	/**
	*       api_search
	*
	*       Returns all items based on given model and key, value pair
	*
	*       @return         ArrayCollection
	**/	
	public function api_search($model, $condition_keys=false, $condition_values=false, $html=false)
	{
		
		if ($model == 'Category')
		{
			$this->ModelName = ClassRegistry::init('Categories.Category');
		}
		elseif ($model == 'Tag')
		{
			$this->ModelName = ClassRegistry::init('Tags.Tag');
		}
		else
		{
			$this->LoadModel($model);
			$this->ModelName = $this->{$model};
		}
		
		if (empty($this->ModelName->displayField))
		{
			 $this->ModelName->displayField = 'name';
		}
		
		$options = array('order' => $this->ModelName->alias . '.' . $this->ModelName->displayField . ' ASC');
		if ($condition_keys)
		{
			if (!is_array($condition_keys))
			{
				$condition_keys = array($condition_keys);
			}
			if (!is_array($condition_values))
			{
				$condition_values = array($condition_values);
			}			
			$options['conditions'] = array_combine($condition_keys,$condition_values);
		}	
		
		$data = $this->ModelName->find('all', $options);
		
		if ($html)
		{
			debug($data);	
		}
		else
		{
			$dataCollection = new ArrayCollection($data);		
			return $dataCollection;		
		}

	}			

	/***********************************************************************************************************/	/**
	*       api_view
	*
	*       Returns all items based on given model
	*
	*       @return         ArrayCollection
	**/	
	public function api_view($model,$id = null,$html=false) {
		
		$this->LoadModel($model);
		
		if (!$this->ModelName->exists($id)) {
			$data[$model]['id'] 	= $id;
			$data[$model]['msg'] = __('Invalid '.$model.' id');
		}
		else
		{
			$options = array('conditions' => array($this->ModelName->alias . '.' . $this->ModelName->primaryKey => $id));
			$data = $this->ModelName->find('first', $options);
		}
		/* RETURNING THE DATA */
		if ($html)
		{
			debug($data);	
		}
		else
		{
			$dataCollection = new ArrayCollection($data);		
			return $dataCollection;		
		}
	}

	/***********************************************************************************************************/	/**
	*       api_add
	*
	*       Adds an item based on given model and key=>value pair
	*
	*       @return         ArrayCollection
	**/	
	public function api_add($model, $key=false, $value=false, $byteArray = false, $categories=false, $styles=false, $types=false, $html=false) {

		if ($model == 'Category')
		{
			$this->ModelName = ClassRegistry::init('Categories.Category');
		}
		elseif ($model == 'Tag')
		{
			$this->ModelName = ClassRegistry::init('Tags.Tag');
		}
		elseif ($model == 'Overlay')
		{
			$model = 'Mask';
			$this->LoadModel($model);
			$this->ModelName = $this->{$model};
			$file_data_name	= 'overlay_hires';
		}
		else
		{
			$this->LoadModel($model);
			$this->ModelName = $this->{$model};
			$file_data_name	= 'hires';
		}

		if (empty($this->request->data))
		{
			$html=false;
			if (!empty($key))
			{
				if (is_array($key))
				{
					$this->request->data = array_combine($key,$value);
				} 
				else
				{
					$this->request->data[$key] = $value;
				}
			}	
		}
		else
		{
			$html=true;	
		}
		if ($this->request->data) {
			foreach ($this->data as $key=>$value)
			{
				$data[$model][$key] = $value;
			}

			if ( ($model != 'Categories') && (isset($data[$model]['categories'])) )
			{
				$categories = explode(",",$this->request->data['categories']);
			}

			if ( ($model != 'Styles') && (isset($this->request->data['styles'])) )
			{
				$styles = explode(",",$this->request->data['styles']);
			}
			
			if ( ($model != 'Types') && (isset($this->request->data['types'])) )
			{
				$types = explode(",",$this->request->data['types']);
			}						
			
			if (isset($_FILES['Filedata']))
			{
				$data[$model][$file_data_name] = $_FILES['Filedata'];
				$fileData = $_FILES['Filedata'];
				unset($_FILES['Filedata']);
				foreach($fileData as $key=>$value)
				{
					$_FILES['data'][$key][$model][$file_data_name] = $value;	
				}
			}
			
			if (isset($data[$model]['id']))
			{
				$this->ModelName->id = $data[$model]['id'];
			}
			else
			{
				$this->ModelName->create();
			}
			
			if ($this->ModelName->save($data)) {
				$id = $this->ModelName->id;
				if ($categories)
				{
					$this->ModelName->Categorized->deleteAll(array(
							'Categorized.foreign_key' => $id,
							'Categorized.model' => $this->ModelName->alias
						)
					);
					foreach($categories as $category_id)
					{
						$this->ModelName->Categorized->create();
						$this->ModelName->Categorized->save(array(
										'id'			=> $this->ModelName->Categorized->id,
										'category_id' 	=> $category_id,
										'foreign_key' 	=> $id,
										'model' 		=> $this->ModelName->alias
									));							
					}
				}
				$types_result = array();
				if ($types)
				{
					$type_model = $model.'Type';
					$this->LoadModel($type_model);
					$this->ModelNameType = $this->{$type_model};	
					
					$this->ModelNameType->deleteAll(array(
						strtolower($model).'_id' => $id
					));				

					foreach($types as $type_id)
					{
						$this->ModelNameType->create();
						$types_result[$type_id] = $this->ModelNameType->save(array(
							strtolower($model).'_id'	=> $id,
							'type_id' 	=> $type_id
						));							
					}
				}
				$styles_result = array();
				if ($styles)
				{
					$style_model = $model.'Style';
					$this->LoadModel($style_model);
					$this->ModelNameStyle = $this->{$style_model};	
					
					$this->ModelNameStyle->deleteAll(array(
						strtolower($model).'_id' => $id
					));				

					foreach($styles as $style_id)
					{
						$this->ModelNameStyle->create();
						$styles_result[$style_id] = $this->ModelNameStyle->save(array(
							strtolower($model).'_id'	=> $id,
							'style_id' 	=> $style_id
						));							
					}
				}								
				
				$data[$model]['id'] 	= $this->ModelName->id;
				$data[$model]['msg'] 	= __('The '.$model.' has been saved');
				$data[$model]['result']	= $this->ModelName->id;
				$data[$model]['types']	= $types;
				$data[$model]['styles']	= $styles;
				$data[$model]['types_result']	= $types_result;
				$data[$model]['styles_result']	= $styles_result;				
			} else {
				$data[$model]['id'] 	= $this->ModelName->id;
				$data[$model]['msg'] 	= __('The '.$model.' could not be saved. Please, try again.');		
				$data[$model]['err'] 	= $this->ModelName->validationErrors;
				$data[$model]['result']	= -1;				
			}
		}
		else
		{
			$data[$model]['id'] 	= $this->ModelName->id;
			$data[$model]['msg'] = __('Invalid post data');								
			$data[$model]['result']	= -1;			
		}

		if ($this->ModelName->validationErrors)
		{
			$html = true;
			if (isset($this->ModelName->validationErrors[$file_data_name][0]))
			{
				die($this->ModelName->validationErrors[$file_data_name][0]);
			}
			
		}
		
		if ($html)
		{
			$return = $data[$model]['result'];
			if ($data[$model]['result'] <= 0)
			{
				$return = $data[$model]['msg'];	
			}				
			//debug($data);
			die($return);
		}
		else
		{
			$dataCollection = new ArrayCollection(array($data[$model]));		
			return $dataCollection;				
		}
		
	}

	/***********************************************************************************************************/	/**
	*       api_save
	*
	*       Saves an item based on given model, id and given key=>value pair
	*
	*       @return         ArrayCollection
	**/	
	public function api_save($model, $id = null, $key, $value, $categories=false, $styles=false, $types=false, $html=false) {
		
		if ($model == 'Category')
		{
			$this->ModelName = ClassRegistry::init('Categories.Category');
		}
		elseif ($model == 'Tag')
		{
			$this->ModelName = ClassRegistry::init('Tags.Tag');
		}
		else
		{
			$this->LoadModel($model);
			$this->ModelName = $this->{$model};
		}

		if (empty($this->request->data))
		{
			if (!empty($key))
			{
				if (is_array($key))
				{
					$this->request->data[$model] = array_combine($key,$value);
				} 
				else
				{
					$this->request->data[$model][$key] = $value;
				}
			}	
		}


		if (isset($this->request->data[$model]['categories']))
		{
			$categories = $this->request->data[$model]['categories'];
		}
		

		if (isset($this->request->data[$model]['styles']))
		{
			$styles = $this->request->data[$model]['styles'];
		}
		

		if (isset($this->request->data[$model]['types']))
		{
			$types = $this->request->data[$model]['types'];
		}
						
		if (!$this->ModelName->exists($id))
		{
			$data[$model]['id'] 	= $id;
			$data[$model]['msg'] 	= __('Invalid '.$model.' id');
			$data[$model]['result']	= -1;

		}
		else
		{
			
			$options = array('conditions' => array($this->ModelName->alias . '.' . $this->ModelName->primaryKey => $id));
			$_data = $this->ModelName->find('first', $options);
			$update_data = array_merge($_data,$this->request->data);			

			if ($this->request->data) {
				$this->ModelName->id = $id;
				$data[$model]['data'] 	= $this->request->data;		
				if ($this->ModelName->save($this->request->data)) {
					$data[$model]['id'] 	= $this->ModelName->primaryKey;
					$data[$model]['msg'] 	= __('The '.$model.' has been saved');
					$data[$model]['result']	= 'OK';
					if ($categories)
					{
						if (!is_array($categories))
						{
							if (stristr($categories, ','))
							{
								$categories = explode(',',$categories);
							}
							else
							{
								$categories = array($categories);	
							}
						}
						$this->ModelName->Categorized->deleteAll(array(
								'Categorized.foreign_key' => $id,
								'Categorized.model' => $this->ModelName->alias
							)
						);
						foreach($categories as $i=>$category_id)
						{
							$this->ModelName->Categorized->create();
							$this->ModelName->Categorized->save(array(
											'id'			=> $this->ModelName->Categorized->id,
											'category_id' 	=> $category_id,
											'foreign_key' 	=> $id,
											'model' 		=> $this->ModelName->alias
										));							
						}
					}	
					$types_result = array();
					if ($types)
					{
						if (!is_array($types))
						{
							if (stristr($types, ','))
							{
								$types = explode(',',$types);
							}
							else
							{
								$types = array($types);	
							}
						}						
						$type_model = $model.'Type';
						$this->LoadModel($type_model);
						$this->ModelNameType = $this->{$type_model};	
						
						$this->ModelNameType->deleteAll(array(
							strtolower($model).'_id' => $id
						));				
	
						foreach($types as $type_id)
						{
							$this->ModelNameType->create();
							$types_result[$type_id] = $this->ModelNameType->save(array(
								strtolower($model).'_id'	=> $id,
								'type_id' 	=> $type_id
							));					
						}
					}
					$styles_result = array();
					if ($styles)
					{
						if (!is_array($styles))
						{
							if (stristr($styles, ','))
							{
								$styles = explode(',',$styles);
							}
							else
							{
								$styles = array($styles);	
							}
						}						
						$style_model = $model.'Style';
						$this->LoadModel($style_model);
						$this->ModelNameStyle = $this->{$style_model};		
						
						$this->ModelNameStyle->deleteAll(array(
							strtolower($model).'_id' => $id
						));				
	
						foreach($styles as $style_id)
						{
							$this->ModelNameStyle->create();
							$styles_result[$style_id] = $this->ModelNameStyle->save(array(
								strtolower($model).'_id'	=> $id,
								'style_id' 	=> $style_id
							));							
						}
					}		

					$data[$model]['types']			= $types;
					$data[$model]['styles']			= $styles;
					$data[$model]['types_result']	= $types_result;
					$data[$model]['styles_result']	= $styles_result;									
										
				} else {
					$data[$model]['id'] 	= $this->ModelName->id;
					$data[$model]['msg'] = __('The '.$model.'  could not be saved. Please, try again.');
					$data[$model]['result']	= -1;
				}
			} else {
				$data[$model]['id'] 	= $this->ModelName->id;
				$data[$model]['msg'] 	= __('No post data for '.$model.' with id '.$id.' given.');
				$data[$model]['result']	= -1;	
			}
		}
		
		if ($html)
		{
			$return = array('gave me to much HTML');
			debug($return);
			debug($data);	
		}
		else
		{
			$dataCollection = new ArrayCollection(array($data[$model]));		
			return $dataCollection;	
		}
	}

	/***********************************************************************************************************/	/**
	*       api_delete
	*
	*       Deletes an item based on given model and id
	*
	*       @return         ArrayCollection
	**/	
	public function api_delete($model,$id = null,$html=false) {
		
		if ($model == 'Category')
		{
			$this->ModelName = ClassRegistry::init('Categories.Category');
		}
		elseif ($model == 'Tag')
		{
			$this->ModelName = ClassRegistry::init('Tags.Tag');
		}
		else
		{
			$this->LoadModel($model);
			$this->ModelName = $this->{$model};
		}
		
		$this->ModelName->id = $id;
		if (!$this->ModelName->exists())
		{
			$data[$model]['id'] 	= $id;
			$data[$model]['msg'] 	= __('Invalid '.$model.' id');
			$data[$model]['result']	= -1;	
		}
		else
		{			
			if ($this->ModelName->delete()) {
				$data[$model]['id'] 	= $id;
				$data[$model]['msg'] 	= __('The '.$model.' has been deleted');
				$data[$model]['result']	= 'OK';					
			} else {
				$data[$model]['id'] 	= $id;
				$data[$model]['msg'] 	= __('The '.$model.'  could not be deleted. Please, try again.');
				$data[$model]['result']	= -1;	
			}

		}
		/* RETURNING THE DATA */
		if ($html)
		{
			debug($data);	
		}
		else
		{
			$return = array('OK');
			if ($data[$model]['result'] != 'OK')
			{
				$return = array($data[$model]['msg']);	
			}
			$dataCollection = new ArrayCollection($return);		
			return $dataCollection;				
		}
	}

	
	
	/***********************************************************************************************************/
	/*                                                SOFTWARE                                                 */
	/***********************************************************************************************************/
	/**
	*       api_get
	*
	*       Returns all items based on given model
	*
	*       @return         ArrayCollection
	**/	
		
		
}
?>