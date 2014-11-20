<?php namespace Syshealth\Command;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Syshealth\JsonFormatter;
use Syshealth\Request;
use Syshealth\System\Linux;
use Syshealth\System\Mac;
use Syshealth\System\SystemInterface;

class MonitorSystemCommand extends Command
{
    const DEFAULT_INTERVAL = 10;

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * @var JsonFormatter
     */
    protected $formatter;

    /**
     * @var Request
     */
    protected $request;

    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('run')
            ->setDescription('Collects system information and sends to the endpoint specified')
            ->addArgument('server-id', InputArgument::REQUIRED, 'The server id generated on the system interface')
            ->addArgument('endpoint', InputArgument::REQUIRED, 'The host address of the post data endpoint')
            ->addOption('secure','s', InputOption::VALUE_NONE, 'Use HTTPS to send the data')
            ->addOption('os','o', InputOption::VALUE_REQUIRED, 'The operating system driver to use linux/mac', 'linux')
            ->addOption('auth.user','u', InputOption::VALUE_REQUIRED, 'Use basic auth and authenticate with this user')
            ->addOption('auth.pass','p', InputOption::VALUE_REQUIRED, 'Password for basic authentication')
            ->addOption('interval','i', InputOption::VALUE_REQUIRED, 'The time to wait between each check', self::DEFAULT_INTERVAL)
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;

        $this->formatter = new JsonFormatter();

        $this->request = new Request($input->getArgument('endpoint'), $input->getOption('secure'));

        if($authUser = $input->getOption('auth.user'))
        {
            $this->request->useBasicAuth($authUser, $input->getOption('auth.pass'));
        }

        $system = $this->getSystemDriver($input->getOption('os'));

        while(1)
        {
            try {
                $systemDetail = $this->runSystemCheck($system);

                $this->postData($systemDetail, $input->getArgument('server-id'), $input->getArgument('endpoint'));
            }
            catch(\Exception $e)
            {
                $output->write('<comment>' . $e->getMessage() . '</comment>');
            }

            sleep($input->getOption('interval'));
        }
    }

    /**
     * @param SystemInterface $system
     * @return \Syshealth\System\Entity\SystemEntity
     */
    private function runSystemCheck(SystemInterface $system)
    {
        return $system->getSystemStatus();
    }

    /**
     * @param $data
     * @param $serverId
     * @throws \Syshealth\RequestCurlException
     * @throws \Syshealth\RequestHttpException
     */
    private function postData($data, $serverId)
    {
        $data = $this->formatter->format($data);

        $this->request->post($serverId, array('data' => $data));

        if($this->output->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE)
        {
            $this->output->writeln($serverId);
            $this->output->writeln($data);
        }
    }

    /**
     * @param $option
     * @return Linux|Mac
     */
    private function getSystemDriver($option)
    {
        return ($option === 'mac') ? new Mac() : new Linux();
    }
}