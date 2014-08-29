<?php

class CurriculasController extends AppController {
	public $helpers = array('Html','Form');
	public $uses = array('Usuario','Curricula');

	function index() {
		$this->set('curriculas', $this->Curricula->find('all'));
		//$this->set('todo', $this->Curso->find('all'));
	}

	public function add() {

		$user = $this->Usuario->findById($this->Auth->User('id'));

		//if($this->isAdmin($user) || $this->isSecretaria($user) || $this->isDirector($user)){
		if(1){

			$noSavedCurso = 0;
			App::import('Vendor', 'zend_include_path');
			App::import('Vendor', 'Zend_Gdata', true, false, 'Zend/Gdata.php');

			Zend_Loader::loadClass('Zend_Http_Client');
			Zend_Loader::loadClass('Zend_Gdata');
			Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
			Zend_Loader::loadClass('Zend_Gdata_Spreadsheets');

			
			//debug ($this->request);	
			if ($this->request->is('post')) { //si viene por post

				$username = 'webmasterepis@episunsa.edu.pe'; // Your google account username
				$password = 'epis$unsa.'; // Your google account password

				//-------------------------------------------------------------------------------
				// Document key - get it from browser addres bar query key for your open spreadsheet

				$spreadsheetkey=$this->request->data['Curricula']['spreadsheetkey'];

				$key = $spreadsheetkey;

				//$key = "0AvfPOhmLXt8tdE5tNnFndm5vWXVFUG54eENfTmU2eGc";

				//echo $key;
				$service = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
				$client = Zend_Gdata_ClientLogin::getHttpClient($username, $password, $service);
				$spreadSheetService = new Zend_Gdata_Spreadsheets($client);
				 
				//--------------------------------------------------------------------------------
				// Example 1: Get cell data
				 
				$query = new Zend_Gdata_Spreadsheets_DocumentQuery();
				$query->setSpreadsheetKey($key);
				$feed = $spreadSheetService->getWorksheetFeed($query);
				$entries = $feed->entries[0]->getContentsAsRows();
				//echo "<hr><h3>Example 1: Get cell data</h3>";
				//echo var_export($entries, true);
				//debug($this->request->data);
				$this->Curricula->create();

				$existsCurricula = $this->Curricula->findById($this->request->data['Curricula']['id']);

				if($existsCurricula){
					$this->Session->setFlash(__('La currícula que ingresaste ya existe'));
					return $this->redirect(array('action' => 'index'));
					
				}

				$this->Curricula->begin();

				$curricula = $this->Curricula->save($this->request->data);

				if (!empty($curricula)) {

					$this->Session->setFlash(__('La currícula ingresada fue guardada correctamente'));

					foreach ($entries as $entrie => $value) {
					//debug($value);
						$insertArrayCurso = array(
											'Curso' => array(
													'id' => $value['codcurso'],
													'componentes_formacion_id' => $value['componenteformacion'],
													'nombre' => $value['nombreasignatura'],
													//'componentes_formacion_id' => $value['depacademicoadscrito'],
													'semestre' => $value['semestre'],
													'creditos' => $value['creditos'],
													'curricula_id' => $this->Curricula->id,
													'prerequisitos' => $value['prerequisitos'],
													'prerequisitos_creditos' => $value['prerequisitoscreditos'],
													'horas_teoria' => $value['horasteoria'],
													'horas_semiPresecial' => $value['horassemi'],
													'horas_teoricoPractico' => $value['horasteoricopractico'],
													'horas_practica' => $value['horaspracticas'],
												)
											);
						//debug ($insertArrayCurso);
						$curso = $this->Curricula->Curso->save($insertArrayCurso);
						if(!empty($curso)){
							//debug($curso);
							$noSavedCurso ++;
						}
					}
					if($noSavedCurso){ // si los cursos no guardados son 0
						
						$this->Curricula->commit();
						return $this->redirect(array('action' => 'index'));
					}else{
						
						$this->Curricula->rollback();
					}
				}else
					$this->Session->setFlash(__('No se pudo agregar la currícula.'));
				
				//debug ($this->request->data);
			    //$this->Curricula->create();
			    //debug($this->request);
			    // if ($this->Curricula->save($this->request->data)) {
			    //     $this->Session->setFlash(__('Your curricula has been saved.'));
			    //     return $this->redirect(array('action' => 'index'));
			    // }
			    //$this->Session->setFlash(__('Unable to add your curricula.'));
			}

		}else{
            $this->Session->setFlash(__('No está autorizado en esta sección'));
            return $this->redirect($this->Auth->loginRedirect);
        }
            

	}
	public function view($id = null) {

		if (!$id) {
            throw new NotFoundException(__('Invalid curricula'));
        }

        $curricula = $this->Curricula->findById($id);
        if (!$curricula) {
            throw new NotFoundException(__('Invalid curricula'));
        }
        $this->set('curricula', $curricula);

	}
	public function edit($id = null) {

		$user = $this->Usuario->findById($this->Auth->User('id'));

		//if($this->isAdmin($user) || $this->isSecretaria($user) || $this->isDirector($user)){
		if(1){

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
		}
		else{
			 $this->Session->setFlash(__('No está autorizado en esta sección'));
            return $this->redirect($this->Auth->loginRedirect);
		}
	}
	public function delete($id) {
		$user = $this->Usuario->findById($this->Auth->User('id'));

		//if($this->isAdmin($user) || $this->isSecretaria($user) || $this->isDirector($user)){
		if(1){

		    if ($this->request->is('get')) {
		        throw new MethodNotAllowedException();
		    }

		    if ($this->Curricula->delete($id)) {
		        $this->Session->setFlash(
		            __('La currícula con código id: %s ha sido eliminada.', h($id))
		        );
		        return $this->redirect(array('action' => 'index'));
		    }

		}
		else{
			 $this->Session->setFlash(__('No está autorizado en esta sección'));
            return $this->redirect($this->Auth->loginRedirect);
		}
	}

}