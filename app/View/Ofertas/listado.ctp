﻿<style type="text/css" title="currentStyle">
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

<div class="containerindex">
	<div class="contenido">
		<div class="row">
		<h1> Listado de Ofertas </h1>
			<div class="col-lg-12 col-md-12">
			
				<table id="myTable">
				
							<thead>
								<tr>
									<th></th>
									<th class="center">Artículo</th>
									<th class="center">Descripcion</th>
									<th class="center">Precio</th>
									<th class="center">Validez</th>
									<th class="center">Farmacia</th>
									<th class="center">Dirección</th>
									<th class="center">Localidad</th>
									<th class="center">CP</th>
									<th class="center">Ver</th>
								</tr>
							</thead>
							<tbody>
							
							<?php  foreach ($ofertas as $oferta): ?>
							
								<tr>
									<td> 
										<? foreach($oferta['Image'] as $img): ?>
											<img src="<?=Router::url("/files/images/".$img['archivo']) ?>" style="height:50px; width:50px">
										<? endforeach; ?><br>
									</td>
									<td class="arti"><?php echo $oferta['Oferta']['articulo']; ?>
									
									
									</td>
									
									<td><?php echo $oferta['Oferta']['descripcion']; ?></td>
									<td class="preciot"><?php echo $oferta['Oferta']['precio']; ?> €</td>
									<td><?php echo $oferta['Oferta']['validez']; ?></td>
									<td>
									<?php echo $this->Html->link($oferta['Farmacia']['nombre'], array('controller' => 'farmacias', 'action' => 'view', $oferta['Farmacia']['id'])); ?>
									
									</td>
									<td><?php echo $oferta['Farmacia']['direccion']; ?></td>
									<td><?php echo $oferta['Farmacia']['localidad']; ?></td>
									<td><?php echo $oferta['Farmacia']['cp']; ?></td>
									<td><button type="button" class="btn"><?php echo $this->Html->link('VER', array('action' => 'view',$oferta['Oferta']['id'])); ?>
								</tr>
							
							<?php endforeach; ?>
							<?php unset($oferta); ?>
							</tbody>
				</table>
			</div>
		</div>
	</div>
</div>