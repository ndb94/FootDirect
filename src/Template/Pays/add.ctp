<?php $this->layout = 'admin'; ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Pays'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="pays form large-9 medium-8 columns content">
    <?= $this->Form->create($pay) ?>
    <fieldset>
        <legend><?= __('Add Pay') ?></legend>
        <?php
            echo $this->Form->input('nom');
            echo $this->Form->input('drapeau');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
