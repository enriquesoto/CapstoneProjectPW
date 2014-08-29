<?php 

class CursosProgramadosController extends AppController {
    public $uses = array('Usuario');
    public function index() {
        //$this->CursosProgramadosController->recursive = 1; //para que salgan los roles

        $this->set('cursosProgramados', $this->paginate());
        //$this->set('usuarios', $this->Usuario->find('all'));
    }

    public function view($id = null) {

        $user = $this->Usuario->findById($this->Auth->User('id'));

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

        if($this->isAdmin($user) || $this->isSecretaria($user) || $this->isDirector($user)){
            
            $this->set('cursos', $this->CursosProgramado->Curso->find('list',array(
                                                                                'fields'=>array(
                                                                                    'id',
                                                                                    'nombre',
                                                                                    'curricula_id',
                                                                                    )
                                                                                )
                                                                    ));
            if ($this->request->is('post')) {

                //debug($this->request->data);
                $anhoDictado = $this->request->data['CursosProgramado']['anho_dictado'];
                $codigoCurso = $this->request->data['CursosProgramado']['curso_id'];
                $cicloApertura = $this->request->data['CursosProgramado']['ciclo_dictado'];
                $turno = $this->request->data['CursosProgramado']['turno'];

                $id = implode("_", array($anhoDictado,'446',$codigoCurso,implode(array($cicloApertura,$turno)))); //formato al id de acuerdo a la unsa
                //bug($id);

                $this->request->data['CursosProgramado']['id'] = $id;
                $this->CursosProgramado->create();
                if ($this->CursosProgramado->saveAll($this->request->data)) {
                    $this->Session->setFlash(__('The CursosProgramado has been saved'));
                    return $this->redirect(array('action' => 'index'));
                }
                $this->Session->setFlash(__('The CursosProgramado could not be saved. Please, try again.'));
            }

        }else{
            $this->Session->setFlash(__('No está autorizado en esta sección'));
            return $this->redirect($this->Auth->loginRedirect);
        }


      
        
    }

    public function edit($id = null) {


        $user = $this->Usuario->findById($this->Auth->User('id'));

        if($this->isAdmin($user) || $this->isSecretaria($user) || $this->isDirector($user)){

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

        if($this->isAdmin($user) || $this->isSecretaria($user) || $this->isDirector($user)){
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

}