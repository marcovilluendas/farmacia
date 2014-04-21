<?php

		echo $this->Html->script('admin');
		echo $this->Html->script('jquery-ui-1.10.4/ui/jquery-ui.js');
		
?>

	<div class="actions">
					<ul>
						<li><a href="#" class="boton_admin add">
							<span class="add">Nuevo post</span></a>
						</li>
					</ul>
	</div>

	<div id="add_post" class="add_from_admin dialog_form" title="Nuevo post">
		<?php
			echo $this->Form->create('Oferta', array('url'=>array('action'=>'add', 'admin' => true)));
			echo $this->Form->input('articulo', array('label'=>'Articulo', 'type' => 'text'));
			echo $this->Form->end("Enviar");
		?>
	</div>


<h1> MIS OFERTAS ACTUALES </h1>

	<table class="sieve table table-striped table-hover">
				<thead id="header">
					<tr>
						<th>Artículo</th>
						<th>Descripcion</th>
						<th>Precio</th>
						<th>Stock</th>
						<th>Farmacia</th>
						<th>Dirección</th>
						<th>Localidad</th>
					</tr>
				</thead>
				<tbody>
				
				<?php  foreach ($oferta as $oferta): ?>
					<tr>
						<td><?php echo $oferta['Oferta']['articulo']; ?></td>
						<td><?php echo $oferta['Oferta']['descripcion']; ?></td>
						<td><?php echo $oferta['Oferta']['precio']; ?></td>
						<td><?php echo $oferta['Oferta']['stock']; ?></td>
						<td><?php echo $oferta['Farmacia']['nombre']; ?></td>
						<td><?php echo $oferta['Farmacia']['direccion']; ?></td>
						<td><?php echo $oferta['Farmacia']['localidad']; ?></td>
						<td><?php echo $oferta['Farmacia']['user_id']; ?></td>
						
						<td>
						<button type="button" class="btn">
							<?php echo $this->Html->link('VER', array('action' => 'view', $oferta['Oferta']['id'])); ?>
						<button>
						<button type="button" class="btn">
							<?php echo $this->Html->link('EDITAR', array('action' => 'edit', 'admin' => true, $oferta['Oferta']['id'])); ?>
						</button>
						</td>
					</tr>
				</tbody>
				<?php endforeach; ?>
				<?php unset($oferta); ?>

	</table>
	
	
	
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