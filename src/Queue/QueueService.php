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

class QueueService
{
    /**
     * @var \Zend\Db\Adapter\Adapter
     */
    protected $dbAdapter;

    public function __construct($dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
    }

    static function factory($data)
    {
        return new Queue($data);
    }

    public function fetchAll()
    {
        $statement = $this->dbAdapter->query('SELECT * FROM `queues`');
        $result = $statement->execute();

        $data = [];
        foreach ($result as $row) {
            $data[] = new Queue($row);
        }

        return $data;
    }

    public function save(Queue $queue)
    {
        if ($queue->getId()) {
            $query = $this->dbAdapter->query('UPDATE `queues` SET `name` = :name WHERE `id = :id`');
            $query->execute($queue->getArrayCopy());
        } else {
            $query = $this->dbAdapter->query("INSERT INTO `queues` (`name`) VALUES (:name)");
            $query->execute(['name' => $queue->getName()]);
            $queue->setId($this->dbAdapter->getDriver()->getLastGeneratedValue());
        }

        return $queue;
    }
}