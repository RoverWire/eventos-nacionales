<?php
class ajuste extends MY_Model {
	
	private $_tabla_regnal          = 'regnal';
	private $_tabla_campos          = 'campos';
	private $_tabla_manadas         = 'manadas';
	private $_tabla_seisenas        = 'seisenas';
	private $_tabla_pagos           = 'pagos';
	private $_tabla_participantes   = 'participantes';
	
	public $actualizacion;
	public $campos;
	public $manadas;
	public $edad_limite;
	public $nombres_campos;
	public $idmanada;
	
	public function __construct()
	{
		parent::MY_Model();
		$this->tabla['nombre']     = 'configuracion';
		$this->tabla['campoclave'] = 'actualizacion';
		$this->tabla['campos']     = array('actualizacion', 'campos', 'manadas', 'seisenas', 'edad_limite');
	}
	
	public function limpiar_tablas()
	{
		$this->db->trans_start();
		$data  = array('idseisena' => '0');
		$this->db->update($this->_tabla_participantes, $data);
		$this->db->truncate($this->_tabla_seisenas);		
		$this->db->truncate($this->_tabla_manadas);
		$this->db->truncate($this->_tabla_campos);
		$this->db->trans_complete();
	}
	
	public function crear_campos()
	{
		$this->consultar();
		$manadas  = $this->manadas;
		$campos   = $this->campos;
		$nombres  = explode(',', $this->nombres_campos);
		$seisenas = array('Amarilla', 'Blanca', 'Cafe', 'Gris', 'Negra', 'Roja');
		$this->limpiar_tablas();
		
		$this->db->trans_start();
		for($i=0; $i<$campos; $i++)
		{
			$this->db->set('nombre', $nombres[$i]);
			$this->db->insert($this->_tabla_campos);
			for($j=0; $j<$manadas; $j++)
			{
				$this->db->set('idcampo', ($i+1));
				$this->db->set('nombre', 'Manada '.($j+1));
				$this->db->insert($this->_tabla_manadas);
			}
		}
		$this->db->trans_complete();
		
		$this->db->select('idmanada');
		$this->db->from($this->_tabla_manadas);
		$this->resultado = $this->db->get();
		$this->asignar_registro();
		
		$this->db->trans_start();
		for($i=0; $i<$this->numero_registros; $i++)
		{
			for($j=0; $j<6; $j++){
				$this->db->set('nombre', $seisenas[$j]);
				$this->db->set('idmanada', $this->idmanada);
				$this->db->insert($this->_tabla_seisenas);
			}
			$this->siguiente();
		}
		$this->db->trans_complete();
	}
}