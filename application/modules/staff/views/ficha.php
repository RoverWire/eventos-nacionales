<form class="uniForm" action="" method="post" enctype="multipart/form-data" name="regnal" id="regnal">
<table class="vgrid" width="100%" cols="2">
		<tr>
			<th width="130" align="right">CUM:</th>
			<td><?php echo $this->miembro->cum; ?></td>
		</tr>
		<tr>
			<th class="odd-th" align="right">Nivel:</th>
			<td class="odd-row"><?php echo $this->miembro->nivel; ?></td>
		</tr>
		<tr>
			<th align="right">Provincia:</th>
			<td><?php echo $this->miembro->provincia; ?></td>
		</tr>
		<tr>
			<th class="odd-th" align="right">Localidad:</th>
			<td class="odd-row"><?php echo $this->miembro->localidad; ?></td>
		</tr>
		<tr>
			<th align="right">Grupo:</th>
			<td><?php echo $this->miembro->grupo; ?></td>
		</tr>
        <tr>
			<th class="odd-th" align="right">Vigencia:</th>
			<td class="odd-row"><?php echo $this->miembro->vigencia; ?></td>
		</tr>
</table>
</form>