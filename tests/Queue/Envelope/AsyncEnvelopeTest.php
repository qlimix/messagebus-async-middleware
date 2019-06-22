<?php declare(strict_types=1);

namespace Qlimix\Tests\MessageBus\Queue\Envelope;

use PHPUnit\Framework\TestCase;
use Qlimix\MessageBus\Queue\Envelope\AsyncEnvelope;
use Qlimix\Serializable\SerializableInterface;

final class AsyncEnvelopeTest extends TestCase
{
    /**
     * @test
     */
    public function shouldDto(): void
    {
        $route = 'foo';
        $message = new class implements SerializableInterface {

            /** @var string  */
            private $foo = 'bar';
            public function getName(): string
            {
                return 'foobar';
            }

            public function serialize(): array
            {
            }

            public static function deserialize(array $data): SerializableInterface
            {
            }
        };

        $asyncEnvelope = new AsyncEnvelope($route, $message);

        $this->assertSame($route, $asyncEnvelope->getRoute());
        $this->assertSame($message, $asyncEnvelope->getMessage());
    }
}
