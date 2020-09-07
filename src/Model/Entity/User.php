<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\IdentityInterface;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;
use Cake\Utility\Text;

/**
 * User Entity
 *
 * @property string $id
 * @property string $name
 * @property string $last_name
 * @property string $username
 * @property string $password
 * @property string|null $api_token
 * @property string|null $role
 * @property string|null $company_id
 *
 * @property \App\Model\Entity\Company $company
 */
class User extends Entity implements IdentityInterface
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
        'last_name' => true,
        'username' => true,
        'password' => true,
        'api_token' => true,
        'role' => true,
        'company_id' => true,
        'company' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

    public function _setId()
    {
        $this->id = Text::uuid();
    }

    public function _setPassword(string $password)
    {
        return (new DefaultPasswordHasher())->hash($password);
    }

    public function getIdentifier()
    {
        return $this->id;
    }

    public function getOriginalData()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

}
