<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
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
        $table = $this->table('users', ['id' => false, 'primary_key' => 'id']);

        $table->addColumn('id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);

        $table->addColumn('name', 'string', [
            'limit' => 30,
            'default' => null,
            'null' => false,
        ]);

        $table->addColumn('last_name', 'string', [
            'limit' => 30,
            'default' => null,
            'null' => false,
        ]);

        $table->addColumn('username', 'string', [
            'limit' => 80,
            'default' => null,
            'null' => false,
        ]);

        $table->addColumn('password', 'string', [
            'default' => null,
            'null' => false,
        ]);

        $table->addColumn('api_token', 'string', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('role', 'string', [
            'default' => 'user',
            'null' => true,
        ]);

        $table->addColumn('company_id', 'uuid', [
            'default' => null,
            'null' => true,
        ]);

        $table->addIndex(['api_token', 'name']);

        $table->addIndex(['username'], ['unique' => true]);

        $table->create();
    }
}
