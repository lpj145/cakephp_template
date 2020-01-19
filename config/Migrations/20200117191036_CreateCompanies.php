<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateCompanies extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('companies', ['id' => false, 'primary_key' => 'id']);

        $table->addColumn('id', 'uuid', [
            'default' => null,
            'null' => false
        ]);

        $table->addColumn('name', 'string', [
            'default' => null,
            'null' => false
        ]);

        $table->addColumn('active', 'boolean', [
            'default' => true,
            'null' => true
        ]);

        $table->addColumn('description', 'text', [
            'default' => null,
            'null' => true
        ]);

        $table->addTimestamps('created_at', 'modified_at');

        $table->addIndex(['name']);
        $table->create();
    }
}
