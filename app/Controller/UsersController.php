<?php


class UsersController extends AppController {

	//public $components = array('Auth');
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout');
    }

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }
	
	public function login() {
	
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
			   if($this->Auth->User('id')){
				$uid = $this->Session->read('Auth.User.id');
				$this->redirect('/Ofertas/ofertas_farmacias/$uid');
				$this->Session->setFlash(__('Ha accedido con su cuenta a la aplicacion'));
			}
			}
			$this->Session->setFlash(__('Usuario invalido, la cuenta y la contraseña no coinciden'));
		}
		
		if($this->Auth->User('id')){
			$this->redirect('/Ofertas/listado');
		}
	}
	
	public function admin_login(){
		$this->redirect(array('admin'=>false, 'action'=>'login'));
	}
	

	public function logout() {
    return $this->redirect($this->Auth->logout());
	}

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Se ha guardado el usuario'));
                $this->redirect('/users/login');
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        $this->request->onlyAllow('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }

	


}
?>