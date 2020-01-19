<?php
/**
 * Created by PhpStorm.
 * User: Marquinho
 * Date: 18/01/2020
 * Time: 23:59
 */

namespace App\Exception;


use Cake\Datasource\EntityInterface;
use Cake\ORM\Entity;
use Throwable;

class PersistenceException extends \RuntimeException
{
    /**
     * @var Entity
     */
    private $entity;

    private $defaultCode = 400;

    public function __construct(
        EntityInterface $entity,
        string $message = "",
        Throwable $previous = null
    )
    {
        parent::__construct($message, $this->defaultCode, $previous);
        $this->entity = $entity;
    }

    public function getErrors()
    {
        return $this->entity->getErrors();
    }

    public function getInvalids()
    {
        return $this->entity->getInvalid();
    }

    /**
     * @return Entity
     */
    public function getEntity()
    {
        return $this->entity;
    }
}