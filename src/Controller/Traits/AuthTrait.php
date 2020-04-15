<?php
namespace App\Controller\Traits;

use App\Model\Entity\Company;
use App\Model\Entity\User;
use Authentication\Controller\Component\AuthenticationComponent;

/**
 * Trait AuthTrait
 * @package App\Controller\Traits
 * @property AuthenticationComponent $Authentication
 */
trait AuthTrait
{
    /**
     * @return User|\Authentication\IdentityInterface|null
     */
    protected function getUser()
    {
        return $this->Authentication->getIdentity();
    }

    protected function getCompany(): Company
    {
        return $this->Authentication->getIdentity()->company;
    }
}
