<?php declare(strict_types=1);

namespace Qlimix\MessageBus\MessageBus\Middleware;

use Qlimix\MessageBus\MessageBus\Middleware\Exception\MiddlewareException;
use Qlimix\MessageBus\Queue\Envelope\AsynchronousEnvelope;
use Qlimix\Queue\Producer\ProducerInterface;
use Qlimix\Serializable\SerializableInterface;
use Throwable;

final class AsynchronousMiddleware implements MiddlewareInterface
{
    /** @var ProducerInterface */
    private $producer;

    /** @var string */
    private $route;

    public function __construct(ProducerInterface $producer, string $route)
    {
        $this->producer = $producer;
        $this->route = $route;
    }

    /**
     * @inheritDoc
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
     */
    public function handle($message, MiddlewareHandlerInterface $handler): void
    {
        if (!$message instanceof SerializableInterface) {
            throw new MiddlewareException('Forced async has to be an serializable message');
        }

        try {
            $this->producer->publish(new AsynchronousEnvelope($this->route, $message));
        } catch (Throwable $exception) {
            throw new MiddlewareException('Could not handle message asynchronous', 0, $exception);
        }
    }
}
