<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><?php $site_root = relative_root(); ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?php echo $site_root; ?>favicon.ico">
<title>Registro Nacional</title>
<link rel="stylesheet" type="text/css" href="<?php echo $site_root; ?>temas/registro/css/reset.css" media="screen" /> 
<link rel="stylesheet" type="text/css" href="<?php echo $site_root; ?>temas/registro/css/text.css" media="screen" /> 
<link rel="stylesheet" type="text/css" href="<?php echo $site_root; ?>temas/registro/css/grid.css" media="screen" /> 
<link rel="stylesheet" type="text/css" href="<?php echo $site_root; ?>temas/registro/css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo $site_root; ?>temas/registro/css/uniform.css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" href="<?php echo $site_root; ?>temas/registro/css/ie6.css" media="screen" /><![endif]--> 
<!--[if IE 7]><link rel="stylesheet" type="text/css" href="<?php echo $site_root; ?>temas/registro/css/ie.css" media="screen" /><![endif]-->
<script type="text/javascript" src="<?php echo $site_root; ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $site_root; ?>js/jquery.notify.js"></script>
<?php echo $_scripts; ?>

</head>

<body class="login_bg">
 <div id="login_box">
 	<form action="" method="post" enctype="application/x-www-form-urlencoded" name="login" id="login">
    	<label for="usuario">Usuario</label>
        <input type="text" id="usuario" name="usuario" />
        <label for="pass">Contraseña</label>
        <input type="password" id="pass" name="pass" />
        <button type="submit">Iniciar Sesión</button>
    </form>
 </div> 
</body>
</html>