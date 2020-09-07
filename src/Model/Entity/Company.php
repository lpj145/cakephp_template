<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Company Entity
 *
 * @property string $id
 * @property string $name
 * @property string $cnpj
 * @property string $ie
 * @property string|null $address
 * @property string|null $city
 * @property string|null $state
 * @property bool $active
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime|null $modified_at
 *
 * @property \App\Model\Entity\User[] $users
 */
class Company extends Entity
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
        'name' => true,
        'cnpj' => true,
        'ie' => true,
        'address' => true,
        'city' => true,
        'state' => true,
        'active' => true,
        'created_at' => true,
        'modified_at' => true,
        'users' => true,
    ];
}
