<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Articlestag Entity.
 *
 * @property int $article_id
 * @property \App\Model\Entity\Article $article
 * @property int $tag_id
 * @property \App\Model\Entity\Tag $tag
 */
class Articlestag extends Entity
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
        'tag_id' => false,
    ];
}
