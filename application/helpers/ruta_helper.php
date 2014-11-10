<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Alternative Routing Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Luis Felipe Perez Puga
 * @link		
 */
 
// ------------------------------------------------------------------------

/**
 * Ruta
 *
 * Crea una ruta absoluta con respecto a la raiz del
 * dominio, recibiendo como parámetro un arreglo o cadena.
 *
 * @access	public
 * @param	string
 * @return	string
 */
 
if( !function_exists('ruta') ){
	
	function ruta( $url = '' ){
		if(is_array($url)){
			$url = implode('/', $url);
		}
		$CI =& get_instance();
		return $CI->config->item('relative_path').$CI->config->item('index_page').'/'.$url;
	}
	
}

// ------------------------------------------------------------------------

/**
 * Site URL
 *
 * Create a local URL based on your basepath. Segments can be passed via the
 * first parameter either as a string or an array.
 *
 * @access	public
 * @param	string
 * @return	string
 */
 
if( ! function_exists('anchor2') ){

	function anchor2($url, $titulo, $atrib = ''){
		$titulo = (string) $titulo;
		if( is_array($url) ){
			$url = implode('/', $url);
		}
		if( $atrib != '' ){
			$atrib = _parse_attributes($atrib);
		}
		$url = relative_root($url);
		return '<a href="'.$url.'"'.$atrib.'>'.$titulo.'</a>';
	}

}

// ------------------------------------------------------------------------

if( ! function_exists('rel_root'))
{
	function relative_root($param = '')
	{
		if(is_array($param))
		{
			$param = implode('/', $param);
		}
		$CI =& get_instance();
		return $CI->config->item('relative_path').'/'.$param;
	}
}
?>