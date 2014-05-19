<div class="container">
<div class="formulario">

<h2> Filtros de Ofertas </h2>



<?php

		echo $this->Form->create('Farmacia',array('url' => array('controller' => 'ofertas', 'action' => 'listado')));
		echo $this->Form->input('articulo');
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

		
		echo $this->Form->end('Buscar');


?>
</div>
</div>
