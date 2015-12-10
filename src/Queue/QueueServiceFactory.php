<?php
/**
 * Docker for Developers Sample Application http://dockerfordevs.io
 *
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @link      https://github.com/dragonmantank/dockerfordevs-app for the canonical source repository
 * @copyright Copyright (c) 2015 Chris Tankersley
 * @license   See LICENSE
 */

namespace App\Queue;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class QueueServiceFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return QueueService
     */
    public function __invoke(ContainerInterface $container)
    {
        $dbAdapter = $container->get('Zend\Db\Adapter\Adapter');
        return new QueueService($dbAdapter);
    }
}