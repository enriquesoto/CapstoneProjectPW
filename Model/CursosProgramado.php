<?php

class CursosProgramado extends AppModel {
	//public $name = 'CursosProgramado';

    public $actsAs = array('Containable');

    public $belongsTo = array(
        'Curso' => array(
            'className' => 'Curso',
            'foreignKey' => 'curso_id'
        )
    );

    public $hasMany = array(
        'Matricula' => array(
            'className' => 'Matricula',
            //'foreignKey' => 'cursos_programado_id', //error?
            //'conditions' => array('Comment.status' => '1'),
            //'order' => 'Curso.created DESC',
            //'limit' => '5',
            'dependent' => true
        )
    );


    public $validate = array(
        'anho_dictado' => array(
            'number' => array(
                    'rule'    => array('range', 2000, 9999),
                    'message' => 'Ingrese un número entre 2000 y 9999'
                )
        ),
        'curso_id' => array(
            'limitChars' => array(
                    'rule'    => array('between', 7, 7),
                    'message' => 'la variable curso_id debe tener 7 caracteres',
                )
        ),
        'ciclo_dictado' => array(
            'options' => array(
                    'rule'    => '/^[ABV]$/i',
                    'message' => 'Solo escoger A,B o V',
                )
        ),
        'turno' => array(
            'options' => array(
                    'rule'    => '/^[ABCDE]$/i',
                    'message' => 'Solo escoger turnos A,B,C,D y E',
                )
        ),

        'tipo_catedra' => array(
            'options' => array(
                    'rule'    => '/^[TLP]$/i',
                    'message' => 'Solo escoger tipos de cátedra T,L o P',
                )
        ),
        // 'spreadsheetkey' => array(
        //     'alphanumeric' => array(
        //             'rule'    =>  'alphaNumeric',
        //             'message' => 'Sólo números y letras',
        //             'allowEmpty' => false,
        //         )
        // ),
        // 'descripcion' => array(
        //     'maxlength' => array(
        //         'rule' => array('maxLength', 256),
        //         'message' => 'El texto no puede ser mayor a 256 caracteres',
        //         'allowEmpty' => true,
        //         )

        //)

    );

}