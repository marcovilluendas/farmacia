
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
				
				<?php  foreach ($ofertas as $oferta): ?>
				
					<tr>
						<td><?php echo $oferta['Oferta']['articulo']; ?></td>
						<td><?php echo $oferta['Oferta']['descripcion']; ?></td>
						<td class="precio"><?php echo $oferta['Oferta']['precio']; ?> €</td>
						<td><?php echo $oferta['Oferta']['stock']; ?></td>
						<td><?php echo $oferta['Farmacia']['nombre']; ?></td>
						<td><?php echo $oferta['Farmacia']['direccion']; ?></td>
						<td><?php echo $oferta['Farmacia']['localidad']; ?></td>
						<td><button type="button" class="btn"><?php echo $this->Html->link('VER', array('action' => 'view',$oferta['Oferta']['id'])); ?>
					</tr>
				</tbody>
				<?php endforeach; ?>
				<?php unset($oferta); ?>
</table>