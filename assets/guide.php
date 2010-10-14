<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registro Nacional</title>
<link rel="stylesheet" type="text/css" href="temas/registro/css/reset.css" media="screen" /> 
<link rel="stylesheet" type="text/css" href="temas/registro/css/text.css" media="screen" /> 
<link rel="stylesheet" type="text/css" href="temas/registro/css/grid.css" media="screen" /> 
<link rel="stylesheet" type="text/css" href="temas/registro/css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="temas/registro/css/uniform.css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" href="temas/registro/css/ie6.css" media="screen" /><![endif]--> 
<!--[if IE 7]><link rel="stylesheet" type="text/css" href="temas/registro/css/ie.css" media="screen" /><![endif]-->
</head>

<body class="main_gradient">
<div class="contenedor">
    <div id="header">
        <div id="head_main">
        	<a id="log_out" href="#"><span>Salir</span></a>
            <div id="head_user"><strong>Luis Felipe Pérez</strong><br /><a href="#">configurar cuenta</a></div>
        </div>
        <div id="head_nav">
        	<ul>
            	<li><a href="#">Inicio</a></li>
                <li><a href="#">Registro</a></li>
                <li><a href="#">Staff</a></li>
                <li><a href="#">Campos</a></li>
                <li><a href="#">Membresía</a></li>
                <li><a href="#">Usuarios</a></li>
                <li><a href="#">Configuracion</a></li>
            </ul>
        </div>
    </div>
    <div id="contenido" class="container_16">
    	<div id="sidebar" class="grid_4 alpha">
        	<div class="titulo_lateral">
            	Opciones
            </div>
            <ul class="menu_lateral">
                <li><a href="#"><span class="icon_lateral icon_registro"></span><u>Nueva Seisena</u> <br /><small>registrar seisena nueva</small></a></li>
                <li><a href="#"><span class="icon_lateral icon_credencial"></span><u>Staff</u> <br /><small>registro de scouters y dirigentes</small></a></li>
                <li><a href="#"><span class="icon_lateral icon_grafica"></span><u>Ocupación</u> <br /><small>progreso de los acampados</small></a></li>
                <li><a href="#"><span class="icon_lateral icon_buscar"></span><u>Buscar participante</u> <br /><small>localización en manada y campo</small></a></li>
                <li><a href="#"><span class="icon_lateral icon_imprimir"></span><u>Carta responsiva</u> <br /><small>imprimir carta de responsabilidad</small></a></li>
                <li><a href="#"><span class="icon_lateral icon_llave"></span><u>Contraseña</u> <br /><small>cambiar contraseña</small></a></li>
            </ul>
        </div>
        
        <div class="grid_12">
        	<h1 class="titulo_seccion"><img src="temas/registro/img/icono-inicio.png" width="24" height="21" alt="" /> Inicio</h1>
            <a href="#" class="dash_option"><span class="dash_icon dash_icon_registro"></span>Registros</a>
            <a href="#" class="dash_option"><span class="dash_icon dash_icon_staff"></span> Staff</a>
            <a href="#" class="dash_option"><span class="dash_icon dash_icon_campos"></span> Campos</a>
            <a href="#" class="dash_option"><span class="dash_icon dash_icon_membresia"></span> Membresía</a>
            <a href="#" class="dash_option"><span class="dash_icon dash_icon_usuarios"></span> Usuarios</a>
            <a href="#" class="dash_option"><span class="dash_icon dash_icon_ajustes"></span> Ajustes</a>
            <br class="clear" style="clear:both;"  />
            
            <form class="uniForm" action="" name="">
            	<fieldset class="inlineLabels">
                	<legend>Formulario</legend>
                	<div class="ctrlHolder">
                    	<label for="nombre">Nombre</label>
                        <input name="nombre" id="nombre" value="" size="35" maxlength="50" type="text" />
                        <p class="formHint">This is a form hint.</p>
                    </div>
                    
                    <div class="ctrlHolder error">
                    	<label for="apellido">Apellido</label>
                        <input name="apellido" id="apellido" value="" size="35" maxlength="50" type="text" />
                        <p class="formHint">This is a form hint.</p>
                    </div>
                    
              <div class="ctrlHolder focused">
                    	<label for="observaciones">Observaciones</label>
                  <textarea name="observaciones" cols="50" rows="10" id="observaciones"></textarea>
              <p class="formHint">This is a form hint.</p>
                    </div>
                    
                </fieldset>
            </form>
           
        </div>
        <div class="clearfix">&nbsp;</div>
    </div>
    <div id="footer">
	  <p>Registro de Eventos Nacionales v2.0</p>
      <img src="temas/registro/img/footer_img.png" name="footer_img" width="110" height="40" id="footer_img" alt="" />
	</div>
</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
</body>
</html>