<?php
/**
 * Created by PhpStorm.
 * User: Marquinho
 * Date: 18/01/2020
 * Time: 23:59
 */

namespace App\Exception;


use Cake\ORM\Exception\PersistenceFailedException;

final class ValidationException extends PersistenceFailedException
{

}