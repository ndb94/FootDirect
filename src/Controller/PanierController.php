<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;



class PanierController extends AppController {
  
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index','add']);
    }


    public function add($id = null, $taille = null)
    {
        $_SESSION['panier'][]=$id;


    }
}
?>