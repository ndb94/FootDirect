<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;



class HomesController extends AppController {
  
    
    public function index(){
        
        $this->loadModel('Pays');
        $query_pays = $this->Pays->find('all', ['fields'=>['id','nom']]);

        $results = $query_pays->toArray();

        
        foreach ($results as $row)
        {
            $listPays[$row['id']]=$row['nom'];
        }


        $this->loadModel('Users');
        $query = $this->Users->find('all');
        
        foreach ($query as $row)
        {
            $listMails[]=$row['mail'];
            $listUsernames[]=$row['username'];
        }
        

        $this->set('list_pays',$listPays);
        $this->set('logs',$listUsernames);
        $this->set('mails',$listMails);

        $var_user = $this->Auth->user();
        $this->set('the_user',$var_user);
              
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index']);
    }
}
?>