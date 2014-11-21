<?php namespace Syshealth\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MonitorStartCommand extends MonitorAbstractCommand
{
    public static $commandName = 'start';

    protected function configure()
    {
        parent::configure();

        $this
            ->setDescription('Starts the system info collection daemon')
            ->addOption('pidfile', null, InputOption::VALUE_REQUIRED, 'The name of the pid file to use', CommandPid::PID_FILE)
            ->addOption('logfile', null, InputOption::VALUE_REQUIRED, 'Log output to file')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getOption('pidfile');


        if($runningPid = $this->isRunning($file))
        {
            $output->writeln('<comment>Already running with PID: ' . $runningPid . '</comment>');

            return;
        }

        if(!$this->writePid($file, ''))
        {
            $output->writeln('<comment>PID file ' . CommandPid::PID_FILE . ' could not be written. Permissions?</comment>');
            die();
        }

        $string = sprintf('%s %s', $input->getArgument('server-id'), $input->getArgument('endpoint'));

        if($input->getOption('secure'))
        {
            $string .= ' --secure';
        }

        if($authUser = $input->getOption('auth.user'))
        {
            $string .= ' --auth.user ' . $authUser;
            $string .= ' --auth.pass ' . $input->getOption('auth.pass');
        }

        if($system = $input->getOption('os'))
        {
            $string .= ' --os ' . $system;
        }

        if($interval = $input->getOption('interval'))
        {
            $string .= ' --interval ' . $interval;
        }

        foreach($input->getOption('parameters') as $param)
        {
            $string .= ' --parameters ' . $param;
        }

        $string = $_SERVER['argv'][0] . ' run ' . $string;

        $logfile = '/dev/null';

        if($input->getOption('logfile'))
        {
            $logfile = $input->getOption('logfile');

            if(!touch($logfile))
            {
                $output->writeln('<comment>Logfile ' . $logfile . ' could not be created. Permissions?</comment>');
                die();
            }
        }

        $command = "$string > $logfile 2>&1 & echo $!";

        $processId = exec($command);

        $this->writePid($file, $processId);

        $output->writeln('<info>Daemon started with PID: ' . $processId . '</info>');

    }

    private function isRunning($file)
    {
        if($processId = @file_get_contents($file))
        {
            return posix_kill($processId, SIG_DFL) ? $processId : false;
        }

        return false;
    }

    private function writePid($file, $pid)
    {
        return @file_put_contents($file, $pid) !== false;
    }
}