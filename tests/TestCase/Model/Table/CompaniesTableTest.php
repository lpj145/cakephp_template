<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CompaniesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CompaniesTable Test Case
 */
class CompaniesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CompaniesTable
     */
    protected $Companies;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Companies',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Companies') ? [] : ['className' => CompaniesTable::class];
        $this->Companies = TableRegistry::getTableLocator()->get('Companies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Companies);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test instanceAndValidate method
     *
     * @return void
     */
    public function testInstanceAndValidate(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test createOrFail method
     *
     * @return void
     */
    public function testCreateOrFail(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
