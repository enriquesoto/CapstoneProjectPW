<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'usuarios', 'action' => 'perfil'),
            'logoutRedirect' => array('controller' => 'home', 'action' => 'index'),

            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Usuario'
                    )
            )
            
            //'authorize' => array('Controller')
            // 'authenticate' => array(
            //     'Form' => array(
            //         'userModel' => 'Usuario',
            //         'fields' => array(
            //             'username' => 'username',
            //             'password' => 'password'
            //         )
            //     )
            // ),
            // 'authorize' => array('Controller')
        )
    );

    

    public function beforeFilter() {
        $this->Auth->allow('index', 'view','forgotpassword','about','contactus');
        $this->Auth->loginAction = array('controller' => 'usuarios', 'action' => 'login');
        //$this->layout = 'alumno';
    }
    //...

    public function isAdmin($user) {
        // Admin can access every action

        //debug($user);
        $nroRoles = count($user['Rol']);
        //debug($nroRoles);
        if(isset($user['Rol'])){

            for ($i=0; $i < $nroRoles; $i++) { 
                # code...
                //debug($user['Rol'][$i]['id']);
                if($user['Rol'][$i]['id'] == 5 ){
                    return true;
                }
            }
  
        }
        // Default deny
        return false;
    }
    public function isSecretaria($user){

        $nroRoles = count($user['Rol']);

        if(isset($user['Rol'])){

            for ($i=0; $i < $nroRoles; $i++) { 
                # code...
                if($user['Rol'][$i]['id'] == 6 ){
                    return true;
                }
            }
  
        }
        // Default deny
        return false;
    }
    public function isDirector($user){

        $nroRoles = count($user['Rol']);

        if(isset($user['Rol'])){

            for ($i=0; $i < $nroRoles; $i++) { 
                # code...
                if($user['Rol'][$i]['id'] == 2 ){
                    return true;
                }
            }
  
        }
        // Default deny
        return false;   
    }
    public function isProfesor($user){
          $nroRoles = count($user['Rol']);

        if(isset($user['Rol'])){

            for ($i=0; $i < $nroRoles; $i++) { 
                # code...
                if($user['Rol'][$i]['id'] == 1 ){
                    return true;
                }
            }
  
        }
        // Default deny
        return false;  
    }
    public function isAlumno($user){
        $nroRoles = count($user['Rol']);

        if(isset($user['Rol'])){

            for ($i=0; $i < $nroRoles; $i++) { 
                # code...
                if($user['Rol'][$i]['id'] == 4 ){

                    return true;
                }
            }
  
        }
        return false;
    }

}
