<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CompaniesFixture
 */
class CompaniesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 60, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null],
        'cnpj' => ['type' => 'string', 'length' => 14, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null],
        'ie' => ['type' => 'string', 'length' => 11, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null],
        'address' => ['type' => 'string', 'length' => 40, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null],
        'city' => ['type' => 'string', 'length' => 40, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null],
        'state' => ['type' => 'string', 'length' => 40, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null],
        'active' => ['type' => 'boolean', 'length' => null, 'default' => 1, 'null' => false, 'comment' => null, 'precision' => null],
        'created_at' => ['type' => 'timestampfractional', 'length' => null, 'default' => 'CURRENT_TIMESTAMP', 'null' => false, 'comment' => null, 'precision' => 6],
        'modified_at' => ['type' => 'timestampfractional', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => 6],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => '75f17044-8b99-47d7-bfae-9e08384cd370',
                'name' => 'Lorem ipsum dolor sit amet',
                'cnpj' => 'Lorem ipsum ',
                'ie' => 'Lorem ips',
                'address' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'state' => 'Lorem ipsum dolor sit amet',
                'active' => 1,
                'created_at' => 1599432646,
                'modified_at' => 1599432646,
            ],
        ];
        parent::init();
    }
}
