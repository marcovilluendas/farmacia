<style type="text/css" title="currentStyle">
			@import "../DataTables/media/css/demo_page.css"; @import "../DataTables/media/css/header.ccss";
			@import "../DataTables/media/css/demo_table.css";
</style>
<script type="text/javascript" src="../DataTables/media/js/jquery.dataTables.min.js"></script>

<script>
		$(document).ready(function() {
			$('#myTable').dataTable({
					 "bPaginate": false,
					 "bInfo": false,
					
					"oLanguage": {
					"sProcessing":     "Procesando...",
					"sLengthMenu":     "Mostrar _MENU_ registros",
					"sZeroRecords":    "No se encontraron resultados",
					"sEmptyTable":     "Ningún dato disponible en esta tabla",
					"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
					"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
					"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
					"sInfoPostFix":    "",
					"sSearch":         "Buscar:",
					"sUrl":            "",
					"sInfoThousands":  ",",
					"sLoadingRecords": "Cargando...",
					"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
					},
					}
			})
		} );

</script>

<div class="contenido">
<div class="row">
	<div class="col-lg-12 col-md-12">
		<table id="myTable">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Dirección</th>
								<th>Localidad</th>
								<th>CP</th>
								<th>Email</th>
								<th>Imagen</th>
							</tr>
						</thead>
						<tbody>

						<?php  foreach ($farmacias as $farmacia): ?>
						 
						<tr>

								<td><?php echo $farmacia['Farmacia']['nombre']; ?></td>
								<td><?php echo $farmacia['Farmacia']['direccion']; ?></td>
								<td><?php echo $farmacia['Farmacia']['localidad']; ?></td>
								<td><?php echo $farmacia['Farmacia']['cp']; ?></td>
								<td><?php echo $farmacia['Farmacia']['email']; ?></td>
								<td><button type="button" class="btn"><?php echo $this->Html->link('VER', array('action' => 'view', $farmacia['Farmacia']['id'])); ?></button></td>

						</tr>
						
						<?php endforeach; ?>
						<?php unset($farmacia); ?>
						
					
		</tbody>
		</table>
	</div>
</div>
</div>