<form cform class="uniForm" action="" method="post" enctype="multipart/form-data" name="formCUM" id="formCUM">
<div id="campo">
	<?php
	for($i=0; $i<$this->manada->numero_registros; $i++)
	{
	?>
	<h3><a href="#"><?php echo $this->manada->nombre_manada; ?></a></h3>
	<div>
	  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="grid">
		 <thead>
          <tr>
            <th width="3%" scope="col">&nbsp;</th>
		    <th width="37%" scope="col">Seisena</th>
		    <th width="52%" scope="col">Provincia</th>
		    <th width="8%" scope="col">Elementos</th>
	       </tr>
        </thead>
        <tbody>
        <?php
			$actual = $this->manada->idmanada;
			$class = TRUE;
			while($actual == $this->manada->idmanada && $i<$this->manada->numero_registros)
			{
		?>
		  <tr>
		    <td align="center"><?php if($this->manada->elementos == 0){ ?><input type="radio" name="asignado" id="asignado<?php echo $this->manada->idseisena; ?>" value="<?php echo $this->manada->idseisena; ?>" /><?php }else{ echo '&nbsp;'; } ?> </td>
		    <td align="center"><label for="asignado<?php echo $this->manada->idseisena; ?>"><?php echo $this->manada->nombre_seisena; ?></label></td>
		    <td><?php echo ($this->manada->elementos) ? $this->manada->provincia:'Disponible'; ?></td>
		    <td align="center"><?php echo $this->manada->elementos; ?></td>
	      </tr>
       	  <?php
				$i++;
				$this->manada->siguiente();
			}
			$this->manada->anterior();
			$i--;
			?>	
        </tbody>
	  </table>
</div>
	<?php
		$this->manada->siguiente();
	}
	?>
</div>
<div class="pieBtn">
	<button type="submit"><span class="ui-icon ui-icon-disk"></span> Guardar</button>
	<button id="btn_cancelar" type="button"><span class="ui-icon ui-icon-arrowthick-1-w"></span> Regresar</button> 
</div>
</form>
<script type="text/javascript">
$(function() {
	$('#campo').accordion();
	$('table.grid').ZebraGrid();
	$('button.sel_campo').click(function(){
		window.location = '<?php echo ruta('registros/paso3/'.$cum); ?>' + '/' + $(this).attr('name');
	});
});
</script>