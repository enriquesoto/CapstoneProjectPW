<?php

class MatriculasController extends AppController {
    public $uses = array('Matricula','Usuario','Rol');
    var $components = array('Password');
    var $cuiAlumno;
    var $username;
    var $passwordAlumno;
    var $nombresAlumno;
    var $apellidoPaternoAlumno;
    var $apellidoMaternoAlumno;
    var $notaFinal;
    var $notaenLetras;

    public function index() {
        $this->set(
             'matriculasList',
             $this->Matricula->find('all')
         );
    }

    public function add() {
        // if ($this->request->is('post')) {
        //     debug($this->request->data);
        //     if ($this->Matricula->saveAll($this->request->data)) {
        //         return $this->redirect(array('action' => 'index'));
        //     }
        // }

        $user = $this->Usuario->findById($this->Auth->User('id'));


        
        if($this->isAdmin($user) || $this->isSecretaria($user) || $this->isDirector($user)){

            App::import('Vendor', 'zend_include_path');

            debug($user);
            App::import('Vendor', 'Zend_Gdata', true, false, 'Zend/Gdata.php');

            Zend_Loader::loadClass('Zend_Http_Client');
            Zend_Loader::loadClass('Zend_Gdata');
            Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
            Zend_Loader::loadClass('Zend_Gdata_Spreadsheets');

            debug($this->request->data);
             if ($this->request->is('post')) {
                // if ($this->CourseMembership->saveAssociated($this->request->data)) {
                //     return $this->redirect(array('action' => 'index'));
                // }

                $username = 'webmasterepis@episunsa.edu.pe'; // Your google account username
                $password = 'epis$unsa.'; // Your google account password


                $service = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
                $client = Zend_Gdata_ClientLogin::getHttpClient($username, $password, $service);
                $spreadSheetService = new Zend_Gdata_Spreadsheets($client);

                $key = $this->request->data['spreadsheetkey'];
                // $anho_dictado = $this->request->data['anho_dictado'];
                // $ciclo_dictado = $this->request->data['ciclo_dictado'];
                $worksheetId= $this->request->data['worksheetId'];

                $DocumentQuery = new Zend_Gdata_Spreadsheets_DocumentQuery();
                $keyListaUIsuarios = "0AvfPOhmLXt8tdDNrcWM3bmxLRlB6VEFVMG1vY0dKM0E";  //excel por defecto NO MODIFICAR
                $DocumentQuery->setSpreadsheetKey($keyListaUIsuarios); 
                $feedDocuments = $spreadSheetService->getWorksheetFeed($DocumentQuery);
                

                $queryAddUsers = new Zend_Gdata_Spreadsheets_CellQuery();
                $queryAddUsers->setSpreadsheetKey($key);
                $queryAddUsers->setWorksheetId(basename($feedDocuments->entries[0]->id)); 

            
                $query = new Zend_Gdata_Spreadsheets_DocumentQuery();
                $query->setSpreadsheetKey($key);
                $feed = $spreadSheetService->getWorksheetFeed($query);

                $query = new Zend_Gdata_Spreadsheets_CellQuery();
                $query->setSpreadsheetKey($key);

                //print_r($feed->entries[$counter]->id);
                $query->setWorksheetId(basename($feed->entries[$worksheetId]->id));                
                //echo $entry->title->text."<br>";
                $query->setMinCol(1);
                $query->setMaxCol(6);
                $query->setMinRow(9);

                $documentTitle = $feed->entries->title;
                    // //$query->setMaxRow(5);
                $feed = $spreadSheetService->getCellFeed($query);



                if(preg_match("/\_[0-9]{4}\_/", $documentTitle,$anho_dictado_match) 
                    && (preg_match("/\_[0-9]{3}\_/", $documentTitle,$codCarrera)) 
                    && (preg_match("/\_[ABCDEabcde]$/",$documentTitle,$ciclo_dictado_match))
                    ) 
                {
                     
                    $anho_dictado = trim($anho_dictado_match[0],"_");

                    $ciclo_dictado = trim($ciclo_dictado_match[0],"_");
                    $codCarrera = trim($codCarrera[0],"_");

                    foreach($feed as $cellEntry) {

                    $row = $cellEntry->cell->getRow();
                    $col = $cellEntry->cell->getColumn();

                    if($row == 9 && $col == 1){
                        $val = $cellEntry->cell->getText();
                        preg_match("/[0-9]{7}/", $val,$matches);
                        $codCurso = $matches[0];
                    }
                    if($row == 10 && $col == 2){
                        $val = $cellEntry->cell->getText();
                        preg_match("/[ABCDEabcde]/", $val,$matches);
                        $grupo = $matches[0];
                    }
                    if( ($row == 13 || $row == 15 || $row == 16)&&( $col == 2 || $col == 3) ) {
                        $val = $cellEntry->cell->getText();
                        if(preg_match("/Firma/", $val,$matches)){

                            $nombresyapellidos = explode("Firma", $val);
                            $nombresyapellidos = explode(",", trim($nombresyapellidos[0]));

                            $apellidosProfesor = explode("/", trim($nombresyapellidos[0]));

                            $apellidoPaternoProfesor= trim($apellidosProfesor[0]);
                            $apellidoMaternoProfesor = trim($apellidosProfesor[1]); 

                            $nombresProfesor = trim($nombresyapellidos[1]);
                            $passwordProfesor = $this->Password->generatePassword(8); 

                            $usernameProfesor = substr($nombresProfesor,0,1).
                                                substr($apellidoPaternoProfesor, 0,3).
                                                substr($apellidoMaternoProfesor,0,3);
                                               


                            echo "$codCurso<br>$grupo<br> 
                            $nombresProfesor  $apellidoPaternoProfesor $apellidoMaternoProfesor<br>";
                            //$nombres
                        }

                    }
                    if( $row >= 15){
                        $val = $cellEntry->cell->getText();
                        if($col == 1 && strpos($val, 'Nro') !== FALSE ) {
                            //echo "mmm";
                            $this->Matricula->CursosProgramado->create();
                            $insertRegisterCursoProgramado = array(
                                                                'CursosProgramado' => array(
                                                                    'id' => $anho_dictado."_".$codCarrera."_".$codCurso."_".$ciclo_dictado.$grupo,
                                                                    'curso_id' => $codCurso,
                                                                    'anho_dictado' => $anho_dictado,
                                                                    'turno' => $grupo,
                                                                    'ciclo_dictado' => $ciclo_dictado,
                                                                    'tipo_catedra' => 'T'
                                                                 ),
                                                            );
                            debug($insertRegisterCursoProgramado);
                            $this->Matricula->CursosProgramado->save($insertRegisterCursoProgramado);
                            $this->Matricula->Usuario->create();

                            $insertRegisterProfesor =array( 
                                                    'Usuario' => array(
                                                        'username' => $usernameProfesor,
                                                        'password' => $passwordProfesor,
                                                        'repass' => $passwordProfesor,
                                                        'nombres' => $nombresProfesor,
                                                        'apellidos' => $apellidoPaternoProfesor."/".$apellidoMaternoProfesor,
                                                        )
                                                    );

                            $resultSaving = $this->Matricula->Usuario->save($insertRegisterProfesor);

                            $usuarioAgregado = $this->Usuario->findByUsername($usernameProfesor);



                            // $insertRegister =array( //2011_446_0201101_BA
                            //                 'CursosProgramado' => array(
                            //                     'id' => $anho_dictado."_".$codCarrera."_".$codCurso."_".$ciclo_dictado.$grupo,
                            //                     'curso_id' => $codCurso,
                            //                     'anho_dictado' => $anho_dictado,
                            //                     'turno' => $grupo,
                            //                     'ciclo_dictado' => $ciclo_dictado,
                            //                     'tipo_catedra' => 'T'
                            //                 ),
                            //                 'Usuario' => array(
                            //                     'username' => $usernameProfesor,
                            //                     'password' => $passwordProfesor,
                            //                     'nombres' => $nombresProfesor,
                            //                     'apellidos' => $apellidoPaternoProfesor."/".$apellidoMaternoProfesor,
                            //                 ),
                            //                 'Matricula' => array(
                            //                     'observacion' => 'Profesor'
                            //                 )
                            //             );
                            
                            // $resultSaving = $this->Matricula->saveAssociated($insertRegister);

                            //debug($insertRegister);

                            $this->Matricula->create();

                            $insertRegisterMatricula = array(
                                                                'Usuario' => array(
                                                                    'id' => $usuarioAgregado['Usuario']['id'],
                                                                ),
                                                                'CursosProgramado' => array(
                                                                    'id' => $anho_dictado."_".$codCarrera."_".$codCurso."_".$ciclo_dictado.$grupo,
                                                                ),
                                                                'Matricula' => array(
                                                                    'observacion' => 'profesor',
                                                                )
                                                            );  

                            $this->Matricula->saveAssociated($insertRegisterMatricula);

                            $this->Matricula->Usuario->Rol->create();

                            $registroRol = array(
                                            'Usuario' => array(
                                                    'id' => $usuarioAgregado['Usuario']['id']
                                                ),
                                            'Rol' => array(
                                                    'id' => '1',
                                                )
                                        );

                            $this->Matricula->Usuario->saveAll($registroRol);

                        
                            debug($usuarioAgregado);
                                          
                            if($resultSaving){

                                 $insertedListEntry = $spreadSheetService->insertRow(array(
                                                                                        'apellidos'=>$apellidoPaternoProfesor."/".$apellidoMaternoProfesor,
                                                                                        'nombres'=>$nombresProfesor,
                                                                                        'usuario'=>$usernameProfesor,
                                                                                        'password' => $passwordProfesor,
                                                                                        'rol'=>'profesor'),
                                                        $keyListaUIsuarios,
                                                        basename($feedDocuments->entries[0]->id));
                                
                            }
                           
                        }
                        
                        if( $col == 2 ){

                            
                            if(preg_match("/[0-9]{8}/", $val,$matches) && !preg_match("/Firma/", $val)){

                                $this->cuiAlumno = $matches[0];
                                echo "$this->cuiAlumno ";
                            }
                        }
                        if($col == 3){
                            if(strpos($val, '/') !== FALSE && !preg_match("/Firma/", $val)){

                                //global $nombresAlumno,$apellidoPaternoAlumno,$apellidoMaternoAlumno;

                                $nombresyapellidosAlumno = $val;
                                $nombresyapellidos = explode(",", trim($nombresyapellidosAlumno));

                                $apellidosAlumno = explode("/", trim($nombresyapellidos[0]));

                                $this->apellidoPaternoAlumno = trim($apellidosAlumno[0]);
                                $this->apellidoMaternoAlumno = trim($apellidosAlumno[1]); 

                                $this->nombresAlumno = trim($nombresyapellidos[1]);
                                $this->passwordAlumno= $this->Password->generatePassword(8); 

                                echo "$this->nombresyapellidosAlumno <br>";
                            }
                        }
                        if($col == 4){
                            if(preg_match("/[0-9]{1,2}/", $val,$matches)){
                                $this->notaFinal = $val;
                                echo "$this->notaFinal <br>";
                            }   
                        }
                        if($col == 5){
                            if(strpos($val, "Letras") == FALSE){
                                $this->notaenLetras = $val;
                                echo "$this->notaenLetras <br>";
                                $this->Matricula->Usuario->create();
                                $insertRegisterAlumno =array( 
                                                    'Usuario' => array(
                                                        'username' => $this->cuiAlumno,
                                                        'password' => $this->passwordAlumno,
                                                        'repass' => $this->passwordAlumno,
                                                        'nombres' => $this->nombresAlumno,
                                                        'apellidos' => $this->apellidoPaternoAlumno."/".
                                                        $this->apellidoMaternoAlumno,
                                                        )
                                                    );
                                
                                //sleep(5);
                                

                                //debug($this->cuiAlumno);

                                $resultSavingUsuario = $this->Matricula->Usuario->save($insertRegisterAlumno);



                                $usuarioAgregado = $this->Usuario->findByUsername($this->cuiAlumno);

                                //debug($usuarioAgregado);

                                $this->Matricula->create();

                                $insertRegisterMatricula = array(
                                                                'Usuario' => array(
                                                                    'id' => $usuarioAgregado['Usuario']['id'],
                                                                ),
                                                                'CursosProgramado' => array(
                                                                    'id' => $anho_dictado."_".$codCarrera."_".$codCurso."_".$ciclo_dictado.$grupo,
                                                                ),
                                                                'Matricula' => array(
                                                                    'notaFinal' => $this->notaFinal,
                                                                    'letras' => $this->notaenLetras
                                                                )
                                                            );  
                                $this->Matricula->saveAssociated($insertRegisterMatricula);
                                $this->Matricula->Usuario->Rol->create();
                                $registroRol = array(
                                        'Usuario' => array(
                                                'id' => $this->Usuario->id,
                                            ),
                                        'Rol' => array(
                                                'id' => '4',
                                            )
                                    );

                                $this->Matricula->Usuario->saveAll($registroRol);

                                if($resultSavingUsuario){

                                    echo "naa";
                                   $insertedListEntry = $spreadSheetService->insertRow(array(
                                                                        'apellidos'=> $this->apellidoPaternoAlumno."/".$this->apellidoMaternoAlumno,
                                                                        'nombres'=>$this->nombresAlumno,
                                                                        'usuario'=>$this->cuiAlumno,
                                                                        'password' => $this->passwordAlumno,
                                                                        'rol'=>'estudiante'),
                                        $keyListaUIsuarios,
                                        basename($feedDocuments->entries[0]->id));
                                

                                }

                            }   
                            //$this->Matricula->saveAssociated($insertRegisterMatricula);

                        }

                        // if($col == 6){
                        //     if(strcmp($val, "Resolucion") != 0 ){
                        //         $resolucion = $val;
                        //         echo "$val<br>";
                        //     }   
                           
                        // }
                        
                    }

                }

                    
                }
                        



            }


        }else{
            $this->Session->setFlash(__('No está autorizado en esta sección'));
            return $this->redirect($this->Auth->loginRedirect);
        }
            

    
       
    }

    function _printFeed($feed)
    {
        $i = 0;
        foreach($feed->entries as $entry) {
          if ($entry instanceof Zend_Gdata_Spreadsheets_CellEntry) {
            print $entry->title->text .' '. $entry->content->text . "<br>";
          } else if ($entry instanceof Zend_Gdata_Spreadsheets_ListEntry) {
            print $i .' '. $entry->title->text .' '. $entry->content->text . "<br>";
          } else {
            print $i .' '. $entry->title->text . "<br>";
          }
          $i++;
        }
    }
}