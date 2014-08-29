<?php

class CursosController extends AppController {
	public $helpers = array('Html','Form');

	function index() {
		$this->set('cursos', $this->Curso->find('all'));
		//$this->set('todo', $this->Curso->find('all'));
	}
	public function edit($id = null) {

		$user = $this->Usuario->findById($this->Auth->User('id'));

		if($this->isAdmin($user) || $this->isSecretaria($user) || $this->isDirector($user)){

		    if (!$id) {
		        throw new NotFoundException(__('Curso no válido'));
		    }

		    $Curso = $this->Curso->findById($id);

		    if (!$Curso) {
		        throw new NotFoundException(__('Curso no válido'));
		    }

		    if ($this->request->is(array('post', 'put'))) {
		        $this->Curso->id = $id;
		        if ($this->Curso->save($this->request->data)) {
		            $this->Session->setFlash(__('El curso ha sido actualizado.'));
		            return $this->redirect(array('action' => 'index'));
		        }
		        $this->Session->setFlash(__('Unable to update your post.'));
		    }

		    if (!$this->request->data) {
		        $this->request->data = $Curso;
		    }

		}
		else{
			 $this->Session->setFlash(__('No está autorizado en esta sección'));
            return $this->redirect($this->Auth->loginRedirect);
		}
	}

}