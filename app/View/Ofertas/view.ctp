


<div class="section-colored">
<div class="row">


<div class="col-md-3">
</div>

<div class="col-md-6 col-xs-12">


			<?php echo $this->Form->create('Oferta'); ?> 

				<h1><?=$oferta['Oferta']['articulo']?></h1>
				<hr>
				
			
			
			<div class="form">
				<label>Descripción: </label><h3><?=$oferta['Oferta']['descripcion']?></h3>
				<label>Precio: </label> <h3><?=$oferta['Oferta']['precio']?></h3>
				<label>Stock: </label> <h3><?=$oferta['Oferta']['stock']?></h3>
				
				
				
				<label>Farmacia: </label> <h3><?=$oferta['Farmacia']['nombre']?></h3>
			</div>
</div>
<div class="col-md-3">
<? foreach($oferta['Image'] as $img): ?>
				<img src="<?=Router::url("/files/images/".$img['archivo']) ?>" style="height:200px; width:200px">
			<? endforeach; ?><br>
</div>

</div>	