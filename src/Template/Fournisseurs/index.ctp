<?php $this->layout = 'admin'; ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Fournisseur'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="fournisseurs index large-9 medium-8 columns content">
    <h3><?= __('Fournisseurs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('nom') ?></th>
                <th><?= $this->Paginator->sort('logo') ?></th>
                <th><?= $this->Paginator->sort('id_pays') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fournisseurs as $fournisseur): ?>
            <tr>
                <td><?= $this->Number->format($fournisseur->id) ?></td>
                <td><?= h($fournisseur->nom) ?></td>
                <td><?= h($fournisseur->logo) ?></td>
                <td><?= $this->Number->format($fournisseur->id_pays) ?></td>
                <td><?= h($fournisseur->created) ?></td>
                <td><?= h($fournisseur->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $fournisseur->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $fournisseur->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $fournisseur->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fournisseur->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
