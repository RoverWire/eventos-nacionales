<form action="" method="post" enctype="application/x-www-form-urlencoded" id="Form" class="ajaxify">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="grid" id="DataGrid" cols="4">
        <thead>
            <tr>
              <th width="2%" scope="col">&nbsp;</th>
                <th width="50%" scope="col">Nombre</th>
                <th width="48%" scope="col">Ocupacion</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>
        </tfoot>
        <tbody id="GridResults">
        <?php

		for($i=0; $i<$this->campo->numero_registros; $i++){
        ?>
            <tr>
                <td><input type="radio" name="Campo" id="Campo<?php echo $this->campo->id; ?>" value="<?php echo $this->campo->id; ?>" /></td>
                <td><label for="Campo<?php echo $this->campo->id; ?>"><?php echo $this->campo->nombre; ?></label></td>
                <td><?php echo $this->campo->ocupacion; ?></td>
            </tr>
        <?php
            $this->campo->siguiente();
        }
		
		if($this->campo->numero_registros == 0){
		?>
        	<tr>
            	<td colspan="5" align="center">No se encontraron resultados registrados</td>
            </tr>
		<?php
		}
        ?>
        </tbody>
    </table>
<div class="pieBtn">
  <button id="btn_asignar" type="submit"><span class="ui-icon ui-icon-check"></span> Asignar Campo</button>
  <button id="btn_regresar" type="button"><span class="ui-icon ui-icon-arrowthick-1-w"></span> Regresar</button>
</div>
</form>
<script type="text/javascript">
$(function() {
	$('#DataGrid').ZebraGrid();
	$('#btn_regresar').click(function(){
		window.location = '<?php echo ruta('registros'); ?>';
	});
});
</script>

