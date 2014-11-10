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
		    <th width="25%" scope="col">Seisena</th>
		    <th width="63%" scope="col">Provincia</th>
		    <th width="7%" scope="col">Elementos</th>
		    <th width="5%" scope="col">Ver</th>
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
		    <td align="center"><?php echo $this->manada->nombre_seisena; ?></td>
		    <td><?php echo ($this->manada->elementos) ? $this->manada->provincia:'Disponible'; ?></td>
		    <td align="center"><?php echo $this->manada->elementos; ?></td>
		    <td align="center">
            <?php
				if($this->manada->scouter != '')
				{
			?>
            <a href="<?php echo ruta('registros/ficha/'.$this->manada->scouter); ?>"><img src="<?php echo relative_root(), 'img/onebit_39.png'; ?>" alt="Ficha" title="Ficha" width="16" height="16" border="0" align="absbottom" /></a>
            <?php
				}
				else
				{
					echo "&nbsp;";
				}
			?>
            </td>
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
<script type="text/javascript">
$(function() {
	$('#campo').accordion();
	$('table.grid').ZebraGrid();
});
</script>