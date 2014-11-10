<form class="uniForm" name="usuario" id="usuario" action="" method="post" enctype="multipart/form-data">
	<div class="error">
		<strong>ATENCIÓN:</strong>
		Las siguientes actividades no pudieron asignarse debido a que ya no cuentan con lugares disponibles.
	</div>

<?php if ($actividad1 > 0 || $actividad2 > 0): ?>

	<fieldset class="inlineLabels">
		<legend>Actividad de Equipo</legend>
		

		<?php if ($actividad1 > 0): ?>
		<div class="ctrlHolder">
			<label for="grupal1">Actividad 1:</label>
			<span class="inputHolder">
				<select name="Grupal[grupal1]" id="grupal1" class="chosen">
					<?php echo $this->actividad->combo_equipo(); ?>
				</select>
				<p class="formHint">primera actividad que harán todos los integrantes</p>
				<?php echo form_error('Grupal[grupal1]'); ?>
			</span>
		</div>
		<?php endif; ?>

		<?php if ($actividad2): ?>
		<div class="ctrlHolder">
			<label for="grupal2">Actividad 2:</label>
			<span class="inputHolder">
				<select name="Grupal[grupal2]" id="grupal2" class="chosen">
					<?php echo $this->actividad->combo_equipo(); ?>
				</select>
				<p class="formHint">segunda actividad que harán todos los integrantes</p>
				<?php echo form_error('Grupal[grupal2]'); ?>
			</span>
		</div>
		<?php endif; ?>
	</fieldset>
<?php endif; ?>

<?php if ($elemento->num_rows() > 0) {?>
	<fieldset class="inlineLabels">
		<legend>Actividad Individual</legend>
		<?php foreach ($elemento->result() as $row){ ?>
		<div class="ctrlHolder">
			<label for="<?php echo $row->lobato_cum; ?>"><?php echo $row->lobato_nombre; ?>:</label>
			<span class="inputHolder">
				<select name="Datos[<?php echo $row->lobato_cum; ?>]" id="<?php echo $row->obato_cum; ?>" class="chosen">
					<?php echo $this->actividad->combo_individual(); ?>
				</select>
				<p class="formHint">actividad individual del elemento</p>
				<?php echo form_error('Datos[<?php echo $row->lobato_cum; ?>]'); ?>
			</span>
		</div>
		<?php } ?>
	</fieldset>
<?php } ?>

	<div class="pieBtn">
		<button type="submit"><span class="ui-icon ui-icon-check"></span> Asignar</button>
	</div>
</form>
<script type="text/javascript">
$(function() {
	$(".chosen").chosen();
});
</script>