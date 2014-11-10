<table width="50%">
	<tr>
		<td>Campo</td>
		<td>Ocupación</td>
		<td>Limite</td>
	</tr>
	<?php for ($i=0; $i < $this->actividad->numero_registros; $i++) { ?>
	<tr>
		<td><?php echo $this->actividad->nombre; ?></td>
		<td><?php echo $this->actividad->ocupacion; ?></td>
		<td><?php echo $this->actividad->capacidad; ?></td>
	</tr>
	<?php $this->actividad->siguiente(); } ?>
</table>