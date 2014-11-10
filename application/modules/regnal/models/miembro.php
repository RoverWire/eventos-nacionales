<?php
class Miembro extends MY_Model
{
	public $cum;
	public $nombre;
	public $provincia;
	public $localidad;
	public $nivel;
	public $grupo;
	public $vigencia;
	
	public function __construct()
	{
		parent::MY_Model();
		$this->tabla['nombre']     = 'regnal';
		$this->tabla['campoclave'] = 'cum';
		$this->tabla['campos']     = array('cum', 'nombre', 'provincia', 'localidad', 'grupo', 'vigencia', 'nivel');
	}
	
	public function combo_provincias($selected = '')
	{
		$sql = 'SELECT DISTINCT(provincia) FROM '.$this->tabla['nombre'].' ORDER BY provincia ASC';
		$this->ejecutar_query($sql);
		$option = '';
		
		for($i=0; $i<$this->numero_registros; $i++)
		{
			$option .= '<option value="'.$this->provincia.'"';
			$option .= ($selected == $this->provincia) ? ' selected>':'>';
			$option .= $this->provincia.'</option>'."\n";
			$this->siguiente();
		}
		
		return $option;
	}
	
	public function combo_nivel($selected = '')
	{
		$sql = 'SELECT DISTINCT(nivel) FROM '.$this->tabla['nombre'].' ORDER BY nivel ASC';
		$this->ejecutar_query($sql);
		$option = '';
		
		for($i=0; $i<$this->numero_registros; $i++)
		{
			$option .= '<option value="'.$this->nivel.'"';
			$option .= ($selected == $this->nivel) ? ' selected>':'>';
			$option .= $this->nivel.'</option>'."\n";
			$this->siguiente();
		}
		
		return $option;
	}
	
	public function validar_scouter($cum)
	{
		$error = array();
		$sql = "SELECT responsable FROM participantes WHERE responsable='$cum'";
		$this->ejecutar_query($sql);
		if($this->numero_registros == 1)
		{
			$error['registrado'] = 1;
		}
		else
		{
			$sql = "SELECT cum FROM pagos WHERE cum = '$cum' LIMIT 1";
			$this->ejecutar_query($sql);
			if($this->numero_registros == 0)
			{
				$error['pago'] = 1;
			}
			$this->liberar_resultados();
			
			$sql = "SELECT * FROM regnal WHERE cum='$cum' AND vigencia >= CURRENT_DATE AND nivel IN ('SCOUTER', 'DIRIGENTE', 'PADRE SCOUT', 'OFICINA NACIONAL') LIMIT 1";
			$this->ejecutar_query($sql);
			if($this->numero_registros == 0)
			{
				$error['membresia'] = 1;
				$sql = "SELECT * FROM regnal WHERE cum='$cum'";
				$this->ejecutar_query($sql);
				if($this->numero_registros == 0)
				{
					$error['noexiste'] = 1;
				}
			}	
		}
		
		return $error;
	}
	
	public function validar_lobato($cum)
	{
		$error = array();
		$sql = "SELECT cum FROM pagos WHERE cum = '$cum' LIMIT 1";
		$this->ejecutar_query($sql);
		if($this->numero_registros == 0)
		{
			$error['pago'] = 1;
		}
		
		$sql = "SELECT cum FROM regnal WHERE cum='$cum' AND vigencia >= CURRENT_DATE LIMIT 1";
		$this->ejecutar_query($sql);
		if($this->numero_registros == 0)
		{
			$error['membresia'] = 1;
		}
		
		$sql = "SELECT cum, nombre, vigencia, provincia, localidad, grupo, nivel, YEAR(CURDATE())-YEAR(nacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(nacimiento,'%m-%d'), 0, -1) AS edad ";
		$sql.= "FROM regnal WHERE cum = '$cum'";
		if($this->edad > 10)
		{
			$error['edad'] = 1;
		}
		
		return $error;
	}
	
	public function validar_staff($cum)
	{
		$error = array();
		$validos = array('SCOUTER', 'DIRIGENTE', 'PADRE SCOUT', 'OFICINA NACIONAL');
		$sql = "SELECT cum, nivel FROM regnal WHERE cum='$cum' AND vigencia >= CURRENT_DATE LIMIT 1";
		$this->ejecutar_query($sql);
		if($this->numero_registros == 0)
		{
			$error['membresia'] = 1;
			$this->liberar_resultados();
			$sql = "SELECT nombre FROM regnal WHERE cum='$cum' LIMIT 1";
			$this->ejecutar_query($sql);
			if($this->numero_registros == 0)
			{
				$error['noexiste'] = 1;
			}
		}
		else
		{
			if( ! in_array($this->nivel, $validos))
			{
				$error['nivel'] = 1;
			}
		}		
				
		return $error;
	}
}
?>