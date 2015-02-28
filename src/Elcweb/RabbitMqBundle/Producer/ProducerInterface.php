<?php

namespace Elcweb\RabbitMqBundle\Producer;


interface ProducerInterface
{
    public function dispatch($routingKey, $data);

    public function publish($routingKey, $data);
}
