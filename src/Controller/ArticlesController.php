<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 */
class ArticlesController extends AppController
{
    //todo pagination
 /*   public $paginate = [
        'Orders' => [],
        'Users' => [],
        'Doughsize' => [],
        'Cruststyle' => [],
        'sortWhitelist' => [
            'order_id', 'Users.name', ' orderdate', 'modified', 'iscompleted'
        ],
        'limit' => 20,
        'order' => [
            'Orders.iscompleted' => 'desc',
            'Orders.order_id' => 'asc',
            'Orders.modified' => 'asc'
        ]
    ];*/
    
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Flash'); // Include the FlashComponent
    }
    

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $articles = $this->Articles->find('all')
                    ->contain(['Users','Tags']);
        
        $this->set('articles', $this->paginate($this->Articles));
        $this->set(compact('articles'));
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $article = $this->Articles->get($id,['contain' => ['Users','Comments','Tags']]);

        $users = $this->Articles->Users->find('list',['keyField' => 'user_id',
                            'valueField' => 'username'])
                      ->toArray();
        
        $this->set(compact('article','users'));
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tags = $this->Articles->Tags->find('list');
        
        $article = $this->Articles->newEntity();

        if ($this->request->is('post')) {
            $this->request->data['tags']['_ids'] = $this->request->data['_ids'];

            $article = $this->Articles->patchEntity($article, $this->request->data, ['associated' => ['Tags']]);

            
            //todo user session id add needed 
            if ($this->Auth->user('user_id') != null) {
                $article->user_id = $this->Auth->user('user_id');
            }        
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The article could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('article','tags'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $taglist = $this->Articles->Tags->find('list');
        
        $article = $this->Articles->get($id,['contain' => ['Users','Tags']]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['tags']['_ids'] = $this->request->data['_ids'];
            
            $article = $this->Articles->patchEntity($article, $this->request->data, ['associated' => ['Tags']]);
            
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The article could not be saved. Please, try again.'));
            }
        }

        $checkedtag = array_map(create_function('$o', 'return $o->tag_id;'), $article->tags);
        $this->set(compact('article', 'taglist', 'checkedtag'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
