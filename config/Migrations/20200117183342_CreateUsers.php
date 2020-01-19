<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
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
        $table = $this->table('users', ['id' => false, 'primary_key' => 'id']);

        $table->addColumn('id', 'uuid');

        $table->addColumn('name', 'string', [
            'limit' => 50,
            'default' => null,
            'null' => false
        ]);

        $table->addColumn('last_name', 'string', [
            'limit' => 50,
            'default' => null,
            'null' => false
        ]);

        $table->addColumn('active', 'boolean', [
            'default' => true,
            'null' => 'true'
        ]);

        $table->addColumn('username', 'string', [
            'limit' => 60,
            'default' => null,
            'null' => false
        ]);

        $table->addColumn('password', 'string', [
            'default' => null,
            'null' => false
        ]);

        $table->addColumn('company_id', 'uuid', [
            'default' => null,
            'null' => true
        ]);

        $table->addColumn('role', 'string', [
            'limit' => 20,
            'default' => 'user',
            'null' => true
        ]);

        $table->addTimestamps('created_at', 'modified_at');
        $table->addIndex(['company_id']);
        $table->addIndex(['username'], [
            'unique' => true
        ]);
        $table->create();
    }
}
