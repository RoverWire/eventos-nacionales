<h1 class="titulo_seccion">Staff Registrado</h1>
<form action="" method="post" enctype="application/x-www-form-urlencoded" id="Form" class="ajaxify">
		<strong>Filtrar:</strong>
		<select name="campo" id="campo">
			<option value="nombre">Nombre</option>
			<option value="cum">CUM</option>
            <option value="nivel">Nivel</option>
		</select>
		<select name="criterio" id="criterio">
        	<option value="like">Contiene</option>
			<option value="where">Igual</option>
		</select>
		<input type="text" name="buscar" id="buscar" size="22" value="" />

	<button id="btn_consulta" class="btn_verde" type="submit"><span class="ui-icon ui-icon-search"></span> Buscar</button>
    <button id="btn_all" class="btn_verde" type="button"><span class="ui-icon ui-icon-info"></span> Mostrar Todos</button>

    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="grid" id="DataGrid" cols="4">
        <thead>
            <tr>
              <th width="3%" scope="col">&nbsp;</th>
                <th width="12%" scope="col">CUM</th>
                <th width="46%" scope="col">Nombre</th>
                <th width="29%" scope="col">Provincia</th>
                <th width="5%" scope="col">Grupo</th>
                <th width="5%" scope="col">Ficha</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="6">
					<button id="btn_eliminar" class="btn_verde" type="button"><span class="ui-icon ui-icon-trash"></span> Eliminar Seleccionados</button>
					<input type="hidden" name="total" id="total" value="<?php echo $this->miembro->total_registros; ?>" />
					<input type="hidden" name="offset" id="offset" value="" />
                    <input type="hidden" name="ordenar" id="ordenar" value="" />
					<input type="hidden" name="orden" id="orden" value="" />
	                <input type="hidden" name="eliminar" id="eliminar" value="" />
                </td>
            </tr>
        </tfoot>
        <tbody id="GridResults">
        <?php
		$site_root = relative_root();
		$site_base = ruta();
		for($i=0; $i<$this->servicio->numero_registros; $i++){
        ?>
            <tr>
                <td><input type="checkbox" name="Del[]" id="Del<?php echo $this->servicio->id; ?>" value="<?php echo $this->servicio->id; ?>" /></td>
                <td><?php echo $this->servicio->cum; ?></td>
                <td><?php echo $this->servicio->nombre; ?></td>
                <td><?php echo $this->servicio->provincia; ?></td>
              <td align="center"><?php echo $this->servicio->grupo; ?></td>
                <td align="center"><a class="fancybox" href="<?php echo $site_base, 'staff/ficha/', $this->servicio->id; ?>"><img src="<?php echo $site_root, 'assets/img/onebit_39.png'; ?>" alt="Ficha" title="Ficha" width="16" height="16" border="0" align="absbottom" /></a></td>
            </tr>
        <?php
            $this->servicio->siguiente();
        }
		
		if($this->servicio->numero_registros == 0){
		?>
        	<tr>
            	<td colspan="6" align="center">No se encontraron resultados registrados</td>
            </tr>
		<?php
		}
        ?>
        </tbody>
    </table>
<div id="loader"></div>
<?php echo $this->pagination->create_links(); ?>
</form>

<div id="modal">
    ¿Desea eliminar el o los elementos seleccionados?
</div>
<script type="text/javascript">
$(function() {
	$('#DataGrid').ZebraGrid();
	$('#btn_consulta').click(function(){
		$('#offset').val(0);
	});
	$('#btn_all').click(function(){
		$('#buscar').val('');
		$('#offset').val(0);
		$('#Form').submit();
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
		title: 'Eliminar Staff',
		buttons: {
			'Cancelar':function(){
				$(this).dialog('close');
				$('#eliminar').val('');
			},
			
			'Eliminar':function(){
				$('#eliminar').val('1');
				$(this).dialog('close');
				$('#Form').submit();
			}
		}
    });
	$('#Form').ajaxify({
				  event:'submit',
				  target:'#GridResults',
				  method:'POST',
				  link:'<?php echo ruta('staff/grid'); ?>',
				  forms:'#Form',
				  loading_txt:'',
				  loading_img:'<?php echo relative_root('assets/img/load.gif'); ?>',
				  loading_target:'#loader',
				  onStart:function(o){
					  $('#DataGrid').hide('blind','',700);
				  },
				  onComplete:function(o){
				  	$('#DataGrid').ZebraGrid();
					load_pages();
					$('#DataGrid').show('blind','',700);
				  }
	});
	
	$('#pagination a').click(function(){
		var num = $(this).attr('href').split('/');
		$('#offset').val(num[1]);
		$('#Form').submit();
	});	
	
	ventana_detalles();
	
<?php echo $this->session->flashdata('extrascript'); ?>

});

function ventana_detalles(){
	$('a.fancybox').fancybox({
				'autoScale'			: true,
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade',
				'type'				: 'iframe',
				'titleShow'		    : false
			});
}

function load_pages(){
	var my_offset = $('#offset').val();
	var my_total  = $('#total').val();
    $('#pagination').load('<?php  echo ruta('staff/grid_pagination/'); ?>' + my_offset + '/' + my_total, function (){
		$('#pagination a').click(function(){
			var num = $(this).attr('href').split('/');
			$('#offset').val(num[1]);
			$('#Form').submit();
		});	
	});

}
</script>