<?php namespace Syshealth\Command;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
class MonitorStopCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('stop')
            ->addOption('pidfile', null, InputOption::VALUE_REQUIRED, 'The Name of the pid file to use', CommandPid::PID_FILE)
            ->setDescription('Stops the daemon')
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

        $pid = @file_get_contents($file);

        if($pid)
        {
            if(posix_kill($pid, SIGTERM))
            {
                $output->writeln('<comment>Process killed with PID: ' . $pid . '</comment>');
            }
            else
            {
                $output->writeln('<comment>No process killed with PID: ' . $pid . '</comment>');
            }
        }
        else
        {
            $output->writeln('<comment>PID not found</comment>');
        }

        @file_put_contents($file, '');
    }
}