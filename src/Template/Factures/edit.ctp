<?php $this->layout = 'admin'; ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $facture->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $facture->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Factures'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="factures form large-9 medium-8 columns content">
    <?= $this->Form->create($facture) ?>
    <fieldset>
        <legend><?= __('Edit Facture') ?></legend>
        <?php
            echo $this->Form->input('id_user');
            echo $this->Form->input('commande');
            echo $this->Form->input('prix_total');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
