<?php
class campo extends MY_Model {
	public $nombre;
	
	public function __construct()
	{
		parent::MY_Model();
		$this->tabla['nombre']     = 'campos';
		$this->tabla['campoclave'] = 'idcampo';
		$this->tabla['campos']     = array('idcampo', 'nombre');
	}
	
	public function ubicacion($cum)
	{
		$this->db->select('c.idcampo, c.nombre AS nombre_campo, m.idmanada, m.nombre AS nombre_manada, s.idseisena, s.nombre AS nombre_seisena');
		$this->db->from('seisenas AS s');
		$this->db->join('manadas AS m', 's.idmanada=m.idmanada');
		$this->db->join('campos AS c', 'c.idcampo=m.idcampo');
		$this->db->where('s.scouter', $cum);
		$this->resultado = $this->db->get();
		return $this->asignar_registro();
	}
	
	public function ubicacion2($cum)
	{
		$this->db->select('c.idcampo, c.nombre');
		$this->db->from('campos AS c');
		$this->db->join('participantes AS p', 'p.idcampo=c.idcampo');
		$this->db->where('p.responsable', $cum);
		$this->db->limit(1);
		$this->resultado = $this->db->get();
		return $this->asignar_registro();
	}
	
	public function actualizar_ocupacion()
	{
		$this->resultado = $this->db->get('campos');
		$this->asignar_registro();
		$cam = array();
		$total = array();
		for ($i=0; $i < $this->numero_registros; $i++) { 
			$this->db->select('COUNT(cum) AS cum', false);
			$this->db->from('participantes');
			$this->db->where('idcampo', $this->idcampo);
			$resultado = $this->db->get();
			$cam = $resultado->row();
			$total = $cam->cum;
			
			$this->db->select('COUNT(DISTINCT(responsable)) AS cum', false);
			$this->db->from('participantes');
			$this->db->where('idcampo', $this->idcampo);
			$resultado = $this->db->get();
			$cam = $resultado->row();
			$total = $total+ $cam->cum;
			
			$this->db->where('idcampo', $this->idcampo);
			$this->db->update('campos', array('ocupacion' => $total));
			
			$this->siguiente();
		}
	}
}