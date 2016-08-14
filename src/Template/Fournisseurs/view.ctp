<?php $this->layout = 'admin'; ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Fournisseur'), ['action' => 'edit', $fournisseur->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Fournisseur'), ['action' => 'delete', $fournisseur->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fournisseur->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Fournisseurs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fournisseur'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="fournisseurs view large-9 medium-8 columns content">
    <h3><?= h($fournisseur->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Nom') ?></th>
            <td><?= h($fournisseur->nom) ?></td>
        </tr>
        <tr>
            <th><?= __('Logo') ?></th>
            <td><?= h($fournisseur->logo) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($fournisseur->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Id Pays') ?></th>
            <td><?= $this->Number->format($fournisseur->id_pays) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($fournisseur->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($fournisseur->modified) ?></td>
        </tr>
    </table>
</div>
