<?php $this->layout = 'admin'; ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Article'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="articles index large-9 medium-8 columns content">
    <h3><?= __('Articles') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('libelle') ?></th>
                <th><?= $this->Paginator->sort('description') ?></th>
                <th><?= $this->Paginator->sort('prix') ?></th>
                <th><?= $this->Paginator->sort('photo') ?></th>
                <th><?= $this->Paginator->sort('id_club') ?></th>
                <th><?= $this->Paginator->sort('id_fournisseur') ?></th>
                <th><?= $this->Paginator->sort('stock_s') ?></th>
                <th><?= $this->Paginator->sort('stock_m') ?></th>
                <th><?= $this->Paginator->sort('stock_l') ?></th>
                <th><?= $this->Paginator->sort('stock_xl') ?></th>
                <th><?= $this->Paginator->sort('stock_xxl') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
            <tr>
                <td><?= $this->Number->format($article->id) ?></td>
                <td><?= h($article->libelle) ?></td>
                <td><?= h($article->description) ?></td>
                <td><?= $this->Number->format($article->prix) ?></td>
                <td><?= h($article->photo) ?></td>
                <td><?= $this->Number->format($article->id_club) ?></td>
                <td><?= $this->Number->format($article->id_fournisseur) ?></td>
                <td><?= $this->Number->format($article->stock_s) ?></td>
                <td><?= $this->Number->format($article->stock_m) ?></td>
                <td><?= $this->Number->format($article->stock_l) ?></td>
                <td><?= $this->Number->format($article->stock_xl) ?></td>
                <td><?= $this->Number->format($article->stock_xxl) ?></td>
                <td><?= h($article->created) ?></td>
                <td><?= h($article->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $article->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $article->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]) ?>
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
