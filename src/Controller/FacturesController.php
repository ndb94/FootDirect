<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

use Cake\Event\Event;

/**
 * Factures Controller
 *
 * @property \App\Model\Table\FacturesTable $Factures
 */
class FacturesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['addCommande','facture']);
    }

    public function index()
    {
        $factures = $this->paginate($this->Factures);

        $this->set(compact('factures'));
        $this->set('_serialize', ['factures']);
    }

    /**
     * View method
     *
     * @param string|null $id Facture id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $facture = $this->Factures->get($id, [
            'contain' => []
        ]);

        $this->set('facture', $facture);
        $this->set('_serialize', ['facture']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $facture = $this->Factures->newEntity();
        if ($this->request->is('post')) {
            $facture = $this->Factures->patchEntity($facture, $this->request->data);
            if ($this->Factures->save($facture)) {
                $this->Flash->success(__('The facture has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The facture could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('facture'));
        $this->set('_serialize', ['facture']);
    }

    public function addCommande()
    {
        if ($this->request->is('post')) {

            $qte=$this->request->session()->read('Panier.qte');
            $pxtot=$this->request->session()->read('Panier.prixtot');

            $facture=[];
            $commande="";

            $this->loadModel('Articles');

            for($i=1;$i<=$qte;$i++)
            {
                $art=$this->request->session()->read('Panier.article'.$i);
                $id=$art['id_article'];
                $article_bd = $this->Articles->get($id);

                $commande= $commande."".$i.". ".$article_bd['libelle']." - Taille ".$art['taille']." - Prix ".number_format($article_bd['prix'], 2, '.', ' ')." € ";

                if($art['taille']=='S')
                {
                    $old_stock=$article_bd['stock_s'];
                    $new_stock=$old_stock-1;

                    $articlesTable = TableRegistry::get('Articles');
                    $article_maj = $articlesTable->get($id);
                    $article_maj->stock_s=$new_stock;
                    $articlesTable->save($article_maj);

                }
                else if($art['taille']=='M')
                {
                    $old_stock=$article_bd['stock_m'];
                    $new_stock=$old_stock-1;

                    $articlesTable = TableRegistry::get('Articles');
                    $article_maj = $articlesTable->get($id);
                    $article_maj->stock_m=$new_stock;
                    $articlesTable->save($article_maj);
                }
                else if($art['taille']=='L')
                {
                    $old_stock=$article_bd['stock_l'];
                    $new_stock=$old_stock-1;

                    $articlesTable = TableRegistry::get('Articles');
                    $article_maj = $articlesTable->get($id);
                    $article_maj->stock_l=$new_stock;
                    $articlesTable->save($article_maj);
                }
                else if($art['taille']=='XL')
                {
                    $old_stock=$article_bd['stock_xl'];
                    $new_stock=$old_stock-1;

                    $articlesTable = TableRegistry::get('Articles');
                    $article_maj = $articlesTable->get($id);
                    $article_maj->stock_xl=$new_stock;
                    $articlesTable->save($article_maj);
                }
                else if($art['taille']=='XXL')
                {
                    $old_stock=$article_bd['stock_xxl'];
                    $new_stock=$old_stock-1;

                    $articlesTable = TableRegistry::get('Articles');
                    $article_maj = $articlesTable->get($id);
                    $article_maj->stock_xxl=$new_stock;
                    $articlesTable->save($article_maj);
                }

                $facture['commande']=$commande;


            }

            $facturesTable = TableRegistry::get('Factures');
            $new_facture = $facturesTable->newEntity();

            $new_facture->id_user = $this->Auth->user()['id'];
            $new_facture->commande = $commande;
            $new_facture->prix_total = $pxtot;

            if ($facturesTable->save($new_facture)) {
                $id = $new_facture->id;
            }

            $this->request->session()->delete('Panier');
            $this->request->session()->write('Panier.qte',0);
            $this->request->session()->write('Panier.prixtot',0);

            return $this->redirect(['controller'=> 'Homes', 'action' => 'index']);
        }




    }

    /**
     * Edit method
     *
     * @param string|null $id Facture id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $facture = $this->Factures->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $facture = $this->Factures->patchEntity($facture, $this->request->data);
            if ($this->Factures->save($facture)) {
                $this->Flash->success(__('The facture has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The facture could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('facture'));
        $this->set('_serialize', ['facture']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Facture id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $facture = $this->Factures->get($id);
        if ($this->Factures->delete($facture)) {
            $this->Flash->success(__('The facture has been deleted.'));
        } else {
            $this->Flash->error(__('The facture could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function facture($id_facture = null){

        $filename="facture";

        $query = $this->Factures->find('all', ['conditions'=> ['id' => $id_facture ]]);

        $result = $query->toArray();

        //debug($result);

        $id_client=$result[0]['id_user'];

        $this->loadModel('Users');
        $query_client = $this->Users->get($id_client);

        $client = $query_client->toArray();

        $this->loadModel('Pays');
        $query_pays = $this->Pays->get($client['id_pays']);

        $pays = $query_pays->toArray();

        $desc=$result[0]['commande'];
        $description_array=explode("€ ",$desc);

        

        //debug($description);


        $this->set('description',$description_array);
        $this->set('pays',$pays['nom']);
        $this->set('client',$client);
        $this->set('commande',$result[0]);



        $this->set('filename',$filename);

    }
}
