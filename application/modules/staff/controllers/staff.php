<?php
class staff extends Controller{
	public function __construct()
	{
		parent::Controller();
		$this->load->model('regnal/miembro');
		$this->load->model('servicio');
		$this->template->write('sidebar', '<li><a href="'.ruta('staff/nuevo').'"><span class="icon_lateral icon_usuario"></span><u>Nuevo</u> <br /><small>registrar nuevo staff al evento</small></a></li>');
		$this->template->write('sidebar', '<li><a href="'.ruta('staff').'"><span class="icon_lateral icon_buscar"></span><u>Listado</u> <br /><small>consulta de staff registrado</small></a></li>');
	}
	
	public function index()
	{
		$this->servicio->consultar('', 0, 15);
		$config['base_url']   = '#';
        $config['total_rows'] = $this->servicio->total_registros;
        $config['per_page']   = 15;
		$config['cur_page']   = 0; 
		$this->pagination->initialize($config); 

		$this->template->add_js('js/jquery.gritter.min.js');
		$this->template->add_js('js/jquery.ajaxify.min.js');
		$this->template->add_js('js/fancybox/jquery.mousewheel-3.0.2.pack.js');
		$this->template->add_js('js/fancybox/jquery.fancybox-1.3.1.js');
		$this->template->add_js('js/jquery.zebragrid.js');
		$this->template->add_css('temas/registro/css/jquery.gritter.css');
		$this->template->add_css('js/fancybox/jquery.fancybox-1.3.1.css');
		$this->template->add_js('js/jquery.uniform.js');
		$this->template->write_view('content', 'consulta');
		$this->template->render();
	}
	
	public function grid()
	{
		$b = array();
		$c = array();
		$datos = array();
		if($this->input->post('eliminar')){
			$this->servicio->eliminar($this->input->post('Del'));
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
		$this->servicio->consultar($b, $offset, 15, $c, '', '', '');
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
		$this->template->add_js('js/jquery.uniform.js');
		$this->template->add_js('js/jquery.gritter.min.js');
		$this->template->add_css('temas/registro/css/jquery.gritter.css');
		$this->template->write('content', '<h1 class="titulo_seccion">Registro de Nuevo Staff</h1>');
		
		if($_POST)
		{
			$datos['extra'] = '';
			$msg = array();
			$this->form_validation->set_rules('cum', 'CUM', 'trim|required|exact_length[10]|xss_clean');
			$this->form_validation->set_error_delimiters('<span class="error-form">', '</span>');
			if($this->form_validation->run())
			{
				$err = $this->miembro->validar_staff($this->input->post('cum'));
				$arreglo = array('cum' => strtoupper($this->input->post('cum')));				
				if(sizeof($err) == 0)
				{
					$this->servicio->agregar($arreglo);
					$msg['title'] = 'Staff Agregado';
					$msg['text']  = sprintf('El miembro %s ha sido agregado al listado del Staff.', $this->miembro->nombre);
					$msg['image'] = relative_root('img/checkmark_64.png');
					$dialog = jgritter_script($msg);
					$this->session->set_flashdata('extrascript', $dialog);
					redirect('staff');
				}
				else
				{
					$msg['title'] = 'Staff No Válido';
					$msg['text']  = '';
					
					if(array_key_exists('noexiste', $err))
					{
						$msg['text'] .= 'El CUM no se encuentra registrado o no existe. ';
					}
					else
					{					
						if(array_key_exists('membresia', $err))
						{
							$msg['text'] .= 'La membresia se encuentra vencida. ';
						}
						
						if(array_key_exists('nivel', $err))
						{
							$msg['text'] .= 'No tiene el cargo apropiado para ser staff. ';
						}
					}
				}
			}
			else
			{
				$msg['title'] = 'Verificar CUM';
				$msg['text']  = 'La información proporcionada no parece ser válida.';
			}
			
			$msg['image']   = relative_root('img/error_64.png');
			$msg['sticky']  =  TRUE;
			$datos['extra'] = jgritter_script($msg);
			$datos['cum']   = $this->input->post('cum');
		}
		else
		{
		   $datos['cum'] = '';
		   $datos['extra'] = '';
		}
		
		$this->template->write_view('content', 'cum', $datos);
		$this->template->render();	
	}
	
	public function ficha($id)
	{
		$this->template->set_master_template('blank');
		$c = array('cum' => $id);
		$this->miembro->consultar($c, 0, 1);
		$this->template->write('content', '<h1 class="titulo_seccion">'.$this->miembro->nombre.'</h1>');
		$this->template->write_view('content', 'ficha');
		$this->template->render();
	}
}
?>