<?php $date_commande = $commande['created']->format('d-m-Y H:i:s'); ?>

<h1><em>FootDirect.com</em></h1>
<h4>Grands Près - Mons</h4>
<h4>065/12.34.56</h4>
<h3 style="text-align: right;"><?= $client['prenom']; ?> <?= $client['nom']; ?></h3>
<h3 style="text-align: right;"><?= $client['rue']; ?>, <?= $client['numero']; ?></h3>
<h3 style="text-align: right;"><?= $client['codepostal']; ?> <?= $client['localite']; ?></h3>
<h3 style="text-align: right;"><?= $pays; ?></h3>
<h2 style="text-align: center;">D&eacute;tails de la commande</h2>
<h4 style="text-align: left;">&nbsp;</h4>
<h4 style="text-align: left;">Num&eacute;ro de Facture : <?= $commande['id']; ?></h4>
<h4 style="text-align: left;">Num&eacute;ro de Client : <?= $client['id']; ?></h4>
<h4 style="text-align: left;">Date de la commande : <?= $date_commande; ?></h4>
</br>
<h3>R&eacute;capitulatif de la commande</h3>
<table style="height: 47px;" width="550">
    <thead>
        <tr>
            <th>________________________</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($description as $ligne) { ?>
        <tr>
                <td></td>
        </tr>
        <tr>
                <td><?= $ligne ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<p>&nbsp;</p>
<h4 style="text-align: right;">Montant total &agrave; payer : <?= number_format($commande['prix_total'], 2, '.', ' '); ?> &euro;</h4>
<p><em>En votre aimable r&egrave;glement,</em></p>
<p><em>Cordialement,</em></p>
<p>&nbsp;</p>
<p>L'&eacute;quipe de FootDirect.com</p>