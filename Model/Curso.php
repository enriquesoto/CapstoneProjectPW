<?php

class Curso extends AppModel {
	public $name = 'Curso';
	public $actsAs = array('Containable');
	public $hasMany = array(
		'CursosProgramado' => array(
		    'className' => 'CursosProgramados',
		    'foreignKey' => 'curso_id',
		    //'conditions' => array('Comment.status' => '1'),
		    //'order' => 'Curso.created DESC',
		    //'limit' => '5',
		    'dependent' => true
		)
	);

	 public $belongsTo = array(
        'Curricula' => array(
            'className' => 'Curricula',
            'foreignKey' => 'curricula_id'
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