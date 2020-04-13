<?php declare(strict_types=1);

namespace Qlimix\Tests\MessageBus\MessageBus\Middleware;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Qlimix\MessageBus\MessageBus\Middleware\AsynchronousMiddleware;
use Qlimix\MessageBus\MessageBus\Middleware\Exception\MiddlewareException;
use Qlimix\MessageBus\MessageBus\Middleware\MiddlewareHandlerInterface;
use Qlimix\Queue\Producer\Exception\ProducerException;
use Qlimix\Queue\Producer\ProducerInterface;
use Qlimix\Serializable\SerializableInterface;

final class AsynchronousMiddlewareTest extends TestCase
{
    private MockObject $producer;

    private AsynchronousMiddleware $asyncMiddleware;

    protected function setUp(): void
    {
        $this->producer = $this->createMock(ProducerInterface::class);
        $this->asyncMiddleware = new AsynchronousMiddleware($this->producer, 'foo');
    }

    public function testShouldHandleAsynchronous(): void
    {
        $this->producer->expects($this->once())
            ->method('publish');

        $this->asyncMiddleware->handle(
            $this->createMock(SerializableInterface::class),
            $this->createMock(MiddlewareHandlerInterface::class)
        );
    }

    public function testShouldThrowOnNoneSerializable(): void
    {
        $this->expectException(MiddlewareException::class);

        $this->asyncMiddleware->handle(
            'foobar',
            $this->createMock(MiddlewareHandlerInterface::class)
        );
    }

    public function testShouldThrowOnDispatchFailure(): void
    {
        $this->producer->expects($this->once())
            ->method('publish')
            ->willThrowException(new ProducerException());

        $this->expectException(MiddlewareException::class);

        $this->asyncMiddleware->handle(
            $this->createMock(SerializableInterface::class),
            $this->createMock(MiddlewareHandlerInterface::class)
        );
    }
}
