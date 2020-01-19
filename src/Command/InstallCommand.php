<?php
declare(strict_types=1);

namespace App\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Migrations\Migrations;

/**
 * Install command.
 */
class InstallCommand extends Command
{
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
        $parser = parent::buildOptionParser($parser);

        return $parser;
    }

    /**
     * Sempre que um deploy for feito num servidor, esse deve ser o primeiro comando a ser executado
     * Esse comando fará a execução das migrações e algumas configurações, bem como se necessário
     * a inicialização de algumas informações no banco de dados.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return null|void|int The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $io->info('Criando banco de dados...');
        $migrateCommand = new Migrations();
        if (!$migrateCommand->migrate()) {
            $io->error('Não foi possível criar o banco de dados, por favor, verifique os logs.');
            return null;
        }
        $io->success('Banco de dados criado e atualizado com sucesso!');
    }
}
