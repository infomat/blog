<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Comments'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Articles'), ['controller' => 'Articles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Article'), ['controller' => 'Articles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="comments form large-9 medium-8 columns content">
    <?= $this->Form->create($comment) ?>
    <fieldset>
        <legend><?= __('Add Comment') ?></legend>
        <?php
            echo $this->Form->input('body');
            echo $this->Form->input('isApproved');
            echo $this->Form->input('author');
            echo $this->Form->input('article_id', ['options' => $articles, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
