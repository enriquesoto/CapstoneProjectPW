<?php 

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');


class Usuario extends AppModel {
    public $actsAs = array('Containable');

    function index() {
        $this->set('Usuarios', $this->Curricula->find('all'));
        //$this->set('todo', $this->Curso->find('all'));
    }

    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            ),
            'maxLength' => array(
                'rule'    => array('maxLength', 32),
                'message' => 'el usuario debe ser de a lo más 32 caracteres'
            ),
            'unique' => array(
                'rule'    => 'isUnique',
                'message' => 'This username has already been taken.'
            ),
            'alphanumeric' => array(
                'rule' => 'alphaNumeric',
                'message'  => 'Sólo números y letras'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Se requiere password'
            ),
            'maxlength' => array(
                    'rule'    => array('maxLength', '64'),
                    'message' => 'el password debe ser de a lo más 64 caracteres'
            ),
            'minLength' => array(
                'rule'    => array('minLength', '8'),
                'message' => 'Al menos 8 caracteres'
            )
        ),
        'repass' => array( 
            'identical' => array(
                'rule' => array('identicalFieldValues', 'password'),
                'message' => 'Las contraseñas deben de ser iguales!'
            )
        ),
        'nombres' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Se requiere el nombre '
            ),
            'maxlenght' => array(
                    'rule'    => array('maxLength', '128'),
                    'message' => 'el nombre debe ser de a lo más 128 caracteres'
            ),
            'minLength' => array(
                'rule'    => array('minLength', '3'),
                'message' => 'Minimum 3 characters long'
            )
        ),
        'apellidos' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Se requiere el apellido'
            ),
            'maxlenght' => array(
                    'rule'    => array('maxLength', '128'),
                    'message' => 'el apellido debe ser de a lo más 128 caracteres'
            ),
            'minLength' => array(
                'rule'    => array('minLength', '4'),
                'message' => 'Minimum 4 characters long'
            )
        ),
        'correo' => array(
            'unique' => array(
                'rule'    => 'isUnique',
                'message' => 'Este correo ya fue tomado'
            ),
            'email'=>'email'
        ),
        'bloqueado' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Se requiere saber si está bloqueado o no'
            ),
            'options' => array(
                'rule'=> array('range', -1, 2), //entre 0 y 1
                'message' => 'El código de bloqueo es 0 o 1 '
            )
        ),
        'fecha_nacimiento' => array(
            'birthday' => array(
                'rule'    => array('date', 'ymd'),
                'message' => 'Por favor, ingresa una fecha válida',
                'allowEmpty' => true,
            )
        )

        // 'role' => array(
        //     'valid' => array(
        //         'rule' => array('inList', array('admin', 'author')),
        //         'message' => 'Please enter a valid role',
        //         'allowEmpty' => false
        //     )
        // )
    );
    public $hasAndBelongsToMany = array(
        'Rol' =>
            array(
                'className' => 'Rol',
                'joinTable' => 'roles_usuarios',
                'foreignKey' => 'usuario_id',
                'associationForeignKey' => 'rol_id',
                'unique' => true,
            )
    );

    public $hasMany = array(
        'Matricula' => array(
            'className' => 'Matricula',
            'foreignKey' => 'usuario_id', //error?
            //'conditions' => array('Comment.status' => '1'),
            //'order' => 'Curso.created DESC',
            //'limit' => '5',
            'dependent' => true
        )
    );

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            //debug($this->data[$this->alias]['password']); //fararada99
            //debug(AuthComponent::password($this->data[$this->alias]['password'])); 
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
            //debug($this->data[$this->alias]['password']);
            //debug(AuthComponent::password($this->data[$this->alias]['password']));
        }
        return true;
    }
    function identicalFieldValues(&$data, $compareField) {
        // $data array is passed using the form field name as the key
        // so let's just get the field name to compare
        $value = array_values($data);
        $comparewithvalue = $value[0];
        return ($this->data[$this->name][$compareField] == $comparewithvalue);
    }
}