<?php $this->layout = 'admin'; ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $fournisseur->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $fournisseur->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Fournisseurs'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="fournisseurs form large-9 medium-8 columns content">
    <?= $this->Form->create($fournisseur) ?>
    <fieldset>
        <legend><?= __('Edit Fournisseur') ?></legend>
        <?php
            echo $this->Form->input('nom');
            echo $this->Form->input('logo');
            echo $this->Form->input('id_pays');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
