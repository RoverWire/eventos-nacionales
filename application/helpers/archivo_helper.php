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

if( ! function_exists('calcular_id') ){
	
	function calcular_id(){
		return date("Ymds"). sprintf("%02d", rand(0,99));
	}
	
}

if( ! function_exists('subir') ){
	
	function subir($Fuente, $Ruta){
		set_time_limit(300);
		if(($Fuente <> "none")&&($Fuente <> "")){
			if($error1 <> 1){
				$Dest = $Ruta;
				$EstaArchivo = file_exists($Dest);
				clearstatcache();
				if ($EstaArchivo == FALSE){
					if(copy($Fuente,$Dest)){
						$Respuesta = 1;
					}else{
						$Respuesta = 0;
						$error1 = 1;
					}
				}else{
					$Respuesta = -1;
				}
				unlink($Fuente);
			}
		}
		return $Respuesta;
	}
	
}

if( ! function_exists('suprimir') ){

	function suprimir($file) {
		if(file_exists($file)){
			return unlink($file);
		}else{
			return false;
		}
	}

}

if( ! function_exists('tamanio_archivo') ){

	function tamanio_archivo($filesize){
		$array = array(
		'YB' => 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024,
		'ZB' => 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024,
		'EB' => 1024 * 1024 * 1024 * 1024 * 1024 * 1024,
		'PB' => 1024 * 1024 * 1024 * 1024 * 1024,
		'TB' => 1024 * 1024 * 1024 * 1024,
		'GB' => 1024 * 1024 * 1024,
		'MB' => 1024 * 1024,
		'KB' => 1024,
		);
		if($filesize <= 1024){
			$filesize = $filesize . ' Bytes';
		}
		foreach($array AS $name => $size){
			if($filesize > $size || $filesize == $size){
				$filesize = round((round($filesize / $size * 100) / 100), 2) . ' ' . $name;
			}
		}
		return $filesize;
	}

}
?>