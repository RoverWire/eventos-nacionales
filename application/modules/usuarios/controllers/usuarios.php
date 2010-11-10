<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class usuarios extends Controller
{
	public function __construct()
	{
		parent::Controller();
		$this->load->model('usuario');
		$this->template->write('sidebar', '<li><a href="'.ruta('usuarios/nuevo').'"><span class="icon_lateral icon_usuario"></span><u>Nuevo</u> <br /><small>agregar nuevo usuario del sistema</small></a></li>');
		$this->template->write('sidebar', '<li><a href="'.ruta('usuarios').'"><span class="icon_lateral icon_buscar"></span><u>Listado</u> <br /><small>consulta de usuarios existentes</small></a></li>');
	}
	
	public function index()
	{
		$this->usuario->consultar('', 0, 15);
		$config['base_url']   = '#';
        $config['total_rows'] = $this->usuario->total_registros;
        $config['per_page']   = 15;
		$config['cur_page']   = 0; 
		$this->pagination->initialize($config);
		
		$this->template->add_js('js/jquery.ajaxify.min.js');
		$this->template->add_js('js/jquery.simplemodal.js');
		$this->template->add_js('js/jquery.zebragrid.js');
		$this->template->add_js('js/jquery.gritter.min.js');
		$this->template->add_css('temas/registro/css/jquery.gritter.css');
		$this->template->write('content', '<h1 class="titulo_seccion">Usuarios</h1>');
		$this->template->write_view('content', 'consulta');
		$this->template->render();
	}
	
	public function grid()
	{
		$b = array();
		$c = array();
		$datos = array();
		if($this->input->post('eliminar')){
			$this->usuario->eliminar($this->input->post('Del'));
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
		$this->usuario->consultar($b, $offset, 15, $c, '', '', '');
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
			$this->form_validation->set_rules('Datos[usuario]', 'Nombre de usuario', 'trim|required|min_length[6]|max_length[30]|xss_clean');
			$this->form_validation->set_rules('Datos[pass]', 'Contraseña', 'trim|required|min_length[8]|max_length[15]|matches[repetir]|md5');
			$this->form_validation->set_rules('repetir', 'Repetir contraseña', 'trim|required|min_length[8]|max_length[15]');
			$this->form_validation->set_rules('Datos[nombre]', 'Nombre', 'trim|required|xss_clean');
			if($this->form_validation->run())
			{
				if($this->usuario->agregar($this->input->post('Datos')))
				{
					$msg['title'] = 'Usuario Agregado';
					$msg['text']  = sprintf('El usuario %s ha sido agregado al listado de usuarios del sistema.', $datos['nombre']);
					$msg['image'] = relative_root('img/checkmark_64.png');
					$dialog = jgritter_script($msg);
					$this->session->set_flashdata('extrascript', $dialog);
					redirect('usuarios');
				}
			}
		}
		else
		{
			$datos = $this->usuario->arreglo_campos();
		}
		$this->template->write('content', '<h1 class="titulo_seccion">Agregar usuario nuevo</h1>');
		$this->template->write_view('content', 'form', $datos);
		$this->template->add_js('/js/jquery.uniform.js');
		$this->template->render();
	}
	
	public function editar($id)
	{
		if($_POST)
		{
			$datos = $this->input->post('Datos');
			$this->form_validation->set_error_delimiters('<span class="error-form">', '</span>');
			$this->form_validation->set_rules('Datos[usuario]', 'Nombre de usuario', 'trim|required|min_length[6]|max_length[30]|xss_clean');
			$this->form_validation->set_rules('Datos[nombre]', 'Nombre', 'trim|required|xss_clean');
			if( ! empty($datos['pass']))
			{
				$this->form_validation->set_rules('Datos[pass]', 'Contraseña', 'trim|required|min_length[8]|max_length[15]|matches[repetir]|md5');
				$this->form_validation->set_rules('repetir', 'Repetir contraseña', 'trim|required|min_length[8]|max_length[15]');
			}
			else
			{
				unset($_POST['Datos']['pass']);
			}
			
			if($this->form_validation->run())
			{
				if($this->usuario->actualizar($id, $this->input->post('Datos')))
				{
					$msg['title'] = 'Usuario Actualizado';
					$msg['text']  = sprintf('El usuario %s ha sido actualizado en el listado de usuarios del sistema.', $datos['nombre']);
					$msg['image'] = relative_root('img/checkmark_64.png');
					$dialog = jgritter_script($msg);
					$this->session->set_flashdata('extrascript', $dialog);
					if($this->session->userdata('ses_idusuario') == $id)
					{
						$this->session->set_userdata('ses_nombre', $_POST['Datos']['nombre']);
					}
					redirect('usuarios');
				}
			}
		}
		else
		{
			$c = array('id' => $id);
			$this->usuario->consultar($c, 0, 1);
			$datos = $this->usuario->datos[0];
		}
		$this->template->write('content', '<h1 class="titulo_seccion">Editar datos de usuario</h1>');
		$this->template->write_view('content', 'form', $datos);
		$this->template->add_js('js/jquery.uniform.js');
		$this->template->render();
	}
	
	public function cuenta()
	{
		$id = $this->session->userdata('ses_idusuario');
		if($_POST)
		{
			$this->form_validation->set_error_delimiters('<span class="error-form">', '</span>');
			$this->form_validation->set_rules('Datos[nombre]', 'Nombre', 'trim|required|xss_clean');
			if( ! empty($datos['pass']))
			{
				$this->form_validation->set_rules('Datos[pass]', 'Contraseña', 'trim|required|min_length[8]|max_length[15]|matches[repetir]|md5');
				$this->form_validation->set_rules('repetir', 'Repetir contraseña', 'trim|required|min_length[8]|max_length[15]');
			}
			else
			{
				unset($_POST['Datos']['pass']);
			}
			
			if($this->form_validation->run())
			{
				if($this->usuario->actualizar($id, $this->input->post('Datos')))
				{
					$msg['title'] = 'Cuenta Actualizada';
					$msg['text']  = sprintf('Los datos de su cuenta han sido actualizados.');
					$msg['image'] = relative_root('img/checkmark_64.png');
					$script = '$(function() { '.jgritter_script($msg).'});';
					$this->template->add_js('js/jquery.gritter.min.js');
		            $this->template->add_css('temas/registro/css/jquery.gritter.css');
					$this->template->add_js($script, 'embed');
					$this->session->set_userdata('ses_nombre', $_POST['Datos']['nombre']);
				}
			}

		}
		
		$c = array('id' => $id);
		$this->usuario->consultar($c);
		$datos = $this->usuario->datos[0];
		$this->template->add_js('js/jquery.uniform.js');
		$this->template->write('content', '<h1 class="titulo_seccion">Información de Cuenta</h1>');
		$this->template->write_view('content', 'cuenta', $datos);
		$this->template->render();
	}
	
	public function login()
	{
		if($this->session->userdata('ses_activo') == 1)
		{
			redirect('usuarios/inicio');
		}
		
		if($_POST)
		{
			if($this->usuario->logueo($this->input->post('usuario', TRUE), $this->input->post('pass')))
			{
				$datos = array(
								   'ses_activo'    => TRUE,
								   'ses_idusuario' => $this->usuario->id,
								   'ses_nombre'    => $this->usuario->nombre,
								   'ses_usuario'   => $this->usuario->usuario,
								   'ses_tipo'      => $this->usuario->tipo
							   );
				$this->session->set_userdata($datos);
				redirect('usuarios/inicio');
			}
			else
			{
				if($this->usuario->numero_registros == 0 && ! empty($_POST['usuario']) && ! empty($_POST['pass']) )
				{
					$mensaje = 'usuario o contraseña incorrectos';
				}
				elseif($this->usuario->numero_registros == 1 && $this->usuario->estado == 0)
				{
					$mensaje = 'la cuenta está suspendida';
				}
				else
				{
					$mensaje = 'por favor proporcione un usuario y contraseña';
				}
				
				$not = array('cls' => 'error', 'html' => $mensaje, 'delay' => 4 );
				$script = '$(function() { '.notify_script($not).'});';
				$this->template->add_js($script, 'embed');
			}
		}
		
		if($this->session->flashdata('extrascript') != '')
		{
			$this->template->add_js($this->session->flashdata('extrascript'), 'embed');
		}
		
		$this->template->set_master_template('login');
		$this->template->render();
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		/*
		$not = array('html' => 'Ha salido del sistema. Inicie sesión para volver a ingresar', 'delay' => 4 );
		$script = '$(function() { '.notify_script($not).'});';
		$this->session->set_flashdata('extrascript', $script);
		$this->session->keep_flashdata('extrascript');
		*/
		redirect();
	}
	
	public function inicio()
	{
		$this->template->write('sidebar', '', TRUE);
		$this->template->write('sidebar', '<li><a href="'.ruta('registros').'"><span class="icon_lateral icon_registro"></span><u>Nueva Seisena</u> <br /><small>agregar nuevas seisenas</small></a></li>');
		$this->template->write('sidebar', '<li><a href="'.ruta('registros/preregistro').'"><span class="icon_lateral icon_buscar"></span><u>Seisena Preregistrada</u> <br /><small>buscar por cum de scouter</small></a></li>');
		$this->template->write('sidebar', '<li><a href="'.ruta('ajustes/editar').'"><span class="icon_lateral icon_credencial"></span><u>Configurar</u> <br /><small>editar parámetros de la herramienta</small></a></li>');
		
		$this->template->write_view('content', 'panel');
		$this->template->render();
	}
	
}