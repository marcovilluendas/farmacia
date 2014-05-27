<style type="text/css" title="currentStyle">
			@import "../../DataTables/media/css/demo_page.css"; @import "../../DataTables/media/css/header.ccss";
			@import "../../DataTables/media/css/demo_table.css";
</style>
<script type="text/javascript" src="../../DataTables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/base/jquery-ui.css" />



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


<div class="container">
	<div id="add_post" class="add_from_admin dialog_form" title="Nueva Oferta">
		<?php
			echo $this->Form->create('Oferta', array('url'=>array('action'=>'add', 'admin' => true)));
			echo $this->Form->input('articulo', array('label'=>'Articulo', 'type' => 'text'));
			echo $this->Form->end("Enviar");
		?>
	</div>


<h1> MIS OFERTAS ACTUALES </h1>

	<table id="myTable">
				<thead>
					<tr>
						<th class="arti">Artículo</th>
						<th>Descripcion</th>
						<th width="80">Precio</th>
						<th>Stock</th>
						<th>Farmacia</th>
						<th>Dirección</th>
						<th>Localidad</th>
						<th>Ver/Editar/Borrar</th>
					</tr>
				</thead>
				<tbody>
				
				<?php  foreach ($oferta as $oferta): ?>
					<tr>
						<td class="arti"><?php echo $oferta['Oferta']['articulo']; ?></td>
						<td><?php echo $oferta['Oferta']['descripcion']; ?></td>
						<td><?php echo $oferta['Oferta']['precio']; ?> €</td>
						<td><?php echo $oferta['Oferta']['stock']; ?></td>
						<td><?php echo $this->Html->link('', array('action' => 'view', $oferta['Farmacia']['id'])); ?>
						<?php echo $oferta['Farmacia']['nombre']; ?></td>
						<td><?php echo $oferta['Farmacia']['direccion']; ?></td>
						<td><?php echo $oferta['Farmacia']['localidad']; ?></td>

						<td>
						
							<button type="button" class="btn">
								<?php echo $this->Html->link('VER', array('action' => 'view', $oferta['Oferta']['id'])); ?>
							</button>
							
							<button type="button" class="btn">
								<?php echo $this->Html->link('EDITAR', array('action' => 'edit', 'admin' => true, $oferta['Oferta']['id'])); ?>
							</button>
							
							<button type="button" class="btn">
							<?php echo $this->Form->postLink(
								'BORRAR',
								array('action' => 'delete', $oferta['Oferta']['id']),
								array('confirm' => 'Estas seguro que quieres borrar este post? ')
							)?>
							</button>
						</td>
					</tr>

					
				<?php endforeach; ?>
				
				<div class="actions right">
					<ul>
						<li><a href="#" class="boton_admin add">
							<span class="add">Insertar Nueva Oferta</span></a>
						</li>
						<li>
							<?php echo $this->Html->link("Editar Farmacia", 
									array(
									'controller' => 'farmacias', 
									'action' => 'edit', 
									'admin'=>false,
									$oferta['Farmacia']['id']
									)); ?>
						</li>
						
						<li>
							<?php echo $this->Html->link("MI FARMACIA", 
									array(
									'controller' => 'farmacias', 
									'action' => 'view', 
									'admin'=>false,
									$oferta['Farmacia']['id']
									)); ?>				
						</li>
					</ul>
				</div>
				
				<?php unset($oferta); ?>
	</tbody>
	</table>
</div>


<script>
	
	$(".add_from_admin").dialog({
		autoOpen: false,
		height: 'auto',
		width: 350,
		modal: true
	});
	$(".add_from_admin .submit INPUT").click(function(e){
		var error_empty_input = false;
		$('.add_from_admin .required INPUT[type="text"]').each(function(e){
			if( $(this).val() == "" ){
				error_empty_input = true;
			}
		});
		if(error_empty_input){
			e.preventDefault();
		}
	});


	$('.boton_admin.add').click(function(){
		//$('#add_user').slideToggle('fast');
		$(".add_from_admin").dialog("open");
		return false;
	});

/*
	//SELECT ACTIVAR
	$('.selectMaqueta').change(function(){
		var select = $(this);
		var valor = $(this).val();
		var post_id = $(this).attr('xml:id');
		
		select.attr('disabled','disabled');
		
		$.get('/posts/maqueta_ajax/'+post_id+'/'+valor, function(data) {
			select.attr('disabled','');
		});
	});
*/
</script>


<?php echo $this->Html->script('jquery.sieve.min'); ?>

<script>
    $(document).ready(function() {
			$("table.sieve").sieve();
	}); 
</script>

