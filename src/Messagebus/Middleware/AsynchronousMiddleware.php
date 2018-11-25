<?php declare(strict_types=1);

namespace Qlimix\MessageBus\MessageBus\Middleware;

use Qlimix\Id\Generator\UUID\UUID4Generator;
use Qlimix\MessageBus\Message\AsynchronousMessage;
use Qlimix\MessageBus\MessageBus\Middleware\Exception\MiddlewareException;
use Qlimix\MessageBus\Queue\Envelope\AsyncEnvelope;
use Qlimix\MessageBus\Queue\Message\AsyncMessage;
use Qlimix\Queue\Producer\ProducerInterface;

final class AsynchronousMiddleware implements MiddlewareInterface
{
    /** @var ProducerInterface */
    private $producer;

    /** @var UUID4Generator */
    private $uuid4Generator;

    /**
     * @param ProducerInterface $producer
     * @param UUID4Generator $uuid4Generator
     */
    public function __construct(ProducerInterface $producer, UUID4Generator $uuid4Generator)
    {
        $this->producer = $producer;
        $this->uuid4Generator = $uuid4Generator;
    }

    /**
     * @inheritDoc
     */
    public function handle($message, MiddlewareHandlerInterface $handler): void
    {
        if ($message instanceof AsynchronousMessage) {
           try {
               $this->producer->publish(new AsyncEnvelope(
                   new AsyncMessage(
                       $this->uuid4Generator->generate()->getUuid4(),
                       $message->getMessage()->serialize()
                   )
               ));
           } catch (\Throwable $exception) {
               throw new MiddlewareException('Could not handle message asynchronous', 0, $exception);
           }

           return;
        }

        $handler->next($message, $handler);
    }
}
