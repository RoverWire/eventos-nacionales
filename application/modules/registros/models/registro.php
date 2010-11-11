<?php
class Registro extends MY_Model {
	public $cum;
	public $responsable;
	public $registrado;
	public $idseisena;
	public $pasado_edad;
	
	public function __construct()
	{
		parent::MY_Model();
		$this->tabla['nombre']     = 'participantes';
		$this->tabla['campoclave'] = 'cum';
		$this->tabla['campos']     = array('cum', 'responsable', 'registrado', 'idseisena', 'pasado_edad');
    }
	
	public function detalles($scouter)
	{
		$this->db->select("p.idseisena, p.idcampo, s.nombre AS scouter_nombre, s.grupo AS scouter_grupo, s.provincia AS scouter_provincia, s.cum AS scouter_cum, l.nombre AS lobato_nombre, l.grupo AS lobato_grupo, l.provincia AS lobato_provincia, l.cum AS lobato_cum, YEAR(CURDATE())-YEAR(l.nacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(l.nacimiento,'%m-%d'), 0, -1) AS lobato_edad", FALSE);
		$this->db->from('participantes AS p');
		$this->db->join('regnal AS s', 'p.responsable = s.cum', 'LEFT');
		$this->db->join('regnal AS l', 'p.cum = l.cum');
		$this->db->where('p.responsable', $scouter);
		$this->resultado = $this->db->get();
		return $this->asignar_registro();
	}
	
	public function registrado($cum)
	{
		$this->db->select('responsable');
		$this->db->from('participantes');
		$this->db->where('responsable', $cum);
		$this->db->limit(1);
		$this->resultado = $this->db->get();
		$this->asignar_registro();
		$existe = ($this->numero_registros == 1) ? TRUE:FALSE;
		$this->liberar_resultados();
		return $existe; 
	}
	
	public function asignar_campo($cum, $campo)
	{
		$this->db->where('responsable', $cum);
		return $this->db->update('participantes', array('idcampo' => $campo));
	}
	
	public function asignar_manada($cum, $idseisena)
	{
		$this->db->select('COUNT(cum) AS contador');
		$this->db->from('participantes');
		$this->db->where('responsable', $cum);
		$this->resultado = $this->db->get();
		$this->asignar_registro();
		$total = $this->contador + 1;
		$this->liberar_resultados();
		
		$this->db->select('provincia');
		$this->db->from('regnal');
		$this->db->where('cum', $cum);
		$this->db->limit(1);
		$this->resultado = $this->db->get();
		$this->asignar_registro();
		$provincia = $this->provincia;
		$this->liberar_resultados();
		
		$this->db->trans_start();
		
		$update = array('idseisena' => $idseisena);
		$this->db->where('responsable', $cum);
		$this->db->update('participantes', $update);
		
		$update = array('provincia' => $provincia, 'elementos' => $total, 'scouter' => $cum);
		$this->db->where('idseisena', $idseisena);
		$this->db->update('seisenas', $update);
		
		$this->db->trans_complete();
		
		return $this->db->trans_status();
	}
	
	public function borrar_asignacion($cum)
	{
		$update = array('provincia' => '', 'elementos' => 0, 'scouter' => '');
		$this->db->where('scouter', $cum);
		$this->db->update('seisenas', $update);
	}
	
	public function cambio_scouter($anterior, $nuevo)
	{
		$this->db->select('provincia');
		$this->db->from('regnal');
		$this->db->where('cum', $nuevo);
		$this->resultado = $this->db->get();
		$this->asignar_registro();
		$provincia = $this->provincia;
		$this->liberar_resultados();
		
		$this->db->trans_start();
		
		$update = array('responsable' => $nuevo);
		$this->db->where('responsable', $anterior);
		$this->db->update('participantes', $update);
		
		$update = array('scouter' => $nuevo, 'provincia' => $provincia);
		$this->db->where('scouter', $anterior);
		$this->db->update('seisenas', $update);
		
		$this->db->trans_complete();
			
		return $this->db->trans_status();
	}
	
	public function seisena_nueva($scouter, $elemento)
	{
		if(is_array($elemento) && ! empty($scouter))
		{
			$this->db->select("cum, YEAR(CURDATE())-YEAR(nacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(nacimiento,'%m-%d'), 0, -1) AS edad", FALSE);
			$this->db->from('regnal');
			$this->db->where_in('cum', $elemento);
			$this->resultado = $this->db->get();
			$this->asignar_registro();
			$scouter = strtoupper($scouter);
			
			$this->db->trans_start();
			for($i=0; $i<$this->numero_registros; $i++)
			{
				$pasado = ($this->edad > 10) ? 1:0;
				$insertar = array('cum' => $this->cum, 'responsable' => $scouter, 'idseisena' => 0, 'registrado' => 0, 'pasado_edad' => $pasado);
				$this->db->insert('participantes', $insertar);
				$this->siguiente();
			}
			$this->db->trans_complete();
			
			return $this->db->trans_status();
		}
		else
		{
			return FALSE;
		}
	}
	
	public function grupo_nuevo($scouter, $elemento)
	{
		if(is_array($elemento) && ! empty($scouter))
		{
			$this->db->select("cum");
			$this->db->from('regnal');
			$this->db->where_in('cum', $elemento);
			$this->resultado = $this->db->get();
			$this->asignar_registro();
			$scouter = strtoupper($scouter);
			
			$this->db->trans_start();
			for($i=0; $i<$this->numero_registros; $i++)
			{
				$insertar = array('cum' => $this->cum, 'responsable' => $scouter);
				$this->db->insert('participantes', $insertar);
				$this->siguiente();
			}
			$this->db->trans_complete();
			
			return $this->db->trans_status();
		}
		else
		{
			return FALSE;
		}
	}
	
	public function agregar_lobato($scouter, $elemento)
	{
		$this->db->select("cum, YEAR(CURDATE())-YEAR(nacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(nacimiento,'%m-%d'), 0, -1) AS edad", FALSE);
		$this->db->from('regnal');
		$this->db->where('cum', $elemento);
		$this->resultado = $this->db->get();
		$this->asignar_registro();
		$scouter = strtoupper($scouter);
		$pasado = ($this->edad > 10) ? 1:0;
		$insertar = array('cum' => $this->cum, 'responsable' => $scouter, 'idseisena' => 0, 'registrado' => 0, 'pasado_edad' => $pasado);
		$this->liberar_resultados();
		
		$this->db->select('idseisena, registrado');
		$this->db->from('participantes');
		$this->db->where('responsable', $scouter);
		$this->db->limit(1);
		$this->resultado = $this->db->get();
		$this->asignar_registro();
		
		$insertar['idseisena']  = $this->idseisena;
		$insertar['registrado'] = $this->registrado;
		
		$this->db->insert('participantes', $insertar);
		
		if($this->idseisena > 0)
		{
			$this->liberar_resultados();
			$this->db->select('elementos');
			$this->db->from('seisenas');
			$this->db->where('scouter', $cum);
			$this->db->limit(1);
			$this->resultado = $this->db->get();
			$this->asignar_registro();
			
			$update = array('elementos' => ($this->elementos + 1));
			$this->db->where('scouter', $cum);
			$this->db->update('seisenas', $update);
		}

	}
	
	public function eliminar_lobato($del)
	{
		$this->db->select('idseisena, registrado');
		$this->db->from('participantes');
		$this->db->where_in('cum', $del);
		$this->db->limit(1);
		$this->resultado = $this->db->get();
		$this->asignar_registro();
		
		if($this->idseisena)
		{
			$this->liberar_resultados();
			$this->db->select('elementos');
			$this->db->from('seisenas');
			$this->db->where('scouter', $cum);
			$this->db->limit(1);
			$this->resultado = $this->db->get();
			$this->asignar_registro();
			
			$update = array('elementos' => ($this->elementos - count($id)));
			$this->db->where('scouter', $cum);
			$this->db->update('seisenas', $update);
		}
		
		$this->db->where_in('cum', $del);
		$this->db->delete('participantes');
	}
}
