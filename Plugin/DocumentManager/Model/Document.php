<?php

/**
 * Document Model
 *
 * @property Page $Page
 * @property Block $Block
 * @property User $User
 */
class Document extends DocumentManagerAppModel {


	public $fileFieldName = 'hires';
	
	public $belongsTo = array(
		'User' => array(
			'className' => 'Users.User',
			'foreignKey' => 'user_id',
		),
	);
	
	public $virtualFields = array(
		'lowres' => 'CONCAT("lowres_", Document.hires)',
		'thumb' => 'CONCAT("thumb_", Document.hires)',
		'path' => 'CONCAT("files/documents/",Document.dir,"/")',
		'full_path' => 'CONCAT("/data/XHIBIT/api.xhibit.com/v2/files/documents/",Document.dir,"/")',
		'fullPath' => 'CONCAT("/data/XHIBIT/api.xhibit.com/v2/files/documents/",Document.dir,"/")',
		'folderName' => 'Document.name_folder',		
		'hires_url' => 'CONCAT("files/documents/",Document.dir,"/",Document.hires)',
		'lowres_url' => 'CONCAT("files/documents/",Document.dir,"/lowres_", Document.hires)',
		'thumb_url' => 'CONCAT("files/documents/",Document.dir,"/thumb_", Document.hires)',				
	);	
	
	
	public $actsAs = array(
		'Upload.Upload' => array(
			'hires'=>array(
				'fields' => array(
					'dir' => 'directory'
				),
				'thumbnailSizes' => array(
					'lowres' => '800l',
					'thumb' => '300l'
				),				
				'deleteOnUpdate' => false,
				'mimetypes' => array('image/jpeg','image/gif','image/png','application/octet-stream','image/pjpeg'),
				'extensions' => array('jpg','jpeg','gif','png'),
				'maxSize' => 200000000,
				'pathMethod' => 'flat'
			)	
				
		)
	);
		
	public function beforeValidate() {
		$this->validate = array(
			'hires' => array(
				'check_0' => array(
					'rule' => 'isValidMimeType',
					'message' => 'File is of an invalid mimetype'
				),					
				'check_1' => array(
					'rule' => 'isUnderPhpSizeLimit',
					'message' => 'File exceeds upload filesize limit'
				),
				'check_2' => array(
					'rule' => 'isUnderFormSizeLimit',
					'message' => 'File exceeds form upload filesize limit'
				),
				'check_3' => array(
					'rule' => 'isCompletedUpload',
					'message' => 'File was not successfully uploaded'
				),
				'check_4' => array(
					'rule' => 'isFileUpload',
					'message' => 'File was missing from submission'
				),
				'check_6' => array(
					'rule' => 'isSuccessfulWrite',
					'message' => 'File was unsuccessfully written to the server'
				),
				'check_7' => array(
					'rule' => 'noPhpExtensionErrors',
					'message' => 'File was not uploaded because of a faulty PHP extension'
				),
				'check_8' => array(
					'rule' => array('isWritable'),
					'message' => 'File upload directory was not writable'
				),
				'check_9' => array(
					'rule' => array('isValidDir'),
					'message' => 'File upload directory does not exist'
				),
			),
			/*
			'url' => array(
				'locationExists' => array(
					'rule' => array('checkLocation'),
					'message' => __d("document_manager", "Fichier non trouvé."),
					'allowEmpty' => false,
				),
			),			
			*/
			
		);

		return true;
	}

	public function beforeDelete() {
		// Don't delete document if file still exists after delete attempt
		return $this->unlinkSafe($this->urlToFile($this->field('url')));
	}

	/**
	 * Checks if the file represented by this document exists
	 */
	function checkLocation($check) {
		return file_exists($this->urlToFile($check['url']));
	}

	/**
	 * Reads the content of the folder which path is defined by given folder names
	 * @param array $pathFolderNames : array('funny', 'images', lolCats') if path is "/files/funny/images/lolCats/"
	 * @return array : path folders and folder content (subfolders and files separately)
	 */
	function readFolder($pathFolderNames) {
		$folder = new Folder($this->getRelativePath($pathFolderNames), true);
		$result = $folder->read(true, true, false);
		$folders = $result[0];
		$files = (empty($pathFolderNames) && Configure::read('DocumentManager.excludeRootFiles')) ? array() : $result[1];
		foreach ($files as $i => $file) {
			// Do not display index.php since it is present for security reasons
			if ( ($file == 'index.php') || (substr($file,0,7) == 'lowres_') || (substr($file,0,6) == 'thumb_') ) {
				unset($files[$i]);
			} else {
				$this->recursive = 2;
				$document = $this->find('first', array(
					'conditions' => array('url' => $this->getRelativePath($pathFolderNames, $file)),
				));
				$user = $this->User->read(null,$document['Document']['user_id']);
				$files[$i] = array(
					'name' => $file,
					'Document' => empty($document) ? null : $document['Document'],
					'User' => empty($user) ? null : $user,
				);
			}
		}
		return compact(array('folders', 'files'));
	}

	/**
	 * Saves given temporary file in a folder which path is defined by given folder names, under given file name
	 * Creates a Document for this file
	 * @param string $tmpName : name of the temporary file
	 * @param array $pathFolderNames
	 * @param string $fileName : name of the resulting file
	 * @param string $comments : comments on the file
	 * @return error description, null on success
	 */
	function saveFile($tmpName, $pathFolderNames, $fileName, $userId, $request_data, $comments = null) {
		$path = $this->getFullPath($pathFolderNames, $fileName);
		if (!is_dir($this->getFullPath($pathFolderNames))) {
			$folder = new Folder($this->getFullPath($pathFolderNames), true);
		}			
		if (file_exists($path)) {
			return __d("document_manager", "Un fichier portant ce nom existe déjà.");
		}
		
		$this->uploadSettings($this->fileFieldName, 'path', $this->getFullPath($pathFolderNames));
		$this->uploadSettings($this->fileFieldName, 'thumbnailPath', $this->getFullPath($pathFolderNames));
		if (move_uploaded_file($tmpName, $path)) {
			$session = new CakeSession();
			$this->create();
			$modified_data =	array_merge(
									$request_data,
									array(
										'user_id' => $userId,
										'url' => $this->getRelativePath($pathFolderNames, $fileName),
										'comments' => $comments,
										'dir' => str_replace(ROOT . DS . APP_DIR . DS . 'webroot' . DS . 'files' . DS . 'documents' . DS,'',$this->getFullPath($pathFolderNames))
										
									)
								);
			$res = $this->save(array('Document'=> $modified_data));
			if (!$res)
			{
				return $this->validationErrors;	
			}
			
			return $res;
		} else {
			return __d("document_manager", "Le fichier n'a pu être sauvegardé.");
		}
	}

	/**
	 * Tries to save an uploaded file as a Document in a folder which path is defined by given folder names.
	 *
	 * @param array $data
	 * @param array $pathFolderNames
	 * @param array $headers: headers of the file upload HTTP request
	 * @return null 
	 */
	function saveDocument($data, $pathFolderNames = array(), $userId, $headers = array()) {
		if (substr($data[$this->fileFieldName]['name'], 0, 1) == '.') {
			return __d("document_manager", "Le nom d'un fichier ne peut pas commencer par un point.");
		} else if (empty($data[$this->fileFieldName]['error']) && !empty($data[$this->fileFieldName]['tmp_name']) && $data[$this->fileFieldName]['tmp_name'] != 'none'
				&& is_uploaded_file($data[$this->fileFieldName]['tmp_name'])) {
			// Upload was successful
			return $this->saveFile($data[$this->fileFieldName]['tmp_name'], $pathFolderNames, $data[$this->fileFieldName]['name'], $userId, $data, empty($data['comments']) ? null : $data['comments']);
		} else {
			if (!empty($headers['Content-Length']) && (int) $headers['Content-Length'] > ($max = $this->phpMaxUploadSize()) * 1024 * 1024) {
				// File upload failed because of file size
				return __d("document_manager", "Les fichiers de plus de %d Mb ne peuvent être mis en ligne.", $max);
			} else {
				return __d("document_manager", "Le fichier n'a put être mis en ligne. Veuillez réessayer.");
			}
		}
		return null;
	}

	/**
	 * Renames given file/folder (with given new file/folder name) from a folder which path is defined by given folder names
	 * @param array $pathFolderNames
	 * @param string $oldName
	 * @param string $newName
	 * @param boolean $folder
	 * @return file info formatted for file element, null on error
	 */
	function renameFile($pathFolderNames, $oldName, $newName, $userId) {
		if (!file_exists($oldPath = $this->getFullPath($pathFolderNames, $oldName))) { // File doesn't exist
			$document = $this->findByUrl($this->getRelativePath($pathFolderNames, $oldName), array('id'));
			if (!empty($document)) {
				$this->delete($document['Document']['id']);
				return array(
					'error' => __d("document_manager", "Ce fichier n'existe plus."),
					'remove' => true,
				);
			}
		} else { // File exists
			if (file_exists($newPath = $this->getFullPath($pathFolderNames, $newName))) {
				// A file with requested new name already exists
				if ($oldName != $newName) { // If same names, no problem
					return array(
						'error' => __d("document_manager", "Un fichier portant ce nom existe déjà."),
						'remove' => false,
					);
				}
			} else {
				$document = $this->findByUrl($this->getRelativePath($pathFolderNames, $newName), array('id'));
				if (!empty($document)) { // A document exists for requested new name, but without a file. This shouldn't happen
					// Prevent database error for duplicate Document URL
					$this->delete($document['Document']['id']);
				}
			}

			if (!($success = $oldName == $newName // If same names, epic win
					|| rename($oldPath, $this->getFullPath($pathFolderNames, $newName)))) {
				return array(
					'error' => __d("document_manager", "Le fichier n'a pu être renommé."),
					'remove' => false,
				);
			}

			$document = $this->findByUrl($this->getRelativePath($pathFolderNames, $oldName), array('id'));
			if (empty($document)) { // No document existed for this file. This should happen only if a file was created in the directory outside of this plugin
				// Create Document for this file
				$session = new CakeSession();
				$this->create();
				$this->save(array(
					'user_id' => $userId,
					'url' => $this->getRelativePath($pathFolderNames, $newName),
				));
			} else {
				$this->id = $document['Document']['id'];
				if ($newName != $oldName) { // File name changed
					// Update Document URL
					$this->saveField('url', $this->getRelativePath($pathFolderNames, $newName));
				}
			}

			// A correct Document exists now for this file: find useful information 
			$document = $this->find('first', array(
				'conditions' => array('id' => $this->id),
				'contain' => array('User'),
				'fields' => array('user_id', 'comments'),
					));
			return array(
				'name' => $newName,
				'Document' => empty($document) ? null : $document['Document'],
				'User' => empty($document) ? null : $document['User'],
			);
		}
	}

	/**
	 * Deletes file described by given absolute path
	 * Deletes corresponding Document (if any)
	 * @param string $path
	 * @return true on success, false on failure
	 */
	function deleteFile($path) {
		$document = $this->findByUrl($this->fileToUrl($path), array('id'));
		if (empty($document)) {
			return $this->unlinkSafe($path);
		} else {
			return $this->delete($document['Document']['id']);
		}
	}

	/**
	 * Creates a subfolder with given name in the folder which path is defined by given folder names
	 * @param array $pathFolderNames
	 * @param string $folderName
	 * @return string : error to display, null if none
	 */
	function createSubFolder($pathFolderNames, $folderName) {
		$folderName = trim($folderName);
		if ($folderName == '') {
			return __d("document_manager", "Veuillez fournir un nom de dossier.");
		} else {
			$folderPath = $this->getFullPath($pathFolderNames, $folderName);
			if (is_dir($folderPath)) {
				return __d("document_manager", "Ce dossier existe déjà.");
			} else if (!mkdir($folderPath)) {
				return __d("document_manager", "Le dossier n'a pu être créé. Veuillez vérifer le nom ou les permissions d'écriture du répertoire racine.");
			} else {
				fclose(fopen($folderPath . DS . 'index.php', 'w'));
				return null;
			}
		}
	}

	/**
	 * Recursively browses the folder defined by given path and checks files ownership
	 * @param string $path
	 * @return true if all files are owned by current user, false otherwise 
	 */
	function checkFolder($path, $userId) {
		if (is_dir($path)) {
			$objects = scandir($path);
			foreach ($objects as $object) {
				if (!in_array($object, array('.', '..', 'index.php')) && !$this->checkFolder($path . DS . $object, $userId)) {
					return false;
				}
			}
			reset($objects);
			return true;
		} else {
			$document = $this->findByUrl($this->fileToUrl($path), array('user_id'));
			return empty($document) || $document['Document']['user_id'] == $userId;
		}
	}

	/**
	 * Recursively deletes the folder defined by given path
	 * @param string $path
	 * @return true on success, false on failure
	 */
	function deleteFolder($path) {
		if (is_dir($path)) {
			$result = true;
			$objects = scandir($path);
			foreach ($objects as $object) {
				$result &= $object == '.' || $object == '..' || $this->deleteFolder($path . DS . $object);
			}
			reset($objects);
			return rmdir($path) && $result;
		} else {
			return $this->deleteFile($path);
		}
	}

	/**
	 * Gets the relative path of a folder which path is defined by given folder names,
	 * or of a file in that folder if $fileName is not empty
	 * @param array $pathFolderNames
	 * @param string $fileName
	 * @return string : relative path
	 */
	function getRelativePath($pathFolderNames = array(), $fileName = '') {
		return sprintf('%s%s/%s%s', empty($fileName) ? '' : '/', Configure::read('DocumentManager.baseDir'), empty($pathFolderNames) ? '' : implode('/', $pathFolderNames) . '/', $fileName);
	}

	/**
	 * Gets the absolute path of a folder which path is defined by given folder names,
	 * or of a file in that folder if $file is not empty
	 * @param array $pathFolderNames
	 * @param string $fileName
	 * @return string : absolute path
	 */
	public function getFullPath($pathFolderNames = array(), $fileName = '') {
		return APP . WEBROOT_DIR . DS . sprintf('%s%s%s%s%s', str_replace('/', DS, Configure::read('DocumentManager.baseDir')), DS, implode(DS, $pathFolderNames), empty($pathFolderNames) || empty($fileName) ? '' : DS, $fileName);
	}

	/**
	 * Extracts a folder name array from an array that may contain additional values (keyed instead of indexed)
	 * @param array $params
	 * @return array
	 */
	function getPathFolderNames($pathFolderNames) {
		$result = array();
		for ($i = 0; isset($pathFolderNames[$i]); $i++) {
			$result[$i] = $pathFolderNames[$i];
		}
		return $result;
	}

	public function phpMaxUploadSize() {
		$memory_limit = (int) (ini_get('memory_limit'));
		$max_upload = (int) (ini_get('upload_max_filesize'));
		$max_post = (int) (ini_get('post_max_size'));
		return min($max_upload, $max_post, $memory_limit);
	}

	
	public function getFlexFilename($fileName)
	{
		$search		= array('%20');
		$replace	= array(' ');
		return str_replace($search, $replace, $fileName);
	}
        
        /**
         * Renames all jpg images to .jpg and all png images to .png
         * 
         * Not sure why this is needed, but other extensions seem to 
         * give problems with the pdfengine:
         * 
         * Maurice: "Verder heb ik een fout ontdekt in het uploaden van 
         * afbeeldingen. Kun jij er ZSM voor zorgen dat ALLEEN de 
         * volgende extensies worden gebruikt: .jpg en .png 
         * Als je dus een file upload met bijvoorbeeld .JPEG, moet je 
         * deze zelf even omzetten naar .jpg, en ook zo opslaan in de 
         * database, anders gaat het dus echt mis later!"
         * 
         * @author lazlo
         */
	public function rename_extension($dirty) {
		$clean = preg_replace('/.(jpeg|jpg|JPG|JPEG)$/', '.jpg', $dirty, -1);
		$clean = preg_replace('/\.(PNG|png)$/', '.png', $clean, -1);
		
		if ($clean)
		{
			return $clean;
		}
		return $dirty;
	}
        
	public function getNextUniqueFilename($dir_array, $fileName)
	{
		$full_path  = $this->getFullPath($dir_array).DS.$fileName;
		
		if (file_exists($full_path))
		{
			/*FS: Fix the extention! */
			$pathinfo				= pathinfo($full_path);
			$ext					= $pathinfo['extension'];
			$file					= str_replace(".".$ext,'',$pathinfo['basename']);
			if (empty($ext))
			{
				list($file,$ext)		= explode(".",$fileName, -1);
			}
			
			$i = 1;
			do
			{
				$checkFileName 	= $file.'('.$i++.').'.$ext;
				$full_path  	= $this->getFullPath($dir_array).DS.$checkFileName;
			} while (file_exists($full_path));
			
			
			return $checkFileName;
		}
		
		return $fileName;

	}

}
