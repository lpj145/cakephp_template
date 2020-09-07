<?php
declare(strict_types=1);

namespace App\Command;

use App\Model\Table\UsersTable;
use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;

/**
 * CreateUser command.
 */
class CreateUserCommand extends Command
{
    /**
     * @var UsersTable
     */
    protected $Users;

    public function initialize(): void
    {
        $this->Users = $this->loadModel('Users');
    }

    /**
     * Hook method for defining this command's option parser.
     *
     * @see https://book.cakephp.org/3.0/en/console-and-shells/commands.html#defining-arguments-and-options
     *
     * @param \Cake\Console\ConsoleOptionParser $parser The parser to be defined
     * @return \Cake\Console\ConsoleOptionParser The built parser.
     */
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser->addArgument('name', [
            'help' => 'Name of user',
            'required' => true
        ]);
        $parser->addArgument('last_name', [
            'help' => 'Last name of user',
            'required' => true
        ]);
        $parser->addArgument('username', [
            'help' => 'username of user',
            'required' => true
        ]);
        $parser->addArgument('password', [
            'help' => 'password are so strong',
            'required' => true
        ]);
        $parser->addArgument('role', [
            'help' => 'role of user',
            'required' => false
        ]);

        return $parser;
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return null|void|int The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $io->success('Tentando criar usuário...');
        $entity = $this->Users->newEntity([
            'name' => $args->getArgument('name'),
            'last_name' => $args->getArgument('last_name'),
            'username' => $args->getArgument('username'),
            'password' => $args->getArgument('password'),
            'role' => $args->getArgument('role'),
        ]);

        if ($entity->hasErrors()) {
            $io->error($entity->getInvalid());
            $io->error($entity->getErrors());
        }

        $this->Users->saveOrFail($entity);
        $io->success(
            sprintf('Usuário %s criado com sucesso, bem vindo %s', $entity->username, $entity->name)
        );
    }
}
