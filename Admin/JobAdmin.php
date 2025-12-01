<?php

namespace Octava\Bundle\JobQueueBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollectionInterface;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Class JobAdmin
 * @package Octava\Bundle\JobQueueBundle\Admin
 */
class JobAdmin extends AbstractAdmin
{
    /**
     * @inheritDoc
     */
    protected function configureDefaultSortValues(array &$sortValues): void
    {
        $sortValues += [
            '_page' => 1,
            '_sort_order' => 'DESC',
            '_sort_by' => 'createdAt',
        ];
    }

    /**
     * @inheritDoc
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id', null, ['label' => 'admin.id'])
            ->add('state', null, ['label' => 'admin.state'])
            ->add('queue', null, ['label' => 'admin.queue'])
            ->add('priority', null, ['label' => 'admin.priority'])
            ->add('workerName', null, ['label' => 'admin.worker_name'])
            ->add('command', null, ['label' => 'admin.command'])
            ->add('exitCode', null, ['label' => 'admin.exit_code']);
    }

    /**
     * @inheritDoc
     */
    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add(
                'id',
                'string',
                [
                    'label' => 'admin.id'
                ]
            )
            ->add('state', null, ['label' => 'admin.state'])
            ->add('queue', null, ['label' => 'admin.queue'])
            ->add('priority', null, ['label' => 'admin.priority'])
            ->add('createdAt', null, ['label' => 'admin.created_at'])
            ->add('startedAt', null, ['label' => 'admin.started_at'])
            ->add('checkedAt', null, ['label' => 'admin.checked_at'])
            ->add('workerName', null, ['label' => 'admin.worker_name'])
            ->add('executeAfter', null, ['label' => 'admin.execute_after'])
            ->add('closedAt', null, ['label' => 'admin.closed_at'])
            ->add('command', null, ['label' => 'admin.command'])
            ->add('exitCode', null, ['label' => 'admin.exit_code'])
            ->add('maxRuntime', null, ['label' => 'admin.max_runtime'])
            ->add('maxRetries', null, ['label' => 'admin.max_retries'])
            ->add('runtime', null, ['label' => 'admin.runtime'])
            ->add(
                'memoryUsage',
                'string',
                [
                    'label' => 'admin.memory_usage',
                    'row_align' => 'right'
                ]
            )
            ->add(
                'memoryUsageReal',
                'string',
                [
                    'label' => 'admin.memory_usage_real',
                    'row_align' => 'right'
                ]
            )
            ->add(
                ListMapper::NAME_ACTIONS,
                null,
                [
                    'actions' => [
                        'show' => [],
                        'delete' => [],
                    ],
                ]
            );
    }

    /**
     * @inheritDoc
     */
    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->with(
                'job',
                [
                    'label' => 'admin.queue',
                ]
            )
            ->add('id', null, ['label' => 'admin.id'])
            ->add('state', null, ['label' => 'admin.state'])
            ->add('queue', null, ['label' => 'admin.queue'])
            ->add('priority', null, ['label' => 'admin.priority'])
            ->add('createdAt', null, ['label' => 'admin.created_at'])
            ->add('startedAt', null, ['label' => 'admin.started_at'])
            ->add('checkedAt', null, ['label' => 'admin.checked_at'])
            ->add('workerName', null, ['label' => 'admin.worker_name'])
            ->add('executeAfter', null, ['label' => 'admin.execute_after'])
            ->add('closedAt', null, ['label' => 'admin.closed_at'])
            ->add('command', null, ['label' => 'admin.command'])
            ->add('args', 'array', ['label' => 'admin.args'])
            ->add('output', null, ['label' => 'admin.output'])
            ->add('errorOutput', null, ['label' => 'admin.error_output'])
            ->add('exitCode', null, ['label' => 'admin.exit_code'])
            ->add('maxRuntime', null, ['label' => 'admin.max_runtime'])
            ->add('maxRetries', null, ['label' => 'admin.max_retries'])
            ->add('stackTrace', null, ['label' => 'admin.stack_trace'])
            ->add('runtime', null, ['label' => 'admin.runtime'])
            ->add(
                'memoryUsage',
                'string',
                [
                    'label' => 'admin.memory_usage',
                    'row_align' => 'right'
                ]
            )
            ->add(
                'memoryUsageReal',
                'string',
                [
                    'label' => 'admin.memory_usage_real',
                    'row_align' => 'right'
                ]
            )
            ->end()
        ;
    }

    /**
     * @inheritDoc
     */
    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        parent::configureRoutes($collection);
        $collection->remove('create');
        $collection->remove('edit');
    }
}
