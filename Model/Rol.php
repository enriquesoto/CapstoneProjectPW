<?php

class Rol extends AppModel {
	public $name = 'Rol';
	public $useTable = 'roles';
    public $actsAs = array('Containable');
	public $hasAndBelongsToMany = array(
        'Usuario' =>
            array(
                'className' => 'Usuario',
                'joinTable' => 'roles_usuarios',
                'foreignKey' => 'rol_id',
                'associationForeignKey' => 'usuario_id',
                'unique' => true
            )
    );

	//public $hasAndBelongsToMany = 'Usuario';

}