<?php 
use Cake\I18n\Date;

?>
<div class="container">
	<div class="row row-offcanvas row-offcanvas-right">
		<div class="col-xs-12 col-sm-12 col-md-12 ">
			<div class="panel panel-default">
				<div class="panel-body text-center">
					<h4>Vos commandes</h4>
				</div>
			</div>
			<table class="table table-hover">
    <thead>
      <tr>
        <th>Date d'achat</th>
        <th>Description</th>
        <th>Prix total</th>
        <th>Voir Facture</th>
      </tr>
    </thead>
    <tbody>
    	<?php 
    	if($commandes==null)
    	{ ?> 
    	<tr>
        <td colspan="4">Aucune commande</td>
      	</tr>
      	<?php }
      	else{ 
      		foreach($commandes as $commande)
      			{ 
      				$date_commande = $commande['created']->format('d-m-Y H:i:s'); ?>
      				<tr>
				        <td><?= $date_commande;?></td>
				        <td><?= $commande['commande'];?></td>
				        <td><?= number_format($commande['prix_total'], 2, '.', ' ');?>€</td>
				        <td style="text-align: center;"><a href="/FootDirect/factures/facture/<?= $commande['id']?>.pdf"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></td>
			      	</tr>
			      	<?php 
			    } 
			}?>
    </tbody>
  </table>





		</div>
	</div>
</div>
