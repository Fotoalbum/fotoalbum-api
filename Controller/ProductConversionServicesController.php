<?php
App::uses('AppController', 'Controller');
App::uses('File', 'Utility');
App::uses('Folder', 'Utility');
App::uses('CakeEmail', 'Network/Email');

/**
 * ProductConversionServices Controller
 *
 * @property ProductConversionService $ProductConversionService
 * @property PaginatorComponent $Paginator
 */
class ProductConversionServicesController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Zip.zip');

    public $paginate = array(
        'limit' => 50,
        'conditions' => array(
            'ProductConversionService.status >=' => 0
        ),
		'order' => 'ProductConversionService.created ASC'
    );
    /**
     * beforeFilter method
     *
     * @return void
     */

    /**
     *       beforeFilter
     *
     *       Add all allow
     *    *       @return         ArrayCollection
     **/
    function beforeFilter()
    {

        parent::beforeFilter();


        Configure::write('debug', 2);


        $this->Auth->Allow();

        $this->cors_enabled = array(
            'http://api.xhibit.com',
            'http://www.xhibit.com',
            'http://beta.xhibit.com',
            'http://new.xhibit.com',
            'http://www.fotoalbum.nl',
            'http://mijn.fotoboek-maken.nl',
            'http://www.moments-to-share.nl',
            'http://enjoy.fotoalbum.nl',
            'http://www.fotoalbum.nl',
            'http://wwww.fotoalbum.be',
            'http://www.albumphoto.be',
            'http://wwww.albumphoto.fr',
        );


        if (!defined("USE_ARRAY_COLLECTION_MAPPING") || USE_ARRAY_COLLECTION_MAPPING != true) {
            $this->response->header('Access-Control-Allow-Credentials', 'false');
            if (isset($_SERVER['HTTP_ORIGIN'])) {
                if (in_array($_SERVER['HTTP_ORIGIN'], $this->cors_enabled)) {
                    $this->response->header('Access-Control-Allow-Origin', $_SERVER['HTTP_ORIGIN']);
                }
            } else {
                foreach ($this->cors_enabled as $cors_enabled) {
                    $this->response->header('Access-Control-Allow-Origin', $cors_enabled);
                }
            }


            $this->response->header('Access-Control-Allow-Origin', '*');

            if ($this->request->is('OPTIONS')) {
                $this->response->header('Access-Control-Allow-Methods', 'HEAD, GET, PUT, POST, OPTIONS, DELETE');
                $this->response->header('Access-Control-Max-Age', '604800');
                $this->response->header('Access-Control-Allow-Headers', 'Origin, Accept, Authorization, Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control');
                $this->response->send();
                exit(0);
            }
        }

        $user_database_source = $this->Session->read('connector.USERDB');
        if ((isset($user_database_source)) && (!empty($user_database_source))) {
            $this->LoadModel('User');
            $this->User->useDbConfig = $user_database_source;
        }
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
		$all_userids = $this->ProductConversionService->find('list', array('fields'=>array('user_id','user_id')));
		$users = $this->User->find('list', 
										array(
											'fields' => array(
												'id','email'
											),
											'conditions' => array(
												'id' => $all_userids
											)
										)
									);
        $this->ProductConversionService->recursive = 0;
        $this->Paginator->settings = $this->paginate;
        $this->set('productConversionServices', $this->Paginator->paginate());
        $this->set('users', $users);		
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null)
    {

        if (!$this->ProductConversionService->exists($id)) {
            throw new NotFoundException(__('Invalid product conversion service'));
        }

        $return_data = $this->_convert_data_from_air_to_admin($id);

        $this->request->data = $return_data;

        $this->set('productConversionService', $return_data);

        //$users = $this->ProductConversionService->User->find('list');
        $productConversions = $this->ProductConversionService->ProductConversion->find('list');
        $products = $this->ProductConversionService->Product->find('list');
        $this->set(compact('users', 'productConversions', 'products'));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $this->ProductConversionService->create();
            if ($this->ProductConversionService->save($this->request->data)) {
                $this->Session->setFlash(__('The product conversion service has been saved'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The product conversion service could not be saved. Please, try again.'));
            }
        }
        $users = $this->ProductConversionService->User->find('list');
        $productConversions = $this->ProductConversionService->ProductConversion->find('list');
        $products = $this->ProductConversionService->Product->find('list');
        $this->set(compact('users', 'productConversions', 'products'));
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null, $recreate = false)
    {

        if (!$this->ProductConversionService->exists($id)) {
            throw new NotFoundException(__('Invalid product conversion service'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->ProductConversionService->save($this->request->data)) {
                $this->Session->setFlash(__('The product conversion service has been saved'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The product conversion service could not be saved. Please, try again.'));
            }
        } else {

            $return_data = $this->_convert_data_from_air_to_admin($id);

            $return_data['ProductConversionService']['ziplink'] = 'http://api.xhibit.com/v2/' . $return_data['ProductConversionService']['photos_array'][0]['path'] . 'download.zip';

            if ($recreate) {
                $return_data['ProductConversionService']['user_product_id'] = '';
                debug(unlink($return_data['ProductConversionService']['photos_array'][0]['full_path'] . 'download.zip'));
            }
            //Create the zip file!
            if (!file_exists($return_data['ProductConversionService']['photos_array'][0]['full_path'] . 'download.zip')) {
                $this->Zip->begin($return_data['ProductConversionService']['photos_array'][0]['full_path'] . 'download.zip');
                $this->Zip->addByContent('fotoalbum.mcf', $return_data['ProductConversionService']['mcf_content']);
                foreach ($return_data['ProductConversionService']['photos_array'] as $photo) {
                    $this->Zip->addFile($photo['full_path'] . $photo['hires'], $photo['hires']);
                }
            }

            $this->request->data = $return_data;


        }
        //$users = $this->ProductConversionService->User->find('list');
        $productConversions = $this->ProductConversionService->ProductConversion->find('list');
        $products = $this->ProductConversionService->Product->find('list');
        $this->set(compact('users', 'productConversions', 'products'));
    }


    function admin_create_user_product($id)
    {

        $return_data = $this->_convert_data_from_air_to_admin($id);
        $product_id = $return_data['ProductConversionService']['product_id'];
        $photos = json_decode($return_data['ProductConversionService']['photos']);
        $filecontent = $return_data['ProductConversionService']['mcf_content'];


        //Get the product information
        $this->loadModel('Product');
        $this->Product->remoteResource = 'products';
        $product_info = $this->Product->find('first', array(
                'conditions' => array('Product.id' => $product_id
                )
            )
        );

        $this->loadModel('PrinterProduct');
        $cover_spine = $this->PrinterProduct->find('first', array(
                'conditions' => array('PrinterProduct.id' => $product_info['PrinterProduct'][0]['id']
                )
            )
        );

        $spine_options = $cover_spine["PrinterProductSpine"];

        //Create the photo xml
        $photo_xml = new SimpleXMLElement('<root/>');

        foreach ($photos as $ph) {

            if ($ph->result == 'OK') {

                $photo = $photo_xml->addChild('photo');
                $photo->addAttribute('id', $ph->id);
                $photo->addAttribute('name', $ph->hires);
                $photo->addAttribute('guid', $ph->guid);
                $photo->addAttribute('guid_folder', $ph->guid_folder);
                $photo->addAttribute('originalWidth', $ph->width);
                $photo->addAttribute('originalHeight', $ph->height);
                $photo->addAttribute('status', 'done');
                $photo->addAttribute('folderID', '');
                $photo->addAttribute('folderName', $ph->folderName);
                $photo->addAttribute('origin', 'Harde schijf');
                $photo->addAttribute('thumb', $ph->thumb);
                $photo->addAttribute('thumb_url', $ph->thumb_url);
                $photo->addAttribute('lowres', $ph->lowres);
                $photo->addAttribute('lowres_url', $ph->lowres_url);
                $photo->addAttribute('hires', $ph->hires);
                $photo->addAttribute('hires_url', $ph->hires_url);
                $photo->addAttribute('path', $ph->path);
                $photo->addAttribute('dateCreated', $ph->created);
                $photo->addAttribute('timeCreated', $ph->created);
                $photo->addAttribute('bytesize', $ph->bytesize);
                $photo->addAttribute('fullPath', $ph->fullPath);
                $photo->addAttribute('url', $ph->url);

                $exif = $photo->addChild('exif');

                //Defaults
                $imageRotation = 0;
                $flipHorizontal = 0;
                $flipVertical = 0;
                $orientation = 0;

                //Try to get the image rotation for this image
                try {

                    $hires = 'http://api.xhibit.com/v2/' . $ph->hires_url;

                    $imagetype = exif_imagetype($hires);

                    if ($imagetype == 2) {

                        $getexif = exif_read_data($hires);

                        if ($getexif) {

                            if (isset($getexif['Orientation'])) {

                                $orientation = $getexif['Orientation'];

                                switch ($orientation) {
                                    case 2:
                                        $flipHorizontal = 1;
                                    case 3:
                                        $imageRotation = 180;
                                        break;
                                    case 4:
                                        $flipVertical = 1;
                                        break;
                                    case 5:
                                        $flipVertical = 1;
                                        $imageRotation = 90;
                                        break;
                                    case 6:
                                        $imageRotation = 90;
                                        break;
                                    case 7:
                                        $flipHorizontal = 1;
                                        $imageRotation = 90;
                                        break;
                                    case 8:
                                        $imageRotation = 270;
                                        break;
                                    default:
                                        $flipHorizontal = 0;
                                        $flipVertical = 0;
                                        $imageRotation = 0;
                                }
                            }
                        }

                        $exif->addAttribute('orientation', $orientation);

                    }

                    $photo->addAttribute('imageRotation', $imageRotation);
                    $photo->addAttribute('flipHorizontal', $flipHorizontal);
                    $photo->addAttribute('flipVertical', $flipVertical);

                    $ph->imageRotation = $imageRotation;
                    $ph->flipHorizontal = $flipHorizontal;
                    $ph->flipVertical = $flipVertical;
                    $ph->force_orientation = 1;

                } catch (Exception $e) {

                    $photo->addAttribute('imageRotation', 0);
                    $photo->addAttribute('flipHorizontal', 0);
                    $photo->addAttribute('flipVertical', 0);

                    $ph->imageRotation = 0;
                    $ph->flipHorizontal = 0;
                    $ph->flipVertical = 0;
                    $ph->force_orientation = 0;
                }
            }
        }

        $pages_xml = $this->_createPagesXML($photos, $product_info, $spine_options, $filecontent);

        //Remove the XML header from the $pages_xml
        $pages_xml = str_replace("<?xml version=\"1.0\"?>\n", '', $pages_xml);

        //Remove the XML header from the $photo_xml
        $photo_export = $photo_xml->asXML();
        $photo_export = str_replace("<?xml version=\"1.0\"?>\n", '', $photo_export);

        //Add default color_xml
        $color_xml = '<root><color id="4294967295" rgb="255;255;255" cmyk="0;0;0;0"/><color id="0" rgb="0;0;0" cmyk="0;0;0;100"/></root>';

        //Add default usedcolor_xml
        $usedcolor_xml = '<root><color uint="0"/><color uint="16777215"/></root>';

        //Add empty textflow_xml
        $textflow_xml = '<root/>';

        //Add empty textlines_xml
        $textlines_xml = '<root/>';

        $this->LoadModel('UserProduct');
        $this->UserProduct->create();
        unset($this->UserProduct->id);

        $update_data = array(
            'UserProduct' => array(
                'user_id' => '111131826', //'Dit is project-omzetten@fotoalbum.nl
                'product_id' => $product_id,
                'platform' => 'enjoy',
                'editor' => 'app_migration',
                'name' => str_replace("_mcf-Dateien", "", $return_data['ProductConversionService']['designElementID']['details']['imagedir']),
                'pages_xml' => $pages_xml,
                'photo_xml' => (string)$photo_export,
                'color_xml' => $color_xml,
                'usedcolor_xml' => $usedcolor_xml,
                'textflow_xml' => $textflow_xml,
                'textlines_xml' => $textlines_xml
            )
        );

        if ($this->UserProduct->save($update_data)) {
            $user_product_id = $this->UserProduct->id;
            $return_data['ProductConversionService']['user_product_id'] = $user_product_id;
            $this->ProductConversionService->save($return_data);
            $this->redirect('http://www.fotoalbum.nl/maak-nu/' . $product_id . '/' . $user_product_id);
        } else {
            die("Error creating the user product id");
        }
    }

    private function _convert_data_from_air_to_admin($id)
    {

        $this->loadModel('Fontfamily');
        $fonts = $this->Fontfamily->find('list');

        $options = array(
            'conditions' => array(
                'ProductConversionService.' . $this->ProductConversionService->primaryKey => $id
            )
        );
        $return_data = $this->ProductConversionService->find('first', $options);

        //Zoeken naar de zoek & vervang van bestandsnamen (upload vs CEWE)
        $_array_photos = json_decode($return_data['ProductConversionService']['photos'], true);
        foreach ($_array_photos as $array_photo) {
            if (isset($array_photo['visible'])) {
                $array_photos[] = $array_photo;
            }
        }
        $search = Hash::extract($array_photos, '{n}.original_filename');
        $replace = Hash::extract($array_photos, '{n}.hires');

        $return_data['ProductConversionService']['mcf_content'] = str_replace($search, $replace, $return_data['ProductConversionService']['mcf_content']);


        //Parsing van de MCF
        $xml_mcf_content = simplexml_load_string($return_data['ProductConversionService']['mcf_content'], "SimpleXMLElement", LIBXML_NOCDATA);
        $json_mcf_content = json_encode($xml_mcf_content);
        $array_mcf_content = json_decode($json_mcf_content, TRUE);


        $return_data['ProductConversionService']['mcf_content_array'] = $array_mcf_content;
        $return_data['ProductConversionService']['photos_array'] = $array_photos;

        $txt = $array_mcf_content;

        $return_data['ProductConversionService']['designElementID']['details'] = Hash::extract($txt, '@attributes');

        // Get the desgin elements
        $designElementIDs = Hash::extract($txt, 'page.{n}.designElementIDs');


        // find all the used backgrounds
        $bg_1 = Hash::extract($txt, 'page.{n}.background.@attributes.templatename');
        $bg_2 = Hash::extract($txt, 'page.{n}.background.{n}.@attributes.templatename');
        $backgrounds = array_merge($bg_1, $bg_2);
        $background_counter = 0;
        $background_array = array();

        $background_s = array(',normal,', ',normal');
        foreach ($backgrounds as $background_key => $_background_value) {

            $background_value = str_replace($background_s, '', $_background_value);
            if (!isset($background_array[$background_value])) {
                $background_array[$background_value] = 0;
            }
            $background_array[$background_value] = $background_array[$background_value] + 1;
            $background_counter++;
        }

        $return_data['ProductConversionService']['designElementID']['backgrounds']['counter'] = $background_counter;
        $return_data['ProductConversionService']['designElementID']['backgrounds']['items'] = $background_array;

        // find all the used layout
        $layouts = Hash::extract($designElementIDs, '{n}.@attributes.layout');
        $layout_counter = 0;
        $layout_array = array();
        foreach ($layouts as $layout_key => $layout_value) {
            if (!isset($layout_array[$layout_value])) {
                $layout_array[$layout_value] = 0;
            }
            $layout_array[$layout_value] = $layout_array[$layout_value] + 1;
            $layout_counter++;
        }

        $return_data['ProductConversionService']['designElementID']['layouts']['counter'] = $layout_counter;
        $return_data['ProductConversionService']['designElementID']['layouts']['items'] = $layout_array;

        // find all the used passepartout
		//LET OP DEZE ZITTEN IN EEN AREA OP EEN PAGINA
        $passepartouts = Hash::extract($txt, 'page.{n}.area.{n}.designElementIDs');
        $passepartout_counter = 0;
        $passepartout_array = array();
        foreach ($passepartouts as $passepartout_key => $passepartout_value) {
            if (!isset($passepartout_array[$passepartout_value])) {
                $passepartout_array[$passepartout_value] = 0;
            }
            $passepartout_array[$passepartout_value] = $passepartout_array[$passepartout_value] + 1;
            $passepartout_counter++;
        }

        $return_data['ProductConversionService']['designElementID']['passepartouts']['counter'] = $passepartout_counter;
        $return_data['ProductConversionService']['designElementID']['passepartouts']['items'] = $passepartout_array;

        //Find all the used fonts
        $fontElementIDs = Hash::extract($txt, 'page.{n}.area.{n}.text');
        $font_counter = 0;
        $font_errors = array();
		$font_array = array();
        foreach ($fontElementIDs as $fontId => $fontElements) {
            $_text = simplexml_load_string($fontElements, "SimpleXMLElement", LIBXML_NOCDATA);
            preg_match("/\/(.*)(font-family:')(.*)(';.*)/", $fontElements, $_font_array);
            if (isset($_font_array[3])) {
                $font_value = $_font_array[3];
                if (!isset($font_array[$font_value])) {
                    $font_array[$font_value] = 0;
                }
                $font_array[$font_value] = $font_array[$font_value] + 1;
                $font_counter++;

                if (!in_array(strtolower($font_value), array_map('strtolower', $fonts))) {
                    if (!in_array($font_value, $font_errors)) {
                        $font_errors[] = $font_value;
                    }
                }
            }
        }


        $return_data['ProductConversionService']['designElementID']['fonts']['counter'] = $font_counter;
        $return_data['ProductConversionService']['designElementID']['fonts']['items'] = $font_array;
        $return_data['ProductConversionService']['designElementID']['fonts']['errors'] = $font_errors;

        //Check if the use wants pagenumbering
        $clipartElementIDs = Hash::extract($txt, 'page.{n}.area.{n}.clipart.@attributes.uniqueName');
        $clipart_counter = 0;
        $clipart_array = array();
        foreach ($clipartElementIDs as $clipartId => $clipartElements) {
            if (!isset($clipart_array[$clipartElements])) {
                $clipart_array[$clipartElements] = 0;
            }
            $clipart_array[$clipartElements] = $clipart_array[$clipartElements] + 1;
            $clipart_counter++;
        }
        $return_data['ProductConversionService']['designElementID']['cliparts']['counter'] = $clipart_counter;
        $return_data['ProductConversionService']['designElementID']['cliparts']['items'] = $clipart_array;

        //Check if the use wants pagenumbering
        $pagenumbering = Hash::extract($txt, 'pagenumbering.outline.@attributes.enabled');
        $return_data['ProductConversionService']['designElementID']['pagenumbering'] = array('active' => $pagenumbering[0]);

        if ($return_data['ProductConversionService']['errors'] == 'Geen fouten') {
            $return_data['ProductConversionService']['errors'] = '';
        }
        return $return_data;
    }


    /*
     * CEWE PRODUCT CONVERSION FROM AIR APPLICATION
     * Author: Maurice Mullens
     * TODO: Move these functions to a new controller!
     */

    function app_conversion_product($id = null)
    {

        Configure::write('debug', 0);

        $product = -1;

        //Get the matching product id from the xhibit_product_conversion table
        $this->loadModel('ProductConversion');

        if (!$id) {

            $data = $this->ProductConversion->find('first', array(
                'conditions' => array('ProductConversion.id' => $this->request->data['id'])
            ));

            if ($data) {

                $product_info = $data['ProductConversion']['product_id'];

                $this->loadModel('Product');
                $this->Product->remoteResource = 'products';
                $product = $this->Product->find('first', array(
                        'conditions' => array('Product.id' => $product_info
                        )
                    )
                );

                $this->autoRender = false;
                return json_encode($product);

            }

        } else {

            $data = $this->ProductConversion->find('first', array(
                'conditions' => array('ProductConversion.id' => $id)
            ));

            if ($data) {
                $product = $data['ProductConversion'];
            }
        }

       return $product;

    }


    function app_conversion()
    {

        Configure::write('debug', 0);

        $producttype = $this->request->data['producttype']; //CeWe Album ID -> without ALB
        $filecontent = json_decode($this->request->data['filecontent']); //JSON
        $photos = json_decode($this->request->data['photos']); //JSON
        $user_id = $this->request->data['user_id'];

        $errors = 'Geen fouten';
        if ($this->request->data['error_images']) {
            $errors = $this->request->data['error_images']; //String
        }

        //Get the product id
        $product_id = -1;
        $product = $this->app_conversion_product($producttype);

        if ($product !== -1) {
            $product_id = $product['product_id'];
        }

        $lang = "nl_NL";

        if ($this->request->data['lang']) {
            $lang = $this->request->data['lang'];
        }

        //For now, store the information in the xhibit_product_conversion_service table and send
        //an email that we can start the conversion
        $this->loadModel('ProductConversionService');

        $this->ProductConversionService->save(array(
            'user_id' => $user_id,
            'product_conversion_id' => $producttype,
            'product_id' => $product_id,
            'mcf_content' => $filecontent->filecontent,
            'photos' => $this->request->data['photos'],
            'errors' => $errors,
            'lang' => $lang,
            'status' => 0,

        ));

        //Send email to allemaal@fotoalbum.nl and inform the user we wil start converting their product
        $Email = new CakeEmail();
        $Email->from(array('conversie@fotoalbum.nl' => 'studio'));
        $Email->to('project-omzetten@fotoalbum.nl');
        $Email->subject('Aanvraag conversie CeWe naar Fotoalbum');
        $Email->send('Er is een nieuwe upload geweest van een CeWe product voor conversie.');

        $this->autoRender = false;
        return json_encode($product_id);
    }


    function error_conversion()
    {

        Configure::write('debug', 0);

        $user_id = $this->request->data['user_id'];
        $mcf = json_decode($this->request->data['mcf_content']);
        $debug_content = $this->request->data['debug_content'];

        $xml = simplexml_load_string($mcf->filecontent);
        $json = json_encode($xml);

        //Send email to maurice@fotoalbum.nl
        $Email = new CakeEmail();
        $Email->from(array('conversie@fotoalbum.nl' => 'studio'));
        $Email->to('maurice@fotoalbum.nl');
        $Email->subject('Probleem conversie');
        $Email->emailFormat('html');
        $Email->send("<html><p>user_id: " . $user_id . "</p><p>" . $debug_content . "</p></html>"); //<p>" . $json . "</p>
        $this->autoRender = false;
        return $user_id;
    }


    private function _createPagesXML($photos, $product_info, $spine_options, $filecontent)
    {

        $pages_xml = new SimpleXMLElement('<root/>');
        $mcf_pages = new SimpleXMLElement($filecontent);

        $xml_attibutes = $mcf_pages[0]->attributes();
        $numpages = $xml_attibutes['normalpages'];

        $pages = $mcf_pages->xpath('page');

        $product = $product_info['Product'];
        $cover = $product_info['ProductCover'];

        $page_width = $product['page_width'];
        $page_height = $product['page_height'];

        $coverWidth = $this->mm2pt($cover['width']);

        $coverHeight = $this->mm2pt($cover['height']);
        $coverSpine = $this->CalculateSpine($spine_options, $numpages);
        $coverWrap = $this->mm2pt($cover['wrap']);
        $coverBleed = $this->mm2pt($cover['bleed']);

        $coverPageWidth = $coverWidth + $coverWrap + $coverBleed;
        $coverPageHeight = $coverHeight + (($coverBleed + $coverWrap) * 2);
        $totalCoverWidth = (($coverWidth + $coverWrap + $coverBleed) * 2) + $coverSpine;
        $totalCoverHeight = ($coverHeight + $coverWrap + $coverBleed) * 2;

        $pageWidth = $this->mm2pt($product['page_width']);
        $pageHeight = $this->mm2pt($product['page_height']);
        $bleed = $this->mm2pt($product['page_bleed']);
        $totalPageWidth = $pageWidth + $bleed;
        $totalPageHeight = $pageHeight + ($bleed * 2);

        $totalSpreadWidth = ($pageWidth + $bleed) * 2;
        $totalSpreadHeight = $pageHeight + ($bleed * 2);

        $covercreated = false;
        $pagenum = 0;

        $pageside = "left";
        $singlepage = "false";
        $singlepagefirst = "false";
        $singlepagelast = "false";
        $firstpage = true;
        $exitnow = false;

        $pageindex = 0;

        $arrmax = count($pages) - 2;

        foreach ($pages as $page) {

            $type = $page['type'];
            $mod = $pageindex % 2;

            $backgroundColor = -1;

            switch ($type) {

                case "fullcover":

                    if ($pageindex == 0 && !$covercreated) {

                        $covercreated = true;

                        $spread_id = String::uuid();

                        $spread = $pages_xml->addChild('spread');

                        $spread->addAttribute('id', $spread_id);
                        $spread->addAttribute('spreadID', $spread_id);
                        $spread->addAttribute('width', $totalCoverWidth);
                        $spread->addAttribute('height', $totalCoverHeight);
                        $spread->addAttribute('totalWidth', $totalCoverWidth);
                        $spread->addAttribute('totalHeight', $totalCoverHeight);
                        $spread->addAttribute('singlepage', 'false');
                        $spread->addAttribute('backgroundColor', '-1');
                        $spread->addAttribute('backgroundAlpha', '1');
                        $spread->addAttribute('version', '3.2.7');

                        $newpages = $spread->addChild('pages');

                        //coverback
                        $page_id = String::uuid();
                        $leftpage = $newpages->addChild('page');
                        $leftpage->addAttribute('pageID', $page_id);
                        $leftpage->addAttribute('spreadID', $spread_id);
                        $leftpage->addAttribute('width', $coverPageWidth);
                        $leftpage->addAttribute('height', $coverPageHeight);
                        $leftpage->addAttribute('pageType', 'coverback');
                        $leftpage->addAttribute('type', 'coverback');
                        $leftpage->addAttribute('pageWidth', $coverWidth); //zonder bleed en wrap
                        $leftpage->addAttribute('pageHeight', $coverHeight); //zonder bleed en wrap
                        $leftpage->addAttribute('horizontalBleed', $coverBleed);
                        $leftpage->addAttribute('verticalBleed', $coverBleed);
                        $leftpage->addAttribute('horizontalWrap', $coverWrap);
                        $leftpage->addAttribute('verticalWrap', $coverWrap);
                        $leftpage->addAttribute('pageNumber', $pagenum);
                        $leftpage->addAttribute('backgroundColor', $backgroundColor);
                        $leftpage->addAttribute('backgroundAlpha', '1');
                        $leftpage->addAttribute('pageLeftRight', 'coverback');
                        $leftpage->addAttribute('singlepage', 'false');
                        $leftpage->addAttribute('singlepageFirst', 'false');
                        $leftpage->addAttribute('singlepageLast', 'false');
                        $leftpage->addAttribute('side', 'coverback');

                        //coverspine
                        $page_id = String::uuid();
                        $newpage = $newpages->addChild('page');
                        $newpage->addAttribute('pageID', $page_id);
                        $newpage->addAttribute('spreadID', $spread_id);
                        $newpage->addAttribute('width', $coverSpine);
                        $newpage->addAttribute('height', $coverPageHeight);
                        $newpage->addAttribute('pageType', 'coverspine');
                        $newpage->addAttribute('type', 'coverspine');
                        $newpage->addAttribute('pageWidth', $coverSpine); //zonder bleed en wrap
                        $newpage->addAttribute('pageHeight', $coverHeight); //zonder bleed en wrap
                        $newpage->addAttribute('horizontalBleed', $coverBleed);
                        $newpage->addAttribute('verticalBleed', $coverBleed);
                        $newpage->addAttribute('horizontalWrap', '0');
                        $newpage->addAttribute('verticalWrap', $coverWrap);
                        $newpage->addAttribute('pageNumber', $pagenum);
                        $newpage->addAttribute('backgroundColor', $backgroundColor);
                        $newpage->addAttribute('backgroundAlpha', '1');
                        $newpage->addAttribute('pageLeftRight', 'coverspine');
                        $newpage->addAttribute('singlepage', 'false');
                        $newpage->addAttribute('singlepageFirst', 'false');
                        $newpage->addAttribute('singlepageLast', 'false');
                        $newpage->addAttribute('side', 'coverspine');

                        //coverfront
                        $page_id = String::uuid();
                        $rightpage = $newpages->addChild('page');
                        $rightpage->addAttribute('pageID', $page_id);
                        $rightpage->addAttribute('spreadID', $spread_id);
                        $rightpage->addAttribute('width', $coverPageWidth);
                        $rightpage->addAttribute('height', $coverPageHeight);
                        $rightpage->addAttribute('pageType', 'coverfront');
                        $rightpage->addAttribute('type', 'coverfront');
                        $rightpage->addAttribute('pageWidth', $coverWidth); //zonder bleed en wrap
                        $rightpage->addAttribute('pageHeight', $coverHeight); //zonder bleed en wrap
                        $rightpage->addAttribute('horizontalBleed', $coverBleed);
                        $rightpage->addAttribute('verticalBleed', $coverBleed);
                        $rightpage->addAttribute('horizontalWrap', $coverWrap);
                        $rightpage->addAttribute('verticalWrap', $coverWrap);
                        $rightpage->addAttribute('pageNumber', $pagenum);
                        $rightpage->addAttribute('backgroundColor', $backgroundColor);
                        $rightpage->addAttribute('backgroundAlpha', '1');
                        $rightpage->addAttribute('pageLeftRight', 'coverfront');
                        $rightpage->addAttribute('singlepage', 'false');
                        $rightpage->addAttribute('singlepageFirst', 'false');
                        $rightpage->addAttribute('singlepageLast', 'false');
                        $rightpage->addAttribute('side', 'coverfront');

                        //Elements
                        $elements = $spread->addChild('elements');

                        $this->_addSpreadElements($spread, $page, $elements, $photos, $leftpage, $rightpage, $coverPageWidth, $coverPageHeight, true, 0, $totalCoverWidth, $totalCoverHeight, $coverSpine, $coverBleed, $coverWrap);

                    }
                    break;

                case "empty":
                case "emptypage":

                    if ($mod == 1) {

                        $pagenum = 1;
                        $pageside = 'right';

                        //First empty page so render the areas if we have them
                        $spread_id = String::uuid();

                        $spread = $pages_xml->addChild('spread');

                        $spread->addAttribute('id', $spread_id);
                        $spread->addAttribute('spreadID', $spread_id);
                        $spread->addAttribute('width', $totalPageWidth + $bleed);
                        $spread->addAttribute('height', $totalPageHeight);
                        $spread->addAttribute('totalWidth', $totalPageWidth + (2 * $bleed));
                        $spread->addAttribute('totalHeight', $totalPageHeight);
                        $spread->addAttribute('singlepage', 'true');
                        $spread->addAttribute('backgroundColor', '-1');
                        $spread->addAttribute('backgroundAlpha', '1');
                        $spread->addAttribute('version', '3.2.7');

                        $newpages = $spread->addChild('pages');

                        //coverback
                        $page_id = String::uuid();
                        $newpage = $newpages->addChild('page');
                        $newpage->addAttribute('pageID', $page_id);
                        $newpage->addAttribute('spreadID', $spread_id);
                        $newpage->addAttribute('width', $totalPageWidth + $bleed);
                        $newpage->addAttribute('height', $totalPageHeight);
                        $newpage->addAttribute('pageType', 'normal');
                        $newpage->addAttribute('type', 'normal');
                        $newpage->addAttribute('pageWidth', $pageWidth); //zonder bleed en wrap
                        $newpage->addAttribute('pageHeight', $pageHeight); //zonder bleed en wrap
                        $newpage->addAttribute('horizontalBleed', $bleed);
                        $newpage->addAttribute('verticalBleed', $bleed);
                        $newpage->addAttribute('horizontalWrap', 0);
                        $newpage->addAttribute('verticalWrap', 0);
                        $newpage->addAttribute('pageNumber', $pagenum);
                        $newpage->addAttribute('backgroundColor', $backgroundColor);
                        $newpage->addAttribute('backgroundAlpha', '1');
                        $newpage->addAttribute('pageLeftRight', $pageside);
                        $newpage->addAttribute('singlepage', 'true');
                        $newpage->addAttribute('singlepageFirst', 'true');
                        $newpage->addAttribute('singlepageLast', 'false');
                        $newpage->addAttribute('side', $pageside);

                        //Elements
                        $elements = $spread->addChild('elements');

                        $this->_addSpreadElements($spread, $page, $elements, $photos, $newpage, null, $pageWidth, $pageHeight, false, $pageWidth + $bleed, $totalSpreadWidth, $totalSpreadHeight, 0, $bleed, 0);

                    }

                    break;

                case "content":
                case "normalpage":

                    //Script here
                    if ($mod == 1) {

                        $pageside = 'left';
                        $pagenum += 1;

                        //First empty page so render the areas if we have them
                        $spread_id = String::uuid();

                        $spread = $pages_xml->addChild('spread');

                        $spread->addAttribute('id', $spread_id);
                        $spread->addAttribute('spreadID', $spread_id);
                        $spread->addAttribute('width', $totalSpreadWidth);
                        $spread->addAttribute('height', $totalSpreadHeight);
                        $spread->addAttribute('totalWidth', $totalSpreadWidth);
                        $spread->addAttribute('totalHeight', $totalSpreadHeight);
                        $spread->addAttribute('singlepage', 'false');
                        $spread->addAttribute('backgroundColor', '-1');
                        $spread->addAttribute('backgroundAlpha', '1');
                        $spread->addAttribute('version', '3.2.7');

                        $newpages = $spread->addChild('pages');

                        //left page
                        $page_id = String::uuid();
                        $leftpage = $newpages->addChild('page');
                        $leftpage->addAttribute('pageID', $page_id);
                        $leftpage->addAttribute('spreadID', $spread_id);
                        $leftpage->addAttribute('width', $totalPageWidth + $bleed);
                        $leftpage->addAttribute('height', $totalPageHeight);
                        $leftpage->addAttribute('pageType', 'normal');
                        $leftpage->addAttribute('type', 'normal');
                        $leftpage->addAttribute('pageWidth', $pageWidth); //zonder bleed en wrap
                        $leftpage->addAttribute('pageHeight', $pageHeight); //zonder bleed en wrap
                        $leftpage->addAttribute('horizontalBleed', $bleed);
                        $leftpage->addAttribute('verticalBleed', $bleed);
                        $leftpage->addAttribute('horizontalWrap', 0);
                        $leftpage->addAttribute('verticalWrap', 0);
                        $leftpage->addAttribute('pageNumber', $pagenum);
                        $leftpage->addAttribute('backgroundColor', $backgroundColor);
                        $leftpage->addAttribute('backgroundAlpha', '1');
                        $leftpage->addAttribute('pageLeftRight', $pageside);
                        $leftpage->addAttribute('singlepage', 'false');
                        $leftpage->addAttribute('singlepageFirst', 'false');
                        $leftpage->addAttribute('singlepageLast', 'false');
                        $leftpage->addAttribute('side', $pageside);

                        $pageside = 'right';
                        $pagenum += 1;

                        //right page
                        $rightpage = null;
                        if ($arrmax != $pageindex) {
                            $page_id = String::uuid();
                            $rightpage = $newpages->addChild('page');
                            $rightpage->addAttribute('pageID', $page_id);
                            $rightpage->addAttribute('spreadID', $spread_id);
                            $rightpage->addAttribute('width', $totalPageWidth + $bleed);
                            $rightpage->addAttribute('height', $totalPageHeight);
                            $rightpage->addAttribute('pageType', 'normal');
                            $rightpage->addAttribute('type', 'normal');
                            $rightpage->addAttribute('pageWidth', $pageWidth); //zonder bleed en wrap
                            $rightpage->addAttribute('pageHeight', $pageHeight); //zonder bleed en wrap
                            $rightpage->addAttribute('horizontalBleed', $bleed);
                            $rightpage->addAttribute('verticalBleed', $bleed);
                            $rightpage->addAttribute('horizontalWrap', 0);
                            $rightpage->addAttribute('verticalWrap', 0);
                            $rightpage->addAttribute('pageNumber', $pagenum);
                            $rightpage->addAttribute('backgroundColor', $backgroundColor);
                            $rightpage->addAttribute('backgroundAlpha', '1');
                            $rightpage->addAttribute('pageLeftRight', $pageside);
                            $rightpage->addAttribute('singlepage', 'false');
                            $rightpage->addAttribute('singlepageFirst', 'false');
                            $rightpage->addAttribute('singlepageLast', 'false');
                            $rightpage->addAttribute('side', $pageside);
                        }

                        //Elements
                        $elements = $spread->addChild('elements');

                        $this->_addSpreadElements($spread, $page, $elements, $photos, $leftpage, $rightpage, $pageWidth, $pageHeight, false, $bleed, $totalSpreadWidth, $totalSpreadHeight, 0, $bleed, 0);

                    }

                    break;
            }

            $pageindex += 1;
        }

        return $pages_xml->asXML();
    }


    private function _addSpreadElements($spread, $page, $elements, $photos, $leftpage, $rightpage, $pagewidth, $pageheight, $isCover, $rightPageCorrection, $totalWidth, $totalHeight, $spine, $bleed, $wrap)
    {

        $dpi = 330 / 96;

        $areas = $page->xpath('area');

        foreach ($areas as $area) {

            $attr = $area->attributes();

            switch ($attr->areatype) {

                case "imagebackgroundarea":

                    $area_attr = $area->imagebackground->attributes();
                    $filename = pathinfo($area_attr['filename'], PATHINFO_FILENAME);
                    $filename = $this->stripFileNameInvalid($filename);

                    $image = $this->GetImageFromUpload($photos, $filename);

                    if ($image) {

                        $position = strtolower($area_attr['backgroundPosition']);

                        //Check the backgroundPosition to determine if we have spread or page background
                        switch ($position) {
                            case "left_or_top":
                                //Add background to coverback
                                $background = $leftpage->addChild('background');
                                $background->addAttribute('id', String::uuid());
                                $background->addAttribute('bytesize', $image->bytesize);
                                $background->addAttribute('hires', $image->hires);
                                $background->addAttribute('hires_url', $image->hires_url);
                                $background->addAttribute('lowres', $image->lowres);
                                $background->addAttribute('lowres_url', $image->lowres_url);
                                $background->addAttribute('thumb', $image->thumb);
                                $background->addAttribute('thumb_url', $image->thumb_url);
                                $background->addAttribute('path', $image->path);
                                $background->addAttribute('origin', 'Hardeschijf');
                                $background->addAttribute('origin_type', '');
                                $background->addAttribute('originalWidth', $this->mm2pt($image->width));
                                $background->addAttribute('originalHeight', $this->mm2pt($image->height));
                                $background->addAttribute('x', 0);
                                $background->addAttribute('y', 0);
                                $background->addAttribute('width', 0);
                                $background->addAttribute('height', 0);
                                $background->addAttribute('fliphorizontal', 0);
                                $background->addAttribute('imageFilter', '');
                                $background->addAttribute('imageRotation', $image->imageRotation);
                                if ($image->imageRotation !== 0) {
                                    $background->addAttribute('imageRotationUpdate', 1);
                                } else {
                                    $background->addAttribute('imageRotationUpdate', 0);
                                }
                                $background->addAttribute('status', 'done');
                                break;
                            case 'right_or_bottom':
                                //Add background to coverfront
                                if ($rightpage) {
                                    $background = $rightpage->addChild('background');
                                } else {
                                    $background = $leftpage->addChild('background');
                                }
                                $background->addAttribute('id', String::uuid());
                                $background->addAttribute('bytesize', $image->bytesize);
                                $background->addAttribute('hires', $image->hires);
                                $background->addAttribute('hires_url', $image->hires_url);
                                $background->addAttribute('lowres', $image->lowres);
                                $background->addAttribute('lowres_url', $image->lowres_url);
                                $background->addAttribute('thumb', $image->thumb);
                                $background->addAttribute('thumb_url', $image->thumb_url);
                                $background->addAttribute('path', $image->path);
                                $background->addAttribute('origin', 'Hardeschijf');
                                $background->addAttribute('origin_type', '');
                                $background->addAttribute('originalWidth', $this->mm2pt($image->width));
                                $background->addAttribute('originalHeight', $this->mm2pt($image->height));
                                $background->addAttribute('x', 0);
                                $background->addAttribute('y', 0);
                                $background->addAttribute('width', 0);
                                $background->addAttribute('height', 0);
                                $background->addAttribute('fliphorizontal', 0);
                                $background->addAttribute('imageFilter', '');
                                $background->addAttribute('imageRotation', $image->imageRotation);
                                if ($image->imageRotation !== 0) {
                                    $background->addAttribute('imageRotationUpdate', 1);
                                } else {
                                    $background->addAttribute('imageRotationUpdate', 0);
                                }
                                $background->addAttribute('status', 'done');
                                break;
                            case 'bundle':
                                //Spread background
                                $background = $spread->addChild('background');
                                $background->addAttribute('id', String::uuid());
                                $background->addAttribute('bytesize', $image->bytesize);
                                $background->addAttribute('hires', $image->hires);
                                $background->addAttribute('hires_url', $image->hires_url);
                                $background->addAttribute('lowres', $image->lowres);
                                $background->addAttribute('lowres_url', $image->lowres_url);
                                $background->addAttribute('thumb', $image->thumb);
                                $background->addAttribute('thumb_url', $image->thumb_url);
                                $background->addAttribute('path', $image->path);
                                $background->addAttribute('origin', 'Hardeschijf');
                                $background->addAttribute('origin_type', '');
                                $background->addAttribute('originalWidth', $this->mm2pt($image->width));
                                $background->addAttribute('originalHeight', $this->mm2pt($image->height));
                                $background->addAttribute('x', 0);
                                $background->addAttribute('y', 0);
                                $background->addAttribute('width', 0);
                                $background->addAttribute('height', 0);
                                $background->addAttribute('fliphorizontal', 0);
                                $background->addAttribute('imageFilter', '');
                                $background->addAttribute('imageRotation', $image->imageRotation);
                                if ($image->imageRotation !== 0) {
                                    $background->addAttribute('imageRotationUpdate', 1);
                                } else {
                                    $background->addAttribute('imageRotationUpdate', 0);
                                }
                                $background->addAttribute('status', 'done');
                                break;
                        }
                    }
                    break;

                case "imagearea":

                    $area_attr = $area->attributes();

                    $img_attr = $area->image->attributes();
                    $filename = pathinfo($img_attr['filename'], PATHINFO_FILENAME);
                    $filename = $this->stripFileNameInvalid($filename);

                    $objectWidth = $area_attr['width'] / ($dpi);
                    $objectHeight = $area_attr['height'] / ($dpi);
                    $objectX = $area_attr['left'] / ($dpi);
                    $objectY = $area_attr['top'] / ($dpi);

                    //Get the image properties
                    $borderenabled = $area_attr['borderenabled'];
                    $bordercolor = '';
                    if ($area_attr['colorborder']) {
                        $bc = str_replace("#", "", $area_attr['colorborder']);
                        $bordercolor = hexdec($bc);
                    }
                    $borderweight = $area_attr['sizeborder'] / ($dpi);
                    if ($borderweight < 0) {
                        $borderweight = 0;
                    };
                    $objectRotation = $area_attr['rotation'];
                    $shadow = "";
                    if ($area_attr['shadowEnabled'] == "1") {
                        $angle = $area_attr['shadowAngle'];
                        if ($angle < 180) {
                            $shadow = "right";
                        } else if ($angle == 180) {
                            $shadow = "bottom";
                        } else if ($angle > 180) {
                            $shadow = "left";
                        }
                    } else {
                        $shadow = "";
                    }

                    $image = $this->GetImageFromUpload($photos, $filename);

                    if ($image) {

                        $scale = (float)$img_attr['scale'];

                        $imageWidth = (((float)$image->width) * $scale) / ($dpi);
                        $imageHeight = (((float)$image->height) * $scale) / ($dpi);
                        $offsetX = (((float)$img_attr['left']) * $scale) / ($dpi);
                        $offsetY = (((float)$img_attr['top']) * $scale) / ($dpi);

                        $element = $elements->addChild('element');
                        $element->addAttribute('id', String::uuid());
                        $element->addAttribute('pageID', "");
                        $element->addAttribute('type', "photo");
                        $element->addAttribute('status', "done");
                        $element->addAttribute('path', $image->path);
                        $element->addAttribute('hires', $image->hires);
                        $element->addAttribute('hires_url', $image->hires_url);
                        $element->addAttribute('lowres', $image->lowres);
                        $element->addAttribute('lowres_url', $image->lowres_url);
                        $element->addAttribute('thumb', $image->thumb);
                        $element->addAttribute('thumb_url', $image->thumb_url);
                        $element->addAttribute('fullPath', $image->fullPath);
                        $element->addAttribute('original_image_id', $image->guid);
                        $element->addAttribute('originalWidth', $objectWidth);
                        $element->addAttribute('originalHeight', $objectHeight);
                        $element->addAttribute('origin', "Harde schijf");
                        $element->addAttribute('bytesize', $image->bytesize);
                        $element->addAttribute('userID', $image->user_id);
                        $element->addAttribute('original_image', "");
                        $element->addAttribute('original_thumb', "");
                        $element->addAttribute('index', "0");
                        $element->addAttribute('objectX', $objectX - $rightPageCorrection);
                        $element->addAttribute('objectY', $objectY - $bleed);
                        $element->addAttribute('objectWidth', $objectWidth);
                        $element->addAttribute('objectHeight', $objectHeight);
                        $element->addAttribute('imageWidth', $imageWidth);
                        $element->addAttribute('imageHeight', $imageHeight);
                        $element->addAttribute('imageFilter', "");
                        $element->addAttribute('shadow', $shadow);
                        $element->addAttribute('offsetX', $offsetX);
                        $element->addAttribute('offsetY', $offsetY);
                        $element->addAttribute('rotation', $objectRotation);
                        $element->addAttribute('imageRotation', $image->imageRotation);
                        if ($image->imageRotation !== 0) {
                            $element->addAttribute('imageRotationUpdate', 1);
                        } else {
                            $element->addAttribute('imageRotationUpdate', 0);
                        }
                        $element->addAttribute('imageAlpha', 1);
                        $element->addAttribute('refWidth', $imageWidth);
                        $element->addAttribute('refHeight', $imageHeight);
                        $element->addAttribute('refOffsetX', 0);
                        $element->addAttribute('refOffsetY', 0);
                        $element->addAttribute('refScale', 1);
                        $element->addAttribute('scaling', 1);
                        $element->addAttribute('mask_original_id', "");
                        $element->addAttribute('mask_original_width', "");
                        $element->addAttribute('mask_original_height', "");
                        $element->addAttribute('mask_path', "");
                        $element->addAttribute('mask_hires', "");
                        $element->addAttribute('mask_hires_url', "");
                        $element->addAttribute('mask_lowres', "");
                        $element->addAttribute('mask_lowres_url', "");
                        $element->addAttribute('mask_thumb', "");
                        $element->addAttribute('mask_thumb_url', "");
                        $element->addAttribute('overlay_original_width', "");
                        $element->addAttribute('overlay_original_height', "");
                        $element->addAttribute('overlay_hires', "");
                        $element->addAttribute('overlay_hires_url', "");
                        $element->addAttribute('overlay_lowres', "");
                        $element->addAttribute('overlay_lowres_url', "");
                        $element->addAttribute('overlay_thumb', "");
                        $element->addAttribute('overlay_thumb_url', "");
                        $element->addAttribute('bordercolor', $bordercolor);
                        $element->addAttribute('borderalpha', 1);
                        $element->addAttribute('borderweight', $borderweight);
                        $element->addAttribute('fliphorizontal', $image->flipHorizontal);
                        $element->addAttribute('fixedposition', "0");
                        $element->addAttribute('fixedcontent', "0");
                        $element->addAttribute('allwaysontop', "0");
                    } else {

                        //Add an empty placeholder for the image
                        $element = $elements->addChild('element');
                        $element->addAttribute('id', String::uuid());
                        $element->addAttribute('pageID', "");
                        $element->addAttribute('type', "photo");
                        $element->addAttribute('status', "empty");
                        $element->addAttribute('path', "");
                        $element->addAttribute('hires', "");
                        $element->addAttribute('hires_url', "");
                        $element->addAttribute('lowres', "");
                        $element->addAttribute('lowres_url', "");
                        $element->addAttribute('thumb', "");
                        $element->addAttribute('thumb_url', "");
                        $element->addAttribute('fullPath', "");
                        $element->addAttribute('original_image_id', "");
                        $element->addAttribute('originalWidth', $objectWidth);
                        $element->addAttribute('originalHeight', $objectHeight);
                        $element->addAttribute('origin', "");
                        $element->addAttribute('bytesize', 0);
                        $element->addAttribute('userID', "");
                        $element->addAttribute('original_image', "");
                        $element->addAttribute('original_thumb', "");
                        $element->addAttribute('index', "0");
                        $element->addAttribute('objectX', $objectX - $rightPageCorrection);
                        $element->addAttribute('objectY', $objectY);
                        $element->addAttribute('objectWidth', $objectWidth);
                        $element->addAttribute('objectHeight', $objectHeight);
                        $element->addAttribute('imageWidth', "");
                        $element->addAttribute('imageHeight', "");
                        $element->addAttribute('imageFilter', "");
                        $element->addAttribute('shadow', $shadow);
                        $element->addAttribute('offsetX', "");
                        $element->addAttribute('offsetY', "");
                        $element->addAttribute('rotation', $objectRotation);
                        $element->addAttribute('imageRotation', 0);
                        $element->addAttribute('imageRotationUpdate', 0);
                        $element->addAttribute('imageAlpha', 1);
                        $element->addAttribute('refWidth', "");
                        $element->addAttribute('refHeight', "");
                        $element->addAttribute('refOffsetX', 0);
                        $element->addAttribute('refOffsetY', 0);
                        $element->addAttribute('refScale', 1);
                        $element->addAttribute('scaling', 1);
                        $element->addAttribute('mask_original_id', "");
                        $element->addAttribute('mask_original_width', "");
                        $element->addAttribute('mask_original_height', "");
                        $element->addAttribute('mask_path', "");
                        $element->addAttribute('mask_hires', "");
                        $element->addAttribute('mask_hires_url', "");
                        $element->addAttribute('mask_lowres', "");
                        $element->addAttribute('mask_lowres_url', "");
                        $element->addAttribute('mask_thumb', "");
                        $element->addAttribute('mask_thumb_url', "");
                        $element->addAttribute('overlay_original_width', "");
                        $element->addAttribute('overlay_original_height', "");
                        $element->addAttribute('overlay_hires', "");
                        $element->addAttribute('overlay_hires_url', "");
                        $element->addAttribute('overlay_lowres', "");
                        $element->addAttribute('overlay_lowres_url', "");
                        $element->addAttribute('overlay_thumb', "");
                        $element->addAttribute('overlay_thumb_url', "");
                        $element->addAttribute('bordercolor', $bordercolor);
                        $element->addAttribute('borderalpha', 1);
                        $element->addAttribute('borderweight', $borderweight);
                        $element->addAttribute('fliphorizontal', "0");
                        $element->addAttribute('fixedposition', "0");
                        $element->addAttribute('fixedcontent', "0");
                        $element->addAttribute('allwaysontop', "0");
                    }
                    break;

                case "freetextarea":
                case "textarea":

                    $area_attr = $area->attributes();

                    $txt_attr = $area->text->attributes();

                    $objectWidth = $area_attr['width'] / ($dpi);
                    $objectHeight = $area_attr['height'] / ($dpi);
                    $objectX = $area_attr['left'] / ($dpi);
                    $objectY = $area_attr['top'] / ($dpi);

                    //Get the box properties
                    $borderenabled = $area_attr['borderenabled'];
                    $bordercolor = '';
                    if ($area_attr['colorborder']) {
                        $bc = str_replace("#", "", $area_attr['colorborder']);
                        $bordercolor = hexdec($bc);
                    }
                    $borderweight = $area_attr['sizeborder'] / ($dpi);
                    if ($borderweight < 0) {
                        $borderweight = 0;
                    };
                    $objectRotation = $area_attr['rotation'];
                    $shadow = "";
                    if ($area_attr['shadowEnabled'] == "1") {
                        $angle = $area_attr['shadowAngle'];
                        if ($angle < 180) {
                            $shadow = "right";
                        } else if ($angle == 180) {
                            $shadow = "bottom";
                        } else if ($angle > 180) {
                            $shadow = "left";
                        }
                    } else {
                        $shadow = "";
                    }

                    $tfID = String::uuid();
                    $element = $elements->addChild('element');
                    $element->addAttribute('id', String::uuid());
                    $element->addAttribute('pageID', '');
                    $element->addAttribute('type', 'text');
                    $element->addAttribute('index', '0');
                    $element->addAttribute('objectX', $objectX - $rightPageCorrection);
                    $element->addAttribute('objectY', $objectY);
                    $element->addAttribute('objectWidth', $objectWidth);
                    $element->addAttribute('objectHeight', $objectHeight);
                    $element->addAttribute('tfID', $tfID);
                    $element->addAttribute('rotation', $objectRotation);
                    $element->addAttribute('shadow', $shadow);
                    $element->addAttribute('bordercolor', $bordercolor);
                    $element->addAttribute('borderalpha', 1);
                    $element->addAttribute('borderweight', $borderweight);
                    $element->addAttribute('coverTitle', 'false');
                    $element->addAttribute('coverSpineTitle', 'false');
                    $element->addAttribute('fixedposition', '0');
                    $element->addAttribute('fixedcontent', '0');
                    $element->addAttribute('allwaysontop', '0');
                    $element->addAttribute('importtext', '1');
                    $element[0] = (string)$area->text;
                    break;

            }
        }

    }

    function GetImageFromUpload($photos, $filename)
    {

        foreach ($photos as $photo) {

            if ($photo->result == "OK") {

                $hires = pathinfo($photo->hires, PATHINFO_FILENAME);

                if ($hires == $filename) {
                    return $photo;
                }
            }
        }

        return false;
    }

    function mm2pt($mm)
    {
        //1 pt = 1/72 inch = 25.4/72 mm = 0.35277777777738178 mm
        return $mm / 0.35277777777738178;
    }

    function CalculateSpine($spine_options, $numPages)
    {

        /* 5 Spine methods

         1 Fixed value from loop (product_price)
         2 Variabel (numpages * value)
         3 Basevalue + value
         4 Basevalue + (numpages * value)
         5 (Basevalue + (numpages * value)) * 1.1
         6 (((num_pages / 2) / 100) / 80) * paper_width / Foprico
         */
        $spineMethod = 1;

        switch ($spineMethod) {
            case 1:
                foreach ($spine_options as $item) {
                    if ($numPages >= $item['min_page'] && $numPages <= $item['max_page']) {
                        return $this->mm2pt($item['value']);
                    }
                };
                break;
            case 2:
                //spine = parseFloat(_productSpine[0].value.toString()) * numPages;
                break;
            case 3:
                //spine = parseFloat(_productSpine[0].base_value.toString()) + parseFloat(_productSpine[0].value.toString());
                break;
            case 4:
                //spine = parseFloat(_productSpine[0].base_value.toString()) + (parseFloat(_productSpine[0].value.toString()) * numPages);
                break;
            case 5:
                //$spine = (parseFloat(_productSpine[0].base_value.toString()) + (parseFloat(_productSpine[0].value.toString()) * numPages)) * 1.1;
                //break;
            case 6:
                //spine = (((numPages / 2) / 10) / 80) * _printerProduct.ProductPaperweight.api_code;
                break;
        }

        return 0;

    }

    public function stripFileNameInvalid($fileName)
    {

        $fileName = strip_tags($fileName);
        $fileName = preg_replace('/[\r\n\t ]+/', ' ', $fileName);
        $fileName = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $fileName);
        $fileName = strtolower($fileName);
        $fileName = html_entity_decode($fileName, ENT_QUOTES, "utf-8");
        $fileName = htmlentities($fileName, ENT_QUOTES, "utf-8");
        $fileName = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $fileName);
        $fileName = str_replace(' ', '-', $fileName);
        $fileName = rawurlencode($fileName);
        $fileName = str_replace('%', '-', $fileName);

        return $fileName;

    }
	
    /*
     * GETS THE designElements for all products
     * Author: Frank
     */

    function get_topx_designelements()
    {	
		Configure::write('debug', 0);
        $options = array(
            //'limit' => 10000,
			/*'conditions' => array(
                'ProductConversionService.' . $this->ProductConversionService->primaryKey => $id
            )*/
        );
		$all = Cache::read('_get_topx_designelements', 'long');
		$items = array('backgrounds','layouts','passepartouts','fonts','cliparts');
		
		if ($all === false)
		{
			$return_data = $this->ProductConversionService->find('all', $options);
			$all = array();	
			
			foreach($items as $item)
			{
				$all[$item] = array();
				$_all[$item] = array();
			}
			foreach($return_data as $PCS)
			{
				//debug($PCS['ProductConversionService']['id']);
				$data = $this->_convert_data_from_air_to_admin($PCS['ProductConversionService']['id']);
				debug($data);
				
				foreach($items as $item)
				{
					$_all[$item] = hash::extract($data['ProductConversionService']['designElementID'], $item.'.items');
					foreach($_all[$item] as $key=>$value)
					{
						$key = (string) $key;
						if (isset($all[$item][$key]))
						{
							$all[$item][$key] = $all[$item][$key] + $value;
						}
						else
						{
							$all[$item][$key] = $value;
						}
					}
				}
			}
			
			Cache::write('_get_topx_designelements', $all, 'long');
		}


		$albums = array();
		foreach($all as $allK=>$allV)
		{
			arsort($allV);
			$all[$allK] = $allV;
			foreach($allV as $k=>$v)
			{
				$retdata[$allK][] = array('id'=>$k, 'count'=>$v);
			}
		}
		
		//debug($retdata['backgrounds']);

		$this->set(compact('items','retdata'));
		//Configure::write('debug', 0);
		$this->autoRender = true;
	}
}
