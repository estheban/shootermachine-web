<?php

namespace Elcweb\RabbitMqBundle\Producer;

use JMS\Serializer\Serializer;
use OldSound\RabbitMqBundle\RabbitMq\Producer;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultProducer implements ProducerInterface
{
    private $context, $dispatcher, $serializer, $rabbitmq;

    public function __construct(SecurityContext $context, EventDispatcherInterface $dispatcher, Serializer $serializer, Producer $rabbitmq)
    {
        $this->context    = $context;
        $this->dispatcher = $dispatcher;
        $this->serializer = $serializer;
        $this->rabbitmq   = $rabbitmq;
        $this->rabbitmq->setContentType('application/json');
    }

    public function dispatch($routingKey, $data)
    {
        // TODO: publish to event_log queue for logging.

        return $this->dispatcher->dispatch($routingKey, new GenericEvent($routingKey, $data));
    }

    public function publish($routingKey, $data)
    {
        $data = $this->prepareData($data);

        $this->rabbitmq->publish($this->serializer->serialize($data, 'json'), $routingKey);
    }

    private function prepareData($data)
    {
        $token = $this->context->getToken();
        if ($token) {
            $username = $token->getUser()->getUsername();
        } else {
            $username = "cli";
        }

        $data['username'] = $username;

        return $data;
    }
}
