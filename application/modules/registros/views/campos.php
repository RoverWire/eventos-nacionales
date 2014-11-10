<?php
#<a href="<?php echo ruta('campos/ver/'.$this->campo->idcampo);
for($i=0; $i<$this->campo->numero_registros; $i++)
{
?>
<button class="sel_campo" type="button" name="<?php echo $this->campo->idcampo; ?>">Campo <?php echo ($i + 1); ?></button>

<?php
	$this->campo->siguiente();
}
?>
<br />
<br />