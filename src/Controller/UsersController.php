<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    //todo pagination sorting not working
    public $paginate = [
        'limit' => 25,
        'users' => [
        'Users.user_id' => 'asc'
        ]
    ];
    
    //Todo which function will be allowed
    /* Initialize */
    public function initialize()
    {
        parent::initialize();
    }
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['signup', 'logout']);

    }
    
    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
    
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        if ($this->request->session()->read('Auth.User.role_id')==1) {
        $users = $this->Users->find('all')
                    ->contain(['Roles'])
                    ->order(['user_id' => 'ASC']);
        $this->set('users', $this->paginate());
        $this->set(compact('users'));
        } else {
            $this->Flash->error(__('Unauthorized Access.'));
        }
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Roles']
        ]);
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Signup method (For users)
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function signup()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            //default role_id: user
            $user-> role_id = 2;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your information has been saved.'));
                return $this->redirect(['controller' => 'Articles','action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your information.'));
        }
        
        $this->set(compact('user'));
    }
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $roles = $this->Users->Roles->find('list', ['keyField' => 'role_id',
                            'valueField' => 'name'])->toArray();
        $this->set(compact('user','roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id,['contain' => ['Roles']]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            pr( $user);
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $roles = $this->Users->Roles->find('list', ['keyField' => 'role_id',
                            'valueField' => 'name'])->toArray();
        $this->set(compact('user', 'roles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    public function isAuthorized($user)
    {
        if ($user['role_id'] == 1){
            if (in_array($this->request->action, ['delete'])) {
                $user_id = (int)$this->request->params['pass'][0];
                if ($user_id == $user['user_id']){
                    return false;
                }
            }
            return true;  
        } else if ($user['role_id'] == 2){
            // All registered users can add orders
            // The owner of an order can edit and delete it
            if (in_array($this->request->action, ['edit','view'])) {
                $user_id = (int)$this->request->params['pass'][0];
                if ($user_id == $user['user_id']) {
                    return true;
                }
            }
        }

        return parent::isAuthorized($user);
    }
}
