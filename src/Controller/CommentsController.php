<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 */
class CommentsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
       // $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
    }
    
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index']);

    }

    /**
     * Index method
     *
     * @return void
     */
    public function index($id = null)
    {
        if ($this->request->session()->read('Auth.User.role_id') == 1){
            //$id will be Article ID. If it is null it will display all comments.
            if ($id == null) {
                 $comments = $this->Comments->find('all')
                    ->contain(['Articles','Users']);
            } else {
                 $comments = $this->Comments->find('all')
                        ->contain(['Articles','Users'])
                        ->where(['Comments.article_id' => $id]);
            }
        } else {
             //$id will be Article ID. If it is null it will display all comments.
            if ($id == null) {
                 $comments = $this->Comments->find('all')
                    ->contain(['Articles','Users'])
                    -> where(['Comments.isApproved' => 1]); 
            } else {
                 $comments = $this->Comments->find('all')
                        ->contain(['Articles','Users'])
                        ->where(['Comments.article_id' => $id, 'Comments.isApproved' => 1]);
            }
        }
        
        $this->set('comments', $this->paginate($this->Comments));
        $this->set(compact('comments'));
    }

    /**
     * View method
     *
     * @param string|null $id Comment id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => ['Articles']
        ]);
        $this->set('comment', $comment);
        $this->set('_serialize', ['comment']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($article_id = null)
    {
        $comment = $this->Comments->newEntity();
        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->data);
            $comment -> article_id = $article_id;
            if ($this->Auth->user('user_id') != null) {
                $comment->user_id = $this->Auth->user('user_id');
                if ($this->Auth->user('role_id') == 1) {
                    $comment->isApproved = 1;
                }
            }     

            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));
                return $this->redirect(['controller' => 'Articles', 'action' => 'view', $article_id]);
            } else {
                $this->Flash->error(__('The comment could not be saved. Please, try again.'));
            }
        }
        $article = $this->Comments->Articles->get($article_id);
        $this->set(compact('comment', 'article'));
        $this->set('_serialize', ['comment']);
    }

     /**
     * Approve method
     *
     * @param string|null $id Comment id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function approve($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => ['Articles']
        ]);
        $comment->isApproved = 1;
        
        if ($this->Comments->save($comment)) {
            $this->Flash->success(__('The comment has been saved.'));
            return $this->redirect(['controller'=>'Articles','action' => 'index']);
        } else {
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
    }

    
    /**
     * Edit method
     *
     * @param string|null $id Comment id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comment = $this->Comments->patchEntity($comment, $this->request->data);
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The comment could not be saved. Please, try again.'));
            }
        }
        $articles = $this->Comments->Articles->find('list', ['limit' => 200]);
        $this->set(compact('comment', 'articles'));
        $this->set('_serialize', ['comment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comment = $this->Comments->get($id);
        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__('The comment has been deleted.'));
        } else {
            $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    

      /**
     * isAuthorized method
     * Authorization depedning on role
     * @param string|null $id Order id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function isAuthorized($user)
    {
        if (in_array($this->request->action, ['index', 'add']))
            return true;
        
        // The owner of an order can edit and delete it
        if (in_array($this->request->action, ['edit', 'delete', 'view'])) {
            $comment_id = (int)$this->request->params['pass'][0];
            if ($this->Comments->isOwnedBy($comment_id, $user['user_id'])) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }
}
