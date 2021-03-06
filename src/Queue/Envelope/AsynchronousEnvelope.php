<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Queue\Envelope;

use Qlimix\Queue\Envelope\EnvelopeInterface;
use Qlimix\Serializable\SerializableInterface;

final class AsynchronousEnvelope implements EnvelopeInterface
{
    private string $route;

    private SerializableInterface $message;

    public function __construct(string $route, SerializableInterface $message)
    {
        $this->route = $route;
        $this->message = $message;
    }

    /**
     * @inheritDoc
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @inheritDoc
     */
    public function getMessage(): SerializableInterface
    {
        return $this->message;
    }
}
