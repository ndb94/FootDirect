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

$this->layout = false;

$cakeDescription = 'FootDirect.com';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icone.jpg','/img/icone.jpg',['type' => 'icon']) ?>
    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->css('starter-template.css') ?>
    <?= $this->Html->css('carousel.css') ?>
    <?= $this->Html->script('jquery') ?>
    <?= $this->Html->script('bootstrap') ?>
    
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="home">
    <header>
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
    </header>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img class="first-slide" src="./webroot/img/banniere.jpg" alt="First slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Bienvenue sur FootDirect.com</h1>
                        <p>Votre site de vente en ligne pour supporter votre équipe</p>
                        &nbsp;</br>
                        &nbsp;</br>
                        <p><div class="btn-group btn-group-lg" role="group" aria-label="groupe de boutons">
                            <button type="button" class="btn btn-default" data-toggle="modal"cdata-backdrop="false" href="#formulaire">Créer un compte</button>
                            <?php if(!isset($the_user)){ ?>
                                <button type="button" class="btn btn-default" data-toggle="modal"cdata-backdrop="false" href="#formSeconnecter">Se connecter</button>
                            <?php }?>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
            <div class="item">
                <img class="second-slide" <?= $this->Html->image('banniere_nike.jpg') ?> alt="Second slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Nike Football</h1>
                        <p>La collection 2016/2017 du géant américain</p>
                        <p><a class="btn btn-lg btn-default" href="/FootDirect/articles/index-for-marque/2" role="button">Voir</a></p>
                    </div>
                </div>
            </div>
            <div class="item">
                <img class="third-slide" <?= $this->Html->image('banniere_juve.jpg') ?> alt="Third slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Juventus 2016/2017</h1>
                        <p><a class="btn btn-lg btn-default" href="/FootDirect/articles/index/2" role="button">Découvrez la nouvelle collection du club italien</a></p>
                    </div>
                </div>
            </div>
        </div>
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>       
    <div class="container marketing">
        <!-- Three columns of text below the carousel -->
        <div class="row">
            <div class="col-lg-4">
                <img class="img-circle" src="./webroot/img/maillot_accueil.jpg" alt="Generic placeholder image" width="140" height="140">
                <h2>Nos articles</h2>
                <p>Notre séléction de maillots</p>
                <p><a class="btn btn-default" href="./articles" role="button">Trouvez votre maillot &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <img class="img-circle" src="./webroot/img/delivery.jpg" alt="Generic placeholder image" width="140" height="140">
                <h2>Livraison offerte</h2>
                <p>FootDirect.com vous assure une livraison express et un retour gratuit</p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <img class="img-circle" src="./webroot/img/admin.jpg" alt="Generic placeholder image" width="140" height="140">
                <h2>Administration</h2>
                <p>Partie destinée à l'administration de FootDirect.com</p>
                <p><a class="btn btn-default" role="button" data-toggle="modal"cdata-backdrop="false" href="/FootDirect/users/login">S'identifier &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
        <div class="modal fade" id="formulaire">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">x</button>
                        <h4 class="modal-title">Vos coordonnées :</h4>
                    </div>
                    <div class="modal-body">
                        <iframe width="0" height="0" border="0" border="none" name="dummyframe" id="dummyframe" ></iframe>&nbsp;Vous êtes nouveau ?
                            <?php echo $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'add'], 'id'=> 'formCreation', 'type' => 'post', 'class' => "form-horizontal", 'target' => "dummyframe"]); ?>
                            <fieldset>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="nom">Nom :</label>  
                                <div class="col-md-4">
                                    <input id="nom" name="nom" placeholder="Votre nom" class="form-control input-md" required="" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="prenom">Prénom :</label>  
                                <div class="col-md-4">
                                    <input id="prenom" name="prenom" placeholder="Votre prénom" class="form-control input-md" required="" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="mail">Adresse email :</label>  
                                <div class="col-md-5">
                                    <div class="verifMail">
                                        <input id="mail" name="mail" placeholder="Votre adresse email" class="form-control input-md" required="" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="login">Username :</label>  
                                <div class="col-md-4">
                                    <div class="verifLogin">
                                        <input id="username" name="username" placeholder="Choisissez un login" class="form-control input-md" required="" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="password">Mot de passe :</label>
                                <div class="col-md-5">
                                    <div class="verifPassword">
                                        <input id="password" name="password" placeholder="Choisissez un mot de passe" class="form-control input-md" required="" type="password">
                                        <span class="help-block">Minimum 8 caractères</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="rue">Rue :</label>  
                                <div class="col-md-4">
                                    <input id="rue" name="rue" placeholder="Votre rue" class="form-control input-md" required="" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="numero">Numéro :</label>  
                                <div class="col-md-3">
                                    <input id="numero" name="numero" placeholder="Votre numéro" class="form-control input-md" required="" type="number">
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="localite">Localité :</label>  
                                <div class="col-md-4">
                                    <input id="localite" name="localite" placeholder="Votre localité" class="form-control input-md" required="" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="codepostal">Code Postal :</label>  
                                <div class="col-md-3">
                                    <input id="codepostal" name="codepostal" placeholder="Votre code postal" class="form-control input-md" required="" type="number">
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="pays">Pays :</label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->select('id_pays',$list_pays); ?>
                                </div>
                            </div>
                            <input type='hidden' id='role' name='role' value='client'>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="envoyer"></label>
                                <div class="col-md-8">
                                    <button id="envoyer" name="envoyer" type="submit" class="btn btn-success">Terminer</button>
                                    <button id="reset" name="reset" type="reset" class="btn btn-danger">Annuler</button>
                                </div>
                            </div>
                            </fieldset>
                        <?php echo $this->Form->end(); ?> 
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="formSeconnecter">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">x</button>
                        <h4 class="modal-title">Se connecter</h4>
                    </div>
                    <div class="modal-body">
                            <?php echo $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'login'], 'id'=> 'formSeconnecter', 'type' => 'post', 'class' => "form-horizontal"]); ?>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="username">Login :</label>  
                                    <div class="col-md-4">
                                        <input id="username" name="username" placeholder="Votre login" class="form-control input-md" required="" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="password">Mot de passe :</label>
                                    <div class="col-md-4">
                                        <input id="password" name="password" placeholder="Votre mot de passe" class="form-control input-md" required="" type="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="connect"></label>
                                    <div class="col-md-4">
                                        <button id="connect" name="connect" type="submit" class="btn btn-success">Se connecter</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            $(function(){
                $("#formCreation").on("submit", function() {
                    var jsLogs = JSON.parse('<?php echo JSON_encode($logs);?>');
                    var jsMails = JSON.parse('<?php echo JSON_encode($mails);?>');                  
                    //vérification du mot de passe
                    $("div.verifLogin").removeClass("has-error");
                    $("div.verifMail").removeClass("has-error");
                    
                    if($("#password").val().length < 8) {
                        $("div.verifPassword").addClass("has-error");
                        $("div.alert").show("slow").delay(4000).hide("slow");
                        return false;
                    }else{
                        $("div.verifPassword").removeClass("has-error");
                    }             
                    //vérification du login
                    var i=0;
                    var flagLog=0;
                    var cptLog=jsLogs.length;
                    while(i<=cptLog&&flagLog===0){
                        
                        if($("#username").val()==jsLogs[i])
                        {
                            $("div.verifLogin").addClass("has-error");
                            alert('Désolé mais ce login est déjà utilisé.');
                            flagLog=1;
                            return false;
                        }
                        else{
                            i++;
                        }
                        
                    }         
                    //vérification du mail
                    var j=0;
                    var flagMail=0;
                    var cptMail=jsMails.length;
                    while(j<=cptMail&&flagMail===0){
                        
                        if($("#mail").val()==jsMails[j])
                        {
                            $("div.verifMail").addClass("has-error");
                            alert('Désolé mais ce mail est déjà associé à un compte.');
                            flagMail=1;
                            return false;
                        }
                        else{
                            j++;
                        }
                        
                    }

                    alert('Votre compte a été créé avec succès.');
                    $('#formulaire').modal('hide');
                    
                });
            });        
        </script>

        
        <!-- FOOTER -->
        <footer>
            <p class="pull-right"><a href="#">Back to top</a></p>
            <p>&copy; 2016 FootDirect.com, Nicolas Del Borrello. &middot;</p>
        </footer>
    </div>
</body>       
</html>
