<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * My_Model
 *
 * Base CRUD pattern for CodeIgniter with file handler
 *
 * @package	CodeIgniter
 * @license 	Creative Commons Attribution-Share Alike 3.0 Unported
 * @author  	Luis Felipe Perez Puga
 * @version 	1.2.0 (07 Jul 2010)
 */

class MY_Model extends Model{
	
	private   $_nombres_reservados;
	
	protected $alto_maximo_imagen;
	protected $ancho_maximo_imagen;
	protected $alto_maximo_thumbnail;
	protected $ancho_maximo_thumbnail;
	protected $campos_archivos;
	protected $campos_atributos;
	protected $carpeta_imagen;
	protected $carpeta_archivo;
	protected $carpeta_audio;
	protected $carpeta_video;
	protected $conexion;
	protected $eof;
	protected $filas_afectadas   = array();
	protected $posicion;
	protected $resultado;
	protected $tabla             = array();
	protected $variable_archivos = 'Datos';
	
	public    $datos = array();
	public    $id;
	public    $numero_registros;
	public    $total_registros;
	
	public function MY_Model()
	{
		parent::Model();
		$this->load->database();
		$this->_nombres_reservados = array('alto_maximo_imagen', 'ancho_maximo_imagen', 'alto_maximo_thumbnail', 'ancho_maximo_thumbnail',
										   'campos_archivos', 'campos_atributos', 'carpeta_imagen', 'carpeta_archivo', 'carpeta_audio',
										   'carpeta_video', 'conexion', 'eof', 'filas_afectadas', 'posicion', 'resultado', 'tabla',
										   'variable_archivos', 'datos', 'id', 'numero_registros', 'total_registros', '_nombres_reservados');
	}
	
	public function actualizar($clave, $dato, $datos_imagenes = '', $datos_archivos = '')
	{
		if( ! empty($clave) && is_array($dato) && ! empty($dato) )
		{
			$resultado_imagenes = array();
			$resultado_archivos = array();
			if( isset( $_FILES[$this->variable_archivos] ) )
			{
				$campo   = array_keys($_FILES[$this->variable_archivos]['name']);
				$num_campos   = count($campo);
				$S[$this->tabla['campoclave']] = $clave;
				$this->Consultar($S);
				for( $i = 0; $i < $num_campos; $i++ )
				{
					if( ! empty($_FILES[$this->variable_archivos]['name'][$campo[0]]))
					{
						$tipo = explode("/",$_FILES[$this->variable_archivos]['type'][$campo[$i]]);
						$imagenes = '';
						$archivos = '';
						switch( $tipo[0] )
						{
							case "image":
								$imagenes = $this->procesar_imagen($campo[$i], $datos_imagenes[$campo[$i]]);
								$resultado_imagenes = array_merge($resultado_imagenes, $imagenes);
								if($resultado_imagenes[$campo[$i]] != ''){
									suprimir('.'.$this->datos[$this->posicion][$campo[$i]]);
									if($datos_imagenes[$campo[$i]]['thumbnail'])
									{
										suprimir('.'.$this->datos[$this->posicion][$datos_imagenes[$campo[$i]]['thumbnail']]);
									}
								}
								break;
								
							case "audio":
								$archivos = $this->procesar_archivo($campo[$i], 'audio', $datos_archivos[$campo[$i]]);
								$resultado_archivos = array_merge($resultado_archivos, $archivos);
								if($resultado_archivos[$campo[$i]] != '')
								{
									suprimir('.'.$this->datos[$this->posicion][$campo[$i]]);
								}
								break;
								
							case "video":
								$archivos = $this->procesar_archivo($campo[$i], 'video', $datos_archivos[$campo[$i]]);
								$resultado_archivos = array_merge($resultado_archivos, $archivos);
								if( $resultado_archivos[$campo[$i]] != '' )
								{
									suprimir('.'.$this->datos[$this->posicion][$campo[$i]]);
								}
								break;
								
							default:
								$archivos = $this->procesar_archivo($campo[$i], '', $datos_archivos[$campo[$i]]);
								$resultado_archivos = array_merge( $resultado_archivos, $archivos );
								if( $resultado_archivos[$campo[$i]] != '' )
								{
									suprimir('.'.$this->datos[$this->posicion][$campo[$i]]);
								}
						}
					}
				}
			}
			
			$resultado = array_merge($dato, $resultado_imagenes, $resultado_archivos);
			
			$condicion = $this->tabla['campoclave']."='".$clave."'";
			$sql = $this->db->update_string( $this->tabla['nombre'],  $resultado, $condicion );
			return $this->ejecutar_instruccion($sql);
		}
		else
		{
			return FALSE;
		}
	}
	
	public function agregar( $dato, $datos_imagenes = '', $datos_archivos = '' )
	{
		if( is_array($dato) && ! empty($dato) )
		{
			$resultado_imagenes = array();
			$resultado_archivos = array();
			if( isset( $_FILES[$this->variable_archivos] ) )
			{
				$campo   = array_keys($_FILES[$this->variable_archivos]['name']);
				$num_campos   = count($campo);
				for( $i = 0; $i < $num_campos; $i++ )
				{
					if( !empty($_FILES[$this->variable_archivos]['name'][$campo[0]]) )
					{
						$tipo = explode("/",$_FILES[$this->variable_archivos]['type'][$campo[$i]]);
						$imagenes = '';
						$archivos = '';
						switch( $tipo[0] )
						{
							case "image":
								$imagenes = $this->procesar_imagen( $campo[$i], $datos_imagenes[$campo[$i]] );
								$resultado_imagenes = array_merge( $resultado_imagenes, $imagenes );
								break;
							case "audio":
								$archivos = $this->procesar_archivo( $campo[$i], 'audio', $datos_archivos[$campo[$i]] );
								$resultado_archivos = array_merge( $resultado_archivos, $archivos );
								break;
							case "video":
								$archivos = $this->procesar_archivo( $campo[$i], 'video', $datos_archivos[$campo[$i]] );
								$resultado_archivos = array_merge( $resultado_archivos, $archivos );
								break;
							default:
								$archivos = $this->procesar_archivo( $campo[$i], '', $datos_archivos[$campo[$i]] );
								$resultado_archivos = array_merge( $resultado_archivos, $archivos );
						}
					}
				}
			}
			
			$campo = array_keys($dato);
			$tam = count($campo);
			for($i=0; $i<$tam; $i++)
			{
				if(empty($dato[$campo[$i]]))
				{
					unset($dato[$campo[$i]]);
				}
			}
			
			$resultado = array_merge($dato, $resultado_imagenes, $resultado_archivos);
			$sql = $this->db->insert_string($this->tabla['nombre'], $resultado);
			return $this->ejecutar_instruccion($sql);
		}else{
			return false;
		}
	}
	
	public function anterior(){
		if( $this->numero_registros > 0 && $this->posicion > 0 )
		{
			$this->posicion--;
			$this->eof = FALSE;
			$this->preparar_registro();
			$this->datos[$this->posicion] = array_merge($this->datos[$this->posicion], $this->resultado->previous_row('array'));
			$this->datos_en_variables();
		}
	}
	
	public function arreglo_campos(){
		if(isset($this->tabla['campos']))
		{
			$array = array();
			$tamanio = count($this->tabla['campos']);
			for($i=0; $i<$tamanio; $i++){
				$array[$this->tabla['campos'][$i]] = '';
			}
			
			return $array;
		}else{
			return false;
		}
	}

	protected function asignar_registro()
	{
		$this->posicion = 0;
		$this->datos = array();
		$this->numero_registros = $this->resultado->num_rows();
		if($this->numero_registros <= 1)
		{
			$this->eof = TRUE;
		}
		else
		{
			$this->eof = FALSE;
		}
		
		if($this->numero_registros > 0)
		{
			$this->obtener_registro();
			$this->datos_en_variables();
		}
		return $this->numero_registros;
	}
	
	public function combo($valor, $etiqueta, $selecccion = '', $campo_orden = '', $orden = '')
	{
		if( ! empty($valor) && ! empty($etiqueta))
		{
			$this->db->select($valor.', '.$etiqueta);
			$this->db->from($this->tabla['nombre']);
			if( ! empty($campo_orden) && ! empty($orden))
			{
				$this->db->order_by($campo_orden, $orden);
			}
			$resultado = $this->db->get();
			$num_rows  = $resultado->num_rows();
			$opciones  = '';
			$row = $resultado->row_array();
			for($i=0; $i<$num_rows; $i++)
			{
				 $opciones .= '<option value="'.$row[$valor].'"';
				 if($row[$valor]==$selecccion)
				 {
				 	$opciones .= ' selected';
				 }
				 $opciones .= '>'.$row[$etiqueta].'</option>'."\n";
				 $row = $resultado->next_row();
			}
			return $opciones;
		}
		else
		{
			return FALSE;
		}
	}
	
	public function combo_paginacion($tamanio)
	{
		$pag = ceil($this->total_registros/$tamanio);
		$option = '';
		for($i=0; $i<$pag; $i++)
		{
			$cur = ($i+1);
			$option .= '<option value="'.($i*15).'">'.$cur.' / '.$pag.'</option>';
		}
		return $Option;
	}
	
	public function consultar($campo = '', $offset = '', $resultados = '', $criterio = '', $campo_orden = '',  $orden = '')
	{
		$this->db->start_cache();
		$this->db->select('*');
		$this->db->from($this->tabla['nombre']);
		
		if( ! is_array($criterio))
		{
			$criterio = array();
		}
		
		if(is_array($campo))
		{
			$num = sizeof($campo);
			$tag = array_keys($campo);
			for($i=0; $i<$num; $i++)
			{
				if( ! isset($criterio[$i]))
				{
					$criterio[$i] = 'where';
				}
				
				switch($criterio[$i])
				{
					case 'or_where':
						$this->db->or_where($tag[$i], $campo[$i]);
						break;
						
					case 'where_in':
						$this->db->where_in($tag[$i], $campo[$i]);
						break;
						
					case 'or_where_in':
						$this->db->or_where_in($tag[$i], $campo[$i]);
						break;
					
					case 'where_not_in':
						$this->db->where_not_in($tag[$i], $campo[$tag[$i]]);
						break;
					
					case 'or_where_not_in':
						$this->db->or_where_not_in($tag[$i], $campo[$tag[$i]]);
						break;
						
					case 'like':
						$this->db->like($tag[$i], $campo[$tag[$i]]);
						break;
					
					case 'or_like':
						$this->db->or_like($tag[$i], $campo[$tag[$i]]);
						break;
						
					case 'not_like':
						$this->db->not_like($tag[$i], $campo[$tag[$i]]);
						break;
						
					case 'or_not_like':
						$this->db->or_not_like($tag[$i], $campo[$tag[$i]]);
						break;
					
					default:
						$this->db->where($tag[$i], $campo[$tag[$i]]);
				}
			}
		}
		
		if( ! empty($campo_orden) && ! empty($orden))
		{
			$this->db->order_by($campo_orden, $orden);
		}
		
		$this->db->stop_cache();
		
		if(is_int($offset) && is_int($resultados))
		{
			$this->total_registros = $this->db->count_all_results();
			$this->db->limit($resultados, $offset);
		}
		elseif(empty($offset) && is_int($resultados))
		{
			$this->db->limit($resultados);
		}
		
		$this->resultado = $this->db->get();
		$this->db->flush_cache();
		return $this->asignar_registro();
	}
	
	protected function datos_en_variables()
	{
		$num = sizeof($this->datos[$this->posicion]);
		$cam = array_keys($this->datos[$this->posicion]);
		$this->id = $this->datos[$this->posicion][$this->tabla['campoclave']];
		for($i=0; $i<$num; $i++)
		{
			if(isset($this->datos[$this->posicion][$cam[$i]]) && ! in_array($cam[$i], $this->_nombres_reservados))
			{
				$var = $cam[$i];
				$this->$var = $this->datos[$this->posicion][$cam[$i]];
			}
		}
	}
	
	protected function ejecutar_instruccion($sql)
	{
		if( ! empty($sql))
		{
			$this->load->database();
			if(is_array($sql))
			{
				$this->filas_afectadas = array();
				$tam = count($sql);
				$i = 0;
				$resultado = TRUE;
				while ($resultado && $i<$tam)
				{
					$resultado = $this->db->simple_query($sql[$i]);
					$this->filas_afectadas[$i] = $this->db->affected_rows();
					$i++;
				}
			}
			else
			{
				$resultado = $this->db->simple_query($sql);
				$this->filas_afectadas = $this->db->affected_rows();	
			}
			
			if($resultado === FALSE)
			{
				$num  = mysql_errno();
				$text = mysql_error();
				show_error('Error MySQL: <br /> <strong>'.$num.'</strong>: '.$text);
			}
			
			return $resultado;
		}
		else
		{
			return FALSE;
		}
	}
	
	protected function ejecutar_query($sql)
	{
		if( ! empty($sql))
		{
			$this->load->database();
			$this->resultado = $this->db->query($sql);
			return $this->asignar_registro();
		}
	}
	
	public function eliminar($id)
	{
		if( ! empty($id))
		{
			if( ! is_array($id))
			{
				$id = explode(",", $id);
			}
			if(count($this->campos_archivos) > 0){
				$this->db->select(implode(', ', $this->campos_archivos));
				$this->db->from($this->tabla['nombre']);
				$this->db->where_in($this->tabla['campoclave'], $id);
				$this->resultado = $this->db->get();
				$this->asignar_registro();			
				$num = count($this->campos_archivos);
				
				for($i=0; $i<$this->numero_registros; $i++)
				{
					for($j=0; $j<$num; $j++)
					{
						if( ! empty($this->datos[$this->posicion][$this->campos_archivos[$i]]))
						{
							suprimir('.'.$this->datos[$this->posicion][$this->campos_archivos[$i]]);
						}
						$this->siguiente();
					}
				}
				$this->liberar_resultados();
			}
			
			$this->db->where_in($this->tabla['campoclave'], $id);
			$this->db->delete($this->tabla['nombre']);
			return $this->db->affected_rows();
		}
		else
		{
			return FALSE;
		}
	}
	
	public function eliminar_archivo($id, $campo)
	{
		if( ! empty($id) && ! empty($campo) && in_array($campo, $this->campos_archivos))
		{
			$this->db->select($campo);
			$this->db->from($this->tabla['nombre']);
			$this->db->where($this->tabla['campoclave'], $id);
			$this->resultado = $this->db->get();
			$resultado = $this->resultado->result();
			suprimir('.'.$resultado->$campo);
			$this->resultado->free_result();
			
			$data = array($campo => '');
			$this->db->where($this->tabla['campoclave'], $id);
			$this->db->update($this->tabla['nombre'], $data);
			return $this->db->affected_rows();
		}
		else
		{
			return FALSE;
		}
	}
	
	public function fin()
	{
		if($this->numero_registros > 0)
		{
			$this->posicion = $this->numero_registros - 1;
			$this->eof = TRUE;
			$this->preparar_registro();
			$this->datos[$this->posicion] = array_merge($this->datos[$this->posicion], $this->resultado->last_row('array'));
			$this->datos_en_variables();	
		}
	}
	
	public function inicio()
	{
		if($this->numero_registros > 0)
		{
			$this->posicion = 0;
			$this->preparar_registro();
			if($this->numero_registros <= 1)
			{
				$this->eof = TRUE;
			}
			else
			{
				$this->eof = FALSE;
			}
			$this->datos[$this->posicion] = array_merge($this->datos[$this->posicion], $this->resultado->first_row('array'));
			$this->datos_en_variables();
		}
	}
	
	public function liberar_resultados()
	{
		$this->resultado->free_result();
		$this->numero_registros = 0;
		$this->posicion = 0;
		$this->datos = array();
	}
	
	protected function obtener_registro()
	{
		if($this->posicion < $this->numero_registros)
		{
			$this->preparar_registro();
			$this->datos[$this->posicion] = array_merge($this->datos[$this->posicion], $this->resultado->row_array());
		}
	}
	
	protected function preparar_registro()
	{
		if(is_array($this->tabla['campos']))
		{
			$this->datos[$this->posicion] = array();
			$num = sizeof($this->tabla['campos']);
			for($i=0; $i<$num; $i++)
			{
				$this->datos[$this->posicion][$this->tabla['campos'][$i]] = '';
			}
		}
	}
	
	protected function procesar_archivo($campo, $tipo = '', $info_extra = '')
	{
		if($_FILES[$this->variable_archivos]['name'][$campo] != '' && $_FILES[$this->variable_archivos]['name'][$campo] != 'none')
		{
			$procesado = array();
			$ext = strtolower(strrchr ($_FILES[$this->variable_archivos]['name'][$campo],"."));
			
			switch($tipo)
			{
				case 'audio':
					$destino = $this->carpeta_audio.calcular_id().$ext;
					break;
				case 'video':
					$destino = $this->carpeta_video.calcular_id().$ext;
					break;
				default:
					$destino = $this->carpeta_archivo.calcular_id().$ext;
					
			}
			
			if(move_uploaded_file($_FILES[$this->variable_archivos]['tmp_name'][$campo], '.'.$destino))
			{
				chmod('.'.$destino, 0775);
				$procesado[$campo] = $destino;
				if(is_array($info_extra))
				{
					if(array_key_exists('tam_archivo', $info_extra))
					{
						$procesado[$info_extra['tam_archivo']] = filesize('.'.$destino);
					}
					
					if(array_key_exists('mime_type', $info_extra))
					{
						$procesado[$info_extra['mime_type']] = mime_content_type('.'.$destino);
					}
					
					if(array_key_exists('ultima_mod', $info_extra))
					{
						$procesado[$info_extra['ultima_mod']] = filemtime('.'.$destino);
					}					
				}
				
				clearstatcache();
			}
			
			return $procesado;
		}
		else
		{
			return FALSE;	
		}
	}
	
	protected function procesar_imagen($campo, $info_extra = '')
	{
		if($_FILES[$this->variable_archivos]['name'][$campo] != '' && $_FILES[$this->variable_archivos]['name'][$campo] != 'none')
		{
			$procesado = array();
			$nombre    = calcular_id().strtolower(strrchr ($_FILES[$this->variable_archivos]['name'][$campo],"."));
			$destino   = $this->carpeta_imagen.$nombre;
			
			if(move_uploaded_file($_FILES[$this->variable_archivos]['tmp_name'][$campo], '.'.$destino))
			{
				chmod('.'.$destino, 0775);
				$procesado[$campo] = $destino;
				if( ! empty($this->alto_maximo_imagen) && ! empty($this->ancho_maximo_imagen))
				{
					$config['source_image'] = '.'.$destino;
					$config['maintain_ratio'] = TRUE;
					$config['width']  = $this->ancho_maximo_imagen;
					$config['height'] = $this->alto_maximo_imagen;
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
				}
				
				if(is_array($info_extra))
				{
					if(array_key_exists('thumbnail', $info_extra) && ! empty($this->alto_maximo_thumbnail) && ! empty($this->ancho_maximo_thumbnail))
					{
						$config['source_image'] = '.'.$destino;
						$config['new_image'] = '.'.$this->carpeta_imagen.'tn_'.$nombre;
						$config['maintain_ratio'] = TRUE;
						$config['width'] = $this->ancho_maximo_thumbnail;
						$config['height'] = $this->alto_maximo_thumbnail;
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
						
						if(file_exists($config['new_image']))
						{
							$procesado[$info_extra['thumbnail']] = $this->carpeta_imagen.'tn_'.$nombre;
							if(array_key_exists('tam_thumbnail', $info_extra))
							{
								$procesado[$info_extra['tam_thumbnail']] = file_size($config['new_image']);
							}
						}						
					}
					
					if(array_key_exists('tam_archivo', $info_extra))
					{
						$procesado[$info_extra['tam_archivo']] = filesize('.'.$destino);
					}
					
					if(array_key_exists('mime_type', $info_extra))
					{
						$procesado[$info_extra['mime_type']] = mime_content_type('.'.$destino);
					}
					
					if(array_key_exists('ultima_mod', $info_extra))
					{
						$procesado[$info_extra['ultima_mod']] = filemtime('.'.$destino);
					}						
				}
				
				clearstatcache();
			} 

                    return $procesado;
		}
		else
		{
			return FALSE;
		}
	}
	
	public function siguiente()
	{
		if($this->numero_registros > 0 && $this->posicion < ($this->numero_registros-1))
		{
			$this->posicion++;
			$this->preparar_registro();
			$this->datos[$this->posicion] = array_merge($this->datos[$this->posicion], $this->resultado->next_row('array'));
			$this->datos_en_variables();
		}
	}
}

/* End of file MY_Model.php */
/* Location: ./system/application/libraries/MY_Model.php */