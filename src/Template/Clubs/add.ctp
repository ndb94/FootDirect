<?php $this->layout = 'admin'; ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Clubs'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="clubs form large-9 medium-8 columns content">
    <?= $this->Form->create($club) ?>
    <fieldset>
        <legend><?= __('Add Club') ?></legend>
        <?php
            echo $this->Form->input('nom');
            echo $this->Form->input('historique');
            echo $this->Form->input('popularite');
            echo $this->Form->input('logo');
            echo $this->Form->input('id_pays');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
