<?php $this->layout = 'admin'; ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $article->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Articles'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="articles form large-9 medium-8 columns content">
    <?= $this->Form->create($article) ?>
    <fieldset>
        <legend><?= __('Edit Article') ?></legend>
        <?php
            echo $this->Form->input('libelle');
            echo $this->Form->input('description');
            echo $this->Form->input('prix');
            echo $this->Form->input('photo');
            echo $this->Form->input('id_club');
            echo $this->Form->input('id_fournisseur');
            echo $this->Form->input('stock_s');
            echo $this->Form->input('stock_m');
            echo $this->Form->input('stock_l');
            echo $this->Form->input('stock_xl');
            echo $this->Form->input('stock_xxl');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
