<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Article Entity.
 *
 * @property int $article_id
 * @property \App\Model\Entity\Article $article
 * @property string $title
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property string $body
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Article extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'article_id' => false,
    ];
}
