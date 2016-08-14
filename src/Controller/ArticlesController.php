<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 */
class ArticlesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index','indexForMarque','view','addPanier','indexPanier','viderPanier','supprimerArticle']);
    }

    public function index($idClub=null)
    {
        $this->loadModel('Clubs');
        $query_clubs = $this->Clubs->find('all');
        $results_clubs = $query_clubs->toArray();

        $this->set('clubs',$results_clubs);

        $this->loadModel('Fournisseurs');
        $query_marques = $this->Fournisseurs->find('all');
        $results_marques = $query_marques->toArray();

        $this->set('marques',$results_marques);

        $jumbo=[];


        if(isset($idClub))
        {
            $query = $this->Articles->find('all', ['conditions' => ['id_club' => $idClub]]);
            $results = $query->toArray();

            $jumbo['nom']=$results_clubs[$idClub-2]['nom'];
            $jumbo['popu']=$results_clubs[$idClub-2]['popularite'];

            $this->loadModel('Pays');
            $query_pays= $this->Pays->find('all', ['conditions' => ['id' => $results_clubs[$idClub-2]['id_pays']]]);
            $results_pays = $query_pays->toArray();

            $jumbo['drapeau']=$results_pays[0]['drapeau'];
        }
        else
        {
            $query = $this->Articles->find('all');
            $results = $query->toArray();

            $jumbo['nom']='Collections 2016/2017';
        }

        $this->set('jumbo',$jumbo);

        $this->set('results',$results);

    }

    public function indexForMarque($idFourn = null)
    {
        $this->loadModel('Clubs');
        $query_clubs = $this->Clubs->find('all');
        $results_clubs = $query_clubs->toArray();

        $this->set('clubs',$results_clubs);

        $this->loadModel('Fournisseurs');
        $query_marques = $this->Fournisseurs->find('all');
        $results_marques = $query_marques->toArray();

        $this->set('marques',$results_marques);

        $jumbo=[];


        if(isset($idFourn))
        {
            $query = $this->Articles->find('all', ['conditions' => ['id_fournisseur' => $idFourn]]);
            $results = $query->toArray();

            $jumbo['nom']=$results_marques[$idFourn-1]['nom'];

            $this->loadModel('Pays');
            $query_pays= $this->Pays->find('all', ['conditions' => ['id' => $results_marques[$idFourn-1]['id_pays']]]);
            $results_pays = $query_pays->toArray();

            $jumbo['drapeau']=$results_pays[0]['drapeau'];
        }
        else
        {
            $query = $this->Articles->find('all');
            $results = $query->toArray();

            $jumbo['nom']='Collections 2016/2017';
        }

        $this->set('jumbo',$jumbo);

        $this->set('results',$results);

    }    

    

    public function indexAdmin()
    {
        $articles = $this->paginate($this->Articles);

        $this->set(compact('articles'));
        $this->set('_serialize', ['articles']);
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => []
        ]);

        $this->set('article', $article);
        $this->set('_serialize', ['article']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->data);
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'indexAdmin']);
            } else {
                $this->Flash->error(__('The article could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('article'));
        $this->set('_serialize', ['article']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->data);
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The article could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('article'));
        $this->set('_serialize', ['article']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
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

    public function addPanier(){

        
        if ($this->request->is('post')) {

            $old_qte=$this->request->session()->read('Panier.qte');
            $old_pt=$this->request->session()->read('Panier.prixtot');


            $choix_article = $this->request->data['id_article'];
            $choix_taille = $this->request->data['select_taille'];
            $choix_prix = $this->request->data['prix'];

            $i=$old_qte+1;

            $this->request->session()->write('Panier.qte', $i);
            $this->request->session()->write('Panier.prixtot', $old_pt+$choix_prix);
            $this->request->session()->write('Panier.article'.$i, array('id_article' => $choix_article, 'taille' => $choix_taille));

            return $this->redirect(['action' => 'index']);
            
        }

    }


    public function indexPanier(){

        $i=1;

        $qte_panier=$this->request->session()->read('Panier.qte');

        for($i=1;$i<=$qte_panier;$i++)
        {

            $articles[] = $this->request->session()->read('Panier.article'.$i);
        }

        for($j=0;$j<$qte_panier;$j++)
        {
            $id = $articles[$j]['id_article'];
            $taille = $articles[$j]['taille'];
            $this->loadModel('Articles');
            $article = $this->Articles->get($id);
            $article['taille'] = $taille; 
            $panier[]= $article;
        }

        

        $this->set('qte_panier',$qte_panier);
        $this->set('panier',$panier);


    }

    public function viderPanier()
    {
        
        $this->request->session()->delete('Panier');
        $this->request->session()->write('Panier.qte',0);
        $this->request->session()->write('Panier.prixtot',0);

        return $this->redirect(['action' => 'index']);

    }

    public function supprimerArticle($id = null, $taille = null)
    {

        if ($this->request->is('post')) {

            $qte=$this->request->session()->read('Panier.qte');
            $old_pt=$this->request->session()->read('Panier.prixtot');

            $j=0;
            $flag=0;
            $indice=0;

            for($i=1;$i<=$qte;$i++)
            {

                $test[] = $this->request->session()->read('Panier.article'.$i);
                $id_test = $test[$j]['id_article'];
                $taille_test = $test[$j]['taille'];

                $t=strtoupper(preg_replace('/[-]/','',$taille));


                if($id_test==$id&&$taille_test==strtoupper($t))
                {
                    $article=$this->Articles->get($id);
                    $prix_article = $article['prix'];

                    $this->request->session()->delete('Panier.article'.$i);

                    $new_qte=$qte-1;
                    $this->request->session()->write('Panier.qte',$new_qte);

                    $new_pt=$old_pt-$prix_article;
                    $this->request->session()->write('Panier.prixtot',$new_pt);

                    $flag=1;
                    $indice=$i;

                }

                $j++;
            }

            if($flag==1&&$new_qte>0)
            {
                $old_panier = $this->request->session()->read('Panier');
                $new_pt=$this->request->session()->read('Panier.prixtot');

                $this->request->session()->write('Panier.qte',$new_qte);
                $this->request->session()->write('Panier.prixtot',$new_pt);


                for($k=$indice;$k<$new_qte+1;$k++)
                {
                    $y=$k+1;

                    $art=$this->request->session()->read('Panier.article'.$y);
                    

                    $this->request->session()->delete('Panier.article'.$y);

                    $this->request->session()->write('Panier.article'.$k, 
                        array('id_article' => $art['id_article'], 'taille' => $art['taille']));
                }

                return $this->redirect(['action' => 'indexPanier']);

            }else
            {
                return $this->redirect(['action' => 'index']);

            }
        }

    }

}
