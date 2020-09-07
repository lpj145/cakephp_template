<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\CompaniesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\CompaniesController Test Case
 *
 * @uses \App\Controller\CompaniesController
 */
class CompaniesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Companies',
        'app.Users',
    ];
}
