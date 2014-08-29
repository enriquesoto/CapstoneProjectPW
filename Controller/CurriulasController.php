<?php
class CurriculasController extends AppController {
	public $helpers = array('Html','Form');

	function index() {
		$this->set('curriculas', $this->Post->find('all'));
	}

}