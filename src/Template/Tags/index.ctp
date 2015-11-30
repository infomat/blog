<nav class="large-2 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Tag'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tags'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Articles'), ['controller'=>'Articles','action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tags index large-10 medium-8 columns content">
    <h3><?= __('Tags') ?></h3>
    <table class="table" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th class="large-4"><?= $this->Paginator->sort('name') ?></th>
                <th class="large-6"><?=  __('Article Title') ?></th>
                <th class="actions large-2"><?= __('Actions') ?></th>
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
                <td class="actions">
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tag->tag_id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tag->tag_id], ['confirm' => __('Are you sure you want to delete # {0}?', $tag->tag_id)]) ?>
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
