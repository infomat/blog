<nav class="large-2 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Comments'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Articles'), ['controller' => 'Articles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Article'), ['controller' => 'Articles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="comments form large-10 medium-8 columns content">
    <h3>Article: <?= h($article->title) ?></h3>
    <?= $this->Form->create($comment) ?>
    <fieldset>
        <legend><?= __('Add Comment') ?></legend>
        <?php
            echo $this->Form->input('body',['label' => 'Comment']);
//Todo Admin is needed            echo $this->Form->input('isApproved');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
