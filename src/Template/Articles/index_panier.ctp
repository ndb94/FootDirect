<?php 
?>
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
		<div class="col-xs-8 col-sm-8 col-md-8 ">
                <table class="table">
                    <tbody>
                        <?php
                        foreach($panier as $article)
                        { ?>
                            <tr>
                                <td><h2><?= $article['libelle']; echo ' - Taille '.$article['taille'] ?></h2>
                                    <p><?= $this->Html->image($article['photo'], array('width'=>'150px'));  ?></p>

                                </td>
                                <td><div class="well"><i><?= $article['description']; ?></i></div><br/>
                                    <?php echo $this->Form->create(null, ['url' => ['controller' => 'Articles', 'action' => 'supprimerArticle/'.$article['id'].'/'.$article['taille']], 'id'=> 'formSuppPanier', 'type' => 'post', 'class' => "form-horizontal"]); ?>
                                        <fieldset>
                                            <input name="id_article" id="id_article" type="hidden" value="<?= $article['id']?>">
                                            <input name="prix" id="prix" type="hidden" value="<?= $article['prix']?>">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="button1id"></label>
                                                <div class="col-md-8">
                                                    <?php $price = number_format($article['prix'], 2, '.', ' '); ?>
                                                <button id="prix" name="prix" class="btn btn-default disabled"><b><?= $price ?> €</b></button>
                                                <button id="supprimer" name="supprimer" type="submit" class="btn btn-danger">Supprimer du panier&nbsp;
                                                        <span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
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
			<div class="col-xs-4 col-sm-4 col-md-4 sidebar-offcanvas" id="sidebar">
				<div class="panel panel-default">
				<!-- Default panel contents -->
					<div class="panel-heading">Détails de la commande</div>
					<!-- Table -->
					<table class="table">
					<thead>
						<tr>
							<th>Article</th>
							<th>Taille</th>
							<th>Prix</th>
						</tr>
					</thead>
					<tbody>
							<?php
                    		foreach($panier as $article)
                    	 	{ ?>
	                    	<tr>
	                 			<td><?= $article['libelle']; ?></td>
	                 			<td><?= $article['taille']; ?></td>
	                 			<td><?= number_format($article['prix'], 2, '.', ' '); ?>  €</td>
	                       	</tr>
                     		<?php } ?>
                     		<tr>
	                 			<td><h4>Total du panier : </h4></td>
	                 			<td></td>
	                 			<td><h4><?= number_format($this->request->session()->read('Panier.prixtot'), 2, '.', ' '); ?> €</h4></td>
	                       	</tr>
	                       	<tr>
	                 			<td>
                 					<?php echo $this->Form->create(null, ['url' => ['controller' => 'Articles', 'action' => 'viderPanier'], 'id'=> 'formViderPanier', 'type' => 'post', 'class' => "form-horizontal"]); ?>
	                 					<fieldset>
									  		<button type="submit" class="btn btn-danger" >Vider le panier&nbsp;
                                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                                        </fieldset>
                                	</form>
								</td>

                                <?php if(isset($userData)){ ?>
                                    <td colspan="2">
                                        <?php echo $this->Form->create(null, ['url' => ['controller' => 'Factures', 'action' => 'addCommande'], 'id'=> 'formConfirmerCommande', 'type' => 'post', 'class' => "form-horizontal"]); ?>
                                            <fieldset>
                                                <button id="confirmer" name="confirmer" type="submit" class="btn btn-success">Confirmer l'achat&nbsp;
                                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
                                            </fieldset>
                                    </form>
                                    </td>
                                    <?php }else{ ?>
                                    <td colspan="2">
                                        <button type="button" class="btn btn-success disabled">Confirmer l'achat&nbsp;
                                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <button type="button" class="btn btn-success" data-toggle="modal"cdata-backdrop="false" href="#formSeconnecter">Connectez-vous pour passer votre commande&nbsp;
                                                <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span></button>
                                    </td>
                                </tr>
                                <?php }?>
	                       	</tr>
					</tbody>
					</table>
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

   </body>
   </html>


