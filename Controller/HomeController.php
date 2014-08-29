<?php

class HomeController extends AppController{
	public $uses = array('Usuario','Home');

	public function index(){
		$this->set('title_for_layout','Bienvenido ');	

		$user = $this->Usuario->findById($this->Auth->User('id'));
        if($this->isAlumno($user)) $this->layout = 'alumno';	
		
	}
	public function about(){
		$this->set('title_for_layout','Acerca de ...');
		$user = $this->Usuario->findById($this->Auth->User('id'));
        if($this->isAlumno($user)){
        	$this->layout = 'alumno';	
        }else
        	$this->layout = 'default';
	}
	public function contactus(){
		$this->set('title_for_layout','Contáctanos');
		$user = $this->Usuario->findById($this->Auth->User('id'));
        if($this->isAlumno($user)) $this->layout = 'alumno';	
	}

} //end class

?>