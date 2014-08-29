<?php

class Curricula extends AppModel {
	public $name = 'Curricula';
	public $actsAs = array('Containable');
	public $hasMany = array(
		'Curso' => array(
		    'className' => 'Curso',
		    'foreignKey' => 'curricula_id',
		    //'conditions' => array('Comment.status' => '1'),
		    //'order' => 'Curso.created DESC',
		    //'limit' => '5',
		    'dependent' => true
		)
	);

	public $validate = array(
	    'id' => array(
	    	'unique' => array(
					'rule'    => 'isUnique', 
	        		'message' => 'This curricula has already been taken.'
	    		),
	    	'maxlenght' => array(
					'rule'    => array('maxLength', 10),
			        'message' => 'el código de cada currícula debe ser de a lo más 10 dígitos'
	    		),
	    	'numeric' => array(
	    			'rule' => 'numeric',
	    			'message' => 'sólo valores numéricos'	
	    		)
	    ),
	    'anho_inicio' => array(
	    	'number' => array(
	    			'rule'    => array('range', 2000, 9999),
        			'message' => 'Ingrese un número entre 2000 y 9999'
	    		)
	   	),
	    'anho_fin' => array(
	    	'number' => array(
	    			'rule'    => array('range', 2000, 9999),
        			'message' => 'Ingrese un número entre 2000 y 9999',
			    	'allowEmpty' => true,
	    		)
	    ),
	    'spreadsheetkey' => array(
	    	'alphanumeric' => array(
	    			'rule'    =>  'alphaNumeric',
        			'message' => 'Sólo números y letras',
			    	'allowEmpty' => false,
	    		)
	    ),
	    'descripcion' => array(
	    	'maxlength' => array(
	    		'rule' => array('maxLength', 256),
	    		'message' => 'El texto no puede ser mayor a 256 caracteres',
	    		'allowEmpty' => true,
	    		)

	    )

	);

	function begin() {
	    $db =& ConnectionManager::getDataSource($this->useDbConfig);
	    $db->begin($this);
	}
	function commit() {
	    $db =& ConnectionManager::getDataSource($this->useDbConfig);
	    $db->commit($this);
	}
	function rollback() {
	    $db =& ConnectionManager::getDataSource($this->useDbConfig);
	    $db->rollback($this);
	}

}