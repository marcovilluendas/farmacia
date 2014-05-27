<?php

class OfertasController extends AppController {
var $components = array('Session');

        public function index() {
		
			$this->loadModel('Farmacia');
			$this->set('localidad', $this->Farmacia->find('all'));

        }    
		

        public function Listado() {
				
			$this->loadModel('Farmacia');
		
		


			if(!empty($this->data) && $this->request->is('post')){
				$cond=array(
					'or' => array(
					"Farmacia.localidad LIKE" => "%{$this->data['Farmacia']['articulo']}%",
					"Oferta.articulo LIKE" => "%{$this->data['Farmacia']['articulo']}%",
					"Farmacia.cp LIKE" => "%{$this->data['Farmacia']['articulo']}%"
				));
			}else{
				$cond = array(
					//"Farmacia.active" => true,
				);
			}
			$this->set('ofertas', $this->Oferta->find('all', array('conditions'=>$cond)));
        }
		
		
		public function admin_add() {
		
			if (!empty($this->request->data)) {
				$this->Oferta->create();

				$this->request->data['Oferta']['id_farmacia'] = $this->Oferta->Farmacia->field('id', array('Farmacia.user_id' => $this->Auth->User('id') ));


				if ($this->Oferta->save($this->request->data)) {
					$this->redirect(array('action'=>'edit', $this->Oferta->id, 'admin'=>true));
				} else {
					$this->Session->setFlash("El post no ha podido ser guardado. Inténtalo de nuevo.");
					$this->redirectBack(array('action'=>'index', 'admin'=>true));
				}
			}
		}
			
	
		public function admin_edit($id = null) {
		
		
			$uid = $this->Session->read('Auth.User.id');
				
				if (empty($uid)){
						$this->Session->setFlash('No esta conectado');
						$this->redirect(array('controller' => 'users', 'action' => 'login'));
				}
		
				if (!$id) {
					throw new NotFoundException(__('Invalid post'));
				}
			
			$this->loadModel('Oferta');
			$oferta = $this->Oferta->findById($id);
									
				if (!$oferta) {
					throw new NotFoundException(__('Invalid post'));
				}
				if ($this->request->is(array('post', 'put'))) {
						$this->Oferta->id = $id;
						
							
							if ($this->Oferta->save($this->request->data)) {
								$this->Session->setFlash(__('=== Su oferta ha sido actualizada ==='));
								return $this->redirect(array('action' => 'ofertas_farmacias/$uid', 'admin' => false));
							}
								$this->Session->setFlash(__('Unable to update your post.'));
						}

							if (!$this->request->data) {
								$this->request->data = $oferta;
							}
		}

		
		public function delete($id) {
		
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if ($this->Oferta->delete($id)) {
				$this->Session->setFlash('La oferta con id: ' . $id . ' ha sido borrada.');
				$this->redirect(array('action' => 'ofertas_farmacias/$uid', 'admin' => false));
			}
		}		

		public function view($id=null) {
		
				 if (!$id) {
						throw new NotFoundException(__('Invalid post'));
					}
					
					$this->loadModel('Farmacia');
					$oferta = $this->Oferta->findById($id);
					
					
					if (!$oferta) {
						throw new NotFoundException(__('Invalid post'));
					}

					$this->set('oferta', $oferta);
		}
		
		
		public function buscar() {

		}
		
		
		public function mis_ofertas($id=null) {
				
				if (!$id) {
						throw new NotFoundException(__('Invalid post'));
					}
					
					$this->loadModel('Farmacia');
					$oferta = $this->Oferta->findById($id);
					
					
					if (!$oferta) {
						throw new NotFoundException(__('Invalid post'));
					}

					$this->set('oferta', $oferta);
		}


		public function ofertas_farmacias($id=null) {
		
				if (!$id) {
						throw new NotFoundException(__('Invalid post'));
					}
					
					$this->loadModel('Farmacia');
					$uid = $this->Session->read('Auth.User.id');
					
			
					$oferta = $this->Oferta->find('all', array(
					'conditions' => array( 'Farmacia.user_id' => $uid)
							
					));
					
					$farmacia = $this->Farmacia->find('all', array(
					'conditions' => array( 'Farmacia.user_id' => $uid)
							
					));
					
					
					
					if (!$farmacia) {
						return $this->redirect(array('controller' => 'farmacias','action' => 'add'));
					}
					

					
					$this->set('oferta', $oferta);
		}
		
}



?>