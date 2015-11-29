<?php
    if ($this->request->session()->read('Auth.User.role_id') == 1){
        echo $this->element('sb_article_admin');
    } else if ($this->request->session()->read('Auth.User.role_id') == 2) {
        echo $this->element('sb_article_user');
    } else {
        echo $this->element('sb_article_nouser');
    }
?>

<div class="articles index large-10 medium-8 columns content">
    <h3><?= __('Articles') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('article_id') ?></th>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('comments') ?></th>
                <th><?= $this->Paginator->sort('tags') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
            <tr>
                <td><?= h($article->article_id) ?></td>
                <td><?= h($article->title) ?></td>
                <td><?= $article->has('user') ? $this->Html->link($article->user->username, ['controller' => 'Users', 'action' => 'view', $article->user->user_id]) : '' ?></td>
                <td><?= $article->comment_count ? $this->Html->link($article->comment_count, ['controller' => 'Comments', 'action' => 'index', $article->article_id]) : '0' ?></td>
                <td>
                <?php foreach ($article->tags as $tag): ?>
                <p class="tag"><?= $this->Html->link($tag->name, ['controller' => 'Tags', 'action' => 'index', $tag->tag_id]) ?></p>
                <?php endforeach; ?>
                </td>
                <td><?= h($article->created) ?></td>
                <td><?= h($article->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('AddComment'), ['controller'=>'Comments', 'action' => 'add', $article->article_id]) ?>
                    <?= $this->Html->link(__('View'), ['action' => 'view', $article->article_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $article->article_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $article->article_id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->article_id)]) ?>
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
