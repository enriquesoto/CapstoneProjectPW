<?php

class Matricula extends AppModel {

    public $actsAs = array('Containable');
    public $belongsTo = array(
        'Usuario' => array(
            'className' => 'Usuario',
            'foreignKey' => 'usuario_id'
        ),
        'CursosProgramado' => array(
        	'className' => 'CursosProgramado',
        	'foreignKey' => 'cursos_programado_id'
        )
    );
}
