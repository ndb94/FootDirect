<?php $this->layout = 'admin'; ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Club'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="clubs index large-9 medium-8 columns content">
    <h3><?= __('Clubs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('nom') ?></th>
                <th><?= $this->Paginator->sort('historique') ?></th>
                <th><?= $this->Paginator->sort('popularite') ?></th>
                <th><?= $this->Paginator->sort('logo') ?></th>
                <th><?= $this->Paginator->sort('id_pays') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clubs as $club): ?>
            <tr>
                <td><?= $this->Number->format($club->id) ?></td>
                <td><?= h($club->nom) ?></td>
                <td><?= h($club->historique) ?></td>
                <td><?= $this->Number->format($club->popularite) ?></td>
                <td><?= h($club->logo) ?></td>
                <td><?= $this->Number->format($club->id_pays) ?></td>
                <td><?= h($club->created) ?></td>
                <td><?= h($club->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $club->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $club->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $club->id], ['confirm' => __('Are you sure you want to delete # {0}?', $club->id)]) ?>
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
