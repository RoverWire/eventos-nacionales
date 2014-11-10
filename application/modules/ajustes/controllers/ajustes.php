<?php
class ajustes extends Controller {
	public function __construct()
	{
		parent::Controller();
		$this->load->model('ajuste');
		$this->template->write('sidebar', '<li><a href="'.ruta('ajustes/editar').'"><span class="icon_lateral icon_credencial"></span><u>Configurar</u> <br /><small>editar parámetros de la herramienta</small></a></li>');
		$this->template->write('sidebar', '<li><a href="'.ruta('ajustes/generar_campos').'"><span class="icon_lateral icon_buscar"></span><u>Crear Campos</u> <br /><small>crear estructura de campos</small></a></li>');
		/*
		$this->template->write('sidebar', '<li><a href="#"><span class="icon_lateral icon_base"></span><u>Importar REGNAL</u> <br /><small>importar datos de membresía.</small></a></li>');
		$this->template->write('sidebar', '<li><a href="#"><span class="icon_lateral icon_base"></span><u>Importar Pagos</u> <br /><small>importar datos de pagos.</small></a></li>');
		$this->template->write('sidebar', '<li><a href="#"><span class="icon_lateral icon_base"></span><u>Importar Seisenas</u> <br /><small>relación de seisenas con scouter.</small></a></li>');
		*/
	}
	
	public function index()
	{
		$this->ajuste->consultar();
		$datos = $this->ajuste->datos[0];
		$this->template->add_js('js/jquery.gritter.min.js');
		$this->template->add_css('temas/registro/css/jquery.gritter.css');
		$this->template->write('content', '<h1 class="titulo_seccion">Configuración</h1>');
		$this->template->write_view('content', 'detalles', $datos);
		$this->template->render();
	}
	
	public function editar()
	{
		if($_POST)
		{
			$datos = $this->input->post('Datos');
			$this->form_validation->set_error_delimiters('<span class="error-form">', '</span>');
			$this->form_validation->set_rules('Datos[manadas]', 'Manadas', 'trim|required|numeric|max_length[2]|xss_clean');
			$this->form_validation->set_rules('Datos[campos]', 'Campos', 'trim|required|numeric|max_length[2]|xss_clean');
			$this->form_validation->set_rules('Datos[edad_limite]', 'Edad Limite', 'trim|required|numeric|max_length[2]|xss_clean');
			$this->form_validation->set_rules('Datos[nombres_campos]', 'Nombre de Campos', 'trim|required|xss_clean');
			if($this->form_validation->run())
			{
				if($this->ajuste->actualizar('rally', $this->input->post('Datos')))
				{
					$msg['title'] = 'Configuración Actualizada';
					$msg['text']  = sprintf('La configuración ha sido actualizada.');
					$msg['image'] = relative_root('img/checkmark_64.png');
					$dialog = jgritter_script($msg);
					$this->session->set_flashdata('extrascript', $dialog);
					redirect('ajustes');
				}
			}
		}
		else
		{
			$this->ajuste->consultar();
			$datos = $this->ajuste->datos[0];	
		}
		$this->template->add_js('js/jquery.uniform.js');
		$this->template->write('content', '<h1 class="titulo_seccion">Modificar Parámetros</h1>');
		$this->template->write_view('content', 'form', $datos);
		$this->template->render();
	}
	
	public function generar_campos()
	{
		if($_POST){
			$this->ajuste->crear_campos();
			redirect('campos');
		}
		$this->template->write_view('content', 'crear');
		$this->template->render();
	}
}