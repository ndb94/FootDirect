<?php
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Controller\Controller;
use App\Controller\AppController; 
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;

//$this->layout = false;

$cakeDescription = 'FootDirect.com';

//debug($jumbo);
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->css('offcanvas.css') ?>
    <?= $this->Html->script('jquery') ?>
    <?= $this->Html->script('bootstrap') ?>
    
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container">
        <div class="row row-offcanvas row-offcanvas-right">
            <div class="col-xs-2 col-sm-2 col-md-2 sidebar-offcanvas" id="sidebar">
                <div class="list-group">
                    <a href="./articles" class="list-group-item active">Toutes les marques</a>
                    <?php foreach($marques as $marque){ ?>
                        <a href="/FootDirect/articles/index-for-marque/<?= $marque['id'] ?>" class="list-group-item"><?= $this->Html->image($marque['logo'], array('width'=>'25px'));?> &nbsp; <?= $marque['nom'];?></a>
                    <?php } ?>
                </div>
                <?php //echo $this->Html->image('player.jpg', array('width'=>'150px'));?>
            </div><!--/.sidebar-offcanvas-->

            <div class="col-xs-8 col-sm-8 col-md-8 ">
                <div class="jumbotron">
                    <h1><?= $jumbo['nom'] ?> <?php if(isset($jumbo['drapeau'])){ echo $this->Html->image("flags/".$jumbo['drapeau'], array('width'=>'50px')); }?> </h1>
                    <?php if(isset($jumbo['popu'])){ for($i=0;$i<$jumbo['popu'];$i++){
                         echo $this->Html->image('star.jpg', array('width'=>'25px'));
                    }}?>
                </div>
                <table class="table">
                    <tbody>
                        <?php
                        foreach($results as $article)
                        { ?>
                            <tr>
                                <td><h2><?= $article['libelle']?></h2>
                                    <p><?= $this->Html->image($clubs[$article['id_club']-2]['logo'], array('width'=>'100px')); echo $this->Html->image($article['photo'], array('width'=>'150px'));  ?></p>

                                </td>
                                <td><div class="well"><i><?= $article['description']; ?></i></div><br/>
                                    <?php if($article['stock_s']==0){?><span class="glyphicon glyphicon-alert" aria-hidden="true"></span>  Taille S en rupture de stock<?php } ?><br/>
                                    <?php if($article['stock_m']==0){?><span class="glyphicon glyphicon-alert" aria-hidden="true"></span>  Taille M en rupture de stock<?php } ?><br/>
                                    <?php if($article['stock_l']==0){?><span class="glyphicon glyphicon-alert" aria-hidden="true"></span>  Taille L en rupture de stock<?php } ?><br/>
                                    <?php if($article['stock_xl']==0){?><span class="glyphicon glyphicon-alert" aria-hidden="true"></span>  Taille XL en rupture de stock<?php } ?><br/>
                                    <?php if($article['stock_xxl']==0){?><span class="glyphicon glyphicon-alert" aria-hidden="true"></span>  Taille XXL en rupture de stock<?php } ?>
                                    <?php echo $this->Form->create(null, ['url' => ['controller' => 'Articles', 'action' => 'addPanier'], 'id'=> 'formAddPanier', 'type' => 'post', 'class' => "form-horizontal"]); ?>
                                        <fieldset>
                                            <input name="id_article" id="id_article" type="hidden" value="<?= $article['id']?>">
                                            <input name="prix" id="prix" type="hidden" value="<?= $article['prix']?>">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="select_taille">Choisissez votre taille :</label>
                                                <div class="col-md-4">
                                                    <select id="select_taille" name="select_taille" class="form-control">
                                                        <?php if($article['stock_s'] > 0){?><option value="S">Taille S</option> <?php } ?>
                                                        <?php if($article['stock_m'] > 0){?><option value="M">Taille M</option> <?php } ?>
                                                        <?php if($article['stock_l'] > 0){?><option value="L">Taille L</option> <?php } ?>
                                                        <?php if($article['stock_xl'] > 0){?><option value="XL">Taille XL</option> <?php } ?>
                                                        <?php if($article['stock_xxl'] > 0){?><option value="XXL">Taille XXL</option> <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="button1id"></label>
                                                <div class="col-md-8">
                                                    <?php $price = number_format($article['prix'], 2, '.', ' '); ?>
                                                <button id="prix" name="prix" class="btn btn-default disabled"><b><?= $price ?> €</b></button>
                                                <button id="ajouter" name="ajouter" type="submit" class="btn btn-success">Ajouter au panier&nbsp;
                                                        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div><!--/.col-xs-12.col-sm-9-->

            <div class="col-xs-2 col-sm-2 col-md-2 sidebar-offcanvas" id="sidebar">
                <div class="list-group">
                    <a href="/FootDirect/articles" class="list-group-item active">Tous les clubs</a>
                    <?php foreach($clubs as $club){ ?>
                        <a href="/FootDirect/articles/index/<?= $club['id']?>" class="list-group-item"><?= $this->Html->image($club['logo'], array('width'=>'25px'));?> &nbsp; <?= $club['nom'];?></a>
                    <?php } ?>
                </div>
            </div><!--/.sidebar-offcanvas-->
        </div><!--/row-->
        <footer>
            <p>&copy; 2016 Company, Inc.</p>
        </footer>

    </div><!--/.container-->
</body>
</html>

