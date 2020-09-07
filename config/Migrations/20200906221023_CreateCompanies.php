<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateCompanies extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('companies', ['id' => false, 'primary_key' => 'id']);

        $table->addColumn('id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);

        $table->addColumn('name', 'string', [
            'limit' => 60,
            'default' => null,
            'null' => false,
        ]);

        $table->addColumn('cnpj', 'string', [
            'limit' => 14,
            'default' => null,
            'null' => false,
        ]);

        $table->addColumn('ie', 'string', [
            'limit' => 11,
            'default' => null,
            'null' => false,
        ]);

        $table->addColumn('address', 'string', [
            'limit' => 40,
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('city', 'string', [
            'limit' => 40,
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('state', 'string', [
            'limit' => 40,
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('active', 'boolean', [
            'default' => true,
            'null' => false,
        ]);

        $table->addTimestamps('created_at', 'modified_at');

        $table->create();
    }
}
