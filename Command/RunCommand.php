<?php

namespace Octava\Bundle\JobQueueBundle\Command;

use JMS\JobQueueBundle\Command\RunCommand as BaseRunCommand;
use JMS\JobQueueBundle\Entity\Repository\JobManager;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Octava\Bundle\JobQueueBundle\Config;

/**
 * Class RunCommand
 * @package Octava\Bundle\JobQueueBundle\Command
 */
class RunCommand extends BaseRunCommand
{
    /**
     * @var Config
     */
    private $config;

    public function __construct(
        Config $config,
        ManagerRegistry $managerRegistry,
        JobManager $jobManager,
        EventDispatcherInterface $dispatcher,
        array $queueOptionsDefault,
        array $queueOptions
    ) {
        $this->config = $config;
        parent::__construct($managerRegistry, $jobManager, $dispatcher, $queueOptionsDefault, $queueOptions);
    }

    public function run(InputInterface $input, OutputInterface $output): int
    {
        $input->setOption(
            'queue',
            $this->config->getRestrictedQueues()
        );

        return parent::run($input, $output);
    }

    protected function configure(): void
    {
        parent::configure();
        $this->setName('octava-job-queue:run');
    }
}
