<?php namespace Syshealth\Command;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MonitorSelfUpdateCommand extends Command
{
    const SOURCE = 'https://github.com/mrjgreen/syshealth/blob/master/build/appmonitor-agent.phar?raw=true';

    protected function configure()
    {
        $this
            ->setName('update')
            ->setDescription('Updates the file')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = @file_get_contents(self::SOURCE);

        $oldFile = @file_get_contents(__FILE__);

        if($file === $oldFile)
        {
            $output->writeln('<comment>Nothing to update</comment>');

            return;
        }

        if($file)
        {
            if(@file_put_contents(__FILE__, $file) !== false)
            {
                $output->writeln('<info>File updated to latest version</info>');
            }
            else
            {
                $output->writeln('<comment>Update could not be written to ' . __FILE__ . '</comment>');
            }
        }
        else
        {
            $output->writeln('<comment>Update could not be downloaded</comment>');
        }
    }
}