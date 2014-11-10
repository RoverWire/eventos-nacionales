<?php
class Actividad extends MY_Model{

	public $nombre;
	public $tipo;
	public $capacidad;
	public $ocupacion;
	
	public function __construct()
	{
		parent::MY_Model();
		$this->tabla['nombre']     = 'actividades';
		$this->tabla['campoclave'] = 'id';
		$this->tabla['campos']     = array('id', 'nombre', 'tipo', 'capacidad', 'ocupacion');
	}

	public function combo_equipo($value = '')
	{
		$this->db->select('id, nombre')
				 ->from($this->tabla['nombre'])
				 ->where('tipo', 'Equipo')
				 ->where('ocupacion < capacidad');

		$query = $this->db->get();
		$options = '';

		foreach ($query->result() as $row) {
			$options .= '<option value="'.$row->id.'"';
			$options .= ($row->id == $value) ? ' selected>':'>';
			$options .= $row->nombre.'</option>'."\n";
		}

		return $options;

	}

	public function combo_individual($value = '')
	{
		$this->db->select('id, nombre')
				 ->from($this->tabla['nombre'])
				 ->where('tipo', 'Individual')
				 ->where('ocupacion < capacidad');

		$query = $this->db->get();
		$options = '';

		foreach ($query->result() as $row) {
			$options .= '<option value="'.$row->id.'"';
			$options .= ($row->id == $value) ? ' selected>':'>';
			$options .= $row->nombre.'</option>';
		}

		return $options;
	}

	public function sin_grupal($cum, $act = 1)
	{
		$act = ($act == 2) ? $act:1;
		$actividad = 'actividad' . $act;

		$this->db->select('scouter')->from('seisenas')->where($actividad, '')->where('scouter', $cum);
		return $this->db->count_all_results();
	}

	public function sin_actividad($cum)
	{
		$this->db->select("p.idseisena, s.nombre AS scouter_nombre, s.grupo AS scouter_grupo, s.provincia AS scouter_provincia, s.cum AS scouter_cum, l.nombre AS lobato_nombre, l.grupo AS lobato_grupo, l.provincia AS lobato_provincia, l.cum AS lobato_cum, YEAR(CURDATE())-YEAR(l.nacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(l.nacimiento,'%m-%d'), 0, -1) AS lobato_edad", FALSE);
		$this->db->from('participantes AS p');
		$this->db->join('regnal AS s', 'p.responsable = s.cum', 'LEFT');
		$this->db->join('regnal AS l', 'p.cum = l.cum');
		$this->db->where('p.responsable', $cum);
		$this->db->where('p.actividad', '');

		return $this->db->get();
	}

	public function asignar($scouter, $grupal, $individual)
	{
		if(is_array($grupal) && is_array($individual) && !empty($scouter))
		{
			$exito = TRUE;

			if(count($individual) == 0){
				$num_elementos = $this->db->where('responsable', $scouter)->from('participantes')->count_all_results();
			}else{
				$num_elementos = count($individual);
			}

			if (isset($grupal['grupal1'])) {
				$this->db->where("(ocupacion + $num_elementos) <= capacidad")->where('id', $grupal['grupal1'])->from($this->tabla['nombre']);
				$result = $this->db->count_all_results();

				if($result){
					//$this->db->where('scouter', $scouter)->update('seisenas', array('actividad1' => $grupal['grupal1']));
					$this->db->simple_query("UPDATE actividades SET ocupacion=(ocupacion + $num_elementos) WHERE id=".$grupal['grupal1'].";");
					$this->db->simple_query("UPDATE seisenas SET actividad1='".$grupal['grupal1']."' WHERE scouter='$scouter';");
				}else{
					$exito = FALSE;
				}
			}

			if (isset($grupal['grupal2'])) {
				$this->db->where("(ocupacion + $num_elementos) <= capacidad")->where('id', $grupal['grupal2'])->from($this->tabla['nombre']);
				$result = $this->db->count_all_results();

				if($result){
					//$this->db->where('scouter', $scouter)->update('seisenas', array('actividad1' => $grupal['grupal2']));
					$this->db->simple_query("UPDATE actividades SET ocupacion=(ocupacion + $num_elementos) WHERE id=".$grupal['grupal2'].";");
					$this->db->simple_query("UPDATE seisenas SET actividad2='".$grupal['grupal2']."' WHERE scouter='$scouter';");
				}else{
					$exito = FALSE;
				}
			}

			$cum = array_keys($individual);
			for($i=0; $i<count($individual); $i++){
				$act = $individual[$cum[$i]];
				$this->db->where('ocupacion <= capacidad')->where('id', $act)->from($this->tabla['nombre']);
				$result = $this->db->count_all_results();
				if($result){
					$this->db->simple_query("UPDATE participantes SET actividad='$act' WHERE cum='".$cum[$i]."' LIMIT 1;");
					$this->db->simple_query("UPDATE actividades SET ocupacion=ocupacion+1 WHERE id='$act' LIMIT 1");
				}else{
					$exito = FALSE;
				}
			}

			return $exito;
		}
		else
		{
			return FALSE;
		}
	}
}