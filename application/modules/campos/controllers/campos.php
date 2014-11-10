<?php
class campos extends Controller{
	public function __construct()
	{
		parent::Controller();
		$this->load->model('campo');
		$this->load->model('manada');
		$this->load->model('seisena');
		$this->template->write('sidebar', '<li><a href="'.ruta('registros').'"><span class="icon_lateral icon_registro"></span><u>Nuevo Grupo</u> <br /><small>agregar grupo de participantes</small></a></li>');
		$this->template->write('sidebar', '<li><a href="'.ruta('registros/preregistro').'"><span class="icon_lateral icon_buscar"></span><u>Grupo Preregistrado</u> <br /><small>buscar por cum de scouter</small></a></li>');
	}
	
	public function index()
	{
		$this->campo->actualizar_ocupacion();
		$this->campo->consultar();
		$this->template->write_view('content', 'campos');
		$this->template->add_js('assets/js/jquery.zebragrid.js');
		$this->template->render();
	}
	
	public function ver($id)
	{
		#$this->manada->manada_seisenas($id);
		$this->template->add_js('assets/js/jquery.zebragrid.js');
		$this->template->write('content', '<h1 class="titulo_seccion">'.$this->manada->nombre_campo."</h1>");
		#$this->template->write_view('content', 'manadas');
		$this->template->render();
	}
}