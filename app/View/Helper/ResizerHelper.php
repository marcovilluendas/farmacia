<?php  

App::uses('AppHelper', 'View/Helper');


class ResizerHelper extends AppHelper { 
  var $cacheDir = 'files/resize'; // relative to IMAGES_URL path 
  
  var $imgError = '/img/imgerror.gif'; // relative to IMAGES_URL path 
  
  /** 
   * Automatically resizes an image and returns formatted IMG tag 
   * 
   * @param string $src Path to the image file, relative to the webroot/img/ directory. 
   * @param array    $options Array of Options. 
   * @access public 
   */

  function resize($src, $opt) {
      
    $defaultOptions = array(
      'width' => 100,
      'height' => 100,
      'crop' => true,
      'htmlAttributes' => array(),
      'return' => false,
      'filter' => '',
      'quality' => 90
    );
    $opt = $this->_setDefaults($opt, $defaultOptions);


    $sourceFilename = WWW_ROOT.$src;

    if($opt['crop']){
      $crop_text = "_crop_";
    }else{
      $crop_text = "_";
    }

    $filename_sin_ext = $this->_removeExtension( basename($src) );
    $ext = $this->_getExtension( basename($src) );

    //$cacheFilename = WWW_ROOT . $this->cacheDir . '/' . $opt['width'] . 'x' . $opt['height'] .$crop_text. $filename_sin_ext.".".$ext;
    //$relfile = $this->webroot . $this->cacheDir . '/' . $opt['width'] . 'x' . $opt['height'] .$crop_text. $filename_sin_ext.".".$ext;
    $cacheFilename = WWW_ROOT . $this->cacheDir . '/' . $opt['width'] . 'x' . $opt['height'] .$crop_text. $src;
    $relfile = $this->webroot . $this->cacheDir . '/' . $opt['width'] . 'x' . $opt['height'] .$crop_text. $src;
   
    if(!is_dir(dirname($cacheFilename))){
      mkdir(dirname($cacheFilename), 0775, true);
    }


    if (file_exists($cacheFilename)) {


    }elseif(is_readable($sourceFilename)){
      App::import('Vendor', 'phpThumb', array('file' => "phpthumb".DS."phpthumb.class.php"));
      $phpThumb = new phpThumb(); 
      
      $phpThumb->src = $sourceFilename;
      $phpThumb->setParameter('w', $opt['width']);
      $phpThumb->setParameter('h', $opt['height']);
      $phpThumb->setParameter('f', $ext);
      $phpThumb->setParameter('fltr', $opt['filter']);
      if($opt['crop']){
        $phpThumb->setParameter('zc', "C");
      }
      $phpThumb->setParameter('q', $opt['quality']);
      $phpThumb->config_imagemagick_path = '/usr/bin/convert';
      //$phpThumb->config_prefer_imagemagick = true;
      //$phpThumb->config_output_format = 'png';
      $phpThumb->config_error_die_on_error = true;
      $phpThumb->config_document_root = '';
      $phpThumb->config_temp_directory = APP . 'tmp';

      if ($phpThumb->GenerateThumbnail()) {
        $phpThumb->RenderToFile($cacheFilename);
      } else {
        return $this->imgError;
      }


    } else { // Can't read source
      return $this->imgError;
    }

    //OUTPUT
    return $relfile;
  }

  function _setDefaults($opt, $defaultOptions){
    foreach($defaultOptions as $key => $default){
      if (!isset($opt[$key])) {
        $opt[$key] = $default;
      }
    }
    return $opt;
  }

  function _getExtension( $fileName ){
    $allowedExtensions = array("gif", "jpg", "jpeg", "png");
    $ext =explode('.', $fileName);
    $ext = strtolower( $ext[count($ext)-1] );
    if (in_array($ext, $allowedExtensions)){
      if($ext == 'jpg') $ext = 'jpeg';
      return $ext;
    }else{
      return 'jpeg';
    }
  }
  function _removeExtension( $fileName ){
    $ext =explode('.', $fileName);
    unset($ext[count($ext)-1]);
    return implode('.',$ext);
  }
}
?>