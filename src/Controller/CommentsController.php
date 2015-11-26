<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 */
class CommentsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index($id = null)
    {
        //$id will be Article ID. If it is null it will display all comments.
        if ($id == null) {
            $this->paginate = [
                'contain' => ['Articles','Users']
            ];
        } else {
             $comments = $this->Comments->find('all')
                    ->contain(['Articles','Users'])
                    ->where(['Comments.article_id' => $id]);
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
            if ($this->request->session()->read('Auth.User.user_id') != null) {
                $this->request->data['user_id'] = $this->request->session()->read('Auth.User.user_id');
                $this->request->data['isApproved'] = 1;
            }
            $comment = $this->Comments->patchEntity($comment, $this->request->data);
            $comment -> article_id = $article_id;
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
}
