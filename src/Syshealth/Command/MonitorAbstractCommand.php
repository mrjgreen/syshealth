<?php namespace Syshealth\Command;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

abstract class MonitorAbstractCommand extends Command
{
    const DEFAULT_INTERVAL = 10;

    /**
     * @var OutputInterface
     */
    protected $output;

    protected function configure()
    {
        $this
            ->setName(static::$commandName)
            ->setDescription('Collects system information and sends to the endpoint specified')
            ->addArgument('server-id', InputArgument::REQUIRED, 'The server id generated on the system interface')
            ->addArgument('endpoint', InputArgument::REQUIRED, 'The host address of the post data endpoint')
            ->addOption('parameters', 'a', InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED, 'An optional key:value set of parameters to pass in the request')
            ->addOption('secure','s', InputOption::VALUE_NONE, 'Use HTTPS to send the data')
            ->addOption('os','o', InputOption::VALUE_REQUIRED, 'The operating system driver to use linux/mac', 'linux')
            ->addOption('auth.user','u', InputOption::VALUE_REQUIRED, 'Use basic auth and authenticate with this user')
            ->addOption('auth.pass','p', InputOption::VALUE_REQUIRED, 'Password for basic authentication')
            ->addOption('interval','i', InputOption::VALUE_REQUIRED, 'The time to wait between each check', self::DEFAULT_INTERVAL)
        ;
    }
}