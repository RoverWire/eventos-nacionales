<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><?php $site_root = relative_root(); ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?php echo $site_root; ?>favicon.ico">
<title>Registro Nacional</title>
<?php echo $header; ?>

<link rel="stylesheet" type="text/css" href="<?php echo $site_root; ?>assets/css/reset.css" media="screen" /> 
<link rel="stylesheet" type="text/css" href="<?php echo $site_root; ?>assets/css/text.css" media="screen" /> 
<link rel="stylesheet" type="text/css" href="<?php echo $site_root; ?>assets/css/grid.css" media="screen" /> 
<link rel="stylesheet" type="text/css" href="<?php echo $site_root; ?>assets/css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo $site_root; ?>assets/css/uniform.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo $site_root; ?>assets/css/jquery-ui.css" media="screen" />
<?php echo $_styles; ?>

<!--[if IE 6]><link rel="stylesheet" type="text/css" href="<?php echo $site_root; ?>assets/css/ie6.css" media="screen" /><![endif]--> 
<!--[if IE 7]><link rel="stylesheet" type="text/css" href="<?php echo $site_root; ?>assets/css/ie.css" media="screen" /><![endif]-->
<script type="text/javascript" src="<?php echo $site_root; ?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $site_root; ?>assets/js/jquery-ui.js"></script>
<?php echo $_scripts; ?>

</head>

<body class="main_gradient">
<div class="contenedor">
    <div id="header">
        <div id="head_main">
        	<a id="log_out" href="<?php echo ruta('usuarios/logout'); ?>"><span>Salir</span></a>
            <div id="head_user"><strong><?php echo $this->session->userdata('ses_nombre'); ?></strong><br /><a href="<?php echo ruta('usuarios/cuenta'); ?>">configurar cuenta</a></div>
        </div>
        <div id="head_nav">
        	<ul>
            	<li><a href="<?php echo ruta('usuarios/inicio'); ?>">Inicio</a></li>
                <li><a href="<?php echo ruta('registros'); ?>">Registro</a></li>
                <li><a href="<?php echo ruta('staff'); ?>">Staff</a></li>
                <li><a href="<?php echo ruta('campos'); ?>">Campos</a></li>
                <li><a href="<?php echo ruta('regnal'); ?>">Membresía</a></li>
                <li><a href="<?php echo ruta('usuarios'); ?>">Usuarios</a></li>
                <li><a href="<?php echo ruta('actividades'); ?>">Actividades</a></li>
            </ul>
        </div>
    </div>
    <div id="contenido" class="container_16">
    	<div id="sidebar" class="grid_4 alpha">
        	<div class="titulo_lateral">
            	Opciones
            </div>
            <ul class="menu_lateral">
            <?php echo $sidebar; ?>
            </ul>       		
        </div>
        
        <div class="grid_12">
        	<?php echo $content; ?>
        </div>
        <div class="clearfix">&nbsp;</div>
    </div>
    <div id="footer">
	  <p>Registro de Eventos Nacionales v2.0</p>
      <img src="<?php echo $site_root; ?>assets/img/footer_img.png" name="footer_img" width="110" height="40" id="footer_img" alt="" />
	</div>
</div>
</body>
</html>