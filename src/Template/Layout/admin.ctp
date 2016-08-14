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
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <div class="top-bar-section">
            <ul class="left">
                <li><?php echo $this->Html->link('Utilisateurs', array('controller' => 'Users', 'action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link('Factures', array('controller' => 'Factures', 'action' => 'index')); ?></li>
                <li><?php echo $this->Html->link('Articles', array('controller' => 'Articles', 'action' => 'indexAdmin')); ?></li>
                <li><?php echo $this->Html->link('Clubs', array('controller' => 'Clubs', 'action' => 'index')); ?></li>
                <li><?php echo $this->Html->link('Pays', array('controller' => 'Pays', 'action' => 'index')); ?></li>
                <li><?php echo $this->Html->link('Fournisseurs', array('controller' => 'Fournisseurs', 'action' => 'index')); ?></li>
            </ul>
        </div>
        <div class="top-bar-section">
            <ul class="right">
                <li><?php echo $this->Html->link('Retour au site', array('controller' => 'Homes', 'action' => 'index')); ?></li>
                <li><?php echo $this->Html->link('Logout', array('controller' => 'Users', 'action' => 'logout')); ?></li>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
</body>
</html>
