<?php $this->layout = 'admin'; ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Facture'), ['action' => 'edit', $facture->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Facture'), ['action' => 'delete', $facture->id], ['confirm' => __('Are you sure you want to delete # {0}?', $facture->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Factures'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Facture'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="factures view large-9 medium-8 columns content">
    <h3><?= h($facture->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Commande') ?></th>
            <td><?= h($facture->commande) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($facture->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Id User') ?></th>
            <td><?= $this->Number->format($facture->id_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Prix Total') ?></th>
            <td><?= $this->Number->format($facture->prix_total) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($facture->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($facture->modified) ?></td>
        </tr>
    </table>
</div>
