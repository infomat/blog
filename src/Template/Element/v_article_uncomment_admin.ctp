 <h4><?= __('Unapproved Comments') ?></h4>
        <table cellpadding="0" cellspacing="0">
        <?php foreach ($article->unapproved_comments as $uncomment): ?>
            <tr>
            <div class="commentrow">
                <td class="large-10">
                <h5 class="commentid"><?=$uncomment->user_id==null ? "Anonymous" : $users[$uncomment->user_id] ?> </h5>
                <p class="comment"><?= h($uncomment->body) ?></p>
                </td>
                <td class="actions large-2">
                    <?= $this->Html->link(__('Approve'), ['controller'=>'comments','action' => 'approve', $uncomment->id]) ?>
                    <?= $this->Html->link(__('View'), ['controller'=>'comments','action' => 'view', $uncomment->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller'=>'comments','action' => 'edit', $uncomment->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller'=>'comments','action' => 'delete', $uncomment->comment_id], ['confirm' => __('Are you sure you want to delete # {0}?', $uncomment->id)]) ?>
                 </td>
            </div>
            </tr>
<?php endforeach; ?>