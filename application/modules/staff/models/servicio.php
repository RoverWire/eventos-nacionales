<?php
class Servicio extends MY_Model{
	public $cum;
	public $estado;
	
	public function __construct()
	{
		parent::MY_Model();
		$this->tabla['nombre'] = 'staff';
		$this->tabla['campoclave'] = 'cum';
		$this->tabla['campos'] = array('cum', 'estado');
	}
	
	public function consultar($campo = '', $offset = '', $resultados = '', $criterio = '', $campo_orden = '',  $orden = '')
	{
		$this->db->start_cache();
		$this->db->select('*');
		$this->db->from('regnal');
		$this->db->join($this->tabla['nombre'], 'regnal.cum=staff.cum');
		
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
}