<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Tags Controller
 *
 * @property \App\Model\Table\TagsTable $Tags
 */
class TagsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $tags = $this->Tags->find('all')
                    ->contain(['Articles']);
 
        $this->set('tags', $this->paginate($this->Tags));
        $this->set('_serialize', ['tags']);
    }

    /**
     * View method
     *
     * @param string|null $id Tag id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tag = $this->Tags->get($id);
        $this->set('tag', $tag);
        $this->set('_serialize', ['tag']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $articlesTable = TableRegistry::get('Articles');
        $article = $articlesTable->newEntity();
        if ($id != null) {
            $article = $articlesTable->get($id);
        }
       
        $tag = $this->Tags->newEntity();
        if ($this->request->is('post')) {
            $tag = $this->Tags->patchEntity($tag, $this->request->data);
         //   $tag->_joinData = $this->Tags->articlestags->newEntity();
        // $this->Tags->link($article, [$tag]);
            $article->dirty('tags', true);  
            if ($this->Tags->save($tag, ['associated' => ['Articles']])) {
                $this->Flash->success(__('The tag has been saved.'));
                return $this->redirect(['controller' => 'Tags', 'action' => 'index']);  //Todo should go view
            } else {
                $this->Flash->error(__('The tag could not be saved. Please, try again.'));
            }
        }
        
        $this->set(compact('tag'));
        $this->set('_serialize', ['tag']);
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Tag id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tag = $this->Tags->get($id);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tag = $this->Tags->patchEntity($tag, $this->request->data);
            if ($this->Tags->save($tag)) {
                $this->Flash->success(__('The tag has been saved.'));
                return $this->redirect(['controller' => 'Articles', 'action' => 'index']);  //Todo should go view
            } else {
                $this->Flash->error(__('The tag could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('tag'));
        $this->set('_serialize', ['tag']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tag = $this->Tags->get($id);
        if ($this->Tags->delete($tag)) {
            $this->Flash->success(__('The tag has been deleted.'));
        } else {
            $this->Flash->error(__('The tag could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
