<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->user_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->user_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->user_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $user->has('user') ? $this->Html->link($user->user->user_id, ['controller' => 'Users', 'action' => 'view', $user->user->user_id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th><?= __('Role') ?></th>
            <td><?= h($user->role) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
    </table>
</div>
