<?php

namespace Octava\Bundle\JobQueueBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Octava\Bundle\JobQueueBundle\Config;

/**
 * Class DefaultQueueCompiler
 * @package Octava\Bundle\JobQueueBundle\DependencyInjection\Compiler
 */
class DefaultQueueCompiler implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $options = $container->getParameter('jms_job_queue.queue_options');
        $config = $container->getDefinition(Config::class);
        if (!empty($options)) {
            $config->addArgument($options);
        }
        $container->setParameter('jms_job_queue.statistics', false);

        $queues = $container->get(Config::class)->getLockQueues();
        foreach ($queues as $queue) {
            $options[$queue] = ['max_concurrent_jobs' => 1];
        }
        $container->setParameter('jms_job_queue.queue_options', $options);
    }
}
