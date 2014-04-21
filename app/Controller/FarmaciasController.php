<?php

class FarmaciasController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $components = array(
        'DataTable.DataTable' => array(
            'columns' => array(
                'nombre' => true,                      // bSearchable and bSortable will be false
                'localidad' => true
            ),
        ),
    );

/**
 * Helpers
 *
 * @var array
 */
    public $helpers = array(
        'DataTable.DataTable',
    );
	
  
        public function index() {

            $this->set('farmacias', $this->Farmacia->find('all'));
			$this->DataTable->paginate = array('Farmacia');
			 
			
        }
		
		public function Detalle() {
		
            $this->set('farmacias', $this->Farmacia->find('all'));
        }
		
		/* public function far($id = null) {
														 if (!$id) {
											throw new NotFoundException(__('Invalid post'));
										}

										$farmacia = $this->Farmacia->findById($id);
										if (!$farmacia) {
											throw new NotFoundException(__('Invalid post'));
										}

										if ($this->request->is(array('post', 'put'))) {
											$this->Farmacia->id = $id;
											if ($this->Farmacia->save($this->request->data)) {
												$this->Session->setFlash(__('Su información se ha guardado'));
												return $this->redirect(array('action' => 'index'));
											}
											$this->Session->setFlash(__('Unable to update your post.'));
										}

										if (!$this->request->data) {
											$this->request->data = $farmacia;
										}
		} */
		
	
		
		
		public function add() {
			if (!empty($this->request->data)) {
				$this->Farmacia->create();
				
				
				$this->request->data['Farmacia']['user_id'] = $this->Auth->User('id');

				if ($this->Farmacia->save($this->request->data)) {
					$this->redirect(array('action'=>'add', $this->Farmacia->id, 'admin'=>false));
				} else {
					$this->Session->setFlash("El post no ha podido ser guardado. Inténtalo de nuevo.");
					$this->redirectBack(array('action'=>'index', 'admin'=>false));
				}
			}
		}
		
		public function view($id=null) {
		
			 if (!$id) {
				throw new NotFoundException(__('Invalid post'));
			}
			
			$this->loadModel('Farmacia');
			$farmacia = $this->Farmacia->findById($id);
			
			
			if (!$farmacia) {
				throw new NotFoundException(__('Invalid post'));
			}

			$this->set('farmacia', $farmacia);
		}
}	

?>