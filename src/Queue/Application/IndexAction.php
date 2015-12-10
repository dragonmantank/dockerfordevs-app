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

use App\Queue\QueueService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Stratigility\MiddlewareInterface;

class IndexAction implements MiddlewareInterface
{
    /**
     * @var QueueService
     */
    protected $queueService;

    public function __construct(QueueService $queueService)
    {
        $this->queueService = $queueService;
    }

    public function get(ServerRequestInterface $request, ResponseInterface $response)
    {
        $queues = $this->queueService->fetchAll();
        $data = [];
        foreach ($queues as $queue) {
            $item = [
                '_links' => [
                    'self' => ['href' => '/api/v0/queue/' . $queue->getId()]
                ],
                'id' => $queue->getId(),
                'name' => $queue->getName(),
            ];
            $data[] = $item;
        }

        $response->getBody()->write(json_encode([
            'total' => count($queues),
            '_embedded' => [
                'queues' => $data,
            ],
        ]));

        return $response->withHeader('Content-Type', 'application/json');
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param callable|null $out
     *
     * @return \Psr\Http\Message\MessageInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $out = null)
    {
        if ($request->getMethod() == 'GET') {
            return $this->get($request, $response);
        } else if ($request->getMethod() == 'POST') {
            return $this->post($request, $response);
        }
    }

    public function post(ServerRequestInterface $request, ResponseInterface $response)
    {
        $data = $request->getParsedBody();
        $queue = QueueService::factory($data);
        $this->queueService->save($queue);

        $responseData = [
            '_links' => [
                'self' => [
                    '/api/v0/queue/' . $queue->getId(),
                ],
            ],
            'id' => $queue->getId(),
            'name' => $queue->getName(),
        ];

        $response->getBody()->write(json_encode($responseData));

        return $response->withHeader('Content-Type', 'application/json');
    }
}