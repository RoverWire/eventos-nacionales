<form class="uniForm" action="" method="post" enctype="multipart/form-data" name="ajustes" id="ajustes">
<table class="vgrid" width="100%" cols="2">
		<tr>
			<th width="200" align="right">Número de Campos:</th>
			<td><?php echo $this->ajuste->campos; ?></td>
		</tr>
		<tr>
			<th class="odd-th" align="right">Número de Manadas:</th>
			<td class="odd-row"><?php echo $this->ajuste->manadas; ?></td>
		</tr>
		<tr>
			<th align="right">Edad Maxima de Participante:</th>
			<td><?php echo $this->ajuste->edad_limite; ?></td>
		</tr>
		<tr>
			<th class="odd-th" align="right">Nombre de los Campos:</th>
			<td class="odd-row"><?php echo $this->ajuste->nombres_campos; ?></td>
		</tr>
</table>
<div class="pieBtn">
		<button id="btn_cancelar" type="button"><span class="ui-icon ui-icon-pencil"></span> Modificar Parámetros</button> 
</div>
</form>
<script type="text/javascript">
$(function() {
	$('#btn_cancelar').click(function(){
		window.location = '<?php echo ruta('ajustes/editar'); ?>';
	});
	
<?php echo $this->session->flashdata('extrascript'); ?>

});
</script>