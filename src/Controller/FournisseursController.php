<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Fournisseurs Controller
 *
 * @property \App\Model\Table\FournisseursTable $Fournisseurs
 */
class FournisseursController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $fournisseurs = $this->paginate($this->Fournisseurs);

        $this->set(compact('fournisseurs'));
        $this->set('_serialize', ['fournisseurs']);
    }

    /**
     * View method
     *
     * @param string|null $id Fournisseur id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fournisseur = $this->Fournisseurs->get($id, [
            'contain' => []
        ]);

        $this->set('fournisseur', $fournisseur);
        $this->set('_serialize', ['fournisseur']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fournisseur = $this->Fournisseurs->newEntity();
        if ($this->request->is('post')) {
            $fournisseur = $this->Fournisseurs->patchEntity($fournisseur, $this->request->data);
            if ($this->Fournisseurs->save($fournisseur)) {
                $this->Flash->success(__('The fournisseur has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The fournisseur could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('fournisseur'));
        $this->set('_serialize', ['fournisseur']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Fournisseur id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fournisseur = $this->Fournisseurs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fournisseur = $this->Fournisseurs->patchEntity($fournisseur, $this->request->data);
            if ($this->Fournisseurs->save($fournisseur)) {
                $this->Flash->success(__('The fournisseur has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The fournisseur could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('fournisseur'));
        $this->set('_serialize', ['fournisseur']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Fournisseur id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fournisseur = $this->Fournisseurs->get($id);
        if ($this->Fournisseurs->delete($fournisseur)) {
            $this->Flash->success(__('The fournisseur has been deleted.'));
        } else {
            $this->Flash->error(__('The fournisseur could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
