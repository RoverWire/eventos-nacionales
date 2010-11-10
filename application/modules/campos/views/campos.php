<h1 class="titulo_seccion">Campos Existentes</h1>

<?php
for($i=0; $i<$this->campo->numero_registros; $i++)
{
?>
<a href="<?php echo ruta('campos/ver/'.$this->campo->idcampo); ?>" class="campo_option"><span class="dash_icon dash_icon_campos"></span><?php echo $this->campo->nombre; ?></a>
<?php
	$this->campo->siguiente();
}
?>