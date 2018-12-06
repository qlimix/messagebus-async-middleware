<?php declare(strict_types=1);

namespace Qlimix\MessageBus\MessageBus\Middleware;

use Qlimix\MessageBus\Message\AsynchronousMessage;
use Qlimix\MessageBus\MessageBus\Middleware\Exception\MiddlewareException;
use Qlimix\MessageBus\Queue\Envelope\AsyncEnvelope;
use Qlimix\Queue\Producer\ProducerInterface;

final class AsynchronousMiddleware implements MiddlewareInterface
{
    /** @var ProducerInterface */
    private $producer;

    /** @var string */
    private $route;

    /**
     * @param ProducerInterface $producer
     * @param string $route
     */
    public function __construct(ProducerInterface $producer, string $route)
    {
        $this->producer = $producer;
        $this->route = $route;
    }

    /**
     * @inheritDoc
     */
    public function handle($message, MiddlewareHandlerInterface $handler): void
    {
        if ($message instanceof AsynchronousMessage) {
           try {
               $this->producer->publish(new AsyncEnvelope($this->route, $message->getMessage()));
           } catch (\Throwable $exception) {
               throw new MiddlewareException('Could not handle message asynchronous', 0, $exception);
           }

           return;
        }

        $handler->next($message, $handler);
    }
}
