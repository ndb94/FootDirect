<?php $this->layout = 'admin'; ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Article'), ['action' => 'edit', $article->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Article'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Articles'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Article'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="articles view large-9 medium-8 columns content">
    <h3><?= h($article->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Libelle') ?></th>
            <td><?= h($article->libelle) ?></td>
        </tr>
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($article->description) ?></td>
        </tr>
        <tr>
            <th><?= __('Photo') ?></th>
            <td><?= h($article->photo) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($article->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Prix') ?></th>
            <td><?= $this->Number->format($article->prix) ?></td>
        </tr>
        <tr>
            <th><?= __('Id Club') ?></th>
            <td><?= $this->Number->format($article->id_club) ?></td>
        </tr>
        <tr>
            <th><?= __('Id Fournisseur') ?></th>
            <td><?= $this->Number->format($article->id_fournisseur) ?></td>
        </tr>
        <tr>
            <th><?= __('Stock S') ?></th>
            <td><?= $this->Number->format($article->stock_s) ?></td>
        </tr>
        <tr>
            <th><?= __('Stock M') ?></th>
            <td><?= $this->Number->format($article->stock_m) ?></td>
        </tr>
        <tr>
            <th><?= __('Stock L') ?></th>
            <td><?= $this->Number->format($article->stock_l) ?></td>
        </tr>
        <tr>
            <th><?= __('Stock Xl') ?></th>
            <td><?= $this->Number->format($article->stock_xl) ?></td>
        </tr>
        <tr>
            <th><?= __('Stock Xxl') ?></th>
            <td><?= $this->Number->format($article->stock_xxl) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($article->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($article->modified) ?></td>
        </tr>
    </table>
</div>
