<form cform class="uniForm" action="" method="post" enctype="multipart/form-data" name="formCUM" id="formCUM">
<div class="ctrlHolder">
	    	<label for="cum">Agregar Lobato</label>
			<span class="inputHolder">
	        	<input name="cum" id="cum" value="" size="10" maxlength="10" type="text" />
	        	<p class="formHint">proporcionar cum del lobato.</p>
			</span>
            <button id="btn_scouter" type="submit"><span class="ui-icon ui-icon-check"></span> Validar</button>
			<?php echo form_error('cum'); ?>
	    </div>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="grid">
		 <thead>
          <tr>
            <th width="2%" scope="col">&nbsp;</th>
		    <th width="10%" scope="col">CUM</th>
		    <th width="48%" scope="col">Nombre</th>
		    <th width="29%" scope="col">Provincia</th>
		    <th width="4%" scope="col">Grupo</th>
		    <th width="7%" scope="col">Edad</th>
        </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="6">
					<button id="btn_eliminar" class="btn_verde" type="button"><span class="ui-icon ui-icon-trash"></span> Eliminar Seleccionados</button>					
	                <input type="hidden" name="eliminar" id="eliminar" value="" />
                </td>
            </tr>
        </tfoot>
        <tbody>
        <?php
		for($i=0; $i<$this->registro->numero_registros; $i++){
		?>
         <tr>
           <td align="center"><input type="checkbox" name="Del[]" id="Del<?php echo $this->registro->lobato_cum; ?>" value="<?php echo $this->registro->lobato_cum; ?>" /></td>
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
      
 <div class="pieBtn">
		<button id="btn_cancelar" type="button"><span class="ui-icon ui-icon-arrowthick-1-w"></span> Regresar</button> 
	</div>
</form>

<div id="modal">
    ¿Desea eliminar el o los elementos seleccionados?
</div>
<script type="text/javascript">
$(function() {
	$('table.grid').ZebraGrid();
	
	$('#btn_cancelar').click(function(){
		window.location = '<?php echo ruta('registros/paso2/'.$this->registro->scouter_cum); ?>';
	});
	
	$('#btn_eliminar').click(function(){
		$('#modal').dialog('open');		
	});
	
	$('#modal').dialog({
		bgiframe: true,
		autoOpen: false,
		width: 350,
		modal: true,
		draggable: false,
		resizable: false,
		title: 'Eliminar Lobatos',
		buttons: {
			'Cancelar':function(){
				$(this).dialog('close');
				$('#eliminar').val('');
			},
			
			'Eliminar':function(){
				$('#eliminar').val('1');
				$(this).dialog('close');
				$('#formCUM').submit();
			}
		}
    });

});
</script>