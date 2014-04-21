<?php

/**
 * Application model for CakePHP.
 */
 
class Oferta extends AppModel {

	public $primaryKey = 'id';
	var $name = 'Oferta';
	
	var $belongsTo = array(
        'Farmacia' => array(
            'className' => 'Farmacia',
            'foreignKey' => 'id_farmacia'
        ),
		
	);
	
	var $hasMany = array(
		'Image' => array(
			'className' => 'Image',
			'foreignKey' => 'foreign_id',
			'conditions' => array('Image.model' => 'Oferta'),
			'fields' => '',
			'order' => array('Image.orden' => 'asc', 'Image.id' => 'asc')
		),
	);
}


?>