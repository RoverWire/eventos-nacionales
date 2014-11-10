<?php
class seisena extends MY_Model {
	public $idseisena;
	public $idmanada;
	public $idcampo;
	public $provincia;
	public $elementos;
	
	public function __construct()
	{
		parent::MY_Model();
		$this->tabla['nombre'] = 'seisenas';
		$this->tabla['campoclave'] = 'idseisena';
		$this->tabla['campos']	= array('idseisena', 'idmanada', 'idcampo', 'provincia', 'elementos');
	}
}