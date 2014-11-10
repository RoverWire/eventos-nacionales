<?php
class Usuario extends MY_Model{
	
	public $usuario;
	public $pass;
	public $nombre;
	public $estado;
	public $tipo;
	
	public function __construct()
	{
		parent::MY_Model();
		$this->tabla['nombre']     = 'usuarios';
		$this->tabla['campoclave'] = 'id';
		$this->tabla['campos']     = array('id', 'usuario', 'pass', 'nombre', 'estado', 'tipo');
	}

	public function logueo($user, $pass)
	{
		$this->numero_registros = 0;
		if( ! empty($user) && ! empty($pass)){
			$this->db->where('usuario', $user);
			$this->db->where('pass', "MD5('$pass')", FALSE);
			$this->db->where('estado', '1');
			$this->resultado = $this->db->get($this->tabla['nombre']);
			$this->asignar_registro();
		}
		
		return $this->numero_registros;
	}
}
?>