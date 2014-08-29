<?php 

class UsuariosController extends AppController {

    public $uses = array('Usuario','Matricula','CursosProgramado','Curso');

    var $components = array('Email','Password');

    public function index() {
        $user = $this->Usuario->findById($this->Auth->User('id'));

        if($this->isAlumno($user)) $this->layout = 'alumno';    //template

        if($this->isAdmin($user) || $this->isSecretaria($user) || $this->isDirector($user) ){
            $this->Usuario->recursive = 1; //para que salgan los roles

            $this->set('usuarios', $this->paginate());
            //$this->set('usuarios', $this->Usuario->find('all'));
        }else{
            $this->Session->setFlash(__('No está autorizado en esta sección'));
            return $this->redirect($this->Auth->loginRedirect);
        }


    }

    public function view($id = null) {
         $user = $this->Usuario->findById($this->Auth->User('id'));

         if($this->isAlumno($user)) $this->layout = 'alumno';    //template


        if($this->isAdmin($user) || $this->isSecretaria($user) || $this->isDirector($user) || $this->isProfesor($user)){
            $this->Usuario->id = $id;
            if (!$this->Usuario->exists()) {
                throw new NotFoundException(__('Invalid user'));
            }
            $this->set('usuario', $this->Usuario->read(null, $id));

        }else{
            $this->Session->setFlash(__('No está autorizado en esta sección'));
            return $this->redirect($this->Auth->loginRedirect);
        }
        

    }

    public function add() {
        //$this->Usuario->Rol->find('list');
        $user = $this->Usuario->findById($this->Auth->User('id'));
        //if($this->isAdmin($user) || $this->isSecretaria($user) || $this->isDirector($user) ){
        if(1){
            $this->set('roles', $this->Usuario->Rol->find('list',
                                                                  array('fields'=>array('id','nombre_rol'))
                                                              ));
            if ($this->request->is('post')) {
                debug($this->request->data);
                $this->Usuario->create();
                if ($this->Usuario->saveAll($this->request->data)) {
                    $this->Session->setFlash(__('The user has been saved'));
                    return $this->redirect(array('action' => 'index'));
                }
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }   

        }else{
            $this->Session->setFlash(__('No está autorizado en esta sección'));
            return $this->redirect($this->Auth->loginRedirect);    
        }
        
        
    }

    public function edit($id = null) {


        $user = $this->Usuario->findById($this->Auth->User('id'));

        if($this->isAlumno($user)) $this->layout = 'alumno';    //template


        if($this->isAdmin($user) || $this->isSecretaria($user) || $this->isDirector($user) ){

            $this->Usuario->id = $id;
            $this->set('roles', $this->Usuario->Rol->find('list',
                                                            array('fields'=>array('id','nombre_rol'))
                                                          ));
            if (!$this->Usuario->exists()) {
                throw new NotFoundException(__('Invalid user'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if ($this->Usuario->save($this->request->data)) {
                    $this->Session->setFlash(__('The user has been saved'));
                    return $this->redirect(array('action' => 'index'));
                }
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            } else {
                $this->request->data = $this->Usuario->read(null, $id);
                unset($this->request->data['Usuario']['password']);
            }

        }else{
            $this->Session->setFlash(__('No está autorizado en esta sección'));
            return $this->redirect($this->Auth->loginRedirect);        
        }


    }

    public function delete($id = null) {

        $user = $this->Usuario->findById($this->Auth->User('id'));

        if($this->isAlumno($user)) $this->layout = 'alumno';    //template


        if($this->isAdmin($user) || $this->isSecretaria($user) || $this->isDirector($user) ){
            $this->request->onlyAllow('post');

            $this->Usuario->id = $id;
            if (!$this->Usuario->exists()) {
                throw new NotFoundException(__('Invalid user'));
            }
            if ($this->Usuario->delete()) {
                $this->Session->setFlash(__('Usuario deleted'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Usuario was not deleted'));
            return $this->redirect(array('action' => 'index'));

        }else{
            $this->Session->setFlash(__('No está autorizado en esta sección'));
            return $this->redirect($this->Auth->loginRedirect);        
        }

        
    }

    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('add', 'logout');
    }

    public function login() {
        //debug($this->request->data['Usuario']['password']);
        //debug(AuthComponent::password($this->request->data['Usuario']['password']));

        if ($this->request->is('post')) {
            //debug($this->Auth);
            if ($this->Auth->login()) {
                //return $this->redirect($this->Auth->redirect());
                
                return $this->redirect($this->Auth->loginRedirect);
            }
            $this->Session->setFlash(__('El usuario y/o password son incorrectos, intente nuevamente'));
        }
    }

    public function logout() {
        $this->layout = 'default';
        return $this->redirect($this->Auth->logout());
    }
    public function perfil() {
        //$this->Usuario->recursive = 2; 

        $this->set('title_for_layout','Mi perfil ');   

        $user = $this->Usuario->findById($this->Auth->User('id'));

        if($this->isAlumno($user)) $this->layout = 'alumno';    //template

        $this->set('miPerfil',$user );
        $this->set('title_for_layout', 'Mi perfil' );
        $this->Session->write('User.id', $user['Usuario']['id']);
    }
    public function my_grades(){
        //debug($this->Session->read('User.id'));  

        // $this->Html->script('jquery-lastest');
        // $this->Html->script('jquery.tablesorter.js');


        $this->set('title_for_layout','Mis Notas ');       

        $user = $this->Usuario->findById($this->Auth->User('id')); 

        $userId = $this->Session->read('User.id');

        if($this->isAlumno($user)) $this->layout = 'alumno';    //template


        $this->Matricula->recursive = 1;  

        $myEnrollments = $this->Matricula->find('all', array(
            
            'contain' => array(
                            'CursosProgramado'=>array( 
                                    'Curso' => array(
                                            'order' => 'Curso.semestre DESC',
                                        ),
                                    'order' => 'CursosProgramado.curso_id,CursosProgramado.anho_dictado,
                                    CursosProgramado.ciclo_dictado ASC'
                                )
                            ),
            'conditions' => 'Matricula.usuario_id ='.$userId,
        ));

        // // $myEnrollments = $this->Curso->find('all',array(
        // //         'contain' => array(
        // //             'CursosProgramado' => array(
        // //                 'Matricula' => array(
        // //                     'conditions' => 'Matricula.usuario_id ='.$userId
        // //                 )
        // //             )
        // //         ),
        // //         'order' => 'Curso.semestre ASC'
        // //     )
        // // );
        // // $notas = array();

        // foreach ($myEnrollments as $myEnrollment) {
        //     # code...
        //     // $notas['']
        //     // $myEnrollment['Matricula']['notaFinal']

        // }

         $this->set('myEnrollments',$myEnrollments);
    }
    public function editar(){

        $this->set('title_for_layout','Editar perfil ');   

        $user = $this->Usuario->findById($this->Auth->User('id')); 

        $userId = $this->Session->read('User.id');

        if($this->isAlumno($user)) $this->layout = 'alumno';    //template


        $this->Usuario->id = $userId;
        // $this->set('roles', $this->Usuario->Rol->find('list',
        //                                                 array('fields'=>array('id','nombre_rol'))
        //                                               ));
        if (!$this->Usuario->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash(__('Sus datos fueron guardados correctamente'));
                return $this->redirect(array('action' => 'perfil'));
            }
            $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
        } else {
            $this->request->data = $this->Usuario->read(null, $userId);
            unset($this->request->data['Usuario']['password']);
        }
    }

    public function forgotpassword(){

            $this->set('title_for_layout','Reiniciar Password ');   

           if(!empty($this->data)) { 
                        //debug($this->request->data);
                        $this->Usuario->recursive = 0; 
                        $user = $this->Usuario->findByCorreo($this->request->data['Usuario']['email']); 
                        if($user) { 
                                //$user['Usuario']['tmp_password'] = $this->Password->generatePassword(8);  
                                $tmp_password= $this->Password->generatePassword(8);  
                                $user['Usuario']['password'] = $tmp_password; 

                                if($this->Usuario->save($user)) { 
                                        // send a mail to finish the registration 
                                    $this->Email->to = $this->request->data['Usuario']['email']; 
                                    $this->Email->subject = 'Nuevo Password para el Sistema de Notas EPIS'; 
                                    $this->Email->replyTo = 'webmasterepis@episunsa.edu.pe'; 
                                    $this->Email->from = 'webmasterepis@episunsa.edu.pe';  
                                    $this->Email->sendAs = 'text'; 
                                    $this->Email->charset = 'utf-8'; 
                                    $body = "Por favor Visite http://www.episunsa.edu.pe/grades/usuarios/login. 
            Tu nuevo password es: {$tmp_password}"; 

                                    if ($this->Email->send($body)) { 
                                        $this->Session->setFlash(__('Tu nueva contraseña fue enviada, por favor revisa tu bandeja de entrada', true), 'warning'); 
                                    } else { 
                                        $this->Session->setFlash(__('Ocurrió un error al enviar el nuevo password, por favor intenta nuevamente o contacta 
                                            al administrador webmasterepis@episunsa.edu.pe', true), 'error'); 
                                    } 
                                    return $this->redirect($this->Auth->loginRedirect);
                                } 
                        } else { 
                                $this->Session->setFlash('No se encontró el correo en nuestra base de datos'); 
                        } 
                } 
    }


}