<?php

class CursoCurso extends AppModel {
	public $name = 'CursoCurso';

    public $belongsTo = array(
        'aCursoOne' => array(
            'className' => 'Curso',
            'foreignKey' => 'curso_id'
        ),
        'aCursoTwo' => array(
            'className' => 'Curso',
            'foreignKey' => 'prerequisito'
        )
    );
}