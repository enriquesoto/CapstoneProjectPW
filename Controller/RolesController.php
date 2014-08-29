<?php

class RolesController extends AppController {
	public $helpers = array('Html','Form');
	public $uses= array('Usuario','Rol');

	function index() {
		$this->set('roles', $this->Rol->find('all'));
		//$this->set('todo', $this->Curso->find('all'));
	}

	public function add() {

		
	}
	public function view($id = null) {

		if (!$id) {
            throw new NotFoundException(__('Invalid curricula'));
        }

        $rol = $this->Rol->findById($id);
        if (!$rol) {
            throw new NotFoundException(__('Invalid curricula'));
        }
        $this->set('rol', $rol);

	}
	public function edit($id = null) {
		$user = $this->Usuario->findById($this->Auth->User('id'));
		if($this->isAdmin($user) || $this->isSecretaria($user) || $this->isDirector($user)){
		    if (!$id) {
		        throw new NotFoundException(__('Curricula no válida'));
		    }

		    $curricula = $this->Curricula->findById($id);

		    if (!$curricula) {
		        throw new NotFoundException(__('Curricula no válida'));
		    }

		    if ($this->request->is(array('post', 'put'))) {
		        $this->Curricula->id = $id;
		        if ($this->Curricula->save($this->request->data)) {
		            $this->Session->setFlash(__('Your curricula has been updated.'));
		            return $this->redirect(array('action' => 'index'));
		        }
		        $this->Session->setFlash(__('Unable to update your post.'));
		    }

		    if (!$this->request->data) {
		        $this->request->data = $curricula;
		    }
		}else{
			$this->Session->setFlash(__('No está autorizado en esta sección'));
            return $this->redirect($this->Auth->loginRedirect);
		}

	}
	public function delete($id) {
		$user = $this->Usuario->findById($this->Auth->User('id'));
		if($this->isAdmin($user) || $this->isSecretaria($user) || $this->isDirector($user)){
		    if ($this->request->is('get')) {
		        throw new MethodNotAllowedException();
		    }

		    if ($this->Curricula->delete($id)) {
		        $this->Session->setFlash(
		            __('La currícula con código id: %s ha sido eliminada.', h($id))
		        );
		        return $this->redirect(array('action' => 'index'));
		    }

		}else{
			 $this->Session->setFlash(__('No está autorizado en esta sección'));
            return $this->redirect($this->Auth->loginRedirect);
		}

	}

}