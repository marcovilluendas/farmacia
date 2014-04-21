<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
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
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));
CakePlugin::loadAll();
/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'Model'                     => array('/path/to/models/', '/next/path/to/models/'),
 *     'Model/Behavior'            => array('/path/to/behaviors/', '/next/path/to/behaviors/'),
 *     'Model/Datasource'          => array('/path/to/datasources/', '/next/path/to/datasources/'),
 *     'Model/Datasource/Database' => array('/path/to/databases/', '/next/path/to/database/'),
 *     'Model/Datasource/Session'  => array('/path/to/sessions/', '/next/path/to/sessions/'),
 *     'Controller'                => array('/path/to/controllers/', '/next/path/to/controllers/'),
 *     'Controller/Component'      => array('/path/to/components/', '/next/path/to/components/'),
 *     'Controller/Component/Auth' => array('/path/to/auths/', '/next/path/to/auths/'),
 *     'Controller/Component/Acl'  => array('/path/to/acls/', '/next/path/to/acls/'),
 *     'View'                      => array('/path/to/views/', '/next/path/to/views/'),
 *     'View/Helper'               => array('/path/to/helpers/', '/next/path/to/helpers/'),
 *     'Console'                   => array('/path/to/consoles/', '/next/path/to/consoles/'),
 *     'Console/Command'           => array('/path/to/commands/', '/next/path/to/commands/'),
 *     'Console/Command/Task'      => array('/path/to/tasks/', '/next/path/to/tasks/'),
 *     'Lib'                       => array('/path/to/libs/', '/next/path/to/libs/'),
 *     'Locale'                    => array('/path/to/locales/', '/next/path/to/locales/'),
 *     'Vendor'                    => array('/path/to/vendors/', '/next/path/to/vendors/'),
 *     'Plugin'                    => array('/path/to/plugins/', '/next/path/to/plugins/'),
 * ));
 *
 */

/**
 * Custom Inflector rules can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */

/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. Make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 *
 * CakePlugin::loadAll(); // Loads all plugins at once
 * CakePlugin::load('DebugKit'); //Loads a single plugin named DebugKit
 *
 */

/**
 * You can attach event listeners to the request lifecycle as Dispatcher Filter. By default CakePHP bundles two filters:
 *
 * - AssetDispatcher filter will serve your asset files (css, images, js, etc) from your themes and plugins
 * - CacheDispatcher filter will read the Cache.check configure variable and try to serve cached content generated from controllers
 *
 * Feel free to remove or add filters as you see fit for your application. A few examples:
 *
 * Configure::write('Dispatcher.filters', array(
 *		'MyCacheFilter', //  will use MyCacheFilter class from the Routing/Filter package in your app.
 *		'MyPlugin.MyFilter', // will use MyFilter class from the Routing/Filter package in MyPlugin plugin.
 * 		array('callable' => $aFunction, 'on' => 'before', 'priority' => 9), // A valid PHP callback type to be called on beforeDispatch
 *		array('callable' => $anotherMethod, 'on' => 'after'), // A valid PHP callback type to be called on afterDispatch
 *
 * ));
 */
Configure::write('Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
	'engine' => 'File',
	'types' => array('notice', 'info', 'debug'),
	'file' => 'debug',
));
CakeLog::config('error', array(
	'engine' => 'File',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
));


/***********************************
 * 			FUNCIONES
 * ********************************/


function formatDate($val){
	if(!$val){return "";}

	$arr = explode('-', substr($val, 0, 10));
// HASTA AQUÍ TODO NORMAL
	$algo= date('d M Y', mktime(0,0,0, $arr[1], $arr[2], $arr[0]));
// en vez de regresar el valor obtenido lo volvemos a descomponer
	$otro_algo= explode(" ", $algo);
// en la posición 1 del arreglo se encuentra el mes en texto.. lo comparamos y cambiamos
	switch($otro_algo[1]){
// las siguientes 3 líneas son las que se repetirán... cabiando solo el respectivo caso.
	   case "Jan":
			$otro_algo[1]="Ene";
			break;
	   case "Apr":
			$otro_algo[1]="Abr";
			break;
		case "Aug":
			$otro_algo[1]="Ago";
			break;
		case "Dec":
			$otro_algo[1]="Dic";
			break;
// Agregar los otros casos, para los otros 11 meses... 
	}
// volvemos a armar la fecha
	$buena= $otro_algo[0]." ".$otro_algo[1]." ".$otro_algo[2];
// y listo... regresamos algo como 06 Abr 2005
	return $buena; 
}
function formatDateSinEspacios($val){
	return ereg_replace( ' ', '-', formatDate($val));
}
function formatDateConHora($val){
	$fecha=formatDate($val);
	$hora=substr($val, 10,6);
	return $fecha." a las ".$hora;
}
function formatDateConHoraConHTML($val){
	$fecha=formatDate($val);
	$hora=substr($val, 10,6);
	return "<strong>".$fecha."</strong> a las <strong>".$hora."</strong>";
}
function getMes($n){
	$mes = array(
		"Enero",
		"Febrero",
		"Marzo",
		"Abril",
		"Mayo",
		"Junio",
		"Julio",
		"Agosto",
		"Septiembre",
		"Octubre",
		"Noviembre",
		"Diciembre"
	);
	return $mes[$n-1];
}


function slug($str){
	$str = strtolower(elimina_acentos(trim($str)));
	$str = preg_replace('/[^a-z0-9-]/', '-', $str);
	$str = preg_replace('/-+/', "-", $str);
	//delete last '-' if exists
	if( substr($str, -1) == '-' ){
		$str = substr($str, 0, -1);
	}
	return $str;
}

function elimina_acentos($texto){
	$texto = ereg_replace("(À|Á|Â|Ã|Ä|Å|à|á|â|ã|ä|å)","a",$texto);
	$texto = ereg_replace("(È|É|Ê|Ë|è|é|ê|ë)","e",$texto);
	$texto = ereg_replace("(Ì|Í|Î|Ï|ì|í|î|ï)","i",$texto);
	$texto = ereg_replace("(Ò|Ó|Ô|Õ|Ö|Ø|ò|ó|ô|õ|ö|ø)","o",$texto);
	$texto = ereg_replace("(Ù|Ú|Û|Ü|ù|ú|û|ü)","u",$texto);
	$texto = ereg_replace("(Ç|ç)","c",$texto);
	$texto = ereg_replace("(Ñ|ñ)","n",$texto);
	$texto = ereg_replace("ÿ","y",$texto);
	return $texto;
}



////////////////////////////////////////////////////////
// Function:         cuttext
// Description: Cuts a string and adds ...

function cortarTexto($value, $length)
{   
	if(is_array($value)) list($string, $match_to) = $value;
	else { $string = $value; $match_to = $value{0}; }

	$match_start = stristr($string, $match_to);
	$match_compute = strlen($string) - strlen($match_start);

	if (strlen($string) > $length)
	{
		if ($match_compute < ($length - strlen($match_to)))
		{
			$pre_string = substr($string, 0, $length);
			$pos_end = strrpos($pre_string, " ");
			if($pos_end === false) $string = $pre_string."...";
			else $string = substr($pre_string, 0, $pos_end)."...";
		}
		else if ($match_compute > (strlen($string) - ($length - strlen($match_to))))
		{
			$pre_string = substr($string, (strlen($string) - ($length - strlen($match_to))));
			$pos_start = strpos($pre_string, " ");
			$string = "...".substr($pre_string, $pos_start);
			if($pos_start === false) $string = "...".$pre_string;
			else $string = "...".substr($pre_string, $pos_start);
		}
		else
		{       
			$pre_string = substr($string, ($match_compute - round(($length / 3))), $length);
			$pos_start = strpos($pre_string, " "); $pos_end = strrpos($pre_string, " ");
			$string = "...".substr($pre_string, $pos_start, $pos_end)."...";
			if($pos_start === false && $pos_end === false) $string = "...".$pre_string."...";
			else $string = "...".substr($pre_string, $pos_start, $pos_end)."...";
		}

		$match_start = stristr($string, $match_to);
		$match_compute = strlen($string) - strlen($match_start);
	}
   
	return $string;
}


function strip_only_tags($str, $tags, $stripContent=false) {
    $content = '';
    if(!is_array($tags)) {
        $tags = (strpos($str, '>') !== false ? explode('>', str_replace('<', '', $tags)) : array($tags));
        if(end($tags) == '') array_pop($tags);
    }
    foreach($tags as $tag) {
        if ($stripContent)
             $content = '(.+</'.$tag.'(>|\s[^>]*>)|)';
         $str = preg_replace('#</?'.$tag.'(>|\s[^>]*>)'.$content.'#is', '', $str);
    }
    return $str;
}

function nl2p($text, $cssClass=''){

	// Return if there are no line breaks.
	if (!strstr($text, "\n")) {
		return $text;
	}

	// Add Optional css class
	if (!empty($cssClass)) {
		$cssClass = ' class="' . $cssClass . '" ';
	}

	// put all text into <p> tags
	$text = '<p' . $cssClass . '>' . $text . '</p>';

	// replace all newline characters with paragraph
	// ending and starting tags
	$text = str_replace("\n", "</p>\n<p" . $cssClass . '>', $text);

	// remove empty paragraph tags & any cariage return characters
	$text = str_replace(array('<p' . $cssClass . '></p>', '<p></p>', "\r"), '', $text);

	return $text;

} // end nl2p



function isAllowedExtension($fileName, $extensions=null) {
	if(!$extensions){
		$allowedExtensions = array("gif", "jpg", "jpeg", "png");
	}else{
		$allowedExtensions  = $extensions;
	}
	$ext =explode('.', $fileName);
	$ext = strtolower( $ext[count($ext)-1] );
	if (in_array($ext, $allowedExtensions)){
		return true;   
	}else{
		return false;
	}
}



function get_IP(){
		if(getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")){
				 $ip = getenv("HTTP_CLIENT_IP");
		}
		   elseif(getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")){
			   $ip = getenv("HTTP_X_FORWARDED_FOR");
		   }
		   elseif(getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")){
			   $ip = getenv("REMOTE_ADDR");
		   }
		   elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")){
 
			   $ip = $_SERVER['REMOTE_ADDR'];
		   }
		   else {
			   $ip = "Unknown";
		   }
		  return $ip;
}
function remote_ip(){
	return get_IP();
}



function removeEmptyTags($html_replace){
	//$pattern = "/<[^\/>]*>([\s]?)*<\/[^>]*>/";
	//return preg_replace($pattern, '', $html_replace);
	$pattern = "/<[^!¦^input¦^br¦^img¦^meta¦^hr¦^\/>]*>([\s]?)*<\/[^>]*>/";
	return preg_replace($pattern, '/<(?!input¦br¦img¦meta¦hr¦\/)[^>]*>\s*<\/[^>]*>/ ', $html_replace);
} 


function make_html_elem($tag, $close=false){
	//check if has id
	if(strpos($tag,'#') !== false) {
		$arr = explode('.', $tag);
		$elem = $arr[0];
		$id = $arr[1];
	}else
	//check if has class
	if(strpos($tag,'.') !== false) {
		$arr = explode('.', $tag);
		$elem = $arr[0];
		$class = $arr[1];
	}else{
		$elem = $tag;
	}

	if( !$close ){
		return '</'.$elem.'>';
	}else{
		if(isset($id)){
			return '<'.$elem.' id="'.$id.'">';
		}elseif(isset($class)){
			return '<'.$elem.' class="'.$class.'">';
		}else{
			return '<'.$elem.'>';
		}
	}
}



function lista_de_tags($tags, $field="title"){
	$lista = "";
	foreach($tags as $tag){
		$lista .= $tag[$field].", ";
	}
	return substr($lista,0,-2);
}


function file_get_contents_curl($url, $curlopt = array()){
	$ch = curl_init();
	$default_curlopt = array(
		CURLOPT_TIMEOUT => 50,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_FOLLOWLOCATION => 1,
		CURLOPT_USERAGENT => "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.13) Gecko/20101203 AlexaToolbar/alxf-1.54 Firefox/3.6.13 GTB7.1"
	);
	$curlopt = array(CURLOPT_URL => $url) + $curlopt + $default_curlopt;
	@curl_setopt_array($ch, $curlopt);
	$response = curl_exec($ch);
	if($response === false)
		trigger_error(curl_error($ch));
	curl_close($ch);
	return $response;
}


function leading_zeros($value, $places){
// Function written by Marcus L. Griswold (vujsa)
// Can be found at http://www.handyphp.com
// Do not remove this header!
	$leading="";
	if(is_numeric($value)){
		for($x = 1; $x <= $places; $x++){
			$ceiling = pow(10, $x);
			if($value < $ceiling){
				$zeros = $places - $x;
				for($y = 1; $y <= $zeros; $y++){
					$leading .= "0";
				}
			$x = $places + 1;
			}
		}
		$output = $leading . $value;
	}
	else{
		$output = $value;
	}
	return $output;
}

function getRef($num){
	return leading_zeros($num, 4);
}

