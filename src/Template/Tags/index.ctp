<nav class="large-2 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Tag'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tag'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Article'), ['controller'=>'Articles','action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tags index large-10 medium-8 columns content">
    <h3><?= __('Tags') ?></h3>
    <table class="table" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th class="large-3"><?= $this->Paginator->sort('name') ?></th>
                <th class="large-9"><?=  __('Article Title') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tags as $tag): ?>
            <tr>
                <td><?= h($tag->name) ?></td>
                <td>
                <?php foreach ($tag->articles as $article): ?>
                <p class="tagarticle"><?= $this->Html->link($article->title, ['controller' => 'Articles', 'action' => 'view', $article->article_id]) ?></p>
                <?php endforeach; ?>
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
