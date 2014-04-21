<?php

/**
 * Application model for CakePHP.
 */
 
class Farmacia extends AppModel {


	public $primaryKey = 'id';
	var $name = 'Farmacia';

	var $hasMany = array(
		'Image' => array(
			'className' => 'Image',
			'foreignKey' => 'foreign_id',
			'conditions' => array('Image.model' => 'Farmacia'),
			'fields' => '',
			'order' => array('Image.orden' => 'asc', 'Image.id' => 'asc')
		),
		'Oferta' => array(
			'className' => 'Oferta',
			'foreignKey' => 'id_farmacia'
		)
	);
	
}


?>