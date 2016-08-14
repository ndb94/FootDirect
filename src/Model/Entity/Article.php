<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Article Entity
 *
 * @property int $id
 * @property string $libelle
 * @property string $description
 * @property float $prix
 * @property string $photo
 * @property int $id_club
 * @property int $id_fournisseur
 * @property int $stock_s
 * @property int $stock_m
 * @property int $stock_l
 * @property int $stock_xl
 * @property int $stock_xxl
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
        'id' => false
    ];
}
