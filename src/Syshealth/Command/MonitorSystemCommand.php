<?php namespace Syshealth\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Syshealth\JsonFormatter;
use Syshealth\Request;
use Syshealth\System\Linux;
use Syshealth\System\Mac;
use Syshealth\System\SystemInterface;

class MonitorSystemCommand extends MonitorAbstractCommand
{
    protected static $commandName = 'run';

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

        $parameters = $this->parseParameters($input->getOption('parameters'));

        while(1)
        {
            try {
                $systemDetail = $this->runSystemCheck($system);

                $this->postData($systemDetail, $input->getArgument('server-id'), $parameters);
            }
            catch(\Exception $e)
            {
                $output->write('<comment>' . $e->getMessage() . '</comment>');
            }

            sleep($input->getOption('interval'));
        }
    }

    /**
     * @param array $params
     * @return array
     */
    private function parseParameters(array $params)
    {
        $paramsFinal = array();

        foreach($params as $param)
        {
            $parts = explode(':', $param, 2);

            if(count($parts) === 2)
            {
                $paramsFinal[$parts[0]] = $parts[1];
            }
        }

        return $paramsFinal;
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
    private function postData($data, $serverId, array $parameters)
    {
        $data = $this->formatter->format($data);

        $payLoad = array(
            'id' => $serverId,
            'data' => $data
        ) + $parameters;

        $this->request->post($payLoad);

        if($this->output->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE)
        {
            $this->output->writeln($payLoad);
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