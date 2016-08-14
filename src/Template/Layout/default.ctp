<?php

$cakeDescription = 'FootDirect.com';

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icone.jpg','/img/icone.jpg',['type' => 'icon']) ?>
    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->css('starter-template.css') ?>
    <?= $this->Html->script('jquery') ?>
    <?= $this->Html->script('bootstrap') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <!--Barre de navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/FootDirect">FootDirect.com</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><?php echo $this->Html->link('La collection', array('controller' => 'Articles', 'action' => 'index')); ?></li>
                        <li><?php echo $this->Html->link('Qui sommes-nous ?', array('controller' => 'Homes', 'action' => 'contacts')); ?></li>
                    </ul>
                    <?php if($this->request->session()->read('Panier.qte')==0)
                    {?>
                    <form class="navbar-form navbar-right">
                        <a href="./articles/index-panier" class="btn btn-primary disabled">Panier vide</a>
                    </form>

                    <?php }else{ ?>
                    <form class="navbar-form navbar-right">
                        <a href="./articles/index-panier" class="btn btn-success">Voir le panier&nbsp;
                            <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                            <?php $prix_total = number_format($this->request->session()->read('Panier.prixtot'), 2, '.', ' '); ?>
                            <?php if($prix_total>0){ ?> <b> <?= $prix_total ?> €</b> <?php }?></a>
                    </form>
                    <?php } ?>
                    <?php if(isset($userData)){ ?> 
                        <ul class="nav navbar-nav navbar-right">
                            <?php if($userData['role']=='admin'){ ?>
                                <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo 'Connecté en tant que ' .$userData['username'] ?><span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><?php echo $this->Html->link('Admnistration', array('controller' => 'Users', 'action' => 'index')); ?></li>
                                    <li role="separator" class="divider"></li>
                                    <li><?php echo $this->Html->link('Se déconnecter', array('controller' => 'Users', 'action' => 'logout')); ?></li>
                                </ul>
                            </li>
                            <?php } else{ ?>
                            <li><a class="navbar-brand"><?php echo 'Bonjour '.$userData['username']; ?></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mon Compte <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><?php echo $this->Html->link('Mes coordonées', array('controller' => 'Users', 'action' => 'edit', $userData['id'])); ?></li>
                                    <li><?php echo $this->Html->link('Mes commandes', array('controller' => 'Users', 'action' => 'commandes', $userData['id'])); ?></li>
                                    <li role="separator" class="divider"></li>
                                    <li><?php echo $this->Html->link('Se déconnecter', array('controller' => 'Users', 'action' => 'logout')); ?></li>
                                </ul>
                            </li>
                            <?php } ?>
                        </ul>
                    <?php }?>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    <!--/Barre de navigation -->
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
</body>
</html>
