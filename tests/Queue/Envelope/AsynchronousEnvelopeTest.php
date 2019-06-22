<?php declare(strict_types=1);

namespace Qlimix\Tests\MessageBus\Queue\Envelope;

use PHPUnit\Framework\TestCase;
use Qlimix\MessageBus\Queue\Envelope\AsynchronousEnvelope;
use Qlimix\Serializable\SerializableInterface;

final class AsynchronousEnvelopeTest extends TestCase
{
    /**
     * @test
     */
    public function shouldDto(): void
    {
        $route = 'foo';
        $message = new class implements SerializableInterface {
            public function getName(): string
            {
            }

            public function serialize(): array
            {
            }

            public static function deserialize(array $data): SerializableInterface
            {
            }
        };

        $asyncEnvelope = new AsynchronousEnvelope($route, $message);

        $this->assertSame($route, $asyncEnvelope->getRoute());
        $this->assertSame($message, $asyncEnvelope->getMessage());
    }
}
