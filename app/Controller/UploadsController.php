<?php
 
App::uses('AppController', 'Controller');
 
class UploadsController extends AppController {
 
/**
 * Metodo que carga las imagenes
 */
    public function index() {
         
        $this->Upload->create();
         
           if ($this->request->is('post')) {
                
            if( $this->data['Upload']['archivo']['error'] == 0 &&  $this->data['Upload']['archivo']['size'] > 0)
             {
                // Informacion del tipo de archivo subido $this->data['Upload']['archivo']['type']
                  $destino = WWW_ROOT.'uploads'.DS;
                  if(move_uploaded_file($archivo['tmp_name'], $destino.$archivo['name']))
                   {               
                      $this->Session->setFlash(__('El archivo se ha guardado'));
                   }
                  else
                   {
                          $this->Session->setFlash(__('El archivo no se pudo subir, por favor intentelo de nuevo'));       
                   }
                   $this->redirect(array('action' => 'index'));
             }else{
                  $this->Session->setFlash(__('Error al intentar subir el archivo'));
              }
        }
         
    }
     
}
?>   