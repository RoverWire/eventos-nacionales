<h1 class="titulo_seccion">Detalles de la Seisena</h1>
<form cform class="uniForm" action="" method="post" enctype="multipart/form-data" name="formCUM" id="formCUM">
  <table class="vgrid" width="100%" cols="2">
    <tr>
      <th width="130" align="right">Nombre Scouter:</th>
      <td><?php echo $this->registro->scouter_nombre; ?></td>
    </tr>
    <tr>
      <th class="odd-th" align="right">CUM</th>
      <td class="odd-row"><?php echo $this->registro->scouter_cum; ?></td>
    </tr>
    <tr>
      <th align="right">Provincia:</th>
      <td><?php echo $this->registro->scouter_provincia; ?></td>
    </tr>
    <tr>
      <th class="odd-th" align="right">Grupo:</th>
      <td class="odd-row"><?php echo $this->registro->scouter_grupo; ?></td>
    </tr>
  </table>
  <h2>Datos de los Elementos</h2>
  
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="grid">
		 <thead>
          <tr>
		    <th width="10%" scope="col">CUM</th>
		    <th width="48%" scope="col">Nombre</th>
		    <th width="32%" scope="col">Provincia</th>
		    <th width="4%" scope="col">Grupo</th>
		    <th width="6%" scope="col">Edad</th>
        </tr>
        </thead>
        <tbody>
        <?php
		for($i=0; $i<$this->registro->numero_registros; $i++){
			$class = ($i%2==0) ? 'alt':'';
		?>
         <tr class="<?php echo $class; ?>">
		    <td align="center"><?php echo $this->registro->lobato_cum; ?></td>
		    <td><?php echo $this->registro->lobato_nombre; ?></td>
		    <td align="center"><?php echo $this->registro->lobato_provincia; ?></td>
		    <td align="center"><?php echo $this->registro->lobato_grupo; ?></td>
		    <td align="center"><?php echo $this->registro->lobato_edad; ?></td>
         </tr>
         <?php
			$this->registro->siguiente();
		}
		 ?>
        </tbody>
	  </table>
      
      <?php
	  	if( ! empty($this->registro->idseisena))
		{
			$this->campo->ubicacion($this->registro->scouter_cum);
	  ?>
      <h2>Acampado Asignado</h2>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="grid">
          <thead>
          <tr>
            <th scope="col">Campo</th>
            <th scope="col">Manada</th>
            <th scope="col">Seisena</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td align="center" width="34%"><?php echo $this->campo->nombre_campo; ?></td>
            <td align="center" width="34%"><?php echo $this->campo->nombre_manada; ?></td>
            <td align="center" width="34%"><?php echo $this->campo->nombre_seisena; ?></td>
          </tr>
          </tbody>
      </table>
     <?php
		}
	 ?>
    <div class="pieBtn">
		<button id="btn_regresar" type="button"><span class="ui-icon ui-icon-arrowthick-1-w"></span> Regresar</button>
	</div>
</form>
<script type="text/javascript">
$(function() {
	$('#btn_regresar').click(function(){
		history.back();
	});
});
</script>