<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Pays Controller
 *
 * @property \App\Model\Table\PaysTable $Pays
 */
class PaysController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $pays = $this->paginate($this->Pays);

        $this->set(compact('pays'));
        $this->set('_serialize', ['pays']);
    }

    /**
     * View method
     *
     * @param string|null $id Pay id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pay = $this->Pays->get($id, [
            'contain' => []
        ]);

        $this->set('pay', $pay);
        $this->set('_serialize', ['pay']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pay = $this->Pays->newEntity();
        if ($this->request->is('post')) {
            $pay = $this->Pays->patchEntity($pay, $this->request->data);
            if ($this->Pays->save($pay)) {
                $this->Flash->success(__('The pay has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The pay could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('pay'));
        $this->set('_serialize', ['pay']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Pay id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pay = $this->Pays->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pay = $this->Pays->patchEntity($pay, $this->request->data);
            if ($this->Pays->save($pay)) {
                $this->Flash->success(__('The pay has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The pay could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('pay'));
        $this->set('_serialize', ['pay']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Pay id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pay = $this->Pays->get($id);
        if ($this->Pays->delete($pay)) {
            $this->Flash->success(__('The pay has been deleted.'));
        } else {
            $this->Flash->error(__('The pay could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
