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

namespace App\Queue\Application;

use Interop\Container\ContainerInterface;

class IndexActionFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return IndexAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $queueService = $container->get('App\Queue\QueueService');
        return new IndexAction($queueService);
    }
}