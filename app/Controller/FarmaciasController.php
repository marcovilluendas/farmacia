<?php

class FarmaciasController extends AppController {

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
   /* public $helpers = array(
        'DataTable.DataTable',
    ); */
	
  
        public function index() {

            $this->set('farmacias', $this->Farmacia->find('all'));
			/* $this->DataTable->paginate = array('Farmacia'); */
			 
			
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
		
		
		public function edit($id = null) {
		
			$uid = $this->Session->read('Auth.User.id');

				if (empty($uid)){
						$this->Session->setFlash('No esta conectado');
						$this->redirect(array('controller' => 'users', 'action' => 'login'));
				}

				if (!$id) {
					throw new NotFoundException(__('Invalid post'));
				}
			
				$this->loadModel('Farmacia');
				$farmacia = $this->Farmacia->findById($id);

				if (!$farmacia) {
					throw new NotFoundException(__('Invalid post'));
				}

				
				if ($this->request->is(array('post', 'put'))) {
						$this->Farmacia->id = $id;
							
							$user_id = $this->Farmacia->field('user_id', array('Farmacia.id'=> $this->request->data['Farmacia']['id']));
							if($user_id != $this->Auth->user('id')){
								$this->Session->setFlash(__('Usted no tiene permiso para editar una farmacia que no es la suya.'));
							}
							else {
							if ($this->Farmacia->save($this->request->data)) {
								$this->Session->setFlash(__('=== La información de su farmacia ha sido actualizada ==='));
								return $this->redirect(array('controller' => 'ofertas', 'action' => 'ofertas_farmacias/$uid', 'admin' => false));
							}
								$this->Session->setFlash(__('Usted no tiene permiso para editar una farmacia que no es la suya.'));
							}
						}

							if (!$this->request->data) {
								$this->request->data = $farmacia;
							}
		}
		
		
		public function view($id=null) {
		
			 if (!$id) {
				throw new NotFoundException(__('Invalid post'));
			}
			
			$this->loadModel('Farmacia');
			$this->loadModel('Oferta');
			$farmacia = $this->Farmacia->findById($id);
			
			
			
			if (!$farmacia) {
				throw new NotFoundException(__('Invalid post'));
			}

			$this->set('farmacia', $farmacia);
			
			
			$oferta = $this->Oferta->find('all', array(
					'conditions' => array( 'Oferta.id_farmacia' => $id)
							
					));

			$this->set('oferta', $oferta);
		}
}	

?>

