<?php
class regnal extends Controller
{
	public function __construct()
	{
		parent::Controller();
		$this->load->model('miembro');
		$this->template->write('sidebar', '<li><a href="'.ruta('regnal/nuevo').'"><span class="icon_lateral icon_credencial"></span><u>Nuevo</u> <br /><small>agregar nuevo miembro al regnal</small></a></li>');
		$this->template->write('sidebar', '<li><a href="'.ruta('regnal').'"><span class="icon_lateral icon_buscar"></span><u>Listado</u> <br /><small>consulta de miembros existentes</small></a></li>');
	}
	
	public function index()
	{
		
		$this->miembro->consultar('', 0, 15);
		$config['base_url']   = '#';
        $config['total_rows'] = $this->miembro->total_registros;
        $config['per_page']   = 15;
		$config['cur_page']   = 0; 
		$this->pagination->initialize($config); 

		$this->template->add_js('js/jquery.gritter.min.js');
		$this->template->add_js('js/jquery.ajaxify.min.js');
		$this->template->add_js('js/jquery.simplemodal.js');
		$this->template->add_js('js/fancybox/jquery.mousewheel-3.0.2.pack.js');
		$this->template->add_js('js/fancybox/jquery.fancybox-1.3.1.js');
		$this->template->add_js('js/jquery.zebragrid.js');
		$this->template->add_css('temas/registro/css/jquery.gritter.css');
		$this->template->add_css('js/fancybox/jquery.fancybox-1.3.1.css');
		$this->template->write_view('content', 'consulta');
		$this->template->render();
	}
	
	public function grid()
	{
		$b = array();
		$c = array();
		$datos = array();
		if($this->input->post('eliminar')){
			$this->miembro->eliminar($this->input->post('Del'));
		}
		
		if($this->input->post('offset') != ''){
			$offset = (int)trim($this->input->post('offset'));
		}else{
			$offset = 0;
		}
		
		if($this->input->post('buscar')){
			$b[$this->input->post('campo')] = $this->input->post('buscar');
			$c[0] = $this->input->post('criterio');
		}
		$datos['offset'] = $offset;
		$this->miembro->consultar($b, $offset, 15, $c, '', '', '');
		$this->load->view('grid', $datos);
	}
	
	public function grid_pagination($offset = 0, $total = 0)
	{
		$config['base_url']   = '#';
        $config['total_rows'] = $total;
        $config['per_page']   = 15;
		$config['cur_page']   = $offset; 
		$this->pagination->initialize($config);
		echo $this->pagination->create_links();
	}
	
	public function nuevo()
	{
		if($_POST)
		{
			$datos = $this->input->post('Datos');
			$this->form_validation->set_error_delimiters('<span class="error-form">', '</span>');
			$this->form_validation->set_rules('Datos[nombre]', 'Nombre completo', 'trim|required|max_length[255]|xss_clean');
			$this->form_validation->set_rules('Datos[provincia]', 'Provincia', 'trim|required|max_length[255]|xss_clean');
			$this->form_validation->set_rules('Datos[nivel]', 'Nivel', 'trim|required|max_length[255]|xss_clean');
			$this->form_validation->set_rules('Datos[localidad]', 'Localidad', 'trim|required|max_length[255]|xss_clean');
			$this->form_validation->set_rules('Datos[grupo]', 'Grupo', 'trim|required|numeric|max_length[3]|xss_clean');
			$this->form_validation->set_rules('Datos[cum]', 'CUM', 'trim|required|exact_length[10]|xss_clean');
			$this->form_validation->set_rules('Datos[vigencia]', 'Vigencia', 'trim|required|exact_length[10]|xss_clean');
			if($this->form_validation->run())
			{
				if($this->miembro->agregar($this->input->post('Datos')))
				{
					$msg['title'] = 'Miembro Agregado';
					$msg['text']  = sprintf('El miembro %s ha sido agregado al listado del REGNAL.', $datos['nombre']);
					$msg['image'] = relative_root('img/checkmark_64.png');
					$dialog = jgritter_script($msg);
					$this->session->set_flashdata('extrascript', $dialog);
					redirect('regnal');
				}
			}
		}
		else
		{
			$datos = $this->miembro->arreglo_campos();
		}
		
		$datos['provincia'] = $this->miembro->combo_provincias($datos['provincia']);
		$datos['nivel'] = $this->miembro->combo_nivel($datos['nivel']);
		$this->template->add_js('js/jquery.uniform.js');
		$this->template->write('content', '<h1 class="titulo_seccion">Nuevo Miembro</h1>');
		$this->template->write_view('content', 'form', $datos);
		$this->template->render();
	}
	
	public function editar($id)
	{
		if($_POST)
		{
			$datos = $this->input->post('Datos');
			$this->form_validation->set_error_delimiters('<span class="error-form">', '</span>');
			$this->form_validation->set_rules('Datos[nombre]', 'Nombre completo', 'trim|required|max_length[255]|xss_clean');
			$this->form_validation->set_rules('Datos[provincia]', 'Provincia', 'trim|required|max_length[255]|xss_clean');
			$this->form_validation->set_rules('Datos[nivel]', 'Nivel', 'trim|required|max_length[255]|xss_clean');
			$this->form_validation->set_rules('Datos[localidad]', 'Localidad', 'trim|required|max_length[255]|xss_clean');
			$this->form_validation->set_rules('Datos[grupo]', 'Grupo', 'trim|required|numeric|max_length[3]|xss_clean');
			$this->form_validation->set_rules('Datos[cum]', 'CUM', 'trim|required|exact_length[10]|xss_clean');
			$this->form_validation->set_rules('Datos[vigencia]', 'Vigencia', 'trim|required|exact_length[10]|xss_clean');
			if($this->form_validation->run())
			{
				if($this->miembro->actualizar($id, $this->input->post('Datos')))
				{
					$msg['title'] = 'Miembro Actualizado';
					$msg['text']  = sprintf('El miembro %s ha sido actualizado en el listado del REGNAL.', $datos['nombre']);
					$msg['image'] = relative_root('img/checkmark_64.png');
					$dialog = jgritter_script($msg);
					$this->session->set_flashdata('extrascript', $dialog);
					redirect('regnal');
				}
			}
		}
		else
		{
			$c = array('cum' => $id);
			$this->miembro->consultar($c, 0, 1);
			$datos = $this->miembro->datos[0];
		}
		
		$datos['provincia'] = $this->miembro->combo_provincias($datos['provincia']);
		$datos['nivel'] = $this->miembro->combo_nivel($datos['nivel']);
		$this->template->add_js('js/jquery.uniform.js');
		$this->template->write('content', '<h1 class="titulo_seccion">Modificar Miembro</h1>');
		$this->template->write_view('content', 'form', $datos);
		$this->template->render();
	}
	
	public function ficha($id)
	{
		$c = array('cum' => $id);
		$this->miembro->consultar($c, 0, 1);
		$this->template->set_master_template('blank');
		$this->template->write('content', '<h1 class="titulo_seccion">'.$this->miembro->nombre.'</h1>');
		$this->template->write_view('content', 'ficha');
		$this->template->render();
	}
}
?>