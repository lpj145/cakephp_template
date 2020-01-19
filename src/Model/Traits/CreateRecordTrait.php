<?php
declare(strict_types=1);

namespace App\Model\Traits;

use App\Exception\PersistenceException;
use App\Exception\ValidationException;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Exception\PersistenceFailedException;
use Cake\Utility\Text;

/**
 * Trait CreateHelp
 * @package Model\Traits
 * @method EntityInterface get($primaryKey, $options = [])
 * @method EntityInterface newEntity($data = null, array $options = [])
 * @method EntityInterface[] newEntities(array $data, array $options = [])
 * @method EntityInterface|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method EntityInterface saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method EntityInterface patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method EntityInterface[] patchEntities($entities, array $data, array $options = [])
 * @method EntityInterface findOrCreate($search, callable $callback = null, $options = [])
 */
trait CreateRecordTrait
{
    /**
     * @param $requestData
     * @param array $options
     * @param string $messageValidation
     * @return EntityInterface
     */
    public function instanceAndValidate($requestData, $options = [], string $messageValidation = ''): EntityInterface
    {
        $entity = $this->newEntity(
            $requestData,
            $options
        );

        if ($entity->hasErrors()) {
            throw new ValidationException($entity, $messageValidation);
        }

        return $entity;
    }

    /**
     * @param EntityInterface $entity
     * @param bool $generateUuid
     * @param string $messageValidation
     * @return EntityInterface
     */
    public function createOrFail(EntityInterface $entity, bool $generateUuid = true, string $messageValidation = '')
    {
        if ($generateUuid) {
            $this->setUuidIfNull($entity);
        }

        try {
            $this->saveOrFail($entity);
        } catch (PersistenceFailedException $exception) {
            throw new PersistenceException($entity, $messageValidation);
        }

        return $entity;
    }

    protected function setUuidIfNull(EntityInterface $entity, string $propertyName = 'id')
    {
        if (is_null($entity->get($propertyName))) {
            $entity->set($propertyName, Text::uuid());
        }

        return $entity;
    }
}