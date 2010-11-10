<?php
class manada extends MY_Model {
	public $idmanada;
	public $idcampo;
	public $idseisena;
	public $provincia;
	
	public function __construct()
	{
		parent::MY_Model();
		$this->tabla['nombre']     = 'manadas';
		$this->tabla['campoclave'] = 'idmanada';
		$this->tabla['campos']     = array('idmanada', 'nombre');
	}
	
	public function manada_seisenas($idcampo)
	{
		$this->db->select('c.nombre AS nombre_campo, m.nombre AS nombre_manada, m.idmanada, s.nombre AS nombre_seisena, s.idseisena, s.provincia, s.elementos, s.scouter');
		$this->db->from('campos AS c');
		$this->db->join('manadas AS m', 'm.idcampo=c.idcampo');
		$this->db->join('seisenas AS s', 'm.idmanada=s.idmanada');
		$this->db->where('c.idcampo', $idcampo);
		$this->resultado = $this->db->get();
		$this->asignar_registro();
	}
}