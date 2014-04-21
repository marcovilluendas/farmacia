<h2> ¿Donde desea buscar ofertas? </h2>
<?php

		echo $this->Form->create('Farmacia',array('url' => array('controller' => 'ofertas', 'action' => 'listado')));
		echo $this->Form->input('articulo');
		
		$options = array(
			'' => '== Todas las localidades ==',
			'Barcelona' => 'Barcelona',
			'Bilbao' => 'Bilbao',
			'Madrid' => 'Madrid',
			'Zaragoza' => 'Zaragoza'
			

		);

		echo $this->Form->input('localidad', array('options' => $options));
		
		echo $this->Form->end('Guardar');


?>
