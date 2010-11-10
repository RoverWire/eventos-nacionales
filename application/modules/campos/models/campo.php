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
}