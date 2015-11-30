<nav class="large-2 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
          <li><?= $this->Html->link(__('Add Comment'), ['controller' => 'Comments', 'action' => 'Add',$article->article_id]) ?> </li>
        <li><?= $this->Html->link(__('Add Tag'), ['controller' => 'Tags', 'action' => 'Add',$article->article_id]) ?> </li>
        <li><?= $this->Html->link(__('Edit Article'), ['action' => 'edit', $article->article_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Article'), ['action' => 'delete', $article->article_id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->article_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Articles'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Article'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="articles view large-10 medium-8 columns content">
    <h3><?= h($article->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Article ID') ?></th>
            <td><?= h($article->article_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($article->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Author') ?></th>
            <td><?= $article->has('user') ? $this->Html->link($article->user->username, ['controller' => 'Users', 'action' => 'view', $article->user->user_id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($article->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($article->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($article->body)); ?>
    </div>
    <div class="row">
        <h4><?= __('Comments') ?></h4>
        <?php foreach ($article->comments as $comment): ?>
            <div class="commentrow">
                <h5 class="commentid"><?=$comment->user_id==null ? "Anonymous" : $users[$comment->user_id] ?> </h5>
                <p class="comment"><?= h($comment->body) ?></p>
            </div>
        <?php endforeach; ?>
        <?php
        if ($this->request->session()->read('Auth.User.role_id') == 1) {
            echo $this->element('v_article_uncomment_admin');
        }
        ?>
        </table>
    </div>
    <div class="row">
        <h4><?= __('Tags') ?> </h4>
        <?php foreach ($article->tags as $tag): ?>
        <p>
            <?= h($tag->name) ?>
        </p>
        <?php endforeach; ?>
    </div>
</div>
