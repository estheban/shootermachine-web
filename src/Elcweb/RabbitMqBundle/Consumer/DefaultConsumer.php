<?php

namespace Elcweb\RabbitMqBundle\Consumer;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use JMS\Serializer\Serializer;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\EventDispatcher\GenericEvent;

class DefaultConsumer implements ConsumerInterface
{
    private $dispatcher, $serializer;

    public function __construct(EventDispatcherInterface $dispatcher, Serializer $serializer)
    {
        $this->dispatcher = $dispatcher;
        $this->serializer = $serializer;
    }

    public function execute(AMQPMessage $msg)
    {
        //$msg will be an instance of `PhpAmqpLib\Message\AMQPMessage` with the $msg->body being the data sent over RabbitMQ.
        echo ("Event: ".$msg->get('routing_key').PHP_EOL);

        $routingKey = $msg->get('routing_key');

        if ($this->dispatcher->hasListeners($routingKey) && $routingKey != '') {
            $data = $this->serializer->deserialize($msg->body, 'array', 'json');

            var_dump($data);

            $this->dispatcher->dispatch($routingKey, new GenericEvent($routingKey, $data));

            return true;
        }

        return false;
    }
}
