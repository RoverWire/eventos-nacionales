<h1 class="titulo_seccion">Campos Existentes</h1>

<form action="" method="post" enctype="application/x-www-form-urlencoded" id="Form" class="ajaxify">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="grid" id="DataGrid" cols="4">
        <thead>
            <tr>
              <th width="50%" scope="col">Nombre</th>
                <th width="48%" scope="col">Ocupacion</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
        </tfoot>
        <tbody id="GridResults">
        <?php

		for($i=0; $i<$this->campo->numero_registros; $i++){
        ?>
            <tr>
                <td><?php echo $this->campo->nombre; ?></td>
                <td><?php echo $this->campo->ocupacion; ?></td>
            </tr>
        <?php
            $this->campo->siguiente();
        }
		
		if($this->campo->numero_registros == 0){
		?>
        	<tr>
            	<td colspan="4" align="center">No se encontraron resultados registrados</td>
            </tr>
		<?php
		}
        ?>
        </tbody>
    </table>
</form>
<script type="text/javascript">
$(function() {
	$('#DataGrid').ZebraGrid();
});
</script>