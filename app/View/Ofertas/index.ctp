<div class="container">
	<div class="row">

	<div class="col-lg-12 col-md-12">
			
			<div class="formulario">
				<h1> ENCUENTRA OFERTAS CERCA DE TI </h1>
			
			
				<div class="col-lg-1 col-md-1">
				</div>
		
			
				<?php
					echo $this->Form->create('Farmacia',array('url' => array('controller' => 'ofertas', 'action' => 'listado')));
				?>

		<div class="space">
		</div>
		
		
			<div class="col-lg-12 col-md-12">
		
				<div class="searchbox">

					<?php
						echo $this->Form->text('articulo', 
						array(
						'placeholder' => 'Inserta aqui tu Código Postal, o tu ciudad o el nombre del artículo', 
						'id' => 'autocomplete')); ?>
					
					<button class="btn-search" type="submit"><i class="fa fa-search"></i></button>

				</div>
			</div>
					<?php
				/*
				echo $this->Form->input('cp');
				
				
				$options = array(
					'' => '== Todas las localidades ==',
					'A Coruña' => 'A Coruña',
					'Alava' => 'Alava',
					'Albacete' => 'Albacete',
					'Alicante' => 'Alicante',
					'Almería' => 'Almería',
					'Avila' => 'Avila',
					'Badajoz' => 'Badajoz',
					'Barcelona' => 'Barcelona',
					'Bilbao' => 'Bilbao',
					'Madrid' => 'Madrid',
					'Zaragoza' => 'Zaragoza'
				);

				echo $this->Form->input('localidad', array('options' => $options));
				*/
				?> 
				<br><br><br>

				<div class="btn-group">

						<?php 
						/*
						echo $this->Html->link('VER FARMACIAS', array('controller' => 'farmacias', 'action' => 'listado', 'admin'=>false)); 
						*/
						?>
					<a href="farmacias/index">
						<button type="button" class="btn-lista">
							VER FARMACIAS
						</button>
					</a>
					
					
					<a href="ofertas/listado">
						<button type="button" class="btn-lista">
							VER OFERTAS
						</button>
					</a>
					
					


					<?php
						echo $this->Form->end();
					?>
				</div>
			</div>
	</div>
	</div>
</div>

