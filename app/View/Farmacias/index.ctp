<script>

$(document).ready(function() {
    $('#myTable').dataTable({
			 "bPaginate": false,
			 "bInfo": false
	})
} );

</script>

<table id="myTable"> 
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Direccion</th>
						<th>Localidad</th>
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
						<td><?php echo $farmacia['Farmacia']['email']; ?></td>
						<td><button type="button" class="btn"><?php echo $this->Html->link('VER', array('action' => 'view', $farmacia['Farmacia']['id'])); ?></button></td>

				</tr>
				
				<?php endforeach; ?>
				<?php unset($farmacia); ?>
				
			
</tbody>
</table>