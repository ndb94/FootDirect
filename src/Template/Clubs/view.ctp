<?php $this->layout = 'admin'; ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Club'), ['action' => 'edit', $club->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Club'), ['action' => 'delete', $club->id], ['confirm' => __('Are you sure you want to delete # {0}?', $club->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Clubs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Club'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="clubs view large-9 medium-8 columns content">
    <h3><?= h($club->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Nom') ?></th>
            <td><?= h($club->nom) ?></td>
        </tr>
        <tr>
            <th><?= __('Historique') ?></th>
            <td><?= h($club->historique) ?></td>
        </tr>
        <tr>
            <th><?= __('Logo') ?></th>
            <td><?= h($club->logo) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($club->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Popularite') ?></th>
            <td><?= $this->Number->format($club->popularite) ?></td>
        </tr>
        <tr>
            <th><?= __('Id Pays') ?></th>
            <td><?= $this->Number->format($club->id_pays) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($club->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($club->modified) ?></td>
        </tr>
    </table>
</div>
