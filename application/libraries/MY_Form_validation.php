<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
class MY_Form_validation extends CI_Form_validation{
    
    function MY_Form_validation($config = array())
	{
        parent::CI_Form_Validation($config);
        $this->_config_rules = $config;
    }    

    function mysql_date($str)
	{
        $pattern = '/([1-3][0-9]{3,3})-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/i';
        return (preg_match($pattern, $str) === 1) ? TRUE:FALSE;
    }
	
	function scout_vigente($str)
	{
		$CI =& get_instance();
		$CI->db->select('cum');
		$CI->db->from('regnal');
		$CI->db->where('cum', $str);
		$CI->db->where('vigencia >= CURRENT_DATE');
		$CI->db->limit(1);
		$resultado = $CI->db->get();
		$existe = ($resultado->num_rows() > 0) ? TRUE:FALSE;
		$resultado->free_result();
		return $existe;
	}
	
	function pago_evento($str)
	{
		$CI =& get_instance();
		$CI->db->select('cum');
		$CI->db->from('pagos');
		$CI->db->where('cum', $str);
		$CI->db->or_where('cambio', $str);
		$CI->db->limit(1);
		$resultado = $CI->db->get();
		$existe = ($resultado->num_rows() > 0) ? TRUE:FALSE;
		$resultado->free_result();
		return $existe;
	}
	
	function nivel_valido($str)
	{
		$validos = array('SCOUTER', 'DIRIGENTE', 'PADRE SCOUT', 'OFICINA NACIONAL');
		$CI =& get_instance();
		$CI->db->select('cum');
		$CI->db->from('regnal');
		$CI->db->where('cum', $str);
		$CI->db->where_in('nivel', $validos);
		$CI->db->limit(1);
		$resultado = $CI->db->get();
		$existe = ($resultado->num_rows() > 0) ? TRUE:FALSE;
		$resultado->free_result();
		return $existe;
	}
	
	function scouter_registrado($str)
	{
		$CI =& get_instance();
		$CI->db->select('responsable');
		$CI->db->from('participantes');
		$CI->db->where('responsable', $str);
		$CI->db->limit(1);
		$resultado = $CI->db->get();
		$existe = ($resultado->num_rows() > 0) ? FALSE:TRUE;
		$resultado->free_result();
		return $existe;
	}
	
	function lobato_registrado($str)
	{
		$CI =& get_instance();
		$CI->db->select('cum');
		$CI->db->from('participantes');
		$CI->db->where('cum', $str);
		$CI->db->limit(1);
		$resultado = $CI->db->get();
		$existe = ($resultado->num_rows() > 0) ? FALSE:TRUE;
		$resultado->free_result();
		return $existe;
	}
	
	function es_muchacho($str)
	{
		$CI =& get_instance();
		$CI->db->select('cum');
		$CI->db->from('regnal');
		$CI->db->where('cum', $str);
		$CI->db->like('nivel', 'LOBATO');
		$CI->db->or_like('nivel', 'SCOUT ', 'after');
		$CI->db->or_like('nivel', 'CAMINANTE');
		$CI->db->or_like('nivel', 'ROVER');
		$CI->db->limit(1);
		$resultado = $CI->db->get();
		$existe = ($resultado->num_rows() == 1) ? TRUE:FALSE;
		$resultado->free_result();
		return $existe;
	}
	
	function es_lobato($str)
	{
		$CI =& get_instance();
		$CI->db->select('cum');
		$CI->db->from('regnal');
		$CI->db->where('cum', $str);
		$CI->db->like('nivel', 'LOBATO');
		$CI->db->limit(1);
		$resultado = $CI->db->get();
		$existe = ($resultado->num_rows() == 1) ? TRUE:FALSE;
		$resultado->free_result();
		return $existe;
	}
}
